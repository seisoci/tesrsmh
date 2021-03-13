<?php

namespace App\Helpers;
use Carbon\Carbon;
use Image;
use File;
use Illuminate\Support\Str;

class Fileupload
{
    public $image_path;
    public $document_path;

    // [array('800', '450', 'thumbnail'), array('1280', '720', 'compress')]
    public static function uploadImagePublic($file, $dimensions, $fileName = NULL)
    {
      if (request()->hasFile($file)) {
        $image_path = storage_path('app/public/images');
        $file = request()->file($file);
        $ext = $file->getClientOriginalExtension();
        $fileName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME). '_' . Carbon::now()->timestamp).'.'.$ext;

        if (!File::isDirectory("$image_path/original")) {
          File::makeDirectory("$image_path/original", 0777, true);
        }
        Image::make($file)->save($image_path . '/original/' . $fileName);

        foreach ($dimensions as $row) {
          $canvas = Image::canvas($row[0], $row[1]);
          $resizeImage  = Image::make($file)->resize($row[0], $row[1], function($constraint) {
              $constraint->aspectRatio();
          });
          if (!File::isDirectory($image_path . '/' . $row[2])) {
              File::makeDirectory($image_path . '/' . $row[2], 0777, true);
          }
          $canvas->insert($resizeImage, 'center');
          $canvas->save($image_path . '/' . $row[2] . '/' . $fileName);
        }
        return $fileName;
      }else{
        return NULL;
      }
    }
}
