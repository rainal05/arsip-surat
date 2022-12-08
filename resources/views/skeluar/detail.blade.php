@extends('layouts.backend')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Detail Surat Keluar</h1>
            <ol class="breadcrumb mb-4">
                @if (auth()->user()->role == 'Admin')
                    <li class="breadcrumb-item active"><a href="{{ url('/surat/keluar') }}"><i
                                class="fa fa-arrow-circle-left"></i> Surat Keluar</a></li>
                    <li class="breadcrumb-item">Detail Surat Keluar</li>
                @endif
                @if (auth()->user()->role == 'Ketua')
                    <li class="breadcrumb-item active"><a href="{{ url('/surat/keluar') }}"><i
                                class="fa fa-arrow-circle-left"></i> Surat Keluar</a></li>
                    <li class="breadcrumb-item">Detail Surat Keluar</li>
                @endif
                @if (auth()->user()->role == 'Sekretaris')
                    <li class="breadcrumb-item active"><a href="{{ url('/surat/keluar') }}"><i
                                class="fa fa-arrow-circle-left"></i> Surat Keluar</a></li>
                    <li class="breadcrumb-item">Detail Surat Keluar</li>
                @endif
                @if (auth()->user()->role == 'Bidang')
                    <li class="breadcrumb-item active"><a href="{{ url('/bidang/surat/keluar') }}">Surat Keluar</a></li>
                    <li class="breadcrumb-item">Detail Surat Keluar</li>
                @endif
            </ol>
            @if (\Session::has('notif'))
                <div class="alert alert-primary" align="center">
                    {!! \Session::get('notif') !!}
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <table class="table table-sm table-stripped">
                        <tbody>
                            <tr>
                                <td colspan="2">
                                    <h4 class="text-primary">Surat Keluar dari
                                        {{ $keluar->user->name ?? ' - Data Sub Bagian Telah DiHapus -' }}</h4>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tujuan</td>
                                <td>: {{ $keluar->tujuan }}</td>
                            </tr>
                            <tr>
                                <td width="22%" class="font-weight-bold">No. Surat</td>
                                <td>: {{ $keluar->no }}</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Surat</td>
                                <td>: <?= Date('d-m-Y', strtotime($keluar->tgl_surat ?? '')) ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">Tanggal Keluar</td>
                                <td>: <?= Date('d-m-Y', strtotime($keluar->tgl_keluar ?? '')) ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold">File Surat</td>
                                <td>: <a href="{{ url('/surat_keluar/' . $keluar->file ?? 'ss') }}"
                                        target="_blank">{{ $keluar->hal }} <i class="fa fa-download"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
