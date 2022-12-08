@extends('layouts.backend')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Sub Bagian</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    <a href="{{ url('/bidang', []) }}"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ url('/bidang', []) }}">Sub Bagian</a></li>
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
                    <form action="/bidang/{{ $user->id }}/update" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-row mt-4">
                            <div class="col-6 col-sm-6">
                                <label for="inputEmailAddress"><b>Nama Sub Bagian</b></label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                                    placeholder="Masukan Nama Bagian">
                            </div>
                            <div class="col-6 col-sm-6">
                                <label for="inputEmailAddress"><b>Username</b></label>
                                <input type="text" name="username" value="{{ $user->username }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class="col-4 col-sm-4">
                                <label for="inputEmailAddress"><b>No Wa</b></label>
                                <input type="number" name="wa" value="{{ $user->wa }}" class="form-control"
                                    placeholder="Masukan No Wa">
                            </div>
                            <div class="col-4 col-sm-4">
                                <label for="inputEmailAddress"><b>Jabatan</b></label>
                                <input type="text" name="jabatan" value="{{ $user->jabatan }}" class="form-control"
                                    placeholder="Jabatan">
                            </div>
                            <div class="col-4 col-sm-4">
                                <label for="inputPassword"><b>Password</b></label>
                                <input type="password" name="password" class="form-control"
                                    placeholder="Masukan Password Baru Jika Ingin Diganti">
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
