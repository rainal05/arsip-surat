@extends('layouts.backend')

@section('content')
    @if (auth()->user()->role == 'Admin')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Edit Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="{{ url('/surat/masuk') }}">Surat Masuk</a></li>
                    <li class="breadcrumb-item">Edit Surat Masuk</li>
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

                        <form action="/surat/masuk/{{ $masuk->id }}/update" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Dari</b></label>
                                    <input type="text" name="dari" class="form-control" value="{{ $masuk->dari }}"
                                        placeholder="Surat Dari">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tujuan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($pim as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat</b></label>
                                    <input type="date" name="tgl_surat" value="{{ $masuk->tgl_surat }}"
                                        class="form-control">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat Masuk</b></label>
                                    <input type="date" name="tgl_masuk" value="{{ $masuk->tgl_masuk }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control" value="{{ $masuk->no }}"
                                        placeholder="No Surat Masuk">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>No Agenda</b></label>
                                    <input type="text" name="agenda" class="form-control" value="{{ $masuk->agenda }}"
                                        placeholder="No Surat Masuk">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal</b></label>
                                    <input type="text" name="hal" class="form-control" value="{{ $masuk->hal }}"
                                        placeholder="Perihal Surat">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Upload File</b></label>
                                    <input type="file" name="file" class="form-control">
                                </div>
                            </div>
                            <label class="form-label">
                                <span class="badge border-dark border-1 text-dark"><i>Note : Scan File Surat Dan Upload
                                        Dalam Bentuk PDF</i></span>
                            </label>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Update</button>
                                {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection
