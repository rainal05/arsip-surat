<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // STAR AKUN BIDANG
    public function index()
    {
        $user = User::where('Role', 'Bidang')->get();
        return view('bidang.index', compact('user'));
    }
    public function store(Request $request)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'wa' => 'required',
            'jabatan' => 'required',
        ], $massage);
        $usr = User::create([
            'role'      => 'Bidang',
            'name'      => $request->name,
            'username'      => $request->username,
            'wa'      => $request->wa,
            'jabatan'      => $request->jabatan,
            'password'  => bcrypt('kpujambikota'),
            'remember_token' => str_random(60),
        ]);
        return redirect()->back()->with(['notif' => 'Bidang <strong>' . $usr->name . '</strong> Ditambah']);
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('bidang.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'username' => 'required',
            'name' => 'required',
            'wa' => 'required',
            'jabatan' => 'required',
            'password' => 'required',
        ], $massage);
        $user = \App\User::find($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->wa = $request->wa;
        $user->jabatan = $request->jabatan;
        $user->password = bcrypt($request->password);
        $user->remember_token = str_random(60);
        $user->save();
        return redirect('/bidang')->with(['notif' => 'Bidang <strong>' . $user->name . '</strong> Diupdate']);
    }
    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with(['notif' => 'Akun </strong>' . $user->name . '</strong> Dihapus']);
    }
    // END AKUN BIDANG

    // STAR AKUN BIDANG
    public function indexpim()
    {
        $pim = User::whereIn('role', array('Ketua', 'Sekretaris'))->get();
        return view('pimpinan.index', compact('pim'));
    }
    public function storepim(Request $request)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'role' => 'required',
            'name' => 'required|unique:users,name',
            'username' => 'required|unique:users,username',
            'wa' => 'required|unique:users,wa',
        ], $massage);
        // $up->tujuan =
        //     Str::slug($up->agenda . $tgl['now']);;
        $pim = User::create([
            'role'      => $request->role,
            'name'      => $request->name,
            'username'  => $request->username,
            'wa'        => $request->wa,
            'jabatan'   => Str::slug($request->role),
            'password'  => bcrypt('kpujambikota'),
            'remember_token' => str_random(60),
        ]);
        return redirect()->back()->with(['notif' => 'Akun <strong>' . $pim->name . '</strong> Ditambah']);
    }
    public function editpim($id)
    {
        $pim = User::find($id);
        return view('pimpinan.edit', compact('pim'));
    }
    public function updatepim(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'role' => 'required',
            'name' => 'required',
            'username' => 'required',
            'wa' => 'required',
            'password' => 'required',
        ], $massage);
        $pim = \App\User::find($id);
        $pim->role = $request->role;
        $pim->name = $request->name;
        $pim->username = $request->username;
        $pim->wa = $request->wa;
        $pim->jabatan =
            Str::slug($request->role);
        $pim->password = bcrypt($request->password);
        $pim->save();
        return redirect('/pimpinan')->with(['notif' => 'Akun <strong>' . $pim->name . '</strong> Diupdate']);
    }
    public function deletepim($id)
    {
        $pim = User::find($id);
        $pim->delete();
        return redirect()->back()->with(['notif' => 'Akun </strong>' . $pim->name . '</strong> Dihapus']);
    }
    // END AKUN BIDANG
}
