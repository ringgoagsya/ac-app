<?php

namespace App\Http\Controllers;
use App\Models\ac;
use App\Models\tr_service;
use App\Models\area;
use App\Models\lokasi;
use App\Models\teknisi;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $area = area::all();
        foreach($area as $areanya){
            $ac_area[$areanya->id_area] = ac::where('id_area','=',$areanya->id_area)->orderBy('status')->get();
        }
        // dd($ac_area);
        return view('dashboard',compact('ac_area','area'));
    }
    public function dashboard()
    {
        $area = area::all();
        foreach($area as $areanya){
            $ac_area[$areanya->id_area] = ac::where('id_area','=',$areanya->id_area)->orderBy('status')->get();
        }
        // dd($ac_area);
        return view('dashboard',compact('ac_area','area'));
    }
    public function detail_dashboard($id_area)
    {
        $now = Carbon::now()->format('Y-m-d');
        $ac = ac::join('lokasis','lokasis.id_lokasi','=','acs.id_lokasi')
                ->join('areas','areas.id_area','=','acs.id_area')
                ->where('acs.id_area','=',$id_area)->get();
        $area = area::all();
        $lokasi = lokasi::all();
        foreach ($ac as $detail_ac) {
            $last_service[$detail_ac->id_ac] = tr_service::where('id_ac','=',$detail_ac->id_ac)->latest()->first();
        }
        return view('admin.dashboard.detail_dashboard',compact('ac','lokasi','last_service','area','lokasi'));
    }
    public function indoor()
    {
        $area = area::limit(12)->get();
        foreach($area as $areanya){
            $ac_area[$areanya->id_area] = ac::where('type_lokasi','=','INDOOR')
                        ->where('id_area','=',$areanya->id_area)->orderBy('status')->get();
        }
        return view('admin.dashboard.indoor',compact('ac_area','area'));

    }
    public function outdoor()
    {
        $area = area::orderBy('id_area','DESC')->limit(10)->get();
        foreach($area as $areanya){
            $ac_area[$areanya->id_area] = ac::where('type_lokasi','=','OUTDOOR')
                        ->where('id_area','=',$areanya->id_area)->orderBy('status')->get();
        }
        // dd($ac_area);
        return view('admin.dashboard.outdoor',compact('ac_area','area'));
    }
}
