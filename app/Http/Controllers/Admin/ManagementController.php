<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Management;
use App\Http\Requests\ManagementRequest;
use App\Support\PublicStorage;
use Illuminate\Support\Collection;

class ManagementController extends Controller
{
    public function index()
    {
        $managements = Management::with('translations')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.management.index', compact('managements'));
    }

    public function create()
    {
        return view('dashboard.management.createOrUpdate');
    }

    public function store(ManagementRequest $request)
    {
        // ✅ Upload photo
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = PublicStorage::put($request->file('photo'), 'managements');
        }

        // ✅ Create main record
        $management = Management::create([
            'photo' => $photo,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position, // enum
            'type' => $request->type,
            'order' => $this->nextOrder($request->type),
        ]);

        // ✅ Create translations
        $management->translations()->createMany([
            [
                'locale' => 'ar',
                'name' => $request->name_ar,
                'bio' => $request->bio_ar,
            ],
            [
                'locale' => 'fr',
                'name' => $request->name_fr,
                'bio' => $request->bio_fr,
            ],
        ]);

        return redirect()->route('managements.index')
            ->with('success', 'Created successfully');
    }

    public function edit($id)
    {
        $management = Management::with('translations')->findOrFail($id);

        // ✅ Get translations safely
        $ar = $management->translations->firstWhere('locale', 'ar');
        $fr = $management->translations->firstWhere('locale', 'fr');

        return view('dashboard.management.createOrUpdate', compact('management', 'ar', 'fr'));
    }

    public function update(ManagementRequest $request, $id)
    {
        $management = Management::findOrFail($id);
        $shouldAssignOrder = $management->order <= 0
            || $management->type !== $request->type;

        // ✅ Update photo if exists
        if ($request->hasFile('photo')) {
            PublicStorage::delete($management->photo);
            $management->photo = PublicStorage::put($request->file('photo'), 'managements');
        }

        // ✅ Update main fields
        $data = [
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'type' => $request->type,
            'photo' => $management->photo,
        ];

        if ($shouldAssignOrder) {
            $data['order'] = $this->nextOrder($request->type, $management->parent_id, $management->id);
        }

        $management->update($data);

        // ❗ FIXED: correct updateOrCreate (DO NOT use translation())
        foreach (['ar', 'fr'] as $locale) {
            $management->translations()->updateOrCreate(
                [
                    'management_id' => $management->id,
                    'locale' => $locale
                ],
                [
                    'name' => $request->input("name_$locale"),
                    'bio'  => $request->input("bio_$locale"),
                ]
            );
        }

        return redirect()->route('managements.index')
            ->with('success', 'Updated successfully');
    }

    public function destroy($id)
    {
        $management = Management::findOrFail($id);
        PublicStorage::delete($management->photo);
        $management->delete();

        return redirect()->route('managements.index')
            ->with('success', 'Deleted successfully');
    }
    public function showManagement()
    {
        $tree = Management::whereNull('parent_id')
            ->where('type', 'current')
            ->with('allChildren.translations', 'translations')
            ->orderBy('order')
            ->get();

        $currentMembers = self::flattenTree($tree)
            ->sortBy([
                fn($a, $b) => (Management::positionOrder()[$a->position] ?? 99) <=> (Management::positionOrder()[$b->position] ?? 99),
                fn($a, $b) => $a->order <=> $b->order,
            ])
            ->values();

        $honoraryMembers = Management::where('type', 'honorary')
            ->with('translations')
            ->orderBy('order')
            ->get();

        $advisoryMembers = Management::where('type', 'consultant')
            ->with('translations')
            ->orderBy('order')
            ->get();

        $formerMembers = Management::where('type', 'former')
            ->with('translations')
            ->orderByDesc('date_to')
            ->orderBy('order')
            ->get();

        return view('Management.index', compact(
            'currentMembers',
            'honoraryMembers',
            'advisoryMembers',
            'formerMembers'
        ));
    }

    /** Flatten the entire tree into a single collection */
    public static function flattenTree(Collection $nodes): Collection
    {
        return $nodes->flatMap(function ($node) {
            return collect([$node])->merge(
                self::flattenTree($node->allChildren)
            );
        });
    }

    private function nextOrder(string $type, ?int $parentId = null, ?int $ignoreId = null): int
    {
        return Management::query()
            ->where('type', $type)
            ->where('parent_id', $parentId)
            ->when($ignoreId, fn($query) => $query->whereKeyNot($ignoreId))
            ->max('order') + 1;
    }
}
