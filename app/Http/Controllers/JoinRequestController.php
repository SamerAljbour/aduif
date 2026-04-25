<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJoinRequest;
use App\Models\JoinRequest;
use App\Models\JoinRequestDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Member;

class JoinRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('joinRequest');
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
    public function store(StoreJoinRequest $request)
    {
        // ✅ Upload single files
        $photoPath = null;
        $cvPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('join_requests/photos', 'public');
        }

        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('join_requests/cv', 'public');
        }

        // ✅ Create main record
        $join = JoinRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'nationality' => $request->nationality,
            'photo' => $photoPath,
            'cv' => $cvPath,
        ]);

        // ✅ Save translation
        $join->translations()->create([
            'locale' => app()->getLocale(),
            'specialization' => $request->specialization,
            'degree' => $request->degree,
            'graduation_university' => $request->graduation_university,
            'current_job' => $request->current_job,
            'workplace' => $request->workplace,
            'interests' => $request->interests,
            'bio' => $request->bio,
        ]);

        // ✅ Multi documents upload
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {

                $path = $file->store('join_requests/documents', 'public');

                // detect type (optional)
                $type = str_contains($file->getMimeType(), 'image')
                    ? 'certificate'
                    : 'other';

                JoinRequestDocument::create([
                    'join_request_id' => $join->id,
                    'file_path' => $path,
                    'type' => $type,
                ]);
            }
        }

        return back()->with('success', 'Application submitted successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(JoinRequest $joinRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JoinRequest $joinRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JoinRequest $joinRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JoinRequest $joinRequest)
    {
        //
    }
    public function adminIndex()
    {
        $requests = JoinRequest::with('translations')->latest()->get();
        return view('dashboard.joinRequests.index', compact('requests'));
    }

    public function approve($id)
    {
        DB::beginTransaction();

        try {

            // 🔹 Load request WITH translations + documents
            $req = JoinRequest::with(['translations', 'documents'])->findOrFail($id);

            // 🔹 Update request status
            $req->update(['status' => 'approved']);

            // 🔹 Create member
            $member = Member::create([
                'email' => $req->email,
                'photo' => $req->photo,
                'cv'    => $req->cv,
                'status' => 'approved',
            ]);

            // 🔹 Copy translations
            foreach ($req->translations as $t) {

                $member->translations()->create([
                    'locale' => $t->locale,
                    'name'   => $req->name, // from main table
                    'specialization' => $t->specialization,
                    'degree' => $t->degree,
                    'graduation_university' => $t->graduation_university,
                    'current_job' => $t->current_job,
                    'workplace' => $t->workplace,
                    'interests' => $t->interests,
                    'bio' => $t->bio,
                ]);
            }

            // 🔥 NEW PART (IMPORTANT)
            // 🔹 Move documents to member (NO duplication)
            foreach ($req->documents as $doc) {
                $doc->update([
                    'member_id' => $member->id,
                ]);
            }

            DB::commit();

            return back()->with('success', 'Request approved and member created successfully');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', $e->getMessage()); // helpful for debugging
        }
    }

    public function reject($id)
    {
        $req = JoinRequest::findOrFail($id);
        $req->update(['status' => 'rejected']);

        return back()->with('error', 'Request rejected');
    }
}
