<?php

namespace Rashidul\River\Services;

class ImageUploadService
{

    public function upload($file, $base_path)
    {
        $filename = date('Y-m-d').'-'.uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($base_path), $filename);
        return $base_path . $filename;
    }
}
