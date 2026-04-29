<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /* ───────── INDEX ───────── */
    public function index()
    {
        $posts = Post::with('translations')->latest()->get();

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

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('posts', 'public');
        }

        $post = Post::create([
            'type' => $request->type,
            'event_date' => $request->event_date,
            'image' => $image,
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

        if ($request->hasFile('image')) {

            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $post->image = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'type' => $request->type,
            'event_date' => $request->event_date,
            'image' => $post->image,
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
}
