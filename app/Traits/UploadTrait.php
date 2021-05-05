<?php


namespace App\Traits;


use Illuminate\Http\Request;

trait UploadTrait
{

    private function imageUpload($images, string $path, $imageCollum = null)
    {
        $uploadedImages = [];

        if (is_array($images)) {
            foreach ($images as $image) {
                $uploadedImages[] = [$imageCollum => $image->store($path, 'public')];
            }
        } else {
            $uploadedImages = $images->store($path, 'public');
        }

        return $uploadedImages;
    }
}
