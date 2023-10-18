<?php

namespace App\Http\Controllers;

use App\Models\tr_service;
use App\Models\area;
use App\Models\lokasi;
use App\Models\ac;
use App\Models\teknisi;
use App\Http\Requests\Storetr_serviceRequest;
use App\Http\Requests\Updatetr_serviceRequest;
use Illuminate\Http\Request;

use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;
class TrServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request){
        // dd($request);
        $now = Carbon::parse($request->input('tanggal_input'))->format('Y-m-d');
        $day = Carbon::parse($now)->format('d');
        $month = Carbon::parse($now)->format('m');
        $year = Carbon::parse($now)->format('Y');
        $data['data'] = tr_service::whereMonth('tanggal_service','=',$month)->whereYear('tanggal_service','=',$year)->get();
        // dd($month,$data);
        return response()->json($data);
        // return Datatables::of($data)->addColumn('DT_RowIndex', function () {
        //     static $index = 1;
        //     return $index++;
        // })->make(true);
    }
    public function tanggal(Request $request){
        // dd($request);
        $now = Carbon::parse($request->tanggal_input)->format('Y-m-d');
        $day = Carbon::parse($now)->format('d');
        $month = Carbon::parse($now)->format('m');
        $year = Carbon::parse($now)->format('Y');
        $ac = ac::all();
        $teknisi = teknisi::all();
        $area = area::all();
        $lokasi = lokasi::all();
        $service = tr_service::whereMonth('tanggal_service','=',$month)
                    ->whereYear('tanggal_service','=',$year)
                    ->orderBy('tanggal_service','DESC')->get();
        return view('admin.service.service',compact('service','ac','teknisi','now','area','lokasi'));
    }
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');
        $day = Carbon::parse($now)->format('d');
        $month = Carbon::parse($now)->format('m');
        $year = Carbon::parse($now)->format('Y');
        $ac = ac::all();
        $teknisi = teknisi::all();
        $area = area::all();
        $lokasi = lokasi::all();
        $service = tr_service::whereMonth('tanggal_service','=',$month)
                                ->whereYear('tanggal_service','=',$year)
                                ->orderBy('tanggal_service','DESC')->get();
        // dd($month,$service);
        return view('admin.service.service',compact('service','ac','teknisi','now','area','lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storetr_serviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_teknisi' => 'required',
            'id_ac' => 'required',
            'tanggal_service' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required'

        ]);

        $tr_service=tr_service::create([
            'id_teknisi' => $request->id_teknisi,
            'id_ac' => $request->id_ac,
            'tanggal_service' => $request->tanggal_service,
            'start_time' => $request->waktu_mulai,
            'stop_time' => $request->waktu_selesai,
            'keterangan' => $request->keterangan
            ]);
        if($tr_service){
            if($request->status){
                ac::where('id_ac','=', $request->id_ac)
                ->update(['status' => $request->status]);
            }
            else{
                ac::where('id_ac','=', $request->id_ac)
                ->update(['status' => 1]);
            }

        }
        return redirect()->route('service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tr_service  $tr_service
     * @return \Illuminate\Http\Response
     */
    public function show(tr_service $tr_service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tr_service  $tr_service
     * @return \Illuminate\Http\Response
     */
    public function edit(tr_service $tr_service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatetr_serviceRequest  $request
     * @param  \App\Models\tr_service  $tr_service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id,$request);
        tr_service::where('id', '=',$id)->update([
            'id_teknisi' => $request->id_teknisi,
            'tanggal_service' => $request->tanggal_service,
            'start_time' => $request->waktu_mulai,
            'stop_time' => $request->waktu_selesai,
            'id_ac' => $request->id_ac,
            'keterangan' => $request->keterangan
        ]);
        ac::where('id_ac', '=',$request->id_ac)->update([
            'status' => $request->status
        ]);

        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tr_service  $tr_service
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = Carbon::now()->format('Y-m-d');
        tr_service::where('id','=', $id)->delete();

        return redirect()->route('service.index');
    }
}
