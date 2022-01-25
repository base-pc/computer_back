<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class UploadService
{
    private $file_name, $image_url, $disk;

    public function setImage ($upload, $width, $height)
    {
        if($upload)
        {
            $file_name = $upload->hashName();

            $img = Image::make($upload);

            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });

            $resource = $img->stream()->detach();

            $path = Storage::disk('s3')->put(
                $this->disk . $file_name,
                $resource
            );

            $image_url = Storage::disk('s3')->url($this->disk . $file_name);

            $this->image_url = $image_url;
            $this->file_name = $file_name;
        }
    }

    public function getPhotoUrl()
    {
        return $this->image_url;
    }

    public function getPhotoName()
    {
        return $this->file_name;
    }

    public function setDisk($disk)
    {
        $this->disk = $disk;
    }
}

?>
