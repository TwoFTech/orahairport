<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveImage($image, $path = 'public') {
        if(!$image) {
            abort(500, "Problème avec l'image");
        }

        $filename = $image->getClientOriginalName() . '-' . time() . '.' . $image->extension();
        \Storage::disk($path)->put($filename, File::get($image));

        return \URL::to('/') . (!\App::environment('local') ? '/public' : '') .'/storage/' . $path . '/images/' . $filename;
    }
}
