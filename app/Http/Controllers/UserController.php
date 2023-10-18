<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\teknisi;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index');
    }
    public function user(){
        $user = user::all();
        $teknisi = teknisi::all();
        return view('admin.user.user',compact('teknisi','user'));
    }
    public function store(request $req){
        // dd($req);
        $req->validate([
            'id_teknisi' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $teknisi = teknisi::where('id_teknisi','=',$req->id_teknisi)->first();
        // dd($req,$teknisi);
        User::create([
            'name' => $teknisi->nama_teknisi,
            'email' => $req->email,
            'email_verified_at' => now(),
            'password' => Hash::make($req->password),
            'level' => 'user',
            'id_teknisi' => $teknisi->id_teknisi,
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
            ]);
        return redirect()->route('user.index');
    }

    public function update(request $req,$id){
        $req->validate([
            'id_teknisi' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $teknisi = teknisi::where('id_teknisi','=',$req->id_teknisi)->first();
        // dd($teknisi);
        User::where('id', $id)->update([
            'name' => $teknisi->nama_teknisi,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'id_teknisi' => $teknisi->id_teknisi,
            'updated_at' => now()
            ]);
        return redirect()->route('user.index');
    }
    public function destroy($id){
        User::where('id', $id)->delete();
        return redirect()->route('user.index');
    }
}
