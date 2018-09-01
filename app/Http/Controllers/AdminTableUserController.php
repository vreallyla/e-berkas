<?php

namespace App\Http\Controllers;

use App\Datacarousel;
use App\historiSendEmail;
use App\mst_data;
use App\sesion;
use App\status;
use App\trDataCategory;
use App\trDataJobDesc;
use App\trDataPosisition;
use App\trRequestChangeJob;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminTableUserController extends Controller
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

    public function apiUser(Request $request)
    {
        $datas = User::where('job_id', $request->id)->orderBy('name', 'asc')->get();

        foreach ($datas as $data) {
            if (!is_null($data->posisition_id)) {
                $posisition = trDataPosisition::findOrFail($data->posisition_id)->name;
            } else {
                $posisition = 'Belum diposikan';
            }
            if (!is_null($data->ava)) {
                $ava = $data->ava;
            } else {
                $ava = 'images/avatar.png';
            }
            $data1[] = array('name' => $data->name, 'id' => $data->id, 'nip' => $data->nip, 'posisition' => $posisition, 'img' => asset($ava));
        }

        return response()->json($data1);
    }

    public function getPosisition(Request $request)
    {
        $data = trDataPosisition::where('job_id', $request->id)->get();
        return response()->json($data);
    }


    public function apiSurat(Request $request)
    {
        $this->getLocation();
        $r = $request;
        $next = 10;
        $skip = ($r->pagination - 1) * $next;


        if (is_null($r->search)) {
            $entity = $this->countCategory($r->id, 0, $r->search);
            if (0 < $entity) {
                $data['status'] = 1;
                $data['pagination'] = ceil($entity / $next);
                $data['entity'] = $entity;
                foreach ($this->getPagination($r->id, $skip, $next) as $row) {
                    $data['list'][] = array('name' => $row->name, 'singkatan' => $row->singkatan, 'maker' => $this->getUser($row->user_id), 'id' => $row->id,
                        'date' => Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->formatLocalized('%A, %d %B %Y'));
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
        return response()->json($data);
    }


    private function findCategory($search, $id)
    {
        $this->getLocation();
        $compare = trDataCategory::where('job_id', $id)->orderBy('name', 'asc')->get();
        $data['status'] = 0;
        foreach ($compare as $row) {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->formatLocalized('%A, %d %B %Y');
            $user = $this->getUser($row->user_id);
            $name = strpos(strtolower($row->name), strtolower($search));
            $singkatan = strpos(strtolower($row->singkatan), strtolower($search));
            $pembuat = strpos(strtolower($user), strtolower($search));
            $dibuat = strpos(strtolower($date), strtolower($search));
            if ($name !== false || $singkatan !== false || $pembuat !== false || $dibuat !== false) {
                $data['list'][] = array('name' => $row->name, 'singkatan' => $row->singkatan, 'maker' => $user, 'date' => $date, 'id' => $row->id);
                $data['status'] = 1;
            }
        }
        return $data;
    }


    private function countCategory($id, $method, $search)
    {
        if ($method == 0) {
            $data = array();
            $data1 = trDataCategory::where('job_id', $id)->orderBy('id', 'desc')->get();
            $data = count($data1);
        } elseif ($method == 1) {
            $component = $this->findCategory($search, $id);
            if ($component['status'] == 1) {
                $data['list'] = $component['list'];
            } else {
                $data['list'] = array();
            }

            $data['count'] = count($data['list']);
        }

        return $data;
    }

    private function getPagination($id, $skip, $next)
    {
        $data = trDataCategory::where('job_id', $id)->orderBy('id', 'desc')->skip($skip)->take($next)->get();

        return $data;

    }


    private function getUser($id)
    {
        $data = User::findOrFail($id)->name;
        return $data;
    }

    public function getLocation()
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'Indonesian');
    }

    public function lihat(Request $r)
    {
        return response()->json($this->showidentities($r->id));
        return $r;
    }

    private function showidentities($id)
    {
        if (is_array($id)) {
            for ($i = 0; $i < count($id); $i++) {
                $countCategory = count(trDataJobDesc::all()) - 1;
                $job = trDataJobDesc::orderBy('name', 'asc');
                $ps = trDataPosisition::orderBy('name', 'asc')->get();
                $key = User::findOrFail($id[$i]);
                $object['ps_id'] = $key->posisitions->id;
                $object['id'] = $id[$i];
                $object['select'] = $key->jobs->id;
                $object['name'] = $key->name;
                $object['role_id'] = $key->role->id;
                $object['ps'] = $key->posisitions->name;
//                $object['due'] = Carbon::createFromFormat('Y-m-d H:i:s', $key->created_at)->formatLocalized('%A, %d %B %Y');
                $object['ids_job'] = $job->skip(1)->take($countCategory)->pluck('id');
                $object['names_job'] = $job->skip(1)->take($countCategory)->pluck('name');
                $object['pss'] = array();
                $object['roles'] = array();
                foreach ($ps as $r) {
                    if ($r->job_id == $key->job_id) {
                        $object['pss'][] = array('id' => $r->id, 'name' => $r->name);
                    }
                }
                foreach (status::orderBy('name', 'asc')->get() as $r) {
                    $object['roles'][] = array('id' => $r->id, 'name' => $r->name);
                }
                $data[] = $object;
            }
        } else {
            $countCategory = count(trDataJobDesc::all()) - 1;
            $job = trDataJobDesc::orderBy('name', 'asc');
            $ps = trDataPosisition::orderBy('name', 'asc')->get();
            $key = User::findOrFail($id);
            $data['ps_id'] = $key->posisitions->id;
            $data['id'] = $id;
            $data['select'] = $key->jobs->id;
            $data['name'] = $key->name;
            $data['nip'] = $key->nip;
            $data['ava'] = $key->ava;
            $data['email'] = $key->email;
            $data['phone'] = $key->phone;
            $data['alamat'] = $key->alamat;
            $data['bio'] = $key->bio;
            $data['role_id'] = $key->role->id;
            $data['ps'] = $key->posisitions->name;
            $data['due'] = Carbon::createFromFormat('Y-m-d H:i:s', $key->created_at)->formatLocalized('%A, %d %B %Y');
            $data['ids_job'] = $job->skip(1)->take($countCategory)->pluck('id');
            $data['names_job'] = $job->skip(1)->take($countCategory)->pluck('name');
            foreach ($ps as $r) {
                if ($r->job_id == $key->job_id) {
                    $data['pss'][] = array('id' => $r->id, 'name' => $r->name);
                }
            }
            foreach (status::orderBy('name', 'asc')->get() as $r) {
                $data['roles'][] = array('id' => $r->id, 'name' => $r->name);
            }

        }
        return $data;
    }

    public function cekhapus(Request $r)
    {
        if (is_array($r->id)) {
            return mst_data::whereIn('user_id', $r->id)->pluck('id');
        } else {
            return response()->json($this->loopcek($r->id));
        }
    }

    private function loopcek($id)
    {
        foreach (mst_data::all() as $ro) {
            $status = array();
            if ($ro->user_id == $id) {
                array_push($status, $ro->id);

            }
        }
        return $status;
    }

    public function hapus(Request $r)
    {
        if (is_array($r->id)) {
            User::whereIn('id', $r->id)->delete();
        } else {
            User::destroy($r->id);
        }
    }

    public function edit(Request $r)
    {
        if (is_array($r->id)) {
            for ($i = 0; $i < count($r->id); $i++) {
                $chan = User::findOrFail($r->id[$i])->update(['job_id' => $r->job_id[$i],
                    'posisition_id' => $r->posisition_id[$i],
                    'role_id' => $r->role_id[$i]]);
            }
        } else {
            $chan = User::findOrFail($r->id)->update($r->except('id'));

        }

    }

    public function storesuratplus(Request $r)
    {
        $x = \session('proSend');
        $pss = $this->saveUser($r, $x);
//
        $cek = strpos($r->name[$x], ' ');
        if ($cek == false) {
            $kurva = strlen($r->name[$x]);
        } else {
            $kurva = $cek;
        }
        $data = ['email' => $r->email[$x],
            'subject' => "akun re:eBerkas",
            'name' => $r->name[$x],
            'kurva' => $kurva,
            'nip' => $r->nip[$x],
            'job_id' => trDataJobDesc::findOrFail($r->job_id[$x])->name,
            'posisition_id' => trDataPosisition::findOrFail($r->posisition_id[$x])->name,
            'role_id' => status::findOrFail($r->role_id[$x])->name,
            'password' => $pss['ps']];
//
        Mail::send('admin.pengurus.mail.send', $data, function ($message) use ($data) {
            $message->from('vreallyla@gmail.com', 'reberkas');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
//        // check for failures must tryed
        if (Mail::failures()) {
            $status = 0;
        } else {
            historiSendEmail::findOrFail($pss['id'])->update(['status' => 'y']);
            $status = 1;
        }
        Session::put('proSend', $x + 1);
        if ($r->entitySend == $x +1) {
            Session::put('proSend', 0);
        }
        return response()->json($status);
    }

    private function sendEmail()
    {

    }

    private function saveUser($r, $x)
    {
        $i = $x;
        $a = str_random(12);
        $id = User::create(['name' => $r->name[$i],
            'job_id' => $r->job_id[$i],
            'posisition_id' => $r->posisition_id[$i],
            'role_id' => $r->role_id[$i],
            'email' => $r->email[$i], 'nip' => $r->nip[$i], 'password' => bcrypt($a)])->id;
        $ids = historiSendEmail::create(['user_id' => $id, 'status' => 't'])->id;
        $pss = ['ps' => $a, 'id' => $ids];
        return $pss;
    }

    public function tryna()
    {
        return view('admin.pengurus.mail.send');
    }

    public function ceknip(Request $r)
    {
        if ($r->mode == 1) {
            $cek = User::all()->pluck('nip');
            foreach ($cek as $a) {
                if ($r->cek == $a) {
                    $status = 0;
                    break;
                } else {
                    $status = 1;
                }
            }
        } else {
            $cek = User::all()->pluck('email');
            foreach ($cek as $a) {
                if ($r->cek == $a) {
                    $status = 0;
                    break;
                } else {
                    $status = 1;
                }
            }
        }

        return $status;
    }

    public function resend(Request $r)
    {
        $x = \session('proSend');
        $finish=0;
        $data = $this->updateUser($r->id);
        $send=$this->resendMail($data);
        Session::put('proSend', $x + 1);
        if ($r->entitySend-1 == $x) {
            Session::put('proSend', 0);
            $finish=1;
        }
        $sc=array('send'=>$send,'status'=>$finish,'a'=>$x,'v'=>$r->entitySend);

        return response()->json($sc);
    }

    private function updateUser($id)
    {
        if (is_array($id)) {
            $data2 = array();
            foreach ($id as $r) {
                $pss = str_random(12);
                $value = historiSendEmail::findOrFail($r);
                $data = $value->usw;
                $data->update(['password' => bcrypt($pss)]);
                $cek = strpos($data->name, ' ');
                if ($cek == false) {
                    $kurva = strlen($data->name);
                } else {
                    $kurva = $cek;
                }
                $data2[] = array('password' => $pss,
                    'subject' => "akun re:eBerkas",
                    'name' => $data->name,
                    'email' => $data->email,
                    'kurva' => $kurva,
                    'nip' => $data->nip,
                    'job_id' => trDataJobDesc::findOrFail($data->job_id)->name,
                    'posisition_id' => trDataPosisition::findOrFail($data->posisition_id)->name,
                    'role_id' => status::findOrFail($data->role_id)->name, 'id' => $r);
            }

        } else {
            $pss = str_random(12);
            $value = historiSendEmail::findOrFail($id);
            $data = $value->usw;
            $data->update(['password' => bcrypt($pss)]);
            $data2 = array();
            $cek = strpos($data->name, ' ');
            if ($cek == false) {
                $kurva = strlen($data->name);
            } else {
                $kurva = $cek;
            }
            $data2 = array('password' => $pss,
                'subject' => "akun re:eBerkas",
                'name' => $data->name,
                'email' => $data->email,
                'kurva' => $kurva,
                'nip' => $data->nip,
                'job_id' => trDataJobDesc::findOrFail($data->job_id)->name,
                'posisition_id' => trDataPosisition::findOrFail($data->posisition_id)->name,
                'role_id' => status::findOrFail($data->role_id)->name
            , 'id' => $id);
        }
        return $data2;
    }

    private function resendMail($data)
    {

        Mail::send('admin.pengurus.mail.send', $data, function ($message) use ($data) {
            $message->from('vreallyla@gmail.com', 'reberkas');
            $message->to($data['email']);
            $message->subject($data['subject']);
        });
        // check for failures must tryed
        if (Mail::failures()) {
            $status = 0;
        } else {
            historiSendEmail::findOrFail($data['id'])->update(['status' => 'y']);
            $status = 1;
        }


        return $status;
    }

//    public function multiDelete(Request $request)
//    {
//        trDataCategory::whereIn('id',$request->id)->delete();
//    }

}

