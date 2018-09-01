<?php

namespace App\Http\Controllers;

use App\mst_data;
use App\trDataCategory;
use App\trDataHistori;
use App\trDataJobDesc;
use App\trFile;
use App\trFileHistori;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Yajra\Datatables\Datatables;

class eBerkasController extends Controller
{
    public function index()
    {
        $base_url = url('/eBerkas');
        $job = trDataCategory::where('job_id', Auth::user()->job_id)->get();
        $data2 = mst_data::where('job_id', Auth::user()->job_id)->orderBy('created_at', 'desc')->get();
        $job2 = array();
        $job3 = array();
        foreach ($job as $row) {
            $job2[] = array($row->id);
        }
        foreach ($job as $row) {
            $job3[] = array($row->singkatan);
        }
$job_id=Auth::user()->job_id;
//        dd($job3);
        $a = -1;
        return view('user.eberkas.index', compact('base_url','job_id', 'job', 'data2', 'job2', 'a', 'job3'));
    }

    public function store(Request $request)
    {
        if (is_array($request->name)) {
            for ($i = 0; $i < count($request->name); $i++) {
                mst_data::create(['name' => $request->name[$i], 'desc' => $request->desc[$i], 'kode' => $request->kode[$i], 'category_id' => $request->category_id[$i],
                    'user_id' => Auth::user()->id, 'job_id' => Auth::user()->job_id, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
                $z = 1;
                foreach ($request->file[$i + 1] as $row) {
                    $rand = rand(111, 999);
                    $name = $request->name[$i] . '_' . Carbon::now()->format('dmy') . $rand . $z++;
                    $filename = 'berkas/surat/'
                        . str_slug($name, '-') . '.' . $row->getClientOriginalExtension();
//                    $filesize = $row->getClientSize();
                    $row->storeAs('public', $filename);
                    trFile::create(['name' => 'storage/' . $filename, 'data_id' => mst_data::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first()->id]);
                }

            }

        } else {
            $data = $request->except('file', 'status');
            $data['user_id'] = Auth::user()->id;
            $data['job_id'] = Auth::user()->job_id;
            mst_data::create($data);
            $z = 1;
            foreach ($request->file as $row) {
                $rand = rand(111, 999);
                $name = $request->name . '_' . Carbon::now()->format('dmy') . $rand . $z++;
                $filename = 'berkas/surat/'
                    . str_slug($name, '-') . '.' . $row->getClientOriginalExtension();
//                    $filesize = $row->getClientSize();
                $row->storeAs('public', $filename);
                trFile::create(['name' => 'storage/' . $filename, 'data_id' => mst_data::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first()->id]);
            }
        }
        return response()->json($request->all());
    }

    public function apiData()
    {
        $products = mst_data::where('job_id', Auth::user()->job_id)->orderBy('id', 'desc')->get();
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        return DataTables::of($products)
            ->addColumn('user', function ($products) {
                return substr(User::findOrFail($products->user_id)->name, 0, 15) . '...';
            })->addColumn('category', function ($products) {
                return trDataCategory::findOrFail($products->category_id)->singkatan;
            })->addColumn('dibuat', function ($products) {
                if (Carbon::now()->subDay(3)->gte($products->created_at) == false) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->created_at)->diffForHumans();
                } else
                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->created_at)->formatLocalized('%A %d %B %Y');
            })
            ->addColumn('action', function ($products) {
                $singkatan = trDataCategory::findOrFail($products->category_id)->singkatan;
                $datalah = trFile::where('data_id', $products->id)->get();

                return view('layouts.partials._action', [
                    'id' => $products->id,
                    'show' => 1,
                    'edit' => 1,
                    'delete' => 1,
                    'table' => $singkatan,
                    'data' => $datalah
                ]);
            })
            ->addColumn('cek', function ($products) {
                $datas = '<input placeholder="pilih data" class="form-control cek" 
                                                                   type="checkbox" value="' . $products->id . '"
                                                                   id="cek[]" name="cek[]" multiple>';

                return html_entity_decode($datas);
            })
            ->rawColumns(['cek', 'action'])
            ->removeColumn('job_id', 'category_id', 'user_id')
            ->make(true);
    }

    public function apiData3()
    {

            $products = mst_data::onlyTrashed()->where('job_id', Auth::user()->job_id)->orderBy('id', 'desc')->get();


        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        return DataTables::of($products)
            ->addColumn('user', function ($products) {
                if (!is_null($products->userdel)) {
                    return substr(User::findOrFail($products->userdel)->name, 0, 15) . '...';

                } else {
                    return substr(User::findOrFail($products->user_id)->name, 0, 15) . '...';
                }
            })->addColumn('category', function ($products) {
                return trDataCategory::findOrFail($products->category_id)->singkatan;
            })->addColumn('dibuat', function ($products) {
                if (Carbon::now()->subDay(3)->gte($products->created_at) == false) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->deleted_at)->diffForHumans();
                } else
                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->deleted_at)->formatLocalized('%A %d %B %Y');
            })
            ->addColumn('action', function ($products) {
                $datalah = trFile::where('data_id', $products->id)->get();

                return view('layouts.partials.___action', [
                    'id' => $products->id,
                    'restore' => 1,
                    'delete' => 1,
                    'data' => $datalah
                ]);
            })
            ->addColumn('cek', function ($products) {
                $datas = '<input placeholder="pilih data" class="form-control cek" 
                                                                   type="checkbox" value="' . $products->id . '"
                                                                   id="cek[]" name="cek[]" multiple>';

                return html_entity_decode($datas);
            })
            ->rawColumns(['cek', 'action'])
            ->removeColumn('job_id', 'category_id', 'user_id')
            ->make(true);
    }

    public function apiData2(Request $request)
    {
        $products = mst_data::where('category_id', $request->id)->orderBy('id', 'desc')->get();
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        return DataTables::of($products)
            ->addColumn('user', function ($products) {
                return substr(User::findOrFail($products->user_id)->name, 0, 15) . '...';
            })->addColumn('category', function ($products) {
                return trDataCategory::findOrFail($products->category_id)->name;
            })->addColumn('dibuat', function ($products) {
                if (Carbon::now()->subDay(3)->gte($products->created_at) == false) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->created_at)->diffForHumans();
                } else
                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->created_at)->formatLocalized('%A %d %B %Y');
            })
            ->addColumn('action', function ($products) {
                $singkatan = trDataCategory::findOrFail($products->category_id)->singkatan;
                $datalah = trFile::where('data_id', $products->id)->get();

                return view('layouts.partials._action', [
                    'id' => $products->id,
                    'show' => 1,
                    'edit' => 1,
                    'delete' => 1,
                    'table' => $singkatan,
                    'data' => $datalah
                ]);
            })
            ->addColumn('cek', function ($products) {
                $datas = '<input placeholder="pilih data" class="form-control cek" 
                                                                   type="checkbox" value="' . $products->id . '"
                                                                   id="cek[]" name="cek[]" multiple>';

                return html_entity_decode($datas);
            })
            ->rawColumns(['cek', 'action'])
            ->removeColumn('job_id', 'category_id', 'user_id')
            ->make(true);
    }

    public function jumlah(Request $request)
    {
        $data = trDataCategory::where('job_id', $request->id)->get();
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $data = mst_data::withTrashed()->findOrFail($request->id);
        $data['category'] = trDataCategory::findOrFail($data->category_id)->name;
        $data['singkatan'] = trDataCategory::findOrFail($data->category_id)->singkatan;
        if (Carbon::now()->subDay(3)->gte($data->created_at) == false) {
            $data['dibuat'] = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->diffForHumans();
        } else {
            $data['dibuat'] = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->formatLocalized('%A %d %B %Y');
        }
        $data['berkas'] = trFile::where('data_id', $request->id)->get();
        $data['user'] = User::findOrFail($data->user_id)->name;
        $data['category2'] = trDataCategory::where('job_id', Auth::user()->job_id)->get();
        if (count(trDataHistori::where('data_id', $request->id)->get()) > 0) {
            $data['diedit'] = count(trDataHistori::where('data_id', $request->id)->get()) . ' kali';
        } else {
            $data['diedit'] = NULL;
        }

        return response()->json($data);
    }

    public function cek(Request $request)
    {
        if (is_array($request->cek)) {
            if ($request->metode == 0) {

                for ($i = 0; $i < count($request->cek); $i++) {
                    $data = mst_data::findOrFail($request->cek[$i]);
                    trDataHistori::create(['name' => $data->name,
                        'kode' => $data->kode, 'desc' => $data->desc, 'user_id' => Auth::user()->id,
                        'category_id' => $data->category_id, 'job_id' => $data->job_id, 'data_id' => $request->cek[$i]
                        , 'deletes' => 0
                        , 'edit' => 0
                        , 'tambah' => 0, 'deldata' => 1, 'resdata' => 0
                    ]);
                    $data->update(['userdel' => Auth::user()->id]);
                    mst_data::destroy($request->cek[$i]);
                }
            } else {
                if (count($request->cek) > 5) {
                    return response()->json(['gagal' => 0]);

                }
                for ($i = 0; $i < count($request->cek); $i++) {
                    $ambil = mst_data::findOrFail($request->cek[$i]);
                    $data ['jadi'][] = array('name' => $ambil->name, 'desc' => $ambil->desc, 'category_id' => $ambil->category_id, 'id' => $ambil->id, 'kode' => $ambil->kode);
                }
            }
            $data['status'] = true;
            $data['category'] = trDataCategory::where('job_id', Auth::user()->job_id)->get();
        }
        else {
            $data['status'] = false;
        }
        return response()->json($data);
    }

    public function multiupdate(Request $request)
    {
        for ($i = 0; $i < count($request->name); $i++) {
            $data = mst_data::findOrFail($request->id[$i]);
            if (!is_array($request->file[$i]) && /*&& !is_array($request->berkas[$i)*/
                $request->name[$i] == $data->name &&
                $request->kode[$i] == $data->kode && $request->desc[$i] == $data->desc && $request->category_id[$i] == $data->category_id) {
                return response()->json(['gagal' => 0, 'ganti' => $request->name[$i], 'file' => $request->file[$i]]);
            }
        }
        $data23 = trFileHistori::where('data_id', $request->id)->orderBy('id', 'desc')->first();
        if ($data23 == null) {
            $datake = 1;
        } else {
            $datake = $data23->datake + 1;
        }
        for ($i = 0; $i < count($request->name); $i++) {
            $data21['tambah'] = 0;
            $data21['edit'] = 0;
            $data21['delete'] = 0;
            $z = 1;
            $data1 = mst_data::findOrFail($request->id[$i]);
            if ($request->name[$i] != $data1->name ||
                $request->kode[$i] != $data1->kode || $request->desc[$i] != $data1->desc || $request->category_id[$i] != $data1->category_id) {
                $data21['edit'] = 1;
            }
            if (is_array($request->file)) {
                foreach ($request->file[$i] as $row) {
                    $rand = rand(111, 999);
                    $name = $request->name[$i] . '_' . Carbon::now()->format('dmy') . $rand . $z++;
                    $filename = 'berkas/surat/'
                        . str_slug($name, '-') . '.' . $row->getClientOriginalExtension();
                    $row->storeAs('public', $filename);
                    trFile::create(['name' => 'storage/' . $filename, 'data_id' => $request->id[$i]]);
                    trFileHistori::create(['datake' => $datake, 'metode' => 2,
                        'file_id' => trFile::where('data_id', $request->id[$i])->where('name', 'storage/' . $filename)->orderBy('id', 'desc')->first()->id
                        , 'data_id' => $request->id[$i]]);
                    $data21['tambah'] = 1;
                }
            }
////
            trDataHistori::create(['name' => $data1->name,
                'kode' => $data1->kode, 'desc' => $data1->desc, 'user_id' => Auth::user()->id,
                'category_id' => $data1->category_id, 'job_id' => $data1->job_id, 'data_id' => $request->id[$i]
                , 'deletes' => $data21['delete']
                , 'edit' => $data21['edit']
                , 'tambah' => $data21['tambah'], 'deldata' => 0, 'resdata' => 0
            ]);
            $data1->update(['name' => $request->name[$i], 'desc' => $request->desc[$i], 'kode' => $request->kode[$i], 'category_id' => $request->category_id[$i]]);
        }
        return response()->json($data21);


    }

    public
    function destroy(Request $request)
    {
        $id = $request->id;
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

        return response()->json(['status' => 'sukses'/*, 'category' => $data->singkatan*/]);
    }

    function restore(Request $request)
    {
        $id = $request->id;
        $data = mst_data::onlyTrashed()->findOrFail($id);
        trDataHistori::create(['name' => $data->name,
            'kode' => $data->kode, 'desc' => $data->desc, 'user_id' => Auth::user()->id,
            'category_id' => $data->category_id, 'job_id' => $data->job_id, 'data_id' => $id
            , 'deletes' => 0
            , 'edit' => 0
            , 'tambah' => 0, 'deldata' => 0, 'resdata' => 1
        ]);

        mst_data::onlyTrashed()->findOrFail($id)->restore();


        return response()->json(['status' => 'sukses']);
    }

    function deleteperm(Request $request)
    {
        $id = $request->id;
        $data = mst_data::onlyTrashed()->findOrFail($id);
        trDataHistori::create(['name' => $data->name,
            'kode' => $data->kode, 'desc' => $data->desc, 'user_id' => $data->user_id,
            'category_id' => $data->category_id, 'job_id' => $data->job_id, 'data_id' => $id
            , 'deletes' => 0
            , 'edit' => 0
            , 'tambah' => 0, 'deldata' => 0, 'resdata' => 0
        ]);

        mst_data::onlyTrashed()->findOrFail($id)->restore();


        return response()->json(['status' => 'sukses']);
    }

    public
    function update(Request $request)
    {
        $data = mst_data::findOrFail($request->id);
        $data21 = array();
        $data21['delete'] = 0;
        $data21['edit'] = 0;
        $data21['tambah'] = 0;

        if (!is_array($request->file) && !is_array($request->berkas) && $request->name == $data->name && $request->kode == $data->kode && $request->desc == $data->desc && $request->category_id == $data->category_id) {
            return response()->json(['gagal' => 0]);
        }
        $data23 = trFileHistori::where('data_id', $request->id)->orderBy('id', 'desc')->first();
        if ($data23 == null) {
            $datake = 1;
        } else {
            $datake = $data23->datake + 1;
        }
//        $data3=mst_data::findOrFail($request->id)->except('id','created_at','updated_at'); fail
        if (is_array($request->berkas)) {
            $jumlah = count(trFile::where('data_id', $request->id)->get());
            if ($jumlah == count($request->berkas)) {
                return response()->json(['gagal' => 1, 'jumlah' => $jumlah, 'jumlah2' => count($request->berkas), 'jadi' => $request->berkas[0]]);
            } else {
                $data21['delete'] = 1;
                for ($i = 0; $i < count($request->berkas); $i++) {
                    trFileHistori::create(['datake' => $datake, 'metode' => 1, 'file_id' => $request->berkas[$i], 'data_id' => $request->id]);
                    trFile::destroy($request->berkas[$i]);
                }
            }
        }
        if (is_array($request->file)) {
            $z = 1;

            foreach ($request->file as $row) {
                $rand = rand(111, 999);
                $name = $request->name . '_' . Carbon::now()->format('dmy') . $rand . $z++;
                $filename = 'berkas/surat/'
                    . str_slug($name, '-') . '.' . $row->getClientOriginalExtension();
//                    $filesize = $row->getClientSize();
                $row->storeAs('public', $filename);
                trFile::create(['name' => 'storage/' . $filename, 'data_id' => $request->id]);
                trFileHistori::create(['datake' => $datake, 'metode' => 2,
                    'file_id' => trFile::where('data_id', $request->id)->where('name', 'storage/' . $filename)->orderBy('id', 'desc')->first()->id
                    , 'data_id' => $request->id]);
            }
            $data21['tambah'] = 1;
        }
        if ($request->name != $data->name || $request->kode != $data->kode || $request->desc != $data->desc || $request->category_id != $data->category_id) {
            $data21['edit'] = 1;
        }
        trDataHistori::create(['name' => $data->name,
            'kode' => $data->kode, 'desc' => $data->desc, 'user_id' => Auth::user()->id,
            'category_id' => $data->category_id, 'job_id' => $data->job_id, 'data_id' => $request->id
            , 'deletes' => $data21['delete']
            , 'edit' => $data21['edit']
            , 'tambah' => $data21['tambah'], 'deldata' => 0, 'resdata' => 0
        ]);
        $data->update(['name' => $request->name, 'kode' => $request->kode, 'desc' => $request->desc, 'category_id' => $request->category_id]);

        return response()->json($data);
    }

    public function history(Request $request)
    {

        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $data = trDataHistori::where('data_id', $request->id)->get();
        $data1 = array();
        $i = -1;
        $j = 0;
        foreach ($data as $a) {
            $i++;
            $waktu = Carbon::createFromFormat('Y-m-d H:i:s', $a->created_at);
            $data1[$i] = $a;
            $data1[$i]['user'] = User::withTrashed()->findOrFail($a->user_id)->name;
            $data1[$i]['tanggal'] = array('tanggal' => $waktu->copy()->toDateString(), 'tglStr' => $waktu->copy()->formatLocalized('%A %d %B %Y'),
                'waktu' => $waktu->copy()->format('H:i') . ' WIB');

            if ($a->deletes == 1 || $a->tambah == 1) {
                $j++;
                if ($a->tambah == 1) {
                    $k = 0;
                    $ulangtambah = trFileHistori::where('data_id', $request->id)->where('datake', $j)->where('metode', 2)->get();
                    $tambah = array();
                    foreach ($ulangtambah as $b) {
                        $tambahan = trFile::withTrashed()->findOrFail($b->file_id);
                        $tambah[$k++] = array('url' => url($tambahan->name), 'name' => substr($tambahan->name, 21));
                    }
                    $data1[$i]['tambahan'] = $tambah;
                }
                if ($a->deletes == 1) {
                    $z = 0;
                    $ulangdelet = trFileHistori::where('data_id', $request->id)->where('datake', $j)->where('metode', 1)->get();
                    $delet = array();
                    foreach ($ulangdelet as $b) {
                        $tambahan = trFile::withTrashed()->findOrFail($b->file_id);
                        $delet[$z++] = array('url' => url($tambahan->name), 'name' => substr($tambahan->name, 21));
                    }
                    $data1[$i]['delete'] = $delet;
                }
            }

        }

        $mst = mst_data::withTrashed()->findOrFail($request->id);
        $waktu1 = Carbon::createFromFormat('Y-m-d H:i:s', $mst->created_at);
        $data1[$i + 1] = $mst;
        $data1[$i + 1]['tanggal'] = array('tanggal' => $waktu1->copy()->toDateString(), 'tglStr' => $waktu1->copy()->formatLocalized('%A %d %B %Y'),
            'waktu' => $waktu1->copy()->format('H:i') . ' WIB');

        for ($i = 0; $i < count($data1) - 1; $i++) {
            if ($data1[$i]['edit'] == 1) {
                $j = 0;
                $editan = array();
                if ($data1[$i]['name'] !== $data1[$i + 1]['name']) {
                    $editan[$j++] = array('name' => 'Kode Surat', 'lama' => $data1[$i]['name'], 'baru' => $data1[$i + 1]['name']);
                }
                if ($data1[$i]['kode'] !== $data1[$i + 1]['kode']) {
                    $editan[$j++] = array('name' => 'Kode Berkas', 'lama' => $data1[$i]['kode'], 'baru' => $data1[$i + 1]['kode']);
                }
                if ($data1[$i]['category_id'] !== $data1[$i + 1]['category_id']) {
                    $editan[$j++] = array('name' => 'Jenis Surat', 'lama' => trDataCategory::findOrFail($data1[$i]['category_id'])->name,
                        'baru' => trDataCategory::findOrFail($data1[$i + 1]['category_id'])->name);
                }
                if ($data1[$i]['desc'] !== $data1[$i + 1]['desc']) {
                    $editan[$j++] = array('name' => 'Detail', 'lama' => $data1[$i]['desc'], 'baru' => $data1[$i + 1]['desc']);
                }
                $data1[$i]['editan'] = $editan;
            }
        }

        return response()->json($data1);

    }


}
