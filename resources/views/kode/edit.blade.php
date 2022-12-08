@extends('layouts.backend')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Kode Surat</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    <a href="{{ url('/kode/surat', []) }}"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ url('/kode/surat', []) }}">Kode Surat</a></li>
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
                    <form action="/kode/surat/{{ $kode->id }}/update" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-row mt-4">
                            <div class="col-6 col-sm-6">
                                <label for="inputEmailAddress"><b>Kode Surat</b></label>
                                <input type="text" name="kode" value="{{ $kode->kode }}" class="form-control"
                                    placeholder="Kode Surat">
                            </div>
                            <div class="col-6 col-sm-6">
                                <label for="inputEmailAddress"><b>Nama Kode</b></label>
                                <input type="text" name="nama" value="{{ $kode->nama }}" class="form-control"
                                    placeholder="Nama Kode">
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class="col-12 col-sm-12">
                                <label for="inputEmailAddress"><b>Uraian</b></label>
                                <input type="text" name="uraian" value="{{ $kode->uraian }}" class="form-control"
                                    placeholder="Uraian Surat">
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
