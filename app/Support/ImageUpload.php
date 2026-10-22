<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

/**
 * Stores uploads directly under public/uploads so they work on shared
 * hosting without needing `php artisan storage:link`.
 */
class ImageUpload
{
    public static function store(UploadedFile $file, string $folder): string
    {
        $extension = strtolower($file->extension() ?: $file->getClientOriginalExtension());
        $name = now()->format('Ymd-His').'-'.Str::random(8).'.'.$extension;
        $file->move(public_path("uploads/{$folder}"), $name);

        return "uploads/{$folder}/{$name}";
    }

    /** Only removes files we uploaded; the bundled site images under images/ are left alone. */
    public static function delete(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/') && is_file(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
