<?php

namespace App\Http\Controllers;

use App\S_keluar;
use App\S_masuk;
use PDF;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function masuk()
    {
        return view('smasuk.rekap');
    }
    public function rmasuk($awalkas, $akhirkas)
    {
        // $tgl['now']     = Carbon::now()->format('d-m-Y');
        $awal = "$awalkas";
        $akhir = "$akhirkas";
        $kasbon = S_masuk::whereBetween('tgl_masuk', [$awalkas, $akhirkas])
            ->get();
        $pdf = PDF::loadView('smasuk.rekapdf', compact('kasbon', 'awal','akhir'))->setPaper('a4', 'potrait');
        return $pdf->stream('Rekap-Surat-Masuk.pdf');
        // dd($kasbon);
    }

    public function keluar()
    {
        return view('skeluar.rekap');
    }
    public function rkeluar($awalkas, $akhirkas)
    {
        $awal = "$awalkas";
        $akhir = "$akhirkas"; 
        $tgl = S_keluar::find($awalkas);
        $keluar = S_keluar::whereBetween('tgl_keluar', [$awalkas, $akhirkas]) 
            ->get();
        $pdf = PDF::loadView('skeluar.rekapdf', compact('keluar', 'tgl','awal','akhir'))->setPaper('a4', 'potrait');
        return $pdf->stream('Rekap-Surat-Keluar.pdf');
        // dd($keluar);
    }
}
