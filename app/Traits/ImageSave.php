<?php

namespace App\Traits;

trait ImageSave
{

    public static function insert_image($foto)
    {
        $extension = "";
        $extension = $foto->getClientOriginalExtension();
        $filename = date('YmdHis') . rand(0, 999);
        try {

            if ($extension != 'png' && $extension != 'jpg') {
                $filename = $filename . ".png";
            } else {
                $filename = $filename . "." . $extension;
            }
            // upload ke uploadgambar
            $destinationPath = 'image';
            $foto->move($destinationPath, $filename);
        } catch (\Exception $exception) {
            $destinationPath = 'uploadgambar';
            $filename = $filename . "." . $extension;
            $foto->move($destinationPath, $filename);
        }

        return $filename;
    }

    public static function update_image($foto, $foto_lama)
    {
        $img = 'image/' . $foto_lama;
        if (is_file($img)) {
            unlink($img);
        }

        $extension = "";
        $extension = $foto->getClientOriginalExtension();
        $filename = date('YmdHis') . rand(0, 999);
        try {

            if ($extension != 'png' && $extension != 'jpg') {
                $filename = $filename . ".png";
            } else {
                $filename = $filename . "." . $extension;
            }
            // upload ke uploadgambar
            $destinationPath = 'image';
            $foto->move($destinationPath, $filename);
        } catch (\Exception $exception) {
            $destinationPath = 'uploadgambar';
            $filename = $filename . "." . $extension;
            $foto->move($destinationPath, $filename);
        }

        return $filename;
    }
}
