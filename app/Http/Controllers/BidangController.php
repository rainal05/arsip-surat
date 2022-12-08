<?php

namespace App\Http\Controllers;

use App\Disposisi;
use App\S_keluar;
use App\S_masuk;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    public function masuk()
    {
        $masuk = Disposisi::orderBy('created_at', 'DESC')->where('user_id', \Auth::user()->id)->get();
        return view('smasuk.index', compact('masuk'));
    }

    public function mdetail($id)
    {
        $masuk = Disposisi::find($id);
        return view('smasuk.detail', compact('masuk'));
    }

    public function keluar()
    {
        $keluar = S_keluar::orderBy('created_at', 'DESC')->where('user_id', \Auth::user()->id)->get();
        return view('skeluar.index', compact('keluar'));
    }

    public function kdetail($id)
    {
        $keluar = S_keluar::find($id);
        return view('skeluar.detail', compact('keluar'));
    }
}
