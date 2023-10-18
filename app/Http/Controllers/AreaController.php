<?php

namespace App\Http\Controllers;

use App\Models\area;
use App\Http\Requests\StoreareaRequest;
use App\Http\Requests\UpdateareaRequest;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $area = area::all();
        return view('admin.area.area',compact('area'));
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
     * @param  \App\Http\Requests\StoreareaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_area' => 'required',
            'nama_area' => 'required'
        ]);
        $area=area::create([
            'id_area' => $request->id_area,
            'nama_area' => $request->nama_area,
            ]);
        return redirect()->route('area.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(area $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateareaRequest  $request
     * @param  \App\Models\area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        area::where('id_area', '=',$id)->update([
            'nama_area' => $request->nama_area,
        ]);

        return redirect()->route('area.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $now = Carbon::now()->format('Y-m-d');
        area::where('id_area','=', $id)->delete();

        return redirect()->route('area.index');
    }
}
