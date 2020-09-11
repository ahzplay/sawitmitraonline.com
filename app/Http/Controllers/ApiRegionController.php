<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;

class ApiRegionController extends Controller
{
    public function getProvinces(){
        $datas = Region::select('code','name')
            ->whereRaw("CHAR_LENGTH(`code`) = '2'")
            ->get();

        return response()->json($datas);
    }
}
