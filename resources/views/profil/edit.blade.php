@extends('layouts.backend')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Edit Akun {{ $profil->name }} </h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">
                    <a href="{{ url('/profile', []) }}"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>
                </li>
                <li class="breadcrumb-item"><a href="{{ url('/profile', []) }}">Profil </a></li>
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
                    <form action="/profile/{{ $profil->id }}/update" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-row mt-4">
                            <div class="col-6 col-sm-6">
                                <label for="inputEmailAddress"><b>Nama</b></label>
                                <input type="text" name="name" value="{{ $profil->name }}" disabled
                                    class="form-control" placeholder="Masukan Nama Akun">
                            </div>
                            <div class="col-6 col-sm-6">
                                <label for="inputEmailAddress"><b>Username</b></label>
                                <input type="text" name="username" value="{{ $profil->username }}" disabled
                                    class="form-control" placeholder="Masukan Username">
                            </div>
                        </div>
                        <div class="form-row mt-4">
                            <div class="col-6 col-sm-6">
                                <label for="inputEmailAddress"><b>No Wa</b></label>
                                <input type="number" name="wa" value="{{ $profil->wa }}" class="form-control"
                                    placeholder="Masukan No Wa (diawali 62)">
                            </div>
                            <div class="col-6 col-sm-6">
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
