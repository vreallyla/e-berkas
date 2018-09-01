<?php

namespace App\Http\Controllers;

use App\mst_data;
use App\trDataCategory;
use App\trDataHistori;
use App\trFile;
use App\trFileHistori;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class eBerkasduaController extends Controller
{
    public function index()
    {
        $category = $this->getCatagories();
        return view('user.eberkas.indexdua', compact('category'));
    }

    private function getCatagories()
    {
        $job = trDataCategory::where('job_id', Auth::user()->job_id)->orderBy('name', 'asc')->get(['id', 'name', 'singkatan']);
        $job2 = $job;
        return $job2;
    }

    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->name); $i++) {
            mst_data::create(['name' => $request->name[$i], 'desc' => $request->desc[$i], 'kode' => $request->kode[$i], 'category_id' => $request->category_id[$i],
                'user_id' => Auth::user()->id, 'job_id' => Auth::user()->job_id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
            $z = 1;
            foreach ($request->file[$i] as $row) {
                $rand = rand(111, 999);
                $name = $request->name[$i] . '_' . Carbon::now()->format('dmy') . $rand . $z++;
                $filename = 'berkas/surat/'
                    . str_slug($name, '-') . '.' . $row->getClientOriginalExtension();
//                    $filesize = $row->getClientSize();
                $row->storeAs('public', $filename);
                trFile::create(['name' => 'storage/' . $filename, 'data_id' => mst_data::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first()->id]);
            }
        }

        return response()->json($request);
    }

    public function api(Request $r)
    {
        $index = $r->index;
        $next = $r->page;
        $skip = ($r->pagination - 1) * $next;
        if ($r->index == 1 || $r->index == 2) {
            $id = null;
        } else {
            $id = $r->id;
        }
        if (is_null($r->search)) {
            $result = $this->notsearch($id, $index, $skip, $next,$r->pagination);
        } else {
            $result = $this->findData($id, $index, $skip, $next, $r->search,$r->pagination);
        }
        return response()->json($result);
    }

    private function findData($id, $index, $skip, $next, $search,$pagi)
    {
        $this->getLocation();
        $label = mst_data::where('job_id', Auth::user()->job_id);
        if (is_null($id)) {
            if ($index == 2) {
                $data = $label->orderBy('id', 'desc')->get();

            } else {
                $data = $label->onlyTrashed()->orderBy('deleted_at', 'desc')->get();
            }
        } else {
            $data = mst_data::where('category_id', $id)->orderBy('id', 'desc')->get();

        }
        $result['entity'] = $result['status'] = 0;
        if (count($data) > 0) {
            foreach ($data as $r) {
                $kode = $r->kode;
                $name = $r->name;
                $user_id = $r->user_id;
                $id = $r->id;
                $user = $r->User->name;
                $userdel_id = $r->userdel;
                $userdel = null;
                if (!is_null($userdel_id)) {
                    $userdel = $r->Userdel->name;
                }

                $category = $r->trDataCategory->name;
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $r->created_at)->formatLocalized('%A, %d %B %Y');
                $date2 = null;
                if (!is_null($r->deleted_at)) {
                    $date2 = Carbon::createFromFormat('Y-m-d H:i:s', $r->deleted_at)->formatLocalized('%A, %d %B %Y');
                }
                $comparkode = strpos(strtolower($kode), strtolower($search));
                $comparname = strpos(strtolower($name), strtolower($search));
                $comparuser = strpos(strtolower($user), strtolower($search));
                $comparuserdel = strpos(strtolower($userdel), strtolower($search));
                $comparcategory = strpos(strtolower($category), strtolower($search));
                $compardate = strpos(strtolower($date), strtolower($search));
                $compardate2 = strpos(strtolower($date2), strtolower($search));

                if (strlen($user) > 11) {
                    $user = substr($user, 0, 11) . '...';
                }
                if (strlen($userdel) > 11) {
                    $userdel = substr($userdel, 0, 11) . '...';
                }
                if ($index == 0) {
                    if ($comparkode !== false || $comparname !== false || $comparuser !== false || $compardate !== false) {
                        $result['status'] = 1;
                        $result['entity'] = $result['entity'] + 1;
                        $rela = array();
                        foreach (trFile::where('data_id', $r->id)->get() as $tr) {
                            $url = $tr->name;
                            $rela[] = array('url' => $url, 'name' => substr($tr->name, 21));

                        }
                        $result['data'][] = array('kode' => $kode, 'name' => $name, 'user_id' => $user_id, 'user' => $user, 'date' => $date
                        , 'id' => $id, 'relation' => $rela);
                    }
                } elseif ($index == 1) {
                    if ($comparkode !== false || $comparname !== false || $compardate2 !== false || $comparcategory !== false || $comparuserdel !== false) {
                        $result['status'] = 1;
                        $result['entity'] = $result['entity'] + 1;
                        $rela = array();
                        foreach (trFile::where('data_id', $r->id)->get() as $tr) {
                            $url = $tr->name;
                            $rela[] = array('url' => $url, 'name' => substr($tr->name, 21));

                        }
                        $result['data'][] = array('kode' => $kode, 'name' => $name, 'category' => $category, 'date2' => $date2
                        , 'userdel' => $userdel
                        , 'userdel_id' => $userdel_id, 'id' => $id, 'relation' => $rela);

                    }
                } elseif ($index == 2) {
                    if ($comparkode !== false || $comparname !== false || $comparuser !== false || $compardate !== false || $comparcategory !== false) {
                        $result['status'] = 1;
                        $result['entity'] = $result['entity'] + 1;
                        $rela = array();
                        foreach (trFile::where('data_id', $r->id)->get() as $tr) {
                            $url = $tr->name;
                            $rela[] = array('url' => $url, 'name' => substr($tr->name, 21));

                        }
                        $result['data'][] = array('kode' => $kode, 'name' => $name, 'user_id' => $user_id, 'user' => $user, 'category' => $category, 'date' => $date
                        , 'id' => $id, 'relation' => $rela);
                    }
                }

            }
            if (isset($result['data'])){
            $anu= array_slice($result['data'], $skip, $next);
            if (count($anu)==0){
                $result['data']=array_slice($result['data'], ($skip-10), $next);
                $pagi=$pagi-1;
            }
            else{
                $result['data']=$anu;
            }
                $result['maxpage'] = ceil($result['entity'] / $next);
            $result['pagi']=$pagi;

            }

        }
        return $result;
    }

    private function inputArray($kode, $name, $user_id, $id, $user, $userdel_id, $userdel, $category, $date, $date2)
    {
        $result['status'] = 1;
        $result['entity'] = $result['entity'] + 1;
        $result['data'][] = array('kode' => $kode, 'name' => $name, 'user_id' => $user_id, 'user' => $user, 'category' => $category, 'date' => $date, 'date2' => $date2
        , 'userdel' => $userdel, 'userdel_id' => $userdel_id, 'id' => $id);
        return $result;
    }


    private function notsearch($id, $index, $skip, $next,$pagi)
    {
        $label = mst_data::where('job_id', Auth::user()->job_id);
        if (is_null($id)) {
            if ($index == 2) {
                $data = $label->orderBy('id', 'desc')->skip($skip)->take($next)->get();
                if (count($data)==0){
                    $data =  mst_data::where('job_id', Auth::user()->job_id)->orderBy('id', 'desc')->skip($skip-10)->take($next)->get();
                    $pagi=$pagi-1;
                }
                $data2 = mst_data::where('job_id', Auth::user()->job_id)->get();

            } else {
                $data = $label->onlyTrashed()->orderBy('deleted_at', 'desc')->skip($skip)->take($next)->get();
                if (count($data)==0){
                    $data = mst_data::where('job_id', Auth::user()->job_id)->onlyTrashed()->orderBy('id', 'desc')->skip($skip-10)->take($next)->get();
                    $pagi=$pagi-1;
                }
                $data2 = mst_data::where('job_id', Auth::user()->job_id)->onlyTrashed()->get();
            }
        } else {
            $data = mst_data::where('category_id', $id)->orderBy('id', 'desc')->skip($skip)->take($next)->get();
            if (count($data)==0){
                $data =  mst_data::where('category_id', $id)->orderBy('id', 'desc')->skip($skip-10)->take($next)->get();
                $pagi=$pagi-1;
            }
            $data2 = mst_data::/*where('job_id', Auth::user()->job_id)->*/where('category_id', $id)->get();
        }
        return $this->setarray($data, $next, $id, $data2,$pagi);
    }

    private function setarray($data, $delimiter, $id, $data2,$pagi)
    {
        $this->getLocation();
        $result = array();
        $entity = $result['entity'] = count($data2);
        $result['status'] = 0;
        if ($entity > 0) {
            $result['status'] = 1;
            $result['pagi'] = $pagi;
            $result['maxpage'] = ceil($entity / $delimiter);
            foreach ($data as $row) {
                $user = $row->User->name;
                $userdel = 'not difined';
                if (!is_null($row->userdel)) {
                    $userdel = $row->Userdel->name;
                }

                if (strlen($user) > 11) {
                    $user = substr($user, 0, 11) . '...';
                }
                if (strlen($userdel) > 11) {
                    $userdel = substr($userdel, 0, 11) . '...';
                }
                $rela = array();
                foreach (trFile::where('data_id', $row->id)->get() as $tr) {
                    $url = $tr->name;
                    $rela[] = array('url' => $url, 'name' => substr($tr->name, 21));

                }
                $deldate = "data tidak tersedia";
                if (!is_null($row->deleted_at)) {
                    $deldate = Carbon::createFromFormat('Y-m-d H:i:s',
                        $row->deleted_at)->formatLocalized('%A, %d %B %Y');
                }
                $result['data'][] = array('name' => $row->name, 'kode' => $row->kode, 'user' => $user, 'user_id' => $row->user_id, 'category' => $row->trDataCategory->name,
                    'date' => Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->formatLocalized('%A, %d %B %Y'),
                    'date2' => $deldate, 'id' => $row->id, 'userdel' => $userdel
                , 'userdel_id' => $row->userdel, 'relation' => $rela);
            }
        }
        return $result;
    }

    public function getLocation()
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
    }

    public function destroy(Request $r)
    {
        $id = $r->id;
        $method = $r->metode;
        if ($method == 2) {
            if (is_array($id)) {
                $datafs = trFileHistori::whereIn('data_id', $id)->get();
                $datads = trDataHistori::whereIn('data_id', $id)->get();
                $dataf = trFile::whereIn('data_id', $id)->get();

                if (!is_null($datafs)) {
                    trFileHistori::whereIn('data_id', $id)->delete();
                }
                if (!is_null($datads)) {
                    trDataHistori::onlyTrashed()->whereIn('data_id', $id)->restore();
                    trDataHistori::whereIn('data_id', $id)->forceDelete();
                }

                if (!is_null($dataf)) {
                    $hapus = trFile::withTrashed()->whereIn('id', $id)->pluck('name')->all();
                    foreach ($hapus as $row) {
//                    $a[]=substr($row,21);
                        Storage::delete('public/' . substr($row, 8));
                    }
                    trFile::onlyTrashed()->whereIn('data_id', $id)->restore();
                    trFile::whereIn('data_id', $id)->forceDelete();
                }

                mst_data::onlyTrashed()->whereIn('id', $id)->restore();
                mst_data::whereIn('id', $id)->forceDelete();
            } else {
                $datafs = trFileHistori::where('data_id', $id)->get();
                $datads = trDataHistori::where('data_id', $id)->get();
                $dataf = trFile::where('data_id', $id)->get();
                if (!is_null($datafs)) {
                    trFileHistori::where('data_id', $id)->delete();
                }
                if (!is_null($datads)) {
                    trDataHistori::onlyTrashed()->where('data_id', $id)->restore();
                    trDataHistori::where('data_id', $id)->forceDelete();
                }

                if (!is_null($dataf)) {
                    $hapus = trFile::withTrashed()->where('id', $id)->pluck('name')->all();
                    foreach ($hapus as $row) {
//                    $a[]=substr($row,21);
                        Storage::delete('public/' . substr($row, 8));
                    }
                    trFile::onlyTrashed()->where('data_id', $id)->restore();
                    trFile::where('data_id', $id)->forceDelete();
                }

                mst_data::onlyTrashed()->findOrFail($id)->restore();
                mst_data::where('id', $id)->forceDelete();


            }

        }
        else {
            if (is_array($id)) {
                $data = mst_data::whereIn('id', $id)->get();
                $trans = array();
                foreach ($data as $row) {
                    $trans[] = array('name' => $row->name,
                        'kode' => $row->kode, 'desc' => $row->desc, 'user_id' => Auth::user()->id,
                        'category_id' => $row->category_id, 'job_id' => $row->job_id, 'data_id' => $row->id
                    , 'deletes' => 0
                    , 'edit' => 0
                    , 'tambah' => 0, 'deldata' => 1, 'resdata' => 0,'created_at'=>Carbon::now(),'updated_at'=>Carbon::now());
                }
                trDataHistori::insert($trans);
                mst_data::whereIn('id', $id)->update(['userdel' => Auth::user()->id]);
                mst_data::whereIn('id', $id)->delete();
            } else {
                $data = mst_data::findOrFail($id);
                trDataHistori::create(['name' => $data->name,
                    'kode' => $data->kode, 'desc' => $data->desc, 'user_id' => Auth::user()->id,
                    'category_id' => $data->category_id, 'job_id' => $data->job_id, 'data_id' => $id
                    , 'deletes' => 0
                    , 'edit' => 0
                    , 'tambah' => 0, 'deldata' => 1, 'resdata' => 0
                ]);
                $data->update(['userdel' => Auth::user()->id]);
                mst_data::destroy($id);
//        $data2 = mst_data::withTrashed()->where('id', $id)->first();
//        $data = trDataCategory::findOrFail($data2->category_id);
            }
        }
        return response()->json(['status' => 'sukses'/*, 'category' => $data->singkatan*/]);
    }

    public function edit(Request $r)
    {
        $this->getLocation();
        $id = $r->id;
//        $metode=$r->metode;
        $data = array();
        $dataCategory = trDataCategory::where('job_id', Auth::user()->job_id)->orderBy('name', 'asc')->get();
        $dataCategory2 = array();
        foreach ($dataCategory as $row) {
            $dataCategory2[] = array('name' => $row->singkatan . ' (' . $row->name . ')', 'id' => $row->id);
        }

        if (is_array($id)) {
            $i = mst_data::whereIn('id', $id)->orderBy('id', 'desc')->get();
            $data['category_list'] = $dataCategory2;
            foreach ($i as $x) {
                $data['listss'][] = array('name' => $x->name,
                    'kode' => $x->kode,
                    'category_id' => $x->category_id,
                    'desc' => $x->desc,
                    'id' => $x->id);
            }
        } else {
            $i = mst_data::withTrashed()->findOrFail($id);
            $dataFile = trFile::where('data_id', $id)->get();
            $dataFile2 = array();
            $cek = $i->Userdel;
            $userdel = '';
            if (!is_null($cek)) {
                $userdel = $cek->name;
            }
            foreach ($dataFile as $row) {
                $dataFile2[] = array('name' => substr($row->name, 21), 'url' => $row->name, 'id' => $row->id);
            }

            $data = array('kode' => $i->kode,
                'name' => $i->name,
                'desc' => $i->desc,
                'user_id' => $i->User->name,
                'userdel' => $userdel,
                'file' => $dataFile2,
                'id' => $i->id,
                'job_id' => $i->category_id,
                'job_list' => $dataCategory2);
        }
        return response()->json($data);
    }

    public function update(Request $r)
    {
        $id = $r->id;
        $idAdd = array();
        $idDel = array();
        $idEdit = array();
        if (is_array($id)) {

        } else {
            $data = mst_data::findOrFail($id);
            $statusFile = 0;
            $statusDel = 0;
            $statusEdit = 0;
            if ($r->hasFile('file')) {
                foreach ($r->file as $row) {
                    $rand = rand(111, 999);
                    $name = $r->name . '_' . Carbon::now()->format('dmy') . $rand . rand(1, 2);
                    $filename = 'berkas/surat/'
                        . str_slug($name, '-') . '.' . $row->getClientOriginalExtension();
//                    $filesize = $row->getClientSize();
                    $row->storeAs('public', $filename);
                    $file_id = trFile::create(['name' => 'storage/' . $filename, 'data_id' => $id])->id;
                    $statusFile = 1;
                    $idAdd[] = trFileHistori::create(['metode' => 2, 'file_id' => $file_id,
                        'data_id' => $id])->id;
                }
            }
            if ($r->has('hapus')) {
                $statusDel = 1;
//                $hapus=trFile::whereIn('id',$r->hapus)->pluck('name')->all();
//                foreach ($hapus as $row){
//                    $a[]=substr($row,21);
//                    Storage::delete('public/'.substr($row,8));
//                }
                if (is_array($r->hapus)) {
                    trFile::whereIn('id', $r->hapus)->delete();
                    foreach ($r->hapus as $row) {
                        $idDel[] = trFileHistori::create(['metode' => 1, 'file_id' => $row,
                            'data_id' => $id])->id;
                    }
                } else {
                    trFile::findOrFail('id', $r->hapus)->destroy();
                    $idDel[] = trFileHistori::create(['metode' => 1, 'file_id' => $r->hapus])->id;
                }

            }
            if ($r->name != $data->name ||
                $r->kode != $data->kode ||
                $r->desc != $data->desc ||
                $r->category_id != $data->category_id) {
                $statusEdit = 1;
            }
            $status = 0;
            if ($statusEdit == 1 || $statusDel == 1 || $statusFile == 1) {
                $status = 1;
                $row = $r;
                $idHistori = trDataHistori::create(['name' => $data->name,
                    'kode' => $data->kode, 'desc' => $data->desc, 'user_id' => Auth::user()->id,
                    'category_id' => $data->category_id, 'job_id' => Auth::user()->job_id, 'data_id' => $id
                    , 'deletes' => $statusDel
                    , 'edit' => $statusEdit
                    , 'tambah' => $statusFile, 'deldata' => 0, 'resdata' => 0])->id;
                if ($statusFile == 1) {
                    $data = trFileHistori::whereIn('id', $idAdd)->update(['histori_id' => $idHistori]);
                }
                if ($statusDel == 1) {
                    $data = trFileHistori::whereIn('id', $idDel)->update(['histori_id' => $idHistori]);
                }
                if ($statusEdit == 1) {
                    $data->update(['name' => $r->name, 'kode' => $r->kode, 'desc' => $r->desc, 'category_id' => $r->category_id]);
                }
            }

        }
        return $status;
    }

    public function multiupdate(Request $r)
    {
        $status = 0;
        for ($i = 0; $i < count($r->id); $i++) {
            $data = mst_data::findOrFail($r->id[$i]);
            if ($r->name[$i] != $data->name ||
                $r->kode[$i] != $data->kode ||
                $r->desc[$i] != $data->desc ||
                $r->category_id[$i] != $data->category_id) {
                $status = 1;

                trDataHistori::create(['name' => $data->name,
                    'kode' => $data->kode, 'desc' => $data->desc,
                    'user_id' => Auth::user()->id, 'category_id' => $data->category_id
                    , 'job_id' => Auth::user()->job_id, 'data_id' => $r->id[$i]
                    , 'deletes' => 0
                    , 'edit' => 1
                    , 'tambah' => 0, 'deldata' => 0, 'resdata' => 0]);
                $data->update(['name' => $r->name[$i],
                    'kode' => $r->kode[$i],
                    'category_id' => $r->category_id[$i],
                    'desc' => $r->desc[$i]]);
            }
        }
        return $status;
    }

    public function restore(Request $r)
    {

        if (is_array($r->id)) {
            mst_data::onlyTrashed()->whereIn('id', $r->id)->update(['userdel' => null]);
            $sample = mst_data::onlyTrashed()->whereIn('id', $r->id)->get();
            foreach ($sample as $data) {
                trDataHistori::create(['name' => $data->name,
                    'kode' => $data->kode, 'desc' => $data->desc,
                    'user_id' => Auth::user()->id, 'category_id' => $data->category_id
                    , 'job_id' => Auth::user()->job_id, 'data_id' => $data->id
                    , 'deletes' => 0
                    , 'edit' => 0
                    , 'tambah' => 0, 'deldata' => 0, 'resdata' => 1]);
            }
            mst_data::onlyTrashed()->whereIn('id', $r->id)->restore();

        } else {
            mst_data::onlyTrashed()->findOrFail($r->id)->update(['userdel' => null]);
            $data = mst_data::onlyTrashed()->findOrFail($r->id);
            trDataHistori::create(['name' => $data->name,
                'kode' => $data->kode, 'desc' => $data->desc,
                'user_id' => Auth::user()->id, 'category_id' => $data->category_id
                , 'job_id' => Auth::user()->job_id, 'data_id' => $r->id
                , 'deletes' => 0
                , 'edit' => 0
                , 'tambah' => 0, 'deldata' => 0, 'resdata' => 1]);
            $data->restore();
        }
        return response()->json('a');
    }

    public function history(Request $r)
    {
        $id = $r->id;
        $metode = $r->id;
        $this->getLocation();
        $i = trDataHistori::withTrashed()->where('data_id', $id)->get();
        $data = null;
        if (!is_null($i)) {
            $data['status']=0;
            foreach ($i as $x) {
                $data['status']=1;
                $delData = array();
                $addData = array();
                $editData = array();
                $datadel = trFileHistori::where('histori_id', $x->id)->get();
                if ($x->deletes == 1) {
                    foreach ($datadel as $z) {
                        $url = $z->files->name;
                        $delData[] = array('url' => url($url), 'name' => substr($url, 21));
                    }
                }
                if ($x->tambah == 1) {
                    foreach ($datadel as $z) {
                        $url = $z->files->name;
                        $addData[] = array('url' => url($url), 'name' => substr($url, 21));
                    }

                }
                if ($x->edit == 1) {
                    $c = mst_data::withTrashed()->findOrFail($id);
                    $nameCek = $c->name;
                    $kodeCek = $c->kode;
                    $ndescCek = $c->desc;
                    $categoryCek = $c->trDataCategory->name;
                    $v = trDataHistori::withTrashed()->where('data_id', $id)->where('edit', 1)->get();
                    if (count($v) > 0) {
                        $cek1 = array();
                        foreach ($v as $d) {
                            $cek1[] = array('id' => $d->id, 'name' => $d->name, 'kode' => $d->kode
                            , 'category_id' => $d->category_id, 'cate' => $d->cate->name, 'desc' => $d->desc);
                        }
                        $cek2 = null;

                        for ($i = 0; $i < count($cek1); $i++) {
                            if ($cek1[$i]['id'] == $x->id) {
                                $cek2 = $i;
                                break;
                            }
                        }

                        if ((count($cek1) - 1) == $cek2) {
                            $dataNextEdit = $cek1[(count($cek1) - 1)];
                            if ($dataNextEdit['name'] != $nameCek) {
                                $nameCek = $dataNextEdit['name'] . ' -> ' . $nameCek;
                            }
                            if ($dataNextEdit['kode'] != $kodeCek) {
                                $kodeCek = $dataNextEdit['kode'] . ' -> ' . $kodeCek;
                            }
                            if ($dataNextEdit['desc'] != $ndescCek) {
                                $ndescCek = $dataNextEdit['desc'] . ' -> ' . $ndescCek;
                            }
                            if ($dataNextEdit['category_id'] != $c->category_id) {
                                $categoryCek = $dataNextEdit['cate'] . ' -> ' . $categoryCek;
                            }
                        } else {
                            $dataNextEdit = $cek1[$cek2 + 1];
                            if ($dataNextEdit['name'] != $x->name) {
                                $nameCek = $x->name . ' -> ' . $dataNextEdit['name'];
                            }
                            if ($dataNextEdit['kode'] != $x->kode) {
                                $kodeCek = $x->kode . ' -> ' . $dataNextEdit['kode'];
                            }
                            if ($dataNextEdit['desc'] != $x->desc) {
                                $ndescCek = $x->desc . ' -> ' . $dataNextEdit['desc'];
                            }
                            if ($dataNextEdit['category_id'] != $x->category_id) {
                                $categoryCek = $x->cate->name . ' -> ' . $dataNextEdit['cate'];
                            }
                        }
                    }
//                    else {
//                        $dataNextEdit = $c;
//                        if ($dataNextEdit['name'] != $x->name) {
//                            $nameCek = $x->name . ' -> ' . $dataNextEdit['name'];
//                        }
//                        if ($dataNextEdit['kode'] != $x->kode) {
//                            $kodeCek = $x->kode . ' -> ' . $dataNextEdit['kode'];
//                        }
//                        if ($dataNextEdit['desc'] != $x->desc) {
//                            $ndescCek = $x->desc . ' -> ' . $dataNextEdit['desc'];
//                        }
//                        if ($dataNextEdit['category_id'] != $x->category_id) {
//                            $categoryCek = $x->cate->name . ' -> ' . $dataNextEdit['cate'];
//                        }
//                    }

                    $editData = array('name' => $nameCek,
                        'kode' => $kodeCek, 'desc' => $ndescCek,
                        'category' => $categoryCek);
                }
                if (is_null($x->updated_at)){
                    $date='Undefined';
                }
                else {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $x->updated_at)->format('d/m/Y H:i:s') . ' WIB.';
                }
                $data['lists'][] = array('user_id' => $x->User->name, 'date' => $date, 'fileDel' => $x->deletes, 'edit' => $x->edit,
                    'addfiles' => $x->tambah, 'del' => $x->deldata, 'res' => $x->resdata,
                    'listDel' => $delData, 'listAdd' => $addData, 'listEdit' => $editData);
            }
        }
        else{
            $data['status']=0;
        }

        return response()->json($data);
    }
}
