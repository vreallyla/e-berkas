<?php

namespace App\Http\Controllers;

use App\Datacarousel;
use App\mst_data;
use App\trDataCategory;
use App\trDataJobDesc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GeneralController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jobdesc = trDataJobDesc::all();
        $jumlah = mst_data::withTrashed()->get();
        Session::put('mstdatacount', $jumlah);
        Session::put('carousel2count', count(Datacarousel::all()));
        foreach (Datacarousel::all() as $row) {
            if ($row->domain == 0) {
                $url = url($row->url);
            } else {
                $url = $row->url;
            }
            $carousel[] = array('title' => $row->title, 'desc' => $row->desc, 'button' => $row->button, 'img' => $row->img, 'url' => $url);
        }
//        dd($carousel);
        return view('user.dashboard', compact('jumlah', 'jobdesc', 'carousel'));
    }

    public function get()
    {
        $data = mst_data::withTrashed()->get();
        if (\session('mstdatacount') == $data) {
            $data2['status'] = 0;
        } else {
            $jobdesc = trDataJobDesc::all();
            $data2 = array();
            $i = -1;
            foreach ($jobdesc as $row) {
                $b = 0;
                if ($row->id !== 1) {
                    $i = $i + 1;
                    foreach ($data as $row2) {
                        $data2['mstdata'][$i] = array('name' => $row->name, 'icon' => asset($row->icon), 'desc' => $row->desc, 'jumlah' => $b);
                        if ($row2->job_id == $row->id) {
                            $b = $b + 1;
                            $data2['mstdata'][$i] = array('name' => $row->name, 'icon' => asset($row->icon), 'desc' => $row->desc, 'jumlah' => $b);
                        }
                    }
                }
            }
            $data2['status'] = 1;
            Session::put('mstdatacount', $data);
        }
//        $carouselcount = count(Datacarousel::all());
//        if (\session('carousel2count') == $carouselcount) {
//            $data2['status2'] = 0;
//        }
//        else {
//            $data2['status2'] = 1;
//            foreach (Datacarousel::orderBy('id', 'desc')->get() as $row) {
//                if ($row->domain == 1) {
//                    $domain = $row->url;
//                } else {
//                    $domain = url($row->url);
//                }
//                $data2['carousel2'][] = array('title' => $row->title, 'button' => $row->button, 'desc' => $row->desc,
//                    'url' => $domain, 'img' => asset($row->img));
//            }
//            Session::put('carousel2count', $carouselcount);
//        }

        return response()->json($data2);
    }
}
