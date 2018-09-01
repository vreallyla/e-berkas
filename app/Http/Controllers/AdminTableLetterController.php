<?php

namespace App\Http\Controllers;

use App\historiSendEmail;
use App\mst_data;
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
use Illuminate\Support\Facades\Storage;

class AdminTableLetterController extends Controller
{
    public function index($users)
    {
        Session::put('requ', count(trRequestChangeJob::where('admin_id', null)->orderBy('id', 'desc')->get()));
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $req = trRequestChangeJob::where('admin_id', null)->orderBy('id', 'desc')->get();
        $countCategory = count(trDataJobDesc::all()) - 1;
        $jobCategory = trDataJobDesc::orderBy('name', 'asc')->skip(1)->take($countCategory)->get();
        $user = User::orderBy('name', 'asc')->get();

        $category = trDataCategory::orderBy('id', 'desc')->get();
        if ($users == 'user' || $users == 'letter') {
            return view('admin.pengurus.user', compact('req', 'jobCategory', 'user', 'users', 'category'));
        } else {
            return redirect()->route('404');
        }
    }

    public function lihat(Request $request)
    {
        $this->getLocation();
        $id = $request->id;
        $data = array();
        if (is_array($id)) {
            for ($i = 0; $i < count($id); $i++) {
                $category = trDataCategory::findOrFail($id[$i]);
                $job = trDataJobDesc::orderBy('name', 'asc');
                $object['select'] = $category->jobdescc->id;
                $object['user'] = User::findOrFail($category->user_id)->name;
                $object['id'] = $id[$i];
                $countCategory = count(trDataJobDesc::all()) - 1;
                $object['ids'] = $job->skip(1)->take($countCategory)->pluck('id');
                $object['names'] = $job->skip(1)->take($countCategory)->pluck('name');
                $object['name'] = $category->name;
                $object['singkatan'] = $category->singkatan;
                $object['singkatan'] = $category->singkatan;
                $object['desc'] = $category->desc;
                $object['due'] = Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at)->formatLocalized('%A, %d %B %Y');
                $data[] = $object;
            }
        } else {
            $category = trDataCategory::findOrFail($id);
            $job = trDataJobDesc::orderBy('name', 'asc');
            $data['select'] = $category->jobdescc->id;
            $data['user'] = User::findOrFail($category->user_id)->name;
            $data['id'] = $id;
            $countCategory = count(trDataJobDesc::all()) - 1;
            $data['ids'] = $job->skip(1)->take($countCategory)->pluck('id');
            $data['names'] = $job->skip(1)->take($countCategory)->pluck('name');
            $data['name'] = $category->name;
            $data['singkatan'] = $category->singkatan;
            $data['singkatan'] = $category->singkatan;
            $data['desc'] = $category->desc;
            $data['due'] = Carbon::createFromFormat('Y-m-d H:i:s', $category->created_at)->formatLocalized('%A, %d %B %Y');

        }
        return response()->json($data);
    }

    public function hapus(Request $request)
    {
        $entity = $request->entity;
        $id = $request->id;
        if (is_array($id)) {
            if ($entity != 'kosong') {
                trFileHistori::whereIn('data_id', $entity)->delete();
                $history = trDataHistori::withTrashed()->whereIn('data_id', $entity);
                $file = trFile::withTrashed()->whereIn('data_id', $entity);
                $data = mst_data::withTrashed()->where('category_id', $id);
                if (count($history->get()) > 0) {
                    $history->restore();
                    $history->forceDelete();
                }
                if (count($file->get()) > 0) {
                    foreach ($file->get() as $r) {
                        Storage::delete('public/' . substr($r->name, 8));
                    }
                    $file->restore();
                    $file->forceDelete();
                }
                if (count($data->get()) > 0) {
                    $data->restore();
                    $data->forceDelete();
                }
            }
            trDataCategory::whereIn('id', $id)->delete();

        } else {
            if ($entity != 'kosong') {

                trFileHistori::whereIn('data_id', $entity)->delete();
                $history = trDataHistori::withTrashed()->whereIn('data_id', $entity);
                $file = trFile::withTrashed()->whereIn('data_id', $entity);
                $data = mst_data::withTrashed()->where('category_id', $id);
                if (count($history->get()) > 0) {
                    $history->restore();
                    $history->forceDelete();
                }
                if (count($file->get()) > 0) {
                    foreach ($file->get() as $r) {
                        Storage::delete('public/' . substr($r->name, 8));
                    }
                    $file->restore();
                    $file->forceDelete();
                }
                if (count($data->get()) > 0) {
                    $data->restore();
                    $data->forceDelete();
                }
            }
            trDataCategory::destroy($id);
        }
//        return response()->json($request->all());
    }

    public function cekhapus(Request $request)
    {
        if (is_array($request->id)) {
            $count = mst_data::whereIn('category_id', $request->id)->pluck('id');
        } else {
            $count = trDataCategory::find($request->id)->mstdata->pluck('id');
        }
        return response()->json($count);
    }

    public function api(Request $request)
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $row = trDataCategory::where('job_id', $request->id)->orderBy('name', 'asc')->get();
        $data = array();

        foreach ($row as $r) {
            $data[] = array('name' => $r->name, 'singkatan' => $r->singkatan, 'user1' => User::findOrFail($r->user_id)->name,
                'dibuat' => Carbon::createFromFormat('Y-m-d H:i:s', $r->created_at)->formatLocalized('%d %B %Y'),
                'id' => $r->id, 'job_id' => $r->job_id
            );
        }

        return response()->json($data);
    }

    public function storesurat(Request $request)
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $user = Auth::user()->id;
        $user2 = Auth::user()->name;
        if (is_array($request->id)) {
            for ($i = 0; $i < count($request->id); $i++) {
                $rubah = trDataCategory::findOrFail($request->id[$i]);
                $rubah->name = $request->name[$i];
                $rubah->singkatan = $request->singkatan[$i];
                $rubah->job_id = $request->job_id[$i];
                $rubah->desc = $request->desc[$i];
                $rubah->user_id = $user;
                $rubah->update();
                $data[] = Carbon::createFromFormat('Y-m-d H:i:s', $rubah->created_at)->formatLocalized('%d %B %Y');
                $data2[] = $user2;
            }
            $request['dibuat'] = $data;
            $request['user'] = $data2;
        } else {
            $data = trDataCategory::findOrFail($request->id);
            $data->name = $request->name;
            $data->singkatan = $request->singkatan;
            $data->job_id = $request->job_id;
            $data->desc = $request->desc;
            $data->user_id = Auth::user()->id;
            $request['dibuat'] = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->formatLocalized('%d %B %Y');
            $request['user'] = Auth::user()->name;
            $request['multi'] = false;
            $data->update();
        }
        return response()->json($request->except('desc'));
    }

    public function storesuratplus(Request $request)
    {

        for ($i = 0; $i < count($request->name); $i++) {
            trDataCategory::create(['name' => $request->name[$i], 'singkatan' => $request->singkatan[$i], 'job_id' => $request->job_id[$i], 'desc' => $request->desc[$i], 'user_id' => Auth::user()->id]);
        }

        return response()->json($request);
    }

    public function getLocation()
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
    }

    public function edit(Request $request)
    {
        $r = $request;
        if (is_array($r->id)) {
            for ($i = 0; $i < count($r->id); $i++) {
                $chan = trDataCategory::findOrFail($r->id[$i])->update(['name' => $r->name[$i], 'singkatan' => $r->singkatan[$i], 'job_id' => $r->job_id[$i], 'desc' => $r->desc[$i]]);
            }
        } else {
            $chan = trDataCategory::findOrFail($r->id)->update($r->except('id', 'noarray', 'user_id'));
            return response()->json($request->except('id', 'noarray', 'user_id'));
        }

    }

    public function apiPenghuni(Request $r)
    {//variable
        if ($r->id=='na'){
            $data=$this->apiPenghunihistori($r);
        }
        else {
            $next = 10;
            $skip = ($r->pagination - 1) * $next;
            //variable
            if (is_null($r->search)) {
                $entity = $this->countCategory($r->id, 0, $r->search);
                if (0 < $entity) {
                    $data['status'] = 1;
                    $data['pagination'] = ceil($entity / $next);
                    $data['entity'] = $entity;
                    foreach ($this->getPagination($r->id, $skip, $next) as $row) {
                        $data['list'][] = array('name' => $row->name,
                            'nip' => $row->nip,
                            'role' => $this->getRole($row->role_id),
                            'id' => $row->id,
                            'ps' => $this->getPosisition($row->posisition_id));
                    }

                } else {
                    $data['status'] = 0;
                }
            } else {
                $component = $this->countCategory($r->id, 1, $r->search);
                if (0 < $component['count']) {
                    $data['status'] = 1;
                    $data['entity'] = $component['count'];
                    $data['pagination'] = ceil($component['count'] / $next);
                    $data['list'] = array_slice($component['list'], $skip, $next);
                } else {

                    $data['status'] = 0;
                }


            }
        }
        return $data;
    }

    private function countCategory($id, $method, $search)
    {
        if ($method == 0) {
            $data = array();
            $data1 = User::where('job_id', $id)->orderBy('name', 'asc')->get();
            $data = count($data1);
        } elseif ($method == 1) {
            $component = $this->findPengguna($search, $id);
            if ($component['status'] == 1) {
                $data['list'] = $component['list'];
            } else {
                $data['list'] = array();
            }

            $data['count'] = count($data['list']);
        }
        return $data;
    }

    private function findPengguna($search, $id)
    {
        $compare = User::where('job_id', $id)->orderBy('name', 'asc')->get();
        $data['status'] = 0;
        foreach ($compare as $row) {
            $role2 = $this->getRole($row->role_id);
            $ps2 = $this->getPosisition($row->posisition_id);
            $name = strpos(strtolower($row->name), strtolower($search));
            $nip = strpos(strtolower($row->nip), strtolower($search));
            $ps = strpos(strtolower($ps2), strtolower($search));
            $role = strpos(strtolower($role2), strtolower($search));

            if ($name !== false || $nip !== false || $ps !== false || $role !== false) {
                $data['list'][] = array('name' => $row->name, 'nip' => $row->nip, 'ps' => $ps2, 'role' => $role2, 'id' => $row->id);
                $data['status'] = 1;
            }
        }
        return $data;
    }

    private function getPagination($id, $skip, $next)
    {
        $data = User::where('job_id', $id)->orderBy('name', 'asc')->skip($skip)->take($next)->get();

        return $data;

    }

    private function getRole($id)
    {
        $data = status::findOrFail($id)->name;
        return $data;
    }

    private function getPosisition($id)
    { $data=trDataPosisition::findOrFail($id)->name;
        return $data;
    }

    public function apiPenghunihistori(Request $r)
    {//variable
        $next = 10;
        $skip = ($r->pagination - 1) * $next;
        //variable
        if (is_null($r->search)) {
            $entity = $this->countCategoryH( 0, $r->search);
            if (0 < $entity) {
                $data['status'] = 1;
                $data['pagination'] = ceil($entity / $next);
                $data['entity'] = $entity;
                $data['list'] =$this->getPaginationH($skip, $next);

            } else {
                $data['status'] = 0;
            }
        } else {
            $component = $this->countCategoryH(1, $r->search);
            if (0 < $component['count']) {
                $data['status'] = 1;
                $data['entity'] = $component['count'];
                $data['pagination'] = ceil($component['count'] / $next);
                $data['list'] = array_slice($component['list'], $skip, $next);
            } else {

                $data['status'] = 0;
            }


        }
        return $data;
    }

    private function countCategoryH( $method, $search)
    {
        if ($method == 0) {
            $data = array();
            $data1 = historiSendEmail::orderBy('id','desc')->get();
            $data = count($data1);
        } elseif ($method == 1) {
            $component = $this->findPenggunaH($search);
            if ($component['status'] == 1) {
                $data['list'] = $component['list'];
            } else {
                $data['list'] = array();
            }

            $data['count'] = count($data['list']);
        }
        return $data;
    }

    private function findPenggunaH($search)
    {
        $c = historiSendEmail::orderBy('id', 'desc')->get();
        $compare = array();
        foreach ($c as $r) {
            $compare[] = array('name' => $r->usw->name
            ,'id' => $r->id
            ,'status' => $r->status
            , 'nip' => $r->usw->nip
            , 'job_id' => trDataJobDesc::findOrFail($r->usw->job_id)->name
            , 'posisition_id' => trDataPosisition::findOrFail($r->usw->posisition_id)->name
            , 'role_id' => status::findOrFail($r->usw->role_id)->name);

        }
        $data['status'] = 0;
        foreach ($compare as $row) {
            $name = strpos(strtolower($row['name']), strtolower($search));
            $nip = strpos(strtolower($row['nip']), strtolower($search));
            $ps = strpos(strtolower($row['posisition_id']), strtolower($search));
            $role = strpos(strtolower($row['role_id']), strtolower($search));
            $job= strpos(strtolower($row['job_id']), strtolower($search));

            if ($name !== false || $nip !== false || $ps !== false || $role !== false|| $job !== false) {
                $data['list'][] = array('name' => $row['name'],
                    'nip' => $row['nip'],
                    'posisition_id' => $row['posisition_id'],
                    'role_id' => $row['role_id'],
                    'job_id' => $row['job_id'],
                    'id' => $row['id']);
                $data['status'] = 1;
            }
        }
        return $data;
    }
    private function getPaginationH($skip, $next)
    {
        $value=historiSendEmail::orderBy('id', 'desc')->skip($skip)->take($next)->get();
        $data=array();
        foreach ($value as $r){

            $data[] = array('name' => $r->usw->name
            ,'id' => $r->id
            ,'status' => $r->status
            , 'nip' => $r->usw->nip
            , 'job_id' => trDataJobDesc::findOrFail($r->usw->job_id)->name
            , 'posisition_id' => trDataPosisition::findOrFail($r->usw->posisition_id)->name
            , 'role_id' => status::findOrFail($r->usw->role_id)->name);;
        }

        return $data;

    }
}
