<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class UploadService
{
    private $file_name;
    private $image_url;
    private $disk;

    public function setImage ($upload)
    {
        if($upload)
        {
            $file_name           = $upload->hashName();
            $image_uploaded_path = $upload->storeAs($this->disk, $file_name, 's3');

            $image_url           = Storage::disk('s3')->url($image_uploaded_path);

            $this->image_url = $image_url;
            $this->file_name = $file_name;

        }else {
            $this->file_name = 'default';
            $this->image_url = Storage::disk('s3')->url($this->disk .'/default.png');

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
