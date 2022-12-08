@extends('layouts.backend')

@section('content')
    <main>
        <div class="container-fluid">
            <h5 class="mt-1">
                <font color="black"><b>SISTEM INFORMASI PENGARSIPAN SURAT MASUK DAN SURAT KELUAR KPU KOTA JAMBI</b></font>
            </h5>
            <ol class="breadcrumb mb-1">
                @if (auth()->user()->role == 'Admin')
                    <li class="breadcrumb-item">Selamat Datang {{ Auth::user()->name }}</li>
                @endif
                @if (auth()->user()->role == 'Bidang')
                    <li class="breadcrumb-item">Selamat Datang {{ Auth::user()->name }}</li>
                @endif
                @if (auth()->user()->role == 'Ketua')
                    <li class="breadcrumb-item">Selamat Datang Ketua KPU Kota Jambi</li>
                @endif
                @if (auth()->user()->role == 'Sekretaris')
                    <li class="breadcrumb-item">Selamat Datang Sekretaris KPU Kota Jambi</li>
                @endif
            </ol>
            @if (\Session::has('notif'))
                <div class="alert alert-primary" align="center">
                    {!! \Session::get('notif') !!}
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">

                                @if (auth()->user()->role == 'Admin')
                                    <div class="row">
                                        <!-- Masuk -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <a href="{{ url('/surat/masuk', []) }}">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div
                                                                    class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                                    Surat Masuk
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                            {!! json_encode($amasuk) !!}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Keluar -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <a href="{{ url('/surat/keluar', []) }}">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div
                                                                    class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                    Surat Keluar
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                            {!! json_encode($akeluar) !!}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-envelope-open fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (auth()->user()->role == 'Bidang')
                                    <div class="row">
                                        <!-- Masuk -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <a href="{{ url('/bidang/surat/masuk', []) }}">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div
                                                                    class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                                    Surat Masuk
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                            {!! json_encode($masuk) !!}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Keluar -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <a href="{{ url('/bidang/surat/keluar', []) }}">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div
                                                                    class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                    Surat Keluar
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                            {!! json_encode($keluar) !!}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-envelope-open fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (auth()->user()->role == 'Ketua')
                                    <div class="row">
                                        <!-- Masuk -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <a href="{{ url('/surat/masuk', []) }}">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div
                                                                    class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                                    Surat Masuk
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                            {!! json_encode($ksmasuk) !!}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Keluar -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <a href="{{ url('/surat/keluar', []) }}">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div
                                                                    class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                    Surat Keluar
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                            {!! json_encode($kskeluar) !!}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-envelope-open fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (auth()->user()->role == 'Sekretaris')
                                    <div class="row">
                                        <!-- Masuk -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <a href="{{ url('/surat/masuk', []) }}">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div
                                                                    class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                                    Surat Masuk
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                            {!! json_encode($ksmasuk) !!}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-envelope fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Keluar -->
                                        <div class="col-xl-4 col-md-6 mb-4">
                                            <div class="card border-left-info shadow h-100 py-2">
                                                <div class="card-body">
                                                    <a href="{{ url('/surat/keluar', []) }}">
                                                        <div class="row no-gutters align-items-center">
                                                            <div class="col mr-2">
                                                                <div
                                                                    class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                                    Surat Keluar
                                                                </div>
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col-auto">
                                                                        <div
                                                                            class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                                            {!! json_encode($kskeluar) !!}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-envelope-open fa-2x text-gray-300"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
