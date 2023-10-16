<?php

namespace App\Service;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function upload($dir, $file): string
    {
        return $this->upload_to_local($dir, $file);
    }

    private function upload_to_local($dir, $file): string
    {
        $path = Storage::disk('public')->put($dir, $file);
        return $path;
    }
}
