<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PublicStorage
{
    public static function put(UploadedFile $file, string $directory): string
    {
        $directory = trim($directory, '/');
        $filename = self::filename($file);
        $destinationPath = public_path('storage/' . $directory);

        if (! File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $filename);

        return $directory . '/' . $filename;
    }

    public static function delete(?string $path): void
    {
        if (! $path) {
            return;
        }

        $path = ltrim($path, '/');

        foreach ([public_path('storage/' . $path), storage_path('app/public/' . $path)] as $filePath) {
            if (File::exists($filePath) && File::isFile($filePath)) {
                File::delete($filePath);
            }
        }
    }

    public static function deleteMany(array $paths): void
    {
        foreach ($paths as $path) {
            self::delete($path);
        }
    }

    private static function filename(UploadedFile $file): string
    {
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $safeName = Str::slug($name) ?: 'file';

        return time() . '_' . uniqid() . '_' . $safeName . ($extension ? '.' . $extension : '');
    }
}
