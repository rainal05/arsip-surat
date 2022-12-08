@extends('layouts.backend')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Profil</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Profil Saya
                </li>
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
                    <table class="table table-sm table-stripped">
                        <tbody>
                            @foreach ($profil as $item)
                                <tr>
                                    <td colspan="2">
                                        <h4 class="text-success">Data Diri Akun, {{ $item->name }}
                                            <a href="profile/{{ $item->id }}/"><i class="fa fa-edit"></i></a>
                                        </h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Username</td>
                                    <td>: {{ $item->username }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">No Wa</td>
                                    <td>: <a href="https://wa.me/{{ $item->wa }}" target="_blank">
                                            {{ $item->wa }}
                                        </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
