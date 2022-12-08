@extends('layouts.backend')

@section('content')
    @if (auth()->user()->role == 'Admin')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Detail Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="{{ url('/surat/masuk') }}">Surat Masuk</a></li>
                    <li class="breadcrumb-item">Detail Surat Masuk</li>
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
                                        <h4 class="text-primary">Surat Masuk Dari {{ $masuk->dari }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">No Agenda</td>
                                    <td>: {{ $masuk->agenda ?? '- Data Hilang -' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tujuan</td>
                                    <td>: {{ $masuk->user->name ?? '- Data Hilang -' }}</td>
                                </tr>
                                <tr>
                                    <td width="22%" class="font-weight-bold">No. Surat</td>
                                    <td>: {{ $masuk->no }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Surat</td>
                                    <td>: <?= Date('d-m-Y', strtotime($masuk->tgl_surat ?? '')) ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Masuk</td>
                                    <td>: <?= Date('d-m-Y', strtotime($masuk->tgl_masuk ?? '')) ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">File Surat</td>
                                    <td>: <a href="{{ url('/surat_masuk/' . $masuk->file ?? 'ss') }}"
                                            target="_blank">{{ $masuk->hal }}
                                            <i class="fa fa-download"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    @endif
    @if (auth()->user()->role == 'Bidang')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Detail Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="{{ url('/bidang/surat/masuk') }}">Surat Masuk</a></li>
                    <li class="breadcrumb-item">Detail Surat Masuk</li>
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
                                        <h4 class="text-primary">Surat Masuk Dari {{ $masuk->dari }}</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Disposisi Dari</td>
                                    <td>: {{ $masuk->ket_sek ?? '-Data Hilang-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">No Agenda</td>
                                    <td>: {{ $masuk->agenda ?? '-Data Hilang-' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tujuan</td>
                                    <td>: {{ $masuk->user->name ?? '- Data Hilang -' }}</td>
                                </tr>
                                <tr>
                                    <td width="22%" class="font-weight-bold">No. Surat</td>
                                    <td>: {{ $masuk->no }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Surat</td>
                                    <td>: <?= Date('d-m-Y', strtotime($masuk->tgl_surat ?? '')) ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tanggal Masuk</td>
                                    <td>: <?= Date('d-m-Y', strtotime($masuk->tgl_masuk ?? '')) ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Sifat</td>
                                    <td>: {{ $masuk->sifat ?? '- Data Hilang -' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Catatan</td>
                                    <td>: {{ $masuk->catat ?? '- Data Hilang -' }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">File Surat</td>
                                    <td>: <a href="{{ url('/surat_masuk/' . $masuk->file ?? 'ss') }}" target="_blank">
                                            {{ $masuk->hal }}
                                            <i class="fa fa-download"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection
