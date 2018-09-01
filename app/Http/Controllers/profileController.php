<?php

namespace App\Http\Controllers;

use App\trDataJobDesc;
use Illuminate\Http\Request;

class profileController extends Controller
{
    public function index()
    {
        $data=trDataJobDesc::all();
        return view('user.profile.index',compact('data'));
    }
}
