<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\ProjectRequest;
use App\Services\AutoTranslateService;
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

        $this->saveTranslations($project, $request);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully');
    }

    public function edit($id)
    {
        $project = Project::with('translations')->findOrFail($id);

        $translation = $this->translationForCurrentLocale($project->translations);
        $translationsByLocale = $project->translations->keyBy('locale');

        return view('dashboard.projects.createOrUpdate', compact('project', 'translation', 'translationsByLocale'));
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

        $this->saveTranslations($project, $request);

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

    private function saveTranslations(Project $project, ProjectRequest $request): void
    {
        if ($request->filled('translations')) {
            foreach (AutoTranslateService::SUPPORTED_LOCALES as $locale) {
                $data = $request->input("translations.$locale", []);

                $project->translations()->updateOrCreate(
                    ['locale' => $locale],
                    [
                        'title' => $data['title'] ?? '',
                        'description' => $data['description'] ?? '',
                    ]
                );
            }

            return;
        }

        $translations = app(AutoTranslateService::class)->translateFields([
            'title' => $request->title,
            'description' => $request->description,
        ], app()->getLocale());

        foreach ($translations as $locale => $data) {
            $project->translations()->updateOrCreate(
                ['locale' => $locale],
                $data
            );
        }
    }

    private function translationForCurrentLocale($translations): ?object
    {
        $locale = app()->getLocale();

        return $translations->firstWhere('locale', $locale)
            ?? $translations->firstWhere('locale', 'en')
            ?? $translations->firstWhere('locale', 'ar')
            ?? $translations->firstWhere('locale', 'fr');
    }
}
