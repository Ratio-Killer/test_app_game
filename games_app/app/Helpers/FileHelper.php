<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class FileHelper
{
    /**
     *
     * @param UploadedFile|null $file
     * @return string
     */
    public static function uploadCover(?UploadedFile $file): string
    {
        $file
            ? $path = $file->store('covers', 'public')
            : $path = 'covers/default_cover.jpg';

        return json_encode(['path' => $path]);
    }
}
