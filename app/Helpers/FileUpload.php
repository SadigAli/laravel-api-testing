<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FileUpload
{
    public function file_upload(UploadedFile|array $file, string $folder): string|array
    {
        if (is_array($file)) {
            $files = [];
            foreach ($file as $f) {
                $fileExtension = $f->getClientOriginalExtension();
                $fileName = Str::uuid() . '.' . $fileExtension;
                $f->move(public_path('uploads/' . $folder), $fileName);
                $files[] = '/uploads/' . $folder . '/' .  $fileName;
            }
            return $files;
        } else {
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = Str::uuid() . '.' . $fileExtension;
            $file->move(public_path('uploads/' . $folder), $fileName);
            return '/uploads/' . $folder . '/'  .  $fileName;
        }
    }

    public function file_delete(string $file): void
    {
        if (File::exists($file)) {
            File::delete($file);
        }
    }
}
