<?php

namespace App\Http\Controllers;

use App\Models\ac;
use App\Models\lokasi;
use App\Models\area;
use App\Models\teknisi;
use App\Models\tr_service;
use App\Http\Requests\StoreacRequest;
use App\Http\Requests\UpdateacRequest;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
class AcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now()->format('Y-m-d');

        $ac = ac::join('lokasis','lokasis.id_lokasi','=','acs.id_lokasi')
                ->join('areas','areas.id_area','=','acs.id_area')
                ->orderBy('acs.id_area')->orderBy('acs.id_ac')->get();
        $area = area::all();
        $lokasi = lokasi::all();
        foreach ($ac as $detail_ac) {
            $last_service[$detail_ac->id_ac] = tr_service::where('id_ac','=',$detail_ac->id_ac)->orderBy('tanggal_service','desc')->first();
        }
        // dd($ac,$last_service,$now);
        return view('admin.ac.ac',compact('ac','last_service','now','area','lokasi'));
    }

    public function getData()
    {
        $data= DB::table('acs')->join('lokasis','lokasis.id_lokasi','=','acs.id_lokasi')
        ->join('areas','areas.id_area','=','acs.id_area')
        ->orderBy('acs.id_area')
        ->leftJoin('tr_services', 'acs.id_ac', '=', 'tr_services.id_ac')
        ->select('acs.id_ac','nama_lokasi','nama_area','status','tanggal_service','keterangan')
        ->groupBy('acs.id_ac')->latest('tr_services.created_at')
        ->limit(25)->get();
        return Datatables::of($data)->addColumn('DT_RowIndex', function () {
            static $index = 1;
            return $index++;
        })->make(true);
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
     * @param  \App\Http\Requests\StoreacRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $ac=ac::create([
            'id_ac' => $request->id_ac,
            'id_lokasi' => $request->id_lokasi,
            'id_area' => $request->id_area,
            'type_lokasi' => $request->type_lokasi,
            'status' => $request->status,
            'alarm_service' => $request->alarm_service
            ]);

            return redirect()->route('ac.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ac  $ac
     * @return \Illuminate\Http\Response
     */
    public function show($id_ac)
    {
        $now = Carbon::now()->format('Y-m-d');
        $ac = ac::where('id_ac','=',$id_ac)->join('lokasis','lokasis.id_lokasi','=','acs.id_lokasi')
                ->join('areas','areas.id_area','=','acs.id_area')
                ->first();
        $area = area::all();
        $lokasi = lokasi::all();
        $last_service[$ac->id_ac] = tr_service::where('id_ac','=',$ac->id_ac)->latest()->first();

        // dd($ac,$now,$last_service);
        return view('admin.ac.detail',compact('ac','last_service','now','area','lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ac  $ac
     * @return \Illuminate\Http\Response
     */
    public function edit(ac $ac)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateacRequest  $request
     * @param  \App\Models\ac  $ac
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request);
        $ac = ac::where('id_ac','=', $id)
        ->update(
            ['id_area' => $request->id_area],
            ['id_lokasi' => $request->id_lokasi],
            ['type_lokasi' => $request->type_lokasi],
            ['alarm_service' => $request->alarm_service],
            ['status' => $request->status],
        );

        return redirect()->route('ac.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ac  $ac
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = Carbon::now()->format('Y-m-d');
        ac::where('id_ac','=', $id)->delete();

        return redirect()->route('ac.index');
    }
}
