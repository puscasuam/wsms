<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function base64ToPng($dir, $base64String, $fileName)
    {
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode(',', $base64String);

        // we could add validation here with ensuring count( $data ) > 1
        // after this, we save the file into the storage folder
        Storage::disk('public')->put($dir .'/' . $fileName, base64_decode($data[1]));
    }

    public static function pngToBase64($dir, $fileName)
    {
        // create base64 string form png
        $data = base64_encode(Storage::disk('public')->get($dir . '/' . $fileName));

        // return encoded image string
        return "data:image/png;base64," . $data;
    }

}
