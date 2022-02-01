<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    //
    public function index(){
        $packages = Package::query()
            ->select('id','name','description','price','photo')
            ->where('status','=','1')
            ->get();
        if (sizeof($packages)>=1){
            return response()->json($packages,200);
        }else{
            return response()->json(["message"=>'please add packages', "data"=>$packages, "status"=>200]);
        }
    }
}
