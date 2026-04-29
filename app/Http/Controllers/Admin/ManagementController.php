<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Management;
use App\Http\Requests\ManagementRequest;
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
            $photo = $request->file('photo')->store('managements', 'public');
        }

        // ✅ Create main record
        $management = Management::create([
            'photo' => $photo,
            'email' => $request->email,
            'position' => $request->position, // enum
            'type' => $request->type,
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

        // ✅ Update photo if exists
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('managements', 'public');
            $management->photo = $photo;
        }

        // ✅ Update main fields
        $management->update([
            'email' => $request->email,
            'position' => $request->position,
            'type' => $request->type,
        ]);

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
        $management->delete();

        return redirect()->route('managements.index')
            ->with('success', 'Deleted successfully');
    }
    public function showManagement()
    {
        $tree = Management::whereNull('parent_id')
            ->with('allChildren.translations', 'translations')
            ->orderBy('order')
            ->where('type', 'current')
            ->get();

        return view('management.index', compact('tree'));
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
}
