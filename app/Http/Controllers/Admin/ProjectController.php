<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Support\PublicStorage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('translations')->latest()->paginate(10);
        return view('dashboard.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('dashboard.projects.createOrUpdate');
    }

    public function store(ProjectRequest $request)
    {
        $image = null;

        if ($request->hasFile('image')) {
            $image = PublicStorage::put($request->file('image'), 'projects');
        }

        $project = Project::create([
            'status' => $request->status,
            'image' => $image,
        ]);

        $project->translations()->createMany([
            [
                'locale' => 'ar',
                'title' => $request->title_ar,
                'description' => $request->description_ar,
            ],
            [
                'locale' => 'fr',
                'title' => $request->title_fr,
                'description' => $request->description_fr,
            ],
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully');
    }

    public function edit($id)
    {
        $project = Project::with('translations')->findOrFail($id);

        $ar = $project->translations->where('locale', 'ar')->first();
        $fr = $project->translations->where('locale', 'fr')->first();

        return view('dashboard.projects.createOrUpdate', compact('project', 'ar', 'fr'));
    }

    public function update(ProjectRequest $request, $id)
    {
        $project = Project::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($project->image) {
                PublicStorage::delete($project->image);
            }

            $project->image = PublicStorage::put($request->file('image'), 'projects');
        }

        $project->update([
            'status' => $request->status,
            'image' => $project->image,
        ]);

        foreach (['ar', 'fr'] as $locale) {
            $project->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $request->input("title_$locale"),
                    'description' => $request->input("description_$locale"),
                ]
            );
        }

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->image) {
            PublicStorage::delete($project->image);
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }
}
