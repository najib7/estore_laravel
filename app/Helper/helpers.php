<?php

use Illuminate\Support\Facades\File;

function upload_image($file, $name, $path, $old_image_name = null) {

    if(File::isFile($file)) {

        if($old_image_name !== null) {
            $old_image = public_path('storage/'. $path .'/' . $old_image_name);
            // delete old image
            if (File::exists($old_image)) {
                File::delete($old_image);
            }
        }

        $file_name = Str::slug($name) . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs($path, $file_name);
        return $file_name;
    }

    return $old_image_name;
}
