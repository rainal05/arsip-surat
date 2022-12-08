<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = User::where('id', \Auth::user()->id)->get();
        return view('profil.index', compact('profil'));
    }

    public function edit($id)
    {
        $profil = User::find($id);
        return view('profil.edit', compact('profil'));
    }

    public function update(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'wa' => 'required',
            'password' => 'required',
        ], $massage);
        $user = \App\User::find($id);
        $user->wa = $request->wa;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('/profile')->with(['notif' => 'Akun <strong>' . $user->name . '</strong> Diupdate']);
    }
}
