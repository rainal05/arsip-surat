@extends('layouts.backend')

@section('content')
    @if (auth()->user()->role == 'Admin')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="#" data-toggle="modal" data-target="#exampleModal">
                            Tambah Surat</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#exampleModal"> <i
                                class="fa fa-plus-circle" aria-hidden="true"></i></a>
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
                                        <th>Nomor, Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th width="10%">Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($masuk as $item)
                                        <tr>
                                            <td>{{ Str::substr($item->agenda, 0, 2) }}</td>
                                            <td>{{ $item->user->name ?? '-data hilang/dihapus-' }}</td>
                                            <td>{{ $item->no }}, <?= Date('d-m-Y', strtotime($item->tgl_surat ?? '')) ?>
                                            </td>
                                            <td><a href="{{ url('/surat_masuk/' . $item->file ?? '-data hilang/dihapus-') }}"
                                                    target="_blank">{{ $item->hal }} <i class="fa fa-download"></i></a>
                                            </td>
                                            <td nowrap>
                                                <div class="dropdown show">
                                                    <a class="btn btn-sm btn-secondary dropdown-toggle" href="#"
                                                        role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        Action
                                                    </a>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item"
                                                            href="https://wa.me/{{ $item->user->wa ?? '0' }}?text=Ada+Surat+Masuk+Tanggal:+<?= Date('d-m-Y', strtotime($item->tgl_masuk ?? '')) ?>%2C+
                                                    Dengan+No+Surat:+{{ $item->no }}%2C+Tanggal+Surat:+{{ $item->tgl_surat }}%2C+Asal+Surat+dari:+{{ $item->dari }}%2C+
                                                    Dengan+Tujuan+Surat:+{{ $item->user_id }}+KPU+Kota+Jambi%2C+Perihal:+{{ $item->hal }}."
                                                            target="_blank">Kirim Wa</a>
                                                        <a class="dropdown-item"
                                                            href="/surat/masuk/disposisi/{{ $item->id }}">Disposisi</a>
                                                        <a class="dropdown-item"
                                                            href="/surat/masuk/detail/{{ $item->id }}">Detail</a>
                                                        <a class="dropdown-item"
                                                            href="/surat/masuk/edit/{{ $item->id }}">Edit</a>
                                                        <a class="dropdown-item"
                                                            href="/surat/masuk/{{ $item->id }}/delete"
                                                            onclick="return confirm('Anda yakin ingin menghapus ?')">Hapus</a>
                                                    </div>
                                                </div>
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Surat Masuk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('/surat/masuk/store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>No Agenda </b></label>
                                    <input type="text" name="agenda" class="form-control" placeholder="No. Agenda">
                                </div>
                            </div>
                            {{-- <input type="hidden" name="agenda" value="{{ $tgl['now'] }}"> --}}
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Dari</b></label>
                                    <input type="text" name="dari" class="form-control" placeholder="Surat Dari">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tujuan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat</b></label>
                                    <input type="date" name="tgl_surat" class="form-control">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat Masuk</b></label>
                                    <input type="date" name="tgl_masuk" class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control"
                                        placeholder="No Surat Masuk">
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
                <h1 class="mt-4">Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Surat Masuk
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
                                        <th>Dari</th>
                                        <th>Nomor, Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th width="10%">Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ketsek as $item)
                                        <tr>
                                            <td>{{ $item->agenda }}</td>
                                            <td>{{ $item->dari }}</td>
                                            <td>{{ $item->no }},
                                                <?= Date('d-m-Y', strtotime($item->tgl_masuk ?? '')) ?></td>
                                            <td><a href="{{ url('/surat_masuk/' . $item->file ?? 'ss') }}"
                                                    target="_blank">{{ $item->hal }} <i
                                                        class="fa fa-download"></i></a>
                                            </td>
                                            <td nowrap>
                                                <a href="/surat/masuk/disposisi/{{ $item->id }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-info-circle"></i> Disposisi
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Surat Masuk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('/surat/masuk/store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Dari</b></label>
                                    <input type="text" name="dari" class="form-control" placeholder="Surat Dari">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat</b></label>
                                    <input type="date" name="tgl_surat" class="form-control">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat Masuk</b></label>
                                    <input type="date" name="tgl_masuk" class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control"
                                        placeholder="No Surat Masuk">
                                </div>
                            </div>
                            <div class="form-row mt-3">
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
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tujuan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                <h1 class="mt-4">Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Surat Masuk
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
                                        <th>Dari</th>
                                        <th>Nomor, Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th width="10%">Pilihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ketsek as $item)
                                        <tr>
                                            <td>{{ $item->agenda }}</td>
                                            <td>{{ $item->dari }}</td>
                                            <td>{{ $item->no }},
                                                <?= Date('d-m-Y', strtotime($item->tgl_masuk ?? '')) ?></td>
                                            <td><a href="{{ url('/surat_masuk/' . $item->file ?? 'ss') }}"
                                                    target="_blank">{{ $item->hal }} <i
                                                        class="fa fa-download"></i></a>
                                            </td>
                                            <td nowrap>
                                                <a href="/surat/masuk/disposisi/{{ $item->id }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-info-circle"></i> Disposisi
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Surat Masuk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('/surat/masuk/store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Dari</b></label>
                                    <input type="text" name="dari" class="form-control" placeholder="Surat Dari">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat</b></label>
                                    <input type="date" name="tgl_surat" class="form-control">
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tanggal Surat Masuk</b></label>
                                    <input type="date" name="tgl_masuk" class="form-control">
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>No Surat</b></label>
                                    <input type="text" name="no" class="form-control"
                                        placeholder="No Surat Masuk">
                                </div>
                            </div>
                            <div class="form-row mt-3">
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
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Tujuan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                <h1 class="mt-4">Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Bidang</li>
                    <li class="breadcrumb-item ">Surat Masuk</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No Agenda</th>
                                        <th>Dari</th>
                                        <th>Nomor, Tanggal Surat</th>
                                        <th>Perihal</th>
                                        <th width="5%">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($masuk as $item)
                                        <tr>
                                            <td>{{ $item->agenda }}</td>
                                            <td>{{ $item->dari }}</td>
                                            <td>{{ $item->no }},
                                                <?= Date('d-m-Y', strtotime($item->tgl_surat ?? '')) ?></td>
                                            <td><a href="{{ url('/surat_masuk/' . $item->file ?? 'ss') }}"
                                                    target="_blank">{{ $item->hal }} <i
                                                        class="fa fa-download"></i></a>
                                            </td>
                                            <td nowrap>
                                                <a href="/bidang/surat/masuk/detail/{{ $item->id }}"
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
