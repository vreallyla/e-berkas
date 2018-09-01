<?php

namespace App\Http\Controllers;

use App\Datacarousel;
use App\mst_data;
use App\sesion;
use App\trDataCategory;
use App\trDataJobDesc;
use App\trDataPosisition;
use App\trRequestChangeJob;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        $change = count(trRequestChangeJob::all());
        $surat = count(mst_data::all());
        $user = count(User::all());
        $user2 = User::orderBy('id', 'desc')->get();
        $user4 = User::orderBy('id', 'desc')->take(8)->get();
        $cate = trDataJobDesc::all();
        $surat2 = mst_data::all();
        $suratfill6 = mst_data::orderBy('id','desc')->take(6)->get();
        $jenis=trDataCategory::orderBy('id','desc')->take(6)->get();
        $gantijob=trRequestChangeJob::orderBy('id','desc')->take(6)->get();

        Session::put('gantijob', $gantijob);
        Session::put('requ', count(trRequestChangeJob::where('admin_id', null)->orderBy('id', 'desc')->get()));
        Session::put('usercount', $user4);
        Session::put('carouselcount', count(Datacarousel::all()));
        $acak = str_random(30) . rand(100001, 999999) . str_random(30) . rand(100001, 999999);
        Session::put('carouselchange1', $acak);
        Session::put('carouselchange2', $acak);
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $req = trRequestChangeJob::where('admin_id', null)->orderBy('id', 'desc')->get();

        $data = array();
        $i = 0;
        foreach ($cate as $row) {
            $i++;
            $data[$i][] = $row->name;
            foreach ($surat2 as $row2) {
                if ($row->id == $row2->job_id) {
                    $data[$i][] = $row2->name;
                }
            }
        }
//dd($surat,$data);
        for ($i = 2; $i <= count($data); $i++) {
            if (count($data[$i]) == 1) {
                Session::put('mstdata' . $i, 0);
            } else {
                Session::put('mstdata' . $i, count($data[$i]) - 1);
            }
        }
//        return Session::all();
        if ($user < 8) {
            $user3 = $user2;
        } else {
            $user3 = $user4;
        }

        foreach (Datacarousel::all() as $row) {
            if ($row->domain == 0) {
                $url = url($row->url);
            } else {
                $url = $row->url;
            }
            $carousel[] = array('title' => $row->title, 'desc' => $row->desc, 'button' => $row->button, 'img' => $row->img, 'id' => $row->id, 'url' => $url);
        }
        return view('admin.dashboard', compact('change', 'surat', 'user', 'req', 'data', 'user3', 'carousel','jenis','gantijob','suratfill6'));
    }

    public function dataget()
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $data['change'] = count(trRequestChangeJob::all());
        $data['surat'] = count(mst_data::all());
        $data['user'] = count(User::all());
$datauser=User::orderBy('id', 'desc')->take(8)->get();
//
        if (\session('usercount') ==$datauser) {
            $data['status1'] = 0;
        } else {
            $data['status1'] = 1;
            foreach ($datauser as $row) {
                $min = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at);
                if ($min->copy()->addDays(2)->gte(Carbon::now())) {
                    $mins = $min->copy()->diffForHumans();
                } elseif ($min->copy()->addDay()->gte(Carbon::now())) {
                    $mins = 'Kemarin';
                } else {
                    $mins = $min->copy()->formatLocalized('%d %B %Y');
                }
                if (is_null($row->ava)) {
                    $ava = asset('images/avatar.png');
                } else {
                    $ava = asset($row->ava);
                }
                $data['pengguna12'][] = array('id' => $row->id, 'name1' => $row->name, 'tgl' => $mins, 'ava1' => $ava);
            }
            Session::put('usercount', $datauser);

        }
        $carouselcount = count(Datacarousel::all());
        if (\session('carouselcount') == $carouselcount && \session('carouselchange1') == \session('carouselchange2')) {
            $data['status2'] = 0;
        } else {
            $data['status2'] = 1;
            foreach (Datacarousel::orderBy('id', 'desc')->get() as $row) {

                $data['carousel'][] = array('id' => $row->id, 'title' => $row->title, 'img' => url($row->img));
            }
            Session::put('carouselcount', $carouselcount);
            Session::put('carouselchange1', \session('carouselchange2'));
        }
        $cate = trDataJobDesc::all();
        $surat2 = mst_data::all();
        $i = 0;
        foreach ($cate as $row) {
            $i++;
            $mstdata[$i][] = $row->name;
            foreach ($surat2 as $row2) {
                if ($row->id == $row2->job_id) {
                    $mstdata[$i][] = $row2->name;
                }
            }
        }
