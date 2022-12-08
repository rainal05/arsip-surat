@extends('layouts.backend')

@section('content')
    @if (auth()->user()->role == 'Admin')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Surat Keluar</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="#" data-toggle="modal" data-target="#exampleModal">
                            Tambah Surat</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#exampleModal"> <i
                                class="fa fa-plus-circle" aria-hidden="true"></i></a></li>
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No Agenda</th>
                                        <th>Tujuan</th>
                                        <th>Kode Surat</th>
                                        <th>Nomor, Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th width="10%">Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keluar as $item)
                                        <tr>
                                            <td>{{ $item->agenda }}</td>
                                            <td>{{ $item->tujuan }}</td>
                                            <td>{{ $item->kode->kode ?? '- Data Hilang -' }}</td>
                                            <td>{{ $item->no }},
                                                <?= Date('d-m-Y', strtotime($item->tgl_surat ?? '')) ?></td>
                                            <td><a href="{{ url('/surat_keluar/' . $item->file ?? 'ss') }}"
                                                    target="_blank">{{ $item->hal }} <i class="fa fa-download"></i></a>
                                            </td>
                                            <td nowrap>
                                                <a href="/surat/keluar/detail/{{ $item->id }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-info-circle"></i> Detail
                                                </a>
                                                <a href="/surat/keluar/edit/{{ $item->id }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="/surat/keluar/{{ $item->id }}/delete"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Anda yakin ingin menghapus ?')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Modal tambah -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Surat Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('/surat/keluar/store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>No Agenda</b></label>
                                    <input type="text" name="agenda" class="form-control" placeholder="No. Agenda">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Pengirim</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tujuan Surat</b></label>
                                    <input type="text" name="tujuan" class="form-control" placeholder="Tujuan Surat">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat</b></label>
                                    <input type="date" name="tgl_surat" class="form-control">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat Keluar</b></label>
                                    <input type="date" name="tgl_keluar" class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control" placeholder="No Surat Masuk">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Kode Surat</b></label>
                                    <select name="kode_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($kode as $item)
                                            <option value="{{ $item->id }}">{{ $item->kode }} |
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal</b></label>
                                    <input type="text" name="hal" class="form-control"
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
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{-- stop modal --}}
    @endif

    @if (auth()->user()->role == 'Ketua')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Surat Keluar</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Surat Keluar
                        </a>
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No Agenda</th>
                                        <th>Tujuan</th>
                                        <th>Kode Surat</th>
                                        <th>Nomor, Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th width="10%">Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ketsek as $item)
                                        <tr>
                                            <td>{{ $item->agenda }}</td>
                                            <td>{{ $item->tujuan }}</td>
                                            <td>{{ $item->kode->kode }}</td>
                                            <td>{{ $item->no }},
                                                <?= Date('d-m-Y', strtotime($item->tgl_surat ?? '')) ?></td>
                                            <td><a href="{{ url('/surat_keluar/' . $item->file ?? 'ss') }}"
                                                    target="_blank">{{ $item->hal }} <i
                                                        class="fa fa-download"></i></a>
                                            </td>
                                            <td nowrap>
                                                <a href="/surat/keluar/detail/{{ $item->id }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-info-circle"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Modal tambah -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Surat Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('/surat/keluar/store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Dari Sub Bagian</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tujuan Surat</b></label>
                                    <input type="text" name="tujuan" class="form-control"
                                        placeholder="Tujuan Surat">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat</b></label>
                                    <input type="date" name="tgl_surat" class="form-control">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat Keluar</b></label>
                                    <input type="date" name="tgl_keluar" class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control"
                                        placeholder="No Surat Masuk">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Kode Surat</b></label>
                                    <select name="kode_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($kode as $item)
                                            <option value="{{ $item->id }}">{{ $item->kode }} |
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal</b></label>
                                    <input type="text" name="hal" class="form-control"
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
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{-- stop modal --}}
    @endif

    @if (auth()->user()->role == 'Sekretaris')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Surat Keluar</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">
                        Surat Keluar
                        </a>
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No Agenda</th>
                                        <th>Tujuan</th>
                                        <th>Kode Surat</th>
                                        <th>Nomor, Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th width="10%">Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ketsek as $item)
                                        <tr>
                                            <td>{{ $item->agenda }}</td>
                                            <td>{{ $item->tujuan }}</td>
                                            <td>{{ $item->kode->kode }}</td>
                                            <td>{{ $item->no }},
                                                <?= Date('d-m-Y', strtotime($item->tgl_surat ?? '')) ?></td>
                                            <td><a href="{{ url('/surat_keluar/' . $item->file ?? 'ss') }}"
                                                    target="_blank">{{ $item->hal }} <i
                                                        class="fa fa-download"></i></a>
                                            </td>
                                            <td nowrap>
                                                <a href="/surat/keluar/detail/{{ $item->id }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-info-circle"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Modal tambah -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Surat Keluar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('/surat/keluar/store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Dari Sub Bagian</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tujuan Surat</b></label>
                                    <input type="text" name="tujuan" class="form-control"
                                        placeholder="Tujuan Surat">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat</b></label>
                                    <input type="date" name="tgl_surat" class="form-control">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat Keluar</b></label>
                                    <input type="date" name="tgl_keluar" class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control"
                                        placeholder="No Surat Masuk">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Kode Surat</b></label>
                                    <select name="kode_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($kode as $item)
                                            <option value="{{ $item->id }}">{{ $item->kode }} |
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal</b></label>
                                    <input type="text" name="hal" class="form-control"
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
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        {{-- stop modal --}}
    @endif

    @if (auth()->user()->role == 'Bidang')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Surat Keluar</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Bidang</li>
                    <li class="breadcrumb-item ">Surat Keluar</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No Agenda</th>
                                        <th>Tujuan</th>
                                        <th>Kode Surat</th>
                                        <th>Nomor, Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th width="10%">Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keluar as $item)
                                        <tr>
                                            <td>{{ $item->agenda }}</td>
                                            <td>{{ $item->tujuan }}</td>
                                            <td>{{ $item->kode->kode ?? '- Data Hilang -' }}</td>
                                            <td>{{ $item->no }},
                                                <?= Date('d-m-Y', strtotime($item->tgl_surat ?? '')) ?></td>
                                            <td><a href="{{ url('/surat_keluar/' . $item->file ?? 'ss') }}"
                                                    target="_blank">{{ $item->hal }} <i
                                                        class="fa fa-download"></i></a></td>
                                            <td nowrap>
                                                <a href="/bidang/surat/keluar/detail/{{ $item->id }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-info-circle"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection
