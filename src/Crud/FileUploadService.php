<?php

namespace Rashidul\River\Crud;

use Illuminate\Support\Str;


//uploads file to public path
class FileUploadService
{

    const UPLOAD_ALL_IAMGES = '/uploads/images';

    public static function uploadSingleImage($file, $rootPath)
    {
        //TODO check if $file is valid
        //TODO check if filename is duplicate

        $path = '';

        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path($rootPath);
        try {
            $file->move($destinationPath, $filename);
            $path = "{$rootPath}/{$filename}";
        } catch (\Exception $e) {
            return $path;
        }

        return $path;
    }

}
