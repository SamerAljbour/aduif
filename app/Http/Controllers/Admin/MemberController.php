<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with(['translations', 'documents'])->latest()->get();
        // dd($members);
        return view('dashboard.members.index', compact('members'));
    }

    // show the members to the public
    public function showMembers()
    {
        $locale = app()->getLocale() === 'ar' ? 'ar' : 'fr';
        $fallbackLocale = $locale === 'fr' ? 'ar' : 'fr';

        $members = Member::with(['translations'])->latest()->paginate(12);

        $memberProfiles = $members->getCollection()->map(function (Member $member) use ($locale, $fallbackLocale) {
            $translation = $member->translations->firstWhere('locale', $locale)
                ?: $member->translations->firstWhere('locale', $fallbackLocale);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
