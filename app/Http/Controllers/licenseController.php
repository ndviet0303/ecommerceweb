<?php

namespace App\Http\Controllers;

use App\Models\license;
use Illuminate\Http\Request;

class licenseController extends Controller
{
    public function licenseShow(){
        $license = license::where('user_id',auth()->user()->id)->get();
        return $license;
    }
}
