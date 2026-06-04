<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Services\AutoTranslateService;
use App\Support\PublicStorage;

class PostController extends Controller
{
    /* ───────── INDEX ───────── */
    public function index()
    {
        $posts = Post::with('translations')->latest()->paginate(10);

        return view('dashboard.posts.index', compact('posts'));
    }

    /* ───────── CREATE ───────── */
    public function create()
    {
        return view('dashboard.posts.createOrUpdate');
    }

    /* ───────── STORE ───────── */
    public function store(PostRequest $request)
    {
        $image = null;

        // ✅ Main image
        if ($request->hasFile('image')) {

            $image = PublicStorage::put($request->file('image'), 'posts');
        }

        // ✅ Photos
        $photos = [];

        if ($request->hasFile('photos')) {

            foreach ($request->file('photos') as $photo) {

                $path = PublicStorage::put($photo, 'posts/photos');

                $photos[] = $path;
            }
        }

        // ✅ Videos
        $videos = [];

        if ($request->hasFile('videos')) {

            foreach ($request->file('videos') as $video) {

                $path = PublicStorage::put($video, 'posts/videos');

                $videos[] = $path;
            }
        }

        $post = Post::create([
            'type' => $request->type,
            'event_date' => $request->event_date,
            'image' => $image,
            'photos' => $photos,
            'videos' => $videos,
        ]);

        $this->saveTranslations($post, $request);

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully');
    }

    /* ───────── EDIT ───────── */
    public function edit($id)
    {
        $post = Post::with('translations')->findOrFail($id);

        $translation = $this->translationForCurrentLocale($post->translations);

        return view('dashboard.posts.createOrUpdate', compact('post', 'translation'));
    }

    /* ───────── UPDATE ───────── */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $oldPhotos = $post->photos ?? [];
        $oldVideos = $post->videos ?? [];
        $keptPhotos = $request->input('existing_photos', []);
        $keptVideos = $request->input('existing_videos', []);

        if ($request->hasFile('image')) {

            if ($post->image) {
                PublicStorage::delete($post->image);
            }

            $post->image = PublicStorage::put($request->file('image'), 'posts');
        }

        $photos = array_values(array_merge(
            array_intersect($oldPhotos, $keptPhotos),
            $this->storeFiles($request->file('photos', []), 'posts/photos')
        ));

        $videos = array_values(array_merge(
            array_intersect($oldVideos, $keptVideos),
            $this->storeFiles($request->file('videos', []), 'posts/videos')
        ));

        $this->deleteMissingFiles($oldPhotos, $photos);
        $this->deleteMissingFiles($oldVideos, $videos);

        $post->update([
            'type' => $request->type,
            'event_date' => $request->event_date,
            'image' => $post->image,
            'photos' => $photos,
            'videos' => $videos,
        ]);

        $this->saveTranslations($post, $request);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /* ───────── DELETE ───────── */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            PublicStorage::delete($post->image);
        }

        $this->deleteFiles($post->photos ?? []);
        $this->deleteFiles($post->videos ?? []);

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
    public function posts()
    {
        $events = Post::with('translation')
            ->where('type', 'event')
            ->latest()
            ->get();

        $news = Post::with('translation')
            ->where('type', 'news')
            ->latest()
            ->get();

        $memories = Post::with('translation')
            ->where('type', 'memory')
            ->latest()
            ->get();

        return view('posts.allPosts', compact('events', 'news', 'memories'));
    }
    public function showPost($id)
    {
        $post = Post::with('translations')->findOrFail($id);

        // 🔥 PREVIOUS (same type only)
        $prev = Post::with('translations')
            ->where('type', $post->type)
            ->where('id', '<', $post->id)
            ->latest('id')
            ->first();

        // 🔥 NEXT (same type only)
        $next = Post::with('translations')
            ->where('type', $post->type)
            ->where('id', '>', $post->id)
            ->oldest('id')
            ->first();

        return view('posts.singlePost', compact('post', 'prev', 'next'));
    }

    private function storeFiles(array|\Illuminate\Http\UploadedFile $files, string $directory): array
    {
        if ($files instanceof \Illuminate\Http\UploadedFile) {
            $files = [$files];
        }

        return array_values(array_filter(array_map(
            fn($file) => $file instanceof \Illuminate\Http\UploadedFile
                ? PublicStorage::put($file, $directory)
                : null,
            $files
        )));
    }

    private function deleteMissingFiles(array $oldFiles, array $currentFiles): void
    {
        $this->deleteFiles(array_diff($oldFiles, $currentFiles));
    }

    private function deleteFiles(array $files): void
    {
        foreach ($files as $file) {
            PublicStorage::delete($file);
        }
    }

    private function saveTranslations(Post $post, PostRequest $request): void
    {
        $translations = app(AutoTranslateService::class)->translateFields([
            'title' => $request->title,
            'description' => $request->description,
        ], app()->getLocale());

        foreach ($translations as $locale => $data) {
            $post->translations()->updateOrCreate(
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
