<?php

namespace App\Http\Controllers;

use App\Kode;
use Illuminate\Http\Request;

class KodeController extends Controller
{
    public function index()
    {
        $kode = Kode::orderBy('created_at', 'DESC')->get();
        return view('kode.index', compact('kode'));
    }

    public function store(Request $request)
    {
        $massage = [
            'kode.required' => 'wajib di isi kode!!',
            'nama.required' => 'wajib di isi nama !!',
            'uraian.required' => 'wajib di isi uraian !!',
        ];

        $this->validate($request, [
            'kode' => 'required|unique:kodes,kode',
            'nama' => 'required',
            'uraian' => 'required',
        ], $massage);
        $kode = Kode::create([
            'kode'      => $request->kode,
            'nama'      => $request->nama,
            'uraian'      => $request->uraian,
        ]);
        return redirect()->back()->with(['notif' => 'Kode <strong>' . $kode->nama . '</strong> Ditambah']);
    }

    public function edit($id)
    {
        $kode = Kode::find($id);
        return view('kode.edit', compact('kode'));
    }

    public function update(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'kode' => 'required',
            'nama' => 'required',
            'uraian' => 'required',
        ], $massage);
        $kode = \App\Kode::find($id);
        $kode->kode = $request->kode;
        $kode->nama = $request->nama;
        $kode->uraian = $request->uraian;
        $kode->save();
        return redirect('/kode/surat')->with(['notif' => 'Kode <strong>' . $kode->nama . '</strong> Diupdate']);
    }

    public function delete($id)
    {
        $kode = Kode::find($id);
        $kode->delete();
        return redirect()->back()->with(['notif' => 'Kode </strong>' . $kode->nama . '</strong> Dihapus']);
    }
}
