<?php

namespace App\Http\Controllers;

use App\Models\lokasi;
use App\Models\area;
use App\Models\ac;
use App\Models\teknisi;
use App\Models\service;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LokasiController extends Controller
{
    public function fetchtype(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        if($request->type_lokasi != 'BOTH'){
            $data['ac'] =  DB::table('acs')->where('type_lokasi','=',$request->type_lokasi)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->get();
            $data['area'] =  DB::table('acs')->where('type_lokasi','=',$request->type_lokasi)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->groupBy('areas.id_area')
                                ->get();
            $data['lokasi'] =  DB::table('acs')->where('type_lokasi','=',$request->type_lokasi)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->groupBy('lokasis.id_lokasi')
                                ->get();
        }
        else{
            $data['ac'] = ac::all();
            $data['area'] = area::all();
            $data['lokasi'] = lokasi::all();
        }
        return response()->json($data);
    }
    public function fetchlokasi(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        if($request->id_lokasi != null && $request->type_lokasi != 'BOTH'){
            $data['ac'] =  DB::table('acs')->where('type_lokasi','=',$request->type_lokasi)
                                ->where('acs.id_lokasi','=',$request->id_lokasi)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->get();
            $data['area'] =  DB::table('acs')->where('acs.id_lokasi','=',$request->id_lokasi)
                                ->where('type_lokasi','=',$request->type_lokasi)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->groupBy('areas.id_area')
                                ->get();
            $data['lokasi'] =  DB::table('acs')->where('acs.id_lokasi','=',$request->id_lokasi)
                                ->where('type_lokasi','=',$request->type_lokasi)
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->groupBy('lokasis.id_lokasi')
                                ->get();
            $data['type_lokasi'] =  DB::table('acs')->where('type_lokasi','=',$request->type_lokasi)
                                ->where('acs.id_lokasi','=',$request->id_lokasi)
                                ->groupBy('type_lokasi')
                                ->get();
        }
        else{
            $data['ac'] =  DB::table('acs')->where('acs.id_lokasi','=',$request->id_lokasi)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->get();
            $data['area'] =  DB::table('acs')->where('acs.id_lokasi','=',$request->id_lokasi)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->groupBy('areas.id_area')
                                ->get();
            $data['lokasi'] =  DB::table('acs')->where('acs.id_lokasi','=',$request->id_lokasi)
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->groupBy('lokasis.id_lokasi')
                                ->get();
            $data['type_lokasi'] =  DB::table('acs')
                                ->where('acs.id_lokasi','=',$request->id_lokasi)
                                ->groupBy('type_lokasi')
                                ->get();
        }
        return response()->json($data);
    }
    public function fetcharea(Request $request)
    {
        $now = Carbon::now()->format('Y-m-d');
        if($request->id_area != null && $request->type_lokasi != 'BOTH'){
            $data['ac'] =  DB::table('acs')->where('type_lokasi','=',$request->type_lokasi)
                                ->where('acs.id_area','=',$request->id_area)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->get();
            $data['area'] =  DB::table('acs')->where('type_lokasi','=',$request->type_lokasi)
                                ->where('acs.id_area','=',$request->id_area)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->groupBy('areas.id_area')
                                ->get();
            $data['lokasi'] =  DB::table('acs')->where('type_lokasi','=',$request->type_lokasi)
                                ->where('acs.id_area','=',$request->id_area)
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->groupBy('lokasis.id_lokasi')
                                ->get();
            $data['type_lokasi'] =  DB::table('acs')->where('acs.id_area','=',$request->id_area)
                                ->groupBy('type_lokasi')
                                ->get();
        }
        else{
            $data['ac'] =  DB::table('acs')->where('acs.id_area','=',$request->id_area)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->get();
            $data['area'] =  DB::table('acs') ->where('acs.id_area','=',$request->id_area)
                                ->join('areas','acs.id_area','=','areas.id_area')
                                ->groupBy('areas.id_area')
                                ->get();
            $data['lokasi'] =  DB::table('acs')->where('acs.id_area','=',$request->id_area)
                                ->join('lokasis','acs.id_lokasi','=','lokasis.id_lokasi')
                                ->groupBy('lokasis.id_lokasi')
                                ->get();
            $data['type_lokasi'] =  DB::table('acs')->where('acs.id_area','=',$request->id_area)
                                ->groupBy('type_lokasi')
                                ->get();
        }
        return response()->json($data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasi = lokasi::all();
        $area = area::all();
        return view('admin.lokasi.lokasi',compact('lokasi','area'));
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
     * @param  \App\Http\Requests\StorelokasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_lokasi' => 'required',
            'nama_lokasi' => 'required'
        ]);
        $lokasi=lokasi::create([
            'id_lokasi' => $request->id_lokasi,
            'nama_lokasi' => $request->nama_lokasi,
            ]);
        return redirect()->route('lokasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show(lokasi $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req,$id)
    {
        lokasi::where('id_lokasi', '=',$id)->update([
            'nama_lokasi' => $req->nama_lokasi,
        ]);

        return redirect()->route('lokasi.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatelokasiRequest  $request
     * @param  \App\Models\lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lokasi $lokasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = Carbon::now()->format('Y-m-d');
        lokasi::where('id_lokasi','=', $id)->delete();

        return redirect()->route('lokasi.index');
    }
}
