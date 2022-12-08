@extends('layouts.backend')

@section('content')
    @if (auth()->user()->role == 'Admin')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Laporan Surat Keluar</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Surat Keluar</li>
                    <li class="breadcrumb-item">Laporan Surat Keluar</li>
                </ol>
                <!-- notif -->
                @if (\Session::has('notif'))
                    <div class="alert alert-primary" align="center">
                        {!! \Session::get('notif') !!}
                    </div>
                @endif
                <!-- notif -->
                <!-- error -->
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <!-- end error -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="form-row mt-4">
                            <div class="col-6 col-sm-6">
                                <label>Tanggal Awal </label>
                                <input class=" form-control" min="2022-01-01" name="awalkeluar" id="awalkeluar"
                                    type="date" />
                            </div>
                            <div class="col-6 col-sm-6">
                                <label>Tanggal Akhir</label>
                                <input class=" form-control" min="2022-01-01" name="akhirkeluar" id="akhirkeluar"
                                    type="date" />
                            </div>
                        </div>
                        <div class="input-group" style="margin-top: 5px">
                            <a href="#" onclick="this.href='/rekap/surat/keluar/'+document.getElementById('awalkeluar').value +
                                '/' + document.getElementById('akhirkeluar').value" target="_blank"
                                class="btn btn-primary">Cetak
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endif


@endsection
