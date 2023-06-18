<?php

use Illuminate\Support\Facades\File;

/**
 * remove temp images.
 *
 */
if (!function_exists('deleteTempFolder')) {
    function deleteTempFolder($path, $type = 'folder')
    {
        if ($type == 'folder'){
            if (File::exists(storage_path($path))) {
                File::deleteDirectory(storage_path($path));
            }
        }

        if ($type == 'file'){
            if (File::exists(public_path($path))) {
                File::delete(public_path($path));
            }
        }
    }
}