<?php

namespace App\Http\Controllers;

use App\Disposisi;
use App\Keperluan;
use App\Kode;
use App\S_masuk;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use File;
use PDF;
use Illuminate\Http\Request;

class SmasukController extends Controller
{
    public function index()
    {
        $tgl['now']     = Carbon::now()->format('Y');
        $user = User::whereIn('role', array('Ketua', 'Sekretaris'))->get();
        $masuk = S_masuk::orderBy('created_at', 'DESC')->get();
        $ketsek = S_masuk::orderBy('created_at', 'DESC')->where('user_id', \Auth::user()->id)->get();
        $kode = Kode::get();
        return view('smasuk.index', compact('masuk', 'user', 'kode', 'ketsek', 'tgl'));
    }

    public function store(Request $request)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];
        $this->validate($request, [
            'agenda' => 'required',
            'no' => 'required|unique:s_masuks,no',
            'tgl_surat' => 'required',
            'tgl_masuk' => 'required',
            'hal' => 'required',
            'user_id' => 'required',
            'dari' => 'required',
            'file' => 'required',
            // 'sifat' => 'required',
        ], $massage);
        $file = $request->file('file');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'surat_masuk';
        $file->move($tujuan_upload, $nama_file);
        //and foto
        $up = new \App\S_masuk;
        $up->agenda = $request->agenda;
        $up->no = $request->no;
        $up->tgl_surat = $request->tgl_surat;
        $up->tgl_masuk = $request->tgl_masuk;
        $up->hal = $request->hal;
        $up->kategori_id = '1';
        // $up->tujuan =
        //     Str::slug($up->agenda . $tgl['now']);;
        $up->user_id = $request->user_id;
        $up->dari = $request->dari;
        $up->file = $nama_file;
        $up->save();
        return redirect()->back()->with('notif', 'Surat Masuk Ditambah');
    }

    public function dispos(Request $request)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];
        $this->validate($request, [
            'user_id' => 'required',
            'sifat' => 'required',
            'keperluan_id' => 'required',
            'catat' => 'required',
        ], $massage);
        $up = new \App\Disposisi;
        $up->agenda = $request->agenda;
        $up->s_masuk_id = $request->s_masuk_id;
        $up->user_id = $request->user_id;
        $up->keperluan_id = $request->keperluan_id;
        $up->no = $request->no;
        $up->tgl_surat = $request->tgl_surat;
        $up->tgl_masuk = $request->tgl_masuk;
        $up->hal = $request->hal;
        $up->ket_sek = $request->ket_sek;
        $up->dari = $request->dari;
        $up->file = $request->file;
        $up->catat = $request->catat;
        $up->sifat = $request->sifat;
        $up->save();
        return redirect()->back()->with('notif', 'Disposisi Ditambah');
    }
    // dispos adm
    public function disposadm(Request $request)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];
        $this->validate($request, [
            'user_id' => 'required',
            'sifat' => 'required',
            'keperluan_id' => 'required',
            'catat' => 'required',
            'ket_sek' => 'required',
        ], $massage);
        $up = new \App\Disposisi;
        $up->agenda = $request->agenda;
        $up->s_masuk_id = $request->s_masuk_id;
        $up->user_id = $request->user_id;
        $up->keperluan_id = $request->keperluan_id;
        $up->no = $request->no;
        $up->tgl_surat = $request->tgl_surat;
        $up->tgl_masuk = $request->tgl_masuk;
        $up->hal = $request->hal;
        $up->ket_sek = $request->ket_sek;
        $up->dari = $request->dari;
        $up->file = $request->file;
        $up->catat = $request->catat;
        $up->sifat = $request->sifat;
        $up->save();
        return redirect()->back()->with('notif', 'Disposisi Ditambah');
    }

    public function detail($id)
    {
        $masuk = S_masuk::find($id);
        return view('smasuk.detail', compact('masuk'));
    }

    public function disposisi($id)
    {
        $pim = User::whereIn('role', array('Ketua', 'Sekretaris'))->get();
        $kep = Keperluan::get();
        $user = User::orderBy('created_at', 'DESC')->where('Role', 'Bidang')->get();
        $masuk = S_masuk::orderBy('created_at', 'DESC')->with(['disposisi'])->find($id);
        $cek = S_masuk::with(['disposisi'])->find($id)->count();
        return view('smasuk.disposisi', compact('masuk', 'user', 'cek', 'kep', 'pim'));
    }
    // edit-delete-print disposisi
    public function disposisiedit($id)
    {
        $dispos = Disposisi::find($id);
        $kep = Keperluan::get();
        $pim = User::whereIn('role', array('Ketua', 'Sekretaris'))->get();
        $sub = User::orderBy('created_at', 'DESC')->where('Role', 'Bidang')->get();
        return view('smasuk.disposisi-edit', compact('dispos', 'kep', 'sub', 'pim'));
    }
    public function updatedispos(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'user_id' => 'required',
            'keperluan_id' => 'required',
            'ket_sek' => 'required',
            'catat' => 'required',
            'sifat' => 'required',
        ], $massage);
        $masuk = \App\Disposisi::find($id);
        $masuk->user_id = $request->user_id;
        $masuk->keperluan_id = $request->keperluan_id;
        $masuk->ket_sek = $request->ket_sek;
        $masuk->catat = $request->catat;
        $masuk->sifat = $request->sifat;
        $masuk->save();
        return redirect('/surat/masuk')->with('notif', 'Disposisi Berhasil Diupdate');
    }
    public function deletedispos($id)
    {
        $user = Disposisi::find($id);
        $user->delete();
        return redirect()->back()->with('notif', 'Disposisi Berhasil Dihapus');
    }
    public function printdispos($id)
    {
        $tgl['now']     = Carbon::now()->format('d-m-Y');
        $invoice = Disposisi::find($id);
        $filename = $invoice->hal;
        $pdf = PDF::loadView('smasuk.disposisi-print', compact('invoice', 'tgl'))->setPaper('a4', 'landscape');
        return $pdf->stream($filename . '-Disposisi.pdf');
    }
    // edit-delete-print disposisi

    // edit
    public function edit($id)
    {
        $kode = Kode::get();
        $pim = User::whereIn('role', array('Ketua', 'Sekretaris'))->get();
        $masuk = S_masuk::with(['disposisi'])->find($id);
        return view('smasuk.edit', compact('masuk', 'pim', 'kode'));
    }

    public function update(Request $request, $id)
    {
        $massage = [
            'required' => ':attribute  wajib di isi !!',
        ];

        $this->validate($request, [
            'agenda' => 'required',
            'no' => 'required',
            'hal' => 'required',
            'user_id' => 'required',
            'dari' => 'required',
        ], $massage);
        $masuk = \App\S_masuk::find($id);
        $masuk->agenda = $request->agenda;
        $masuk->no = $request->no;
        $masuk->tgl_surat = $request->tgl_surat;
        $masuk->tgl_masuk = $request->tgl_masuk;
        $masuk->hal = $request->hal;
        $masuk->user_id = $request->user_id;
        $masuk->dari = $request->dari;
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalName();
            $nama_file = time() . '.' . $extension;
            $file->move('surat_masuk', $nama_file);
            $masuk->file = $nama_file;
        }
        $masuk->save();
        return redirect('/surat/masuk')->with(['notif' => 'Surat <strong>' . $masuk->dari . '</strong> Diupdate']);
    }

    public function delete($id)
    {
        // hapus file
        $masuk = S_masuk::where('id', $id)->first();
        File::delete('surat_masuk/' . $masuk->file);

        // hapus data
        S_masuk::where('id', $id)->delete();

        return redirect()->back()->with('notif', 'Data Berhasil Dihapus');
    }

    public function print($id)
    {
        $invoice = S_masuk::with(['disposisi'])->find($id);
        $filename = $invoice->hal;
        $pdf = PDF::loadView('smasuk.print', compact('invoice'))->setPaper('a4', 'landscape');
        return $pdf->stream($filename . '-Surat Masuk.pdf');
    }
}
