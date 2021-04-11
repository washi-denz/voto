<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null, $old_name = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name, $disk);

        if ($old_name != null) {
            Storage::disk($disk)->delete(trim($folder, '/') . '/' . $old_name);
            //unlink(public_path(trim($folder, '/') . '/' . $old_name));
        }
        return $file;
    }
}
