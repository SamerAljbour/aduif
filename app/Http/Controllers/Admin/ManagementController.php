<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Management;
use App\Http\Requests\ManagementRequest;

class ManagementController extends Controller
{
    public function index()
    {
        $managements = Management::with('translations')->latest()->get();

        return view('dashboard.management.index', compact('managements'));
    }

    public function create()
    {
        return view('dashboard.management.createOrUpdate');
    }

    public function store(ManagementRequest $request)
    {
        // upload photo
        $photo = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('managements', 'public');
        }

        // create main record
        $management = Management::create([
            'photo' => $photo,
            'email' => $request->email,
            'position' => $request->position,
            'type' => $request->type,

        ]);

        // create translations
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

        // get translations
        $ar = $management->translations->where('locale', 'ar')->first();
        $fr = $management->translations->where('locale', 'fr')->first();

        return view('dashboard.management.createOrUpdate', compact('management', 'ar', 'fr'));
    }

    public function update(ManagementRequest $request, $id)
    {
        $management = Management::findOrFail($id);

        // update photo if exists
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('managements', 'public');
            $management->photo = $photo;
        }

        // update main fields
        $management->update([
            'email' => $request->email,
            'position' => $request->position,
            'type' => $request->type,

        ]);

        // update translations
        foreach (['ar', 'fr'] as $locale) {
            $management->translation()->updateOrCreate(
                ['locale' => $locale],
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
}
