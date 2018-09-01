<?php

namespace App\Http\Controllers;

use App\mst_data;
use App\trDataCategory;
use App\trDataJobDesc;
use App\trDataPosisition;
use App\trRequestChangeJob;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index()
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $user = User::findOrFail(Auth::user()->id);
        $category = trDataPosisition::where('job_id', $user->job_id)->get();
        $ganti = 0;
        Session::put('jobupdate', $user->ganti);
//return Session::all();
        if (!is_null($user->ganti)) {
            $ganti = 1;
            $ganti2 = trRequestChangeJob::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            $ke = 'ke ' . trDataPosisition::findOrFail($ganti2->changeposisition_id)->name . ' di ' . trDataJobDesc::findOrFail($ganti2->changejob_id)->name;
        }


        return view('user.setting.update', compact('user', 'category', 'ganti', 'ke'));
    }

    public function getjob(Request $request)
    {
        $data = trDataPosisition::where('job_id', $request->id)->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $data1 = User::findOrFail($request->id);
        $job = $data1->job_id;
        $posisition = $data1->posisition_id;
        $statem = 0;
        $statgl = 0;
        $data = $request->all();
        if (!is_null($request->name)) {
            $data1->name = $request->name;
        }
        else{
            $data['name']='Data belum diisi';
        }
        if (!is_null($request->tempat_lahir)) {
            $data1->tempat_lahir = $request->tempat_lahir;
            $statem = 1;
        }
        if (!is_null($request->tgl_lahir)) {
            $data1->tgl_lahir = Carbon::createFromFormat('d/m/Y', $request->tgl_lahir)->format('Y-m-d');
            $statgl = 1;
        }
        if (!is_null($request->email)) {
            $data1->email = $request->email;
        }
        else{
            $data['email']='Data belum diisi';
        }
        if (!is_null($request->phone)) {
            $data1->phone = $request->phone;
        }
        else{
            $data['phone']='Data belum diisi';
        }
        if (!is_null($request->password)) {
            $data1['password'] = Hash::make($request->password);
        }
        if (!is_null($request->bio)) {
            $data1->bio = $request->bio;
        }
        else{
            $data['bio']='Data belum diisi';
        }
        if (!is_null($request->alamat)) {
            $data1->alamat = $request->alamat;
        }
        else{
            $data['alamat']='Data belum diisi';
        }
        $coba = 0;

            if ($request->job_id != $job || $request->posisition_id != $posisition) {
                trRequestChangeJob::create(['user_id' => $request->id, 'changejob_id' => $request->job_id,
                    'changeposisition_id' => $request->posisition_id, 'status' => 0,'posisition_id'=>Auth::user()->posisition_id,'job_id'=>Auth::user()->job_id]);
                $data1->ganti = 1;
                $coba = $data['status'] = 1;
            }

        if ($coba == 1) {
            $data['jabatan'] = trDataPosisition::findOrFail($request->posisition_id)->name . ' di ' . trDataJobDesc::findOrFail($request->job_id)->name;

        }

        if ($statem==1&&$statgl==1) {
            $data['ttl'] = $request->tempat_lahir . ', ' . Carbon::createFromFormat('d/m/Y', $request->tgl_lahir)->formatLocalized('%d %B %Y');
        }
        else{
            $data['ttl'] = 'Data belum diisi...';

        }

//
        $data['job'] = trDataJobDesc::all();
        $data['job_id'] = $job;
        $data['posisition_id'] = $posisition;
        $data['job_idreq'] = $request->job_id;
        $data['posisition_idreq'] = $request->posisition_id;
        $data['posisition'] = trDataPosisition::where('job_id', $job)->get();

        $data['file2'] = '';
        if ($request->hasFile('ava')) {
            $rand = rand(111, 999);
            $name = Carbon::now()->format('dmy') . $rand . str_random(8) . rand(0, 9);
            $filename = 'user/'
                . str_slug($name, '-') . '.' . $request->ava->getClientOriginalExtension();
            $request->ava->storeAs('public', $filename);
            if (!is_null($data1->ava)) {
                Storage::delete('public/' . substr($data1->ava, 8));
            }
            $data1->ava = $data['file2'] = 'storage/' . $filename;
        }
        $data1->update();
        $datefo=Carbon::createFromFormat('Y-m-d H:i:s',User::findOrFail($request->id)->updated_at);
$data['waktu']=$datefo->formatLocalized('%d %B %Y ').$datefo->format('H:i').' WIB';
        Session::put('jobupdate',1);
//
//
        return response()->json($data);

    }

    public function waktu()
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $data['waktu'] = User::findOrFail(Auth::user()->id)->updated_at->diffForHumans();
        $cek = User::findOrFail(Auth::user()->id);
        if (\session('jobupdate') == $cek->ganti) {
            $data['statusupdate'] = false;
        } else {
            $data['statusupdate'] = true;
            $requp = trRequestChangeJob::where('user_id', $cek->id)->orderBy('id', 'desc')->first();
            if ($requp->status == 1) {
                $data['statusperubahan'] = true;
            } else {
                $data['statusperubahan'] = false;
            }

            $set = trDataJobDesc::all();
            foreach ($set as $row) {
                $data['listjob'][] = array('name' => $row->name, 'id' => $row->id);
            }

            $set2 = trDataPosisition::where('job_id', $cek->job_id)->get();
            foreach ($set2 as $row) {
                $data['listposisition'][] = array('name' => $row->name, 'id' => $row->id);
            }
            $data['rubah'] = array('job' => trDataJobDesc::findOrFail($cek->job_id)->name, 'posisition' => trDataPosisition::findOrFail($cek->posisition_id)->name,
                'job_id' => $cek->job_id, 'posisition_id' => $cek->posisition_id);
            Session::put('jobupdate', $cek->ganti);
//            Session::put('posisitionupdate',$cek->posisition_id);
        }
        return response()->json($data);
    }

    public function cek(Request $request)
    {
        $data = array();
        if (is_null($request->id)) {
            $data['status'] = 0;
        } else {
            if (Hash::check($request->id, Auth::user()->password)) {
                $data['status'] = 1;
            } else {
                $data['status'] = 2;
            }
        }
//                        $data['status'] = 1;

        return response()->json($data);

    }

    public function kirim(Request $request)
    {
        $data['statuskirim'] = $count=count(trRequestChangeJob::where('user_id', $request->id)->orderBy('id', 'desc')->get());
if ($count>0){
    $data['list'] = trRequestChangeJob::where('user_id', $request->id)->orderBy('id', 'desc')->first()->admin_id;

}
        return $data;

    }

    public function pengurus()
    {

        return view('user.setting.pengurus');
    }

    public function suratplus(Request $request)
    {
        $job = Auth::user()->job_id;

        for ($i = 0; $i < count($request->name); $i++) {
            trDataCategory::create(['name' => $request->name[$i], 'singkatan' => $request->singkatan[$i], 'job_id' => $job, 'desc' => $request->singkatan[$i]]);
        }

        return response()->json(['status' => 1, $request->all()]);

    }

    public function ceksurat(Request $request)
    {
        $job = Auth::user()->job_id;

        $datacek = trDataCategory::where('job_id', $job)->where('singkatan', $request->cek)->first();
        $datacek2 = trDataCategory::where('job_id', $job)->where('name', $request->cek)->first();
        if (count($datacek) > 0 || count($datacek2) > 0) {
            return response()->json(['status' => 0, 'name' => $datacek2['name'], 'singkatan' => $datacek['singkatan']]);
        }


        return response()->json(['status' => 1]);
    }

    public function apiData()
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $products = trDataCategory::where('job_id', Auth::user()->job_id)->get();
        return DataTables::of($products)
            ->addColumn('dibuat', function ($products) {
                if (Carbon::now()->subDay(3)->gte($products->created_at) == false) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->created_at)->diffForHumans();
                } else
                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->created_at)->formatLocalized('%A %d %B %Y');
            })->make(true);
    }

}
