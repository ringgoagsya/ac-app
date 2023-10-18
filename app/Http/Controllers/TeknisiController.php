<?php

namespace App\Http\Controllers;

use App\Models\teknisi;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teknisi = teknisi::all();
        return view('admin.teknisi.teknisi',compact('teknisi'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'id_teknisi' => 'required',
            'type_teknisi' => 'required',
            'nama_teknisi' => 'required'
        ]);
        $teknisi=teknisi::create([
            'id_teknisi' => $request->id_teknisi,
            'type_teknisi' => $request->type_teknisi,
            'nama_teknisi' => $request->nama_teknisi,
            ]);
        return redirect()->route('teknisi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\teknisi  $teknisi
     * @return \Illuminate\Http\Response
     */
    public function show(teknisi $teknisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\teknisi  $teknisi
     * @return \Illuminate\Http\Response
     */
    public function edit(teknisi $teknisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\teknisi  $teknisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        teknisi::where('id_teknisi', '=',$id)->update([
            'nama_teknisi' => $request->nama_teknisi,
            'type_teknisi' => $request->type_teknisi
        ]);

        return redirect()->route('teknisi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\teknisi  $teknisi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        teknisi::where('id_teknisi','=', $id)->delete();

        return redirect()->route('teknisi.index');
    }
}
