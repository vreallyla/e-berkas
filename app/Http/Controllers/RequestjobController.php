<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestjobController extends Controller
{
    public function index()
    {
        return view('admin.requestjob.index');
    }
}
