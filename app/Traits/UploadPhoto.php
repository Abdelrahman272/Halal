<?php

namespace App\Traits;

use App\Models\Photo;

trait UploadPhoto
{
    public function uploadPhoto($folder, $photo, $modelClass)
    {
        $new_image = Photo::create([
            'image_type' => 'image/jpg',
            'parentable_type' => $modelClass
         ]);
    }
}
