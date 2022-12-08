<?php

namespace App\Http\Controllers;

use App\Disposisi;
use App\S_keluar;
use App\S_masuk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $masuk = Disposisi::where('user_id', \Auth::user()->id)
            ->count();
        $keluar = S_keluar::where('user_id', \Auth::user()->id)
            ->count();
        // BIDANG
        $amasuk = S_masuk::get()
            ->count();
        $akeluar = S_keluar::get()
            ->count();
        // ketsek
        $ksmasuk = S_masuk::where('user_id', \Auth::user()->id)
            ->count();
        $kskeluar = S_keluar::where('user_id', \Auth::user()->id)
            ->count();
        return view('home', compact('masuk', 'keluar', 'amasuk', 'akeluar', 'ksmasuk', 'kskeluar'));
    }
}
