@extends('layouts.backend')

@section('content')
    @if (auth()->user()->role == 'Admin')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Edit Disposisi</h1>
                <ol class="breadcrumb mb-4"> 
                    <li class="breadcrumb-item">Edit Disposisi</li>
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

                        <form action="/surat/masuk/disposisi/{{ $dispos->id }}/update" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row mt-3"> 
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control" value="{{ $dispos->no }}"
                                        disabled >
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal Surat</b></label>
                                    <input type="text" name="hal" class="form-control" value="{{ $dispos->hal }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3"> 
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Diteruskan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                            @foreach ($sub as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Sifat</b></label>
                                    <select name="sifat" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        <option value="Biasa">Biasa</option>
                                        <option value="Mendesak">Mendesak</option>
                                        <option value="Perlu Perhatian Khusus">Perlu Perhatian Khusus</option>
                                        <option value="Perlu Perhatian Batas Waktu">Perlu Perhatian Batas Waktu</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Mohon Bantuan Saudara Untuk</b></label>
                                    <select name="keperluan_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($kep as $item)
                                        <option value="{{ $item->id}}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Disposisi Dari</b></label>
                                    <select name="ket_sek" class="multisteps-form__select form-control">
                                    <option value="">-- PILIH --</option>
                                        @foreach ($pim as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>    
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Catatan</b></label>
                                    <textarea name="catat" cols="30" rows="3" class="form-control">{{ $dispos->catat }}</textarea>
                                </div>
                            </div> 
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-success">Update</button>
                                {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </main>
    @endif
    @if (auth()->user()->role == 'Ketua')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Edit Disposisi</h1>
                <ol class="breadcrumb mb-4"> 
                    <li class="breadcrumb-item">Edit Disposisi</li>
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

                        <form action="/surat/masuk/disposisi/{{ $dispos->id }}/update" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="ket_sek" value="{{ Auth::user()->name }}">
                            <div class="form-row mt-3"> 
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control" value="{{ $dispos->no }}"
                                        disabled >
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal Surat</b></label>
                                    <input type="text" name="hal" class="form-control" value="{{ $dispos->hal }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3"> 
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Diteruskan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                            @foreach ($sub as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Sifat</b></label>
                                    <select name="sifat" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        <option value="Biasa">Biasa</option>
                                        <option value="Mendesak">Mendesak</option>
                                        <option value="Perlu Perhatian Khusus">Perlu Perhatian Khusus</option>
                                        <option value="Perlu Perhatian Batas Waktu">Perlu Perhatian Batas Waktu</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Mohon Bantuan Saudara Untuk</b></label>
                                    <select name="keperluan_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($kep as $item)
                                        <option value="{{ $item->id}}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>    
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Catatan</b></label>
                                    <textarea name="catat" cols="30" rows="3" class="form-control">{{ $dispos->catat }}</textarea>
                                </div>
                            </div> 
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-success">Update</button>
                                {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </main>
    @endif
    @if (auth()->user()->role == 'Sekretaris')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Edit Disposisi</h1>
                <ol class="breadcrumb mb-4"> 
                    <li class="breadcrumb-item">Edit Disposisi</li>
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

                        <form action="/surat/masuk/disposisi/{{ $dispos->id }}/update" method="POST"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="ket_sek" value="{{ Auth::user()->name }}">
                            <div class="form-row mt-3"> 
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control" value="{{ $dispos->no }}"
                                        disabled >
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal Surat</b></label>
                                    <input type="text" name="hal" class="form-control" value="{{ $dispos->hal }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3"> 
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Diteruskan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                            @foreach ($sub as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Sifat</b></label>
                                    <select name="sifat" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        <option value="Biasa">Biasa</option>
                                        <option value="Mendesak">Mendesak</option>
                                        <option value="Perlu Perhatian Khusus">Perlu Perhatian Khusus</option>
                                        <option value="Perlu Perhatian Batas Waktu">Perlu Perhatian Batas Waktu</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Mohon Bantuan Saudara Untuk</b></label>
                                    <select name="keperluan_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($kep as $item)
                                        <option value="{{ $item->id}}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>    
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Catatan</b></label>
                                    <textarea name="catat" cols="30" rows="3" class="form-control">{{ $dispos->catat }}</textarea>
                                </div>
                            </div> 
                            <div class="text-center mt-3">
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
