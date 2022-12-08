<?php

namespace App\Http\Controllers;

use App\Keperluan;
use Illuminate\Http\Request;

class KeperluanController extends Controller
{
    public function index()
    {
        $kep = Keperluan::orderBy('created_at', 'DESC')->get();
        return view('keperluan.index', compact('kep'));
    }

    public function store(Request $request)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'nama' => 'required|unique:keperluans,nama',
        ], $massage);
        $kode = Keperluan::create([
            'nama'      => $request->nama,
        ]);
        return redirect()->back()->with(['notif' => 'Keperluan <strong>' . $kode->nama . '</strong> Ditambah']);
    }

    public function edit($id)
    {
        $kode = Keperluan::find($id);
        return view('keperluan.edit', compact('kode'));
    }

    public function update(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'nama' => 'required',
        ], $massage);
        $kode = \App\Keperluan::find($id);
        $kode->nama = $request->nama;
        $kode->save();
        return redirect('/keperluan/disposisi')->with(['notif' => 'Keperluan <strong>' . $kode->nama . '</strong> Diupdate']);
    }

    public function delete($id)
    {
        $kode = keperluan::find($id);
        $kode->delete();
        return redirect()->back()->with(['notif' => 'Keperluan </strong>' . $kode->nama . '</strong> Dihapus']);
    }
}
