<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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

            $image = $request->file('image')->store('posts', 'public');

            $source = storage_path('app/public/' . $image);
            $destination = public_path('storage/' . $image);

            if (!File::exists(dirname($destination))) {
                File::makeDirectory(dirname($destination), 0755, true);
            }

            File::copy($source, $destination);
        }

        // ✅ Photos
        $photos = [];

        if ($request->hasFile('photos')) {

            foreach ($request->file('photos') as $photo) {

                $path = $photo->store('posts/photos', 'public');

                $source = storage_path('app/public/' . $path);
                $destination = public_path('storage/' . $path);

                if (!File::exists(dirname($destination))) {
                    File::makeDirectory(dirname($destination), 0755, true);
                }

                File::copy($source, $destination);

                $photos[] = $path;
            }
        }

        // ✅ Videos
        $videos = [];

        if ($request->hasFile('videos')) {

            foreach ($request->file('videos') as $video) {

                $path = $video->store('posts/videos', 'public');

                $source = storage_path('app/public/' . $path);
                $destination = public_path('storage/' . $path);

                if (!File::exists(dirname($destination))) {
                    File::makeDirectory(dirname($destination), 0755, true);
                }

                File::copy($source, $destination);

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

        $post->translations()->createMany([
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

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully');
    }

    /* ───────── EDIT ───────── */
    public function edit($id)
    {
        $post = Post::with('translations')->findOrFail($id);

        $ar = $post->translations->where('locale', 'ar')->first();
        $fr = $post->translations->where('locale', 'fr')->first();

        return view('dashboard.posts.createOrUpdate', compact('post', 'ar', 'fr'));
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
                Storage::disk('public')->delete($post->image);
            }

            $post->image = $request->file('image')->store('posts', 'public');
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

        foreach (['ar', 'fr'] as $locale) {
            $post->translations()->updateOrCreate(
                ['locale' => $locale],
                [
                    'title' => $request->input("title_$locale"),
                    'description' => $request->input("description_$locale"),
                ]
            );
        }

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /* ───────── DELETE ───────── */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $this->deleteFiles($post->photos ?? []);
        $this->deleteFiles($post->videos ?? []);

        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
    public function posts()
    {
        $news = Post::with('translation')
            ->where('type', 'news')
            ->latest()
            ->get();

        $memories = Post::with('translation')
            ->where('type', 'memory')
            ->latest()
            ->get();

        return view('posts.allPosts', compact('news', 'memories'));
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
                ? $file->store($directory, 'public')
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
            Storage::disk('public')->delete($file);
        }
    }
}
