<?php

namespace App\Http\Controllers;

use App\historiSendEmail;
use App\mst_data;
use App\sesion;
use App\status;
use App\trDataCategory;
use App\trDataHistori;
use App\trDataJobDesc;
use App\trDataPosisition;
use App\trFile;
use App\trFileHistori;
use App\trRequestChangeJob;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;

class EmployesController extends Controller
{
    public function coba2($id)
    {
        return response()->json(trRequestChangeJob::find($id)->job);
    }

    public function coba(/*Request $request*/)
    {
        $data=User::all();

        return $data;
    }


    public function index()
    {
        $user = User::all();
        $base_url = url('employes');
        return view('user.employes.index', compact('user', 'base_url'));
    }

    public function caridata(Request $request)
    {

        $data = User::withTrashed()->findOrFail($request->id);
        $job = trDataJobDesc::findOrFail($data->job_id);
        $name=$data->name;
        $cek=strlen($name);
        if ($cek>14){
            $name=substr($name,0,20).'...';
        }
        if (!empty($data->posisition_id)) {
            $category = trDataPosisition::findOrFail($data->posisition_id);
        } else {
            $category = null;
        }
        setlocale(LC_TIME, 'Indonesian');
        if(!empty($data->tgl_lahir)) {
            $tgl = $data->tempat_lahir . ', ' .Carbon::createFromFormat('Y-m-d', $data->tgl_lahir)->formatLocalized('%d %B %Y');
        }
        else{
            $tgl= "Data belum diisi";
        }
        if(!empty($data->deleted_at)) {
            $softdel=Carbon::createFromFormat('Y-m-d H:i:s', $data->deleted_at)->formatLocalized('%d %B %Y');
        }
        else{
            $softdel=0;
        }if(!empty($data->phone)) {
            $phone=$data->phone;
        }
        else{
            $phone="Data belum diisi";
        }if(!empty($data->bio)) {
            $bio=$data->bio;
        }
        else{
            $bio="Data belum diisi";
        }
        $data1 = array('name' => $name, 'nip' => $data->nip, 'ttl' => $tgl, 'email' => $data->email, 'phone' => $phone, 'bio' => $bio,
            'job' => $job, 'category' => $category, 'ava' => $data->ava,'softdel'=>$softdel);
        return response()->json($data1);
    }
}
