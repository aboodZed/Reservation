<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function imageRequest(Request $request) // upload image ----------------------------------------------------------
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        if ($validator->fails()) {
            return $this->sendError(__('text.input_validation'), __('text.missing_data'));
        }

        $path = $this->uploadImage($request->photo);
        return $this->sendResponse($path, 'Image uploaded successfully');
    }

    public function uploadImage($photo, $path = 'cache') // save upload image ----------------------------------------------------------
    {
        $new_photo =  'img_' . Str::random() . '_' . now()->timestamp   . '.' . $photo->extension();
        // . '/' . $path
        //->resize(512, 512)
        $img = Image::make($photo->getRealPath())->resize(320, 320);
        $img->save(storage_path('app/photo/uploads/' . $path . '/' . $new_photo));
        //. '/' . $path . '/'
        return Crypt::encryptString($path . '/' . $new_photo);
    }

    public function moveImage($old_path, $folder) // move from cache image ----------------------------------------------------------
    {
        $n = Crypt::decryptString($old_path);
        $new_path = Str::replace('cache', $folder . 's', $n);
        \File::move(storage_path('app/photo/uploads/' . $n), storage_path('app/photo/uploads/' . $new_path));
        return Crypt::encryptString($new_path);
    }


    public function getImage($name) // access image ----------------------------------------------------------
    {
        $n = Crypt::decryptString($name);
        $p = Storage::path('photo/uploads/' . $n);
        return response()->file($p);
    }
}
