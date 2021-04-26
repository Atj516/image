<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{

    public function create(Request $request)
    {
        $image = new Image();
        if(isset($request->image)) {
            $image = $request->file('image');
            //$image = base64_decode($request->image);
            $profile_image_name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = base_path('public/uploads/image');
            $imagePath = $destinationPath. "/".  $profile_image_name;
            // print_r($destinationPath);exit;
            $image->move($destinationPath, $profile_image_name);
            // $data = $request->image;
            // list($type, $data) = explode(';', $data);
            // list(, $data)      = explode(',', $data);
            // $data = base64_decode($data);
            // $profile_image_name = time().'.png';
            // $destinationPath = public_path('/uploads/'.$profile_image_name);
            // file_put_contents($destinationPath, $data);
            $image_url = url('/uploads/image').'/'.$profile_image_name;
            return response()->json(['result' => $image_url,'message'=>"Success",'status'=>1,'response_code' => 200], 200);
        }
    }
}