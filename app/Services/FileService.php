<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileService
{
    public function storeBase64Image($base64, string $folder): string
    {
        if (strpos($base64, ',') > -1) {
            $data = explode(',', $base64);
            $data = base64_decode($data[1], true);

            $extension = explode('/', mime_content_type($base64))[1];

            $image_path = $folder.'/'.rand().'.'.$extension;

            Storage::disk('public')->put($image_path, $data, 'public');

            return Storage::url($image_path);
        }

        return $base64;
    }
}
