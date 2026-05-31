<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class PostRequest extends FormRequest
{

    public function rules(): array
    {
        $post = $this->postModel();

        return [
            'type' => 'required|in:event,news,memory',
            'event_date' => 'required|date',

            'image' => ($post?->image ? 'nullable' : 'required') . '|image|max:2048',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:4096',
            'videos' => 'nullable|array',
            'videos.*' => 'file|mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/webm,video/ogg,video/x-matroska,video/mpeg|max:262144',
            'existing_photos' => 'nullable|array',
            'existing_photos.*' => 'string',
            'existing_videos' => 'nullable|array',
            'existing_videos.*' => 'string',

            // Arabic
            'title_ar' => 'required|string|max:255',
            'description_ar' => 'required|string',

            // French
            'title_fr' => 'required|string|max:255',
            'description_fr' => 'required|string',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $post = $this->postModel();
            $existingPhotos = array_intersect($post?->photos ?? [], $this->input('existing_photos', []));
            $existingVideos = array_intersect($post?->videos ?? [], $this->input('existing_videos', []));

            // $photoCount = count($existingPhotos)
            //     + count($this->file('photos', []));
            // $videoCount = count($existingVideos)
            //     + count($this->file('videos', []));

            // if ($photoCount < 1) {
            //     $validator->errors()->add('photos', 'At least one photo is required.');
            // }

            // if ($videoCount < 1) {
            //     $validator->errors()->add('videos', 'At least one video is required.');
            // }
        });
    }

    private function postModel(): ?Post
    {
        $routePost = $this->route('post');

        if ($routePost instanceof Post) {
            return $routePost;
        }

        if ($routePost) {
            return Post::find($routePost);
        }

        return null;
    }
}
