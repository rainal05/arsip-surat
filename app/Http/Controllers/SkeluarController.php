<?php

namespace App\Http\Controllers;

use App\Kode;
use App\S_keluar;
use App\User;
use File;
use Illuminate\Http\Request;

class SkeluarController extends Controller
{
    public function index()
    {
        $kode = Kode::get();
        $user = User::whereIn('role', array('Ketua', 'Sekretaris', 'Bidang'))->get();
        $ketsek = S_keluar::orderBy('created_at', 'DESC')->where('user_id', \Auth::user()->id)->get();
        $keluar = S_keluar::orderBy('created_at', 'DESC')->get();
        return view('skeluar.index', compact('keluar', 'user', 'kode', 'ketsek'));
    }

    public function store(Request $request)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];
        $this->validate($request, [
            'agenda' => 'required',
            'no' => 'required|unique:s_keluars,no',
            'tgl_surat' => 'required',
            'tgl_keluar' => 'required',
            'hal' => 'required',
            'user_id' => 'required',
            'tujuan' => 'required',
            'file' => 'required',
        ], $massage);
        $file = $request->file('file');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'surat_keluar';
        $file->move($tujuan_upload, $nama_file);
        //and foto
        $up = new \App\S_keluar;
        $up->agenda = $request->agenda;
        $up->no = $request->no;
        $up->tgl_surat = $request->tgl_surat;
        $up->tgl_keluar = $request->tgl_keluar;
        $up->hal = $request->hal;
        $up->kategori_id = '2';
        $up->user_id = $request->user_id;
        $up->tujuan = $request->tujuan;
        $up->kode_id = $request->kode_id;
        $up->file = $nama_file;
        // $up->tgl = $tgl['now'];
        // $up->jam = $jam['now'];
        $up->save();
        return redirect()->back()->with('notif', 'Surat Keluar Ditambah');
    }

    public function detail($id)
    {
        $keluar = S_keluar::find($id);
        return view('skeluar.detail', compact('keluar'));
    }

    public function edit($id)
    {
        $kode = Kode::get();
        $user = User::where('Role', 'Bidang')->get();
        $keluar = S_keluar::find($id);
        return view('skeluar.edit', compact('keluar', 'user', 'kode'));
    }

    public function update(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'agenda' => 'required',
            'no' => 'required',
            'tgl_surat' => 'required',
            'tgl_keluar' => 'required',
            'hal' => 'required',
            'tujuan' => 'required',
        ], $massage);
        $keluar = \App\S_keluar::find($id);
        $keluar->agenda = $request->agenda;
        $keluar->no = $request->no;
        $keluar->tgl_surat = $request->tgl_surat;
        $keluar->tgl_keluar = $request->tgl_keluar;
        $keluar->hal = $request->hal;
        $keluar->user_id = $request->user_id;
        $keluar->tujuan = $request->tujuan;
        $keluar->kode_id = $request->kode_id;
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalName();
            $nama_file = time() . '.' . $extension;
            $file->move('surat_keluar', $nama_file);
            $keluar->file = $nama_file;
        }
        $keluar->save();
        return redirect('/surat/keluar')->with('notif', 'Berhasi di Update');
    }

    public function delete($id)
    {
        // hapus file
        $keluar = S_keluar::where('id', $id)->first();
        File::delete('surat_keluar/' . $keluar->file);

        // hapus data
        S_keluar::where('id', $id)->delete();

        return redirect()->back()->with('notif', 'Data Berhasil Dihapus');
    }
}
