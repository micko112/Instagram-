<?php

namespace App\Services;

use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Storage;

class FileService
{
    protected $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    public function updateFile($model, $request, $type)
    {
        if (!empty($model->file)) {
            $currentFile = public_path() . $model->file;

            if (file_exists($currentFile) && $currentFile != public_path() . '/user-placeholder.png') {
                unlink($currentFile);
            }
        }

        $uploadedFile = $request->file('file');

        if ($type === "user") {
            $image = $this->imageManager->read($uploadedFile)->resize(400, 400);
        } else {
            $image = $this->imageManager->read($uploadedFile);
        }

        $filename = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $path = 'uploads/' . $filename;

        Storage::disk('public')->put($path, (string) $image->toJpeg());

        $model->file = '/storage/' . $path;
        return $model;
    }

}
