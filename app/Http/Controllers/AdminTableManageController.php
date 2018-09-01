<?php

namespace App\Http\Controllers;

use App\Datacarousel;
use App\mst_data;
use App\status;
use App\trDataCategory;
use App\trDataJobDesc;
use App\trDataPosisition;
use App\trRequestChangeJob;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Yajra\Datatables\Datatables;

class AdminTableManageController extends Controller
{
    public function index()
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        Session::put('requ', count(trRequestChangeJob::where('admin_id', null)->orderBy('id', 'desc')->get()));
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $req = trRequestChangeJob::where('admin_id', null)->orderBy('id', 'desc')->get();
        $jobType1 = trDataJobDesc::all();
        $countjob = count($jobType1);
        $jobType = trDataJobDesc::orderBy('name', 'asc')->skip(1)->take($countjob)->get();
        $requestJob = trRequestChangeJob::orderBy('id', 'desc')->get();
        $entityPage = ceil(count($requestJob) / 10);
        $statusPage = 5 < $entityPage;
        $contentPage = $requestJob->take(10);

        return view('admin.requestjob.index', compact('req', 'jobType', 'entityPage', 'contentPage', 'statusPage'));
    }

    public function apiData(Request $request)
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        $skip = ($request->pagination - 1) * 10;
        $next = 10;

        if ($request->id == 0) {
            $requestJob = trRequestChangeJob::orderBy('id', 'desc')->get();
            $entity = count($requestJob);
            $loop = trRequestChangeJob::orderBy('id', 'desc')->skip($skip)->take($next)->get();
        } else {
            $requestJob = trRequestChangeJob::where('job_id', $request->id)->orderBy('id', 'desc')->get();
            $entity = count($requestJob);
            if ($entity > 0) {
                $loop = trRequestChangeJob::where('job_id', $request->id)->orderBy('id', 'desc')->skip($skip)->take($next)->get();
            }
        }
        $data['list'] = array();
        $entityPage = array();
        if ($entity > 0) {

            if (is_null($request->search)) {
                foreach ($loop as $row) {

                    if ($row->status == 0) {
                        $class = 'wait';
                    } elseif ($row->status == 1) {
                        $class = 'accept';
                    } else {
                        $class = 'deny';
                    }
                    $entityPage = array();
                    for ($i = 1; $i <= ceil($entity / 10); $i++) {
                        $entityPage[] = $i;
                    }

                    $data['list'][] = array('user' => $row->user->name, 'old' => $row->oldposisition->name . ' di ' . $row->oldjob->name,
                        'new' => $row->posisition->name . ' di ' . $row->job->name,
                        'date' => Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->formatLocalized('%A, %d %B %Y'),
                        'status' => $row->status, 'id' => $row->id, 'class' => $class);
                }
                $data['amount']=$entity;
            }
            else {
                foreach ($requestJob as $row) {
                    $user=$row->user->name;
                    $old=$row->oldposisition->name . ' di ' . $row->oldjob->name;
                    $new=$row->posisition->name . ' di ' . $row->job->name;
                    if ($row->status==0) {
                        $status ='Menunggu';
                    }elseif ($row->status==1) {
                        $status ='Diterima';
                    }else {
                        $status ='Ditolak';
                    }
                    $date=Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->formatLocalized('%A, %d %B %Y');
                    $name = strpos(strtolower($user), strtolower($request->search));
                    $seksi = strpos(strtolower($old), strtolower($request->search));
                    $new1 = strpos(strtolower($new), strtolower($request->search));
                    $date1 = strpos(strtolower($date), strtolower($request->search));
                    $status1 = strpos(strtolower($status), strtolower($request->search));
                    if ($name !== false || $seksi !== false || $new1 !== false || $date1 !== false || $status1 !== false) {
                        if ($row->status == 0) {
                            $class = 'wait';
                        } elseif ($row->status == 1) {
                            $class = 'accept';
                        } else {
                            $class = 'deny';
                        }
                        $entityPage = array();
                        $data['list'][] = array('user' => $user, 'old' => $old,
                            'new' => $new, 'date' => $date,
                            'status' => $row->status, 'id' => $row->id, 'class' => $class);
                    }
                }
                for ($i = 1; $i <= ceil(count($data['list']) / 10); $i++) {
                    $entityPage[] = $i;
                }
                $data['amount']=count($data['list']);
                $data['list']=array_slice($data['list'],$skip,$next);
            }
        }
        $data['pagination'] = $request->pagination;
        $data['entity'] = $entityPage;

        return response()->json($data);
    }

    public function accept(Request $request)
    {
        $id = $request->id;
        if (is_array($id)) {
            for ($i = 0; $i < count($id); $i++) {
                $data = trRequestChangeJob::findOrFail($id[$i]);
                $terima = $data->user;
                $terima->job_id = $data->changejob_id;
                $terima->posisition_id = $data->changeposisition_id;
                $terima->ganti = null;
                $terima->update();
                $data->status = 1;
                $data->admin_id = Auth::user()->id;
                $data->update();
            }
        } else {
            $data = trRequestChangeJob::findOrFail($id);
            $terima = $data->user;
            $terima->job_id = $data->changejob_id;
            $terima->posisition_id = $data->changeposisition_id;
            $terima->ganti = null;
            $terima->update();
            $data->status = 1;
            $data->admin_id = Auth::user()->id;
            $data->update();
        }
        return response()->json($id);
    }

    public function deny(Request $request)
    {
        $id = $request->id;
        if (is_array($id)) {
            for ($i = 0; $i < count($id); $i++) {
                $data = trRequestChangeJob::findOrFail($id[$i]);
                $terima = $data->user;
                $terima->job_id = $data->changejob_id;
                $terima->posisition_id = $data->changeposisition_id;
                $terima->ganti = null;
                $terima->update();
                $data->status = 2;
                $data->admin_id = Auth::user()->id;
                $data->update();
            }
        } else {
            $data = trRequestChangeJob::findOrFail($id);
            $terima = $data->user;
            $terima->job_id = $data->job_id;
            $terima->posisition_id = $data->posisition_id;
            $terima->ganti = null;
            $terima->update();
            $data->status = 2;
            $data->admin_id = Auth::user()->id;
            $data->update();
        }
        return response()->json($id);
    }

    public function apiData2(Request $request)
    {
        $products = trRequestChangeJob::where('job_id', $request->id);
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
        return DataTables::of($products)
            ->addColumn('user', function ($products) {
                $user = User::findOrFail($products->user_id)->name;
                $length = strlen($user);
                if ($length > 12) {
                    return substr(User::findOrFail($products->user_id)->name, 0, 12) . '...';
                } else {
                    return $user;
                }
            })
//            ->addColumn('category', function ($products) {
//                return trDataCategory::findOrFail($products->category_id)->singkatan;
//            })->addColumn('dibuat', function ($products) {
//                if (Carbon::now()->subDay(3)->gte($products->created_at) == false) {
//                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->created_at)->diffForHumans();
//                } else
//                    return Carbon::createFromFormat('Y-m-d H:i:s', $products->created_at)->formatLocalized('%A %d %B %Y');
//            })
            ->addColumn('action', function ($products) {

                return view('layouts.partials.status', [
                    'id' => $products->id,
                    'user' => $products->user_id,
                    'status' => $products->status,
                ]);
            })
            ->addColumn('change', function ($products) {

                return $products->oldjob->name . ' di ' . $products->oldposisition->name . '<br>&rrarr;' . $products->posisition->name . ' di ' . $products->job->name;
            })
            ->addColumn('cek', function ($products) {
                $datas = '<input placeholder="pilih data" class="cek0" data-id="' . $products->id . '"
                                                                   type="checkbox" value="' . $products->id . '"
                                                                   id="cek0[]" name="cek0[]" multiple>';

                return html_entity_decode($datas);
            })
            ->rawColumns(['cek', 'action', 'change'])
//            ->removeColumn('job_id', 'category_id', 'user_id')
            ->make(true);
    }


}
