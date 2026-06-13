<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\MemberTranslation;
use App\Services\AutoTranslateService;
use App\Support\PublicStorage;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locale = $this->currentLocale();
        [$firstFallback, $secondFallback] = $this->fallbackLocales($locale);

        $members = Member::with(['translations', 'documents'])
            ->orderBy(
                MemberTranslation::select('name')
                    ->whereColumn('member_translations.member_id', 'members.id')
                    ->where('locale', $locale)
                    ->limit(1)
            )
            ->orderBy(
                MemberTranslation::select('name')
                    ->whereColumn('member_translations.member_id', 'members.id')
                    ->where('locale', $firstFallback)
                    ->limit(1)
            )
            ->orderBy(
                MemberTranslation::select('name')
                    ->whereColumn('member_translations.member_id', 'members.id')
                    ->where('locale', $secondFallback)
                    ->limit(1)
            )
            ->paginate(10);
        // dd($members);
        return view('dashboard.members.index', compact('members'));
    }

    // show the members to the public
    public function showMembers()
    {
        $locale = $this->currentLocale();
        [$firstFallback, $secondFallback] = $this->fallbackLocales($locale);

        $members = Member::with(['translations'])
            ->orderBy(
                MemberTranslation::select('name')
                    ->whereColumn('member_translations.member_id', 'members.id')
                    ->where('locale', $locale)
                    ->limit(1)
            )
            ->orderBy(
                MemberTranslation::select('name')
                    ->whereColumn('member_translations.member_id', 'members.id')
                    ->where('locale', $firstFallback)
                    ->limit(1)
            )
            ->orderBy(
                MemberTranslation::select('name')
                    ->whereColumn('member_translations.member_id', 'members.id')
                    ->where('locale', $secondFallback)
                    ->limit(1)
            )
            ->paginate(12);

        $memberProfiles = $members->getCollection()->map(function (Member $member) use ($locale, $firstFallback, $secondFallback) {
            $translation = $member->translations->firstWhere('locale', $locale)
                ?: $member->translations->firstWhere('locale', $firstFallback)
                ?: $member->translations->firstWhere('locale', $secondFallback);

            return [
                'id' => $member->id,
                'email' => $member->email,
                'phone' => $member->phone,
                'photo' => $member->photo,
                'cv' => $member->cv,
                'translation' => [
                    'locale' => $translation?->locale,
                    'name' => $translation?->name,
                    'specialization' => $translation?->specialization,
                    'degree' => $translation?->degree,
                    'graduation_university' => $translation?->graduation_university,
                    'current_job' => $translation?->current_job,
                    'workplace' => $translation?->workplace,
                    'interests' => $translation?->interests,
                    'bio' => $translation?->bio,
                ],
            ];
        });

        $members->setCollection($memberProfiles);

        return view('members', compact('members', 'locale'));
    }

    private function currentLocale(): string
    {
        $locale = app()->getLocale();

        return in_array($locale, ['en', 'ar', 'fr'], true) ? $locale : 'fr';
    }

    private function fallbackLocales(string $locale): array
    {
        return array_values(array_diff(['en', 'ar', 'fr'], [$locale]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $member->load('translations');
        $translationsByLocale = $member->translations->keyBy('locale');

        return view('dashboard.members.edit', compact('member', 'translationsByLocale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:30',
            'status' => 'required|in:pending,approved,rejected',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:8192',
            'translations' => 'required|array',
            'translations.en.name' => 'required|string|max:255',
            'translations.en.specialization' => 'nullable|string|max:255',
            'translations.en.degree' => 'nullable|string|max:255',
            'translations.en.graduation_university' => 'nullable|string|max:255',
            'translations.en.current_job' => 'nullable|string|max:255',
            'translations.en.workplace' => 'nullable|string|max:255',
            'translations.en.interests' => 'nullable|string',
            'translations.en.bio' => 'nullable|string',
            'translations.ar.name' => 'required|string|max:255',
            'translations.ar.specialization' => 'nullable|string|max:255',
            'translations.ar.degree' => 'nullable|string|max:255',
            'translations.ar.graduation_university' => 'nullable|string|max:255',
            'translations.ar.current_job' => 'nullable|string|max:255',
            'translations.ar.workplace' => 'nullable|string|max:255',
            'translations.ar.interests' => 'nullable|string',
            'translations.ar.bio' => 'nullable|string',
            'translations.fr.name' => 'required|string|max:255',
            'translations.fr.specialization' => 'nullable|string|max:255',
            'translations.fr.degree' => 'nullable|string|max:255',
            'translations.fr.graduation_university' => 'nullable|string|max:255',
            'translations.fr.current_job' => 'nullable|string|max:255',
            'translations.fr.workplace' => 'nullable|string|max:255',
            'translations.fr.interests' => 'nullable|string',
            'translations.fr.bio' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            PublicStorage::delete($member->photo);
            $member->photo = PublicStorage::put($request->file('photo'), 'members/photos');
        }

        if ($request->hasFile('cv')) {
            PublicStorage::delete($member->cv);
            $member->cv = PublicStorage::put($request->file('cv'), 'members/cv');
        }

        $member->update([
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'status' => $validated['status'],
            'photo' => $member->photo,
            'cv' => $member->cv,
        ]);

        foreach (AutoTranslateService::SUPPORTED_LOCALES as $locale) {
            $data = $validated['translations'][$locale];

            $member->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'name' => $data['name'],
                    'specialization' => $data['specialization'] ?? null,
                    'degree' => $data['degree'] ?? null,
                    'graduation_university' => $data['graduation_university'] ?? null,
                    'current_job' => $data['current_job'] ?? null,
                    'workplace' => $data['workplace'] ?? null,
                    'interests' => $data['interests'] ?? null,
                    'bio' => $data['bio'] ?? null,
                ]
            );
        }

        return redirect()->route('members.index')
            ->with('success', 'Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