//dd($data);
        for ($i = 2; $i <= count($mstdata); $i++) {
            if (count($mstdata[$i]) == 1) {
                $mstdata2['mstdata'][$i] = 0;
            } else {
                $mstdata2['mstdata'][$i] = count($mstdata[$i]) - 1;

            }
        }
        for ($i = 2; $i <= count($mstdata); $i++) {
            if (\session('mstdata' . $i) == $mstdata2['mstdata'][$i]) {
                $data['mstdata'][] = false;
                $presentase1=substr((count($mstdata[$i]) - 1)*100/$data['surat'],0,4);
                $data['mstdata2'][] = array('jumlah' => count($mstdata[$i]) - 1,'presentase'=>$presentase1);

            } else {
                $data['mstdata'][] = true;
                $presentase1=substr((count($mstdata[$i]) - 1)*100/$data['surat'],0,4);
                $data['mstdata2'][] = array('jumlah' => count($mstdata[$i]) - 1,'presentase'=>$presentase1);
                Session::put('mstdata' . $i, count($mstdata[$i]) - 1);

            }
        }
        $ganti=trRequestChangeJob::orderBy('id','desc')->take(6)->get();
        if ($ganti == \session('gantijob')){
            $data['statusganti']=false;
        }
        else{
            $data['statusganti']=true;
            foreach ($ganti as $row){
                if($row->status==0){
                    $status='Menunggu';
                    $title='Menunggu Konfirmasi';
                    $label='info';
                }
                elseif ($row->status==1){
                    $status='Terkonfirmasi';
                    $title='Permintaan telah terkonfirmasi';
                    $label='success';
                }else{
                    $status='Ditolak';
                    $title='Permintaan ditolak';
                    $label='danger';
                }
                $waktu=Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at);
                $data['isiganti'][]=array('name'=>User::findOrFail($row->user_id)->name,
                    'job'=>trDataJobDesc::findOrFail($row->job_id)->name,
                    'posisition'=>trDataPosisition::findOrFail($row->posisition_id)->name,
                    'changejob'=>trDataJobDesc::findOrFail($row->changejob_id)->name,
                    'changeposisition'=>trDataPosisition::findOrFail($row->changeposisition_id)->name,
                    'status'=>$status,
                    'title'=>$title,
                    'label'=>$label,
                    'waktu'=>$waktu->copy()->formatLocalized('%d %B %Y'),
                    'terlewat'=>$waktu->copy()->diffForHumans()
                );
            }
            Session::put('gantijob', $ganti);

        }

        return response()->json($data);
    }

    public function datauniv()
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $req = trRequestChangeJob::where('admin_id', null)->orderBy('id', 'desc')->get();
        if (\session()->has('requ')) {
            if (\session('requ') == count($req)) {
                $data['status'] = 0;
            }
            else {

                for ($i = 0; $i < count($req) - session('requ'); $i++) {
                    $min = Carbon::createFromFormat('Y-m-d H:i:s', $req[$i]->created_at);
                    if ($min->copy()->addDays(2)->gte(Carbon::now())) {
                        $mins = $min->copy()->diffForHumans();
                    } elseif ($min->copy()->addDay()->gte(Carbon::now())) {
                        $mins = 'Kemarin';
                    } else {
                        $mins = $min->copy()->formatLocalized('%d %B %Y');
                    }
                    $data['req'][] = array('ava' => asset($req[$i]->user->ava), 'name' => $req[$i]->user->name, 'id' => $req[$i]->id, 'min' => $mins,
                        'dari' => $req[$i]->user->posisitions->name . ' di ' . $req[$i]->user->jobs->name, 'ke' => $req[$i]->posisition->name . ' di ' . $req[$i]->job->name);
                }
                $data['status'] = 1;
                Session::put('requ', count(trRequestChangeJob::where('admin_id', null)->orderBy('id', 'desc')->get()));
            }
        }


        return response()->json($data);
    }

    public function accept(Request $request)
    {
        $data = trRequestChangeJob::find($request->id);
        $data->admin_id = Auth::user()->id;
        $data->status = 1;
        $data->update();
        $data2 = User::find(trRequestChangeJob::find($request->id)->user_id);
        $data2->job_id = $data->changejob_id;
        $data2->posisition_id = $data->changeposisition_id;
        $data2->ganti = null;
        $data2->update();
    }

    public function reject(Request $request)
    {
        $data = trRequestChangeJob::find($request->id);
        $data->admin_id = Auth::user()->id;
        $data->status = 2;
        $data->update();
        $data2 = User::find(trRequestChangeJob::find($request->id)->user_id);
        $data2->ganti = null;
        $data2->update();
    }

    public function carouseladd(Request $request)
    {
        $data = $request->all();
        $rand = rand(111, 999);
        $name = $request->name . '_' . Carbon::now()->format('dmy') . str_random(10) . $rand;
        $filename = 'carousel/' . str_slug($name, '-') . '.' . $request->img->getClientOriginalExtension();
        $request->img->storeAs('public', $filename);
        $data['img'] = 'storage/' . $filename;
        if ($request->has('domain')) {
            $data['domain'] = 0;
        } else {
            $data['domain'] = 1;
        }
        Datacarousel::create($data);
        return response()->json($data);
    }

    public function carouseledit(Request $request)
    {

        $data = Datacarousel::findOrFail($request->id);
        $data->button = $request->button;
        $data->title = $request->title;
        if ($request->has('domain')) {
            $data->domain = 0;
        } else {
            $data->domain = 1;
        }
        $data->desc = $request->desc;
        $data->url = $request->url;
        if ($request->hasFile('img')) {
            $rand = rand(111, 999);
            $name = Carbon::now()->format('dmy') . $rand . str_random(8) . $rand;
            $filename = 'carousel/'
                . str_slug($name, '-') . '.' . $request->img->getClientOriginalExtension();
            $request->img->storeAs('public', $filename);
            if (!is_null($data->img)) {
                Storage::delete('public/' . substr($data->img, 8));
            }
            $data->img = 'storage/' . $filename;
        }
        $data->update();
        $acak = str_random(30) . rand(100001, 999999) . str_random(30) . rand(100001, 999999);
        Session::put('carouselchange2', $acak);
    }

    public function carouselget(Request $request)
    {
        $data = Datacarousel::findOrFail($request->id);
        return response()->json($data);
    }

    public function suratshow(Request $request)
    {
        $data=trDataCategory::findOrFail($request->id);
        $data1=array('name'=>$data->name,'singkatan'=>$data->singkatan,'desc'=>$data->desc,
            'user'=>User::withTrashed()->find($data->user_id)->name,
            'job'=>trDataJobDesc::find($data->job_id)->name,
            );
        return response()->json($data1);
    }

    public function carouseldelete(Request $request)
    {
        $data=Datacarousel::findOrFail($request->id);
        Storage::delete('public/' . substr($data->img, 8));
        Datacarousel::destroy($request->id);

    }

    public function mstdatashow(Request $request)
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $data1=mst_data::findOrFail($request->id);
        $data=array('name'=>$data1->name,'kode'=>$data1->kode,'category_id'=>trDataCategory::find($data1->category_id)->name,
            'job_id'=>trDataJobDesc::find($data1->job_id)->name,'user_id'=>User::find($data1->user_id)->name,
            'create_at'=>Carbon::createFromFormat('Y-m-d H:i:s', $data1->created_at)->formatLocalized('%d %B %Y'),
            'desc'=>$data1->desc
            );
        return response()->json($data);
    }
}
