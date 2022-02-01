<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //
    public function index(){
        $images = Image::query()
            ->select('id','image','description')
            ->get();
        if (sizeof($images)>=1){
            return response()->json($images,200);
        }else{
            return response()->json(["message"=>'please add gallery images', "data"=>$images, "status"=>200]);
        }
    }
}
