@extends('layouts.backend')

@section('content')
    @if (auth()->user()->role == 'Admin')
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Disposisi Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="{{ url('/surat/masuk') }}">
                            <i class="fa fa-arrow-circle-left"></i> Surat Masuk</a></li>
                    <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Disposisi</a>
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
                            <table class="table table-bordered" id="tbl-disposisi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Detail</th>
                                        <th width="16%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($masuk->disposisi as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <table class="table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Dari</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->dari }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Nomor Surat</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tanggal Surat</b></td>
                                                            <td>:</td>
                                                            <td><?= Date('d-m-Y', strtotime($item->tgl_surat ?? '')) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Perihal Surat</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->hal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tanggal Masuk</b></td>
                                                            <td>:</td>
                                                            <td><?= Date('d-m-Y', strtotime($item->tgl_masuk ?? '')) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>No Agenda</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->agenda }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Diteruskan</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->user->name ?? '- Data Hilang -' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Sifat Surat</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->sifat }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Untuk</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->keperluan->nama ?? '- Data Hilang -' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Catatan</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->catat ?? '-' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>
                                                <a href="/surat/masuk/disposisi/{{ $item->id }}/print"
                                                    class="btn btn-info btn-sm" target="_blank" >
                                                    <i class="fa fa-print"></i> Cetak
                                                </a>
                                                <a href="/surat/masuk/disposisi/{{ $item->id }}/edit"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="/surat/masuk/disposisi/{{ $item->id }}/delete"
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Disposisi Surat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('/surat/masuk/disposadm') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="s_masuk_id" value="{{ $masuk->id }}">
                            <input type="hidden" name="agenda" value="{{ $masuk->agenda }}">
                            <input type="hidden" name="no" value="{{ $masuk->no }}">
                            <input type="hidden" name="hal" value="{{ $masuk->hal }}">
                            <input type="hidden" name="tgl_surat" value="{{ $masuk->tgl_surat }}">
                            <input type="hidden" name="tgl_masuk" value="{{ $masuk->tgl_masuk }}">
                            {{-- <input type="hidden" name="ket_sek"
                                value=" {{ $masuk->user->name ?? 'data hilang/dihapus' }}"> --}}
                            <input type="hidden" name="dari" value="{{ $masuk->dari }}">
                            <input type="hidden" name="file" value="{{ $masuk->file }}">
                            <div class="form-row">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>No Agenda</b></label>
                                    <input type="text" name="agenda" class="form-control" value="{{ $masuk->agenda }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Nomor Surat</b></label>
                                    <input type="text" name="no" class="form-control" value="{{ $masuk->no }}"
                                        disabled>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal Surat</b></label>
                                    <input type="text" name="hal" class="form-control" value="{{ $masuk->hal }}"
                                        disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Diteruskan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
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
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Disposisi Dari</b></label>
                                    <select name="ket_sek" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($pim as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Catatan</b></label>
                                    <textarea name="catat" cols="30" rows="4" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="text-center mt-3">
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
                <h1 class="mt-4">Disposisi Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="{{ url('/surat/masuk') }}">
                            <i class="fa fa-arrow-circle-left"></i> Surat Masuk</a></li>
                    <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Disposisi</a>
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
                            <table class="table table-bordered" id="tbl-disposisi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Detail</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($masuk->disposisi as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <table class="table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Dari</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->dari }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Nomor Surat</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tanggal Surat</b></td>
                                                            <td>:</td>
                                                            <td><?= Date('d-m-Y', strtotime($item->tgl_surat ?? '')) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Perihal Surat</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->hal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tanggal Masuk</b></td>
                                                            <td>:</td>
                                                            <td><?= Date('d-m-Y', strtotime($item->tgl_masuk ?? '')) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>No Agenda</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->agenda }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Diteruskan</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Sifat Surat</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->sifat }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Untuk</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->keperluan->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Catatan</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->catat ?? '-' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td align="center">
                                                <a class="btn btn-success btn-sm"
                                                    href="https://wa.me/{{ $item->user->wa ?? '0' }}?text=Ada+Surat+Masuk+Tanggal:+<?= Date('d-m-Y', strtotime($item->tgl_masuk ?? '')) ?>%2C+
                                                    Dengan+No+Surat:+{{ $item->no }}%2C+Tanggal+Surat:+{{ $item->tgl_surat }}%2C+Asal+Surat+dari:+{{ $item->dari }}%2C+
                                                    Dengan+Tujuan+Surat:+{{ $item->user_id }}+KPU+Kota+Jambi%2C+Perihal:+{{ $item->hal }}."
                                                    target="_blank">Kirim Wa</a>
                                                <a href="/surat/masuk/disposisi/{{ $item->id }}/edit"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="/surat/masuk/disposisi/{{ $item->id }}/delete"
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Disposisi Surat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('/surat/masuk/dispos') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="s_masuk_id" value="{{ $masuk->id }}">
                            <input type="hidden" name="agenda" value="{{ $masuk->agenda }}">
                            <input type="hidden" name="no" value="{{ $masuk->no }}">
                            <input type="hidden" name="hal" value="{{ $masuk->hal }}">
                            <input type="hidden" name="tgl_surat" value="{{ $masuk->tgl_surat }}">
                            <input type="hidden" name="tgl_masuk" value="{{ $masuk->tgl_masuk }}">
                            <input type="hidden" name="ket_sek"
                                value=" {{ $masuk->user->name ?? 'data hilang/dihapus' }}">
                            <input type="hidden" name="dari" value="{{ $masuk->dari }}">
                            <input type="hidden" name="file" value="{{ $masuk->file }}">
                            <div class="form-row">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>No Agenda</b></label>
                                    <input type="text" name="agenda" class="form-control"
                                        value="{{ $masuk->agenda }}" disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Nomor Surat</b></label>
                                    <input type="text" name="no" class="form-control"
                                        value="{{ $masuk->no }}" disabled>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal Surat</b></label>
                                    <input type="text" name="hal" class="form-control"
                                        value="{{ $masuk->hal }}" disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Diteruskan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
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
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Catatan</b></label>
                                    <textarea name="catat" cols="30" rows="4" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="text-center mt-3">
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
                <h1 class="mt-4">Disposisi Surat Masuk</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active"><a href="{{ url('/surat/masuk') }}">
                            <i class="fa fa-arrow-circle-left"></i> Surat Masuk</a></li>
                    <li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Tambah Disposisi</a>
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
                            <table class="table table-bordered" id="tbl-disposisi">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Detail</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($masuk->disposisi as $item)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <table class="table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td><b>Dari</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->dari }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Nomor Surat</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->no }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tanggal Surat</b></td>
                                                            <td>:</td>
                                                            <td><?= Date('d-m-Y', strtotime($item->tgl_surat ?? '')) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Perihal Surat</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->hal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Tanggal Masuk</b></td>
                                                            <td>:</td>
                                                            <td><?= Date('d-m-Y', strtotime($item->tgl_masuk ?? '')) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>No Agenda</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->agenda }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Diteruskan</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Sifat Surat</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->sifat }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Untuk</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->keperluan->nama }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><b>Catatan</b></td>
                                                            <td>:</td>
                                                            <td>{{ $item->catat ?? '-' }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td align="center">
                                                <a class="btn btn-success btn-sm"
                                                    href="https://wa.me/{{ $item->user->wa ?? '0' }}?text=Ada+Surat+Masuk+Tanggal:+<?= Date('d-m-Y', strtotime($item->tgl_masuk ?? '')) ?>%2C+
                                                Dengan+No+Surat:+{{ $item->no }}%2C+Tanggal+Surat:+{{ $item->tgl_surat }}%2C+Asal+Surat+dari:+{{ $item->dari }}%2C+
                                                Dengan+Tujuan+Surat:+{{ $item->user_id }}+KPU+Kota+Jambi%2C+Perihal:+{{ $item->hal }}."
                                                    target="_blank">Kirim Wa</a>
                                                <a href="/surat/masuk/disposisi/{{ $item->id }}/edit"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="/surat/masuk/disposisi/{{ $item->id }}/delete"
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Disposisi Surat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ url('/surat/masuk/dispos') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="s_masuk_id" value="{{ $masuk->id }}">
                            <input type="hidden" name="agenda" value="{{ $masuk->agenda }}">
                            <input type="hidden" name="no" value="{{ $masuk->no }}">
                            <input type="hidden" name="hal" value="{{ $masuk->hal }}">
                            <input type="hidden" name="tgl_surat" value="{{ $masuk->tgl_surat }}">
                            <input type="hidden" name="tgl_masuk" value="{{ $masuk->tgl_masuk }}">
                            <input type="hidden" name="ket_sek"
                                value=" {{ $masuk->user->name ?? 'data hilang/dihapus' }}">
                            <input type="hidden" name="dari" value="{{ $masuk->dari }}">
                            <input type="hidden" name="file" value="{{ $masuk->file }}">
                            <div class="form-row">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>No Agenda</b></label>
                                    <input type="text" name="agenda" class="form-control"
                                        value="{{ $masuk->agenda }}" disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Nomor Surat</b></label>
                                    <input type="text" name="no" class="form-control"
                                        value="{{ $masuk->no }}" disabled>
                                </div>
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Perihal Surat</b></label>
                                    <input type="text" name="hal" class="form-control"
                                        value="{{ $masuk->hal }}" disabled>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-6 col-sm-6">
                                    <label for="inputEmailAddress"><b>Diteruskan</b></label>
                                    <select name="user_id" class="multisteps-form__select form-control">
                                        <option value="">-- PILIH --</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
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
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <div class="col-12 col-sm-12">
                                    <label for="inputEmailAddress"><b>Catatan</b></label>
                                    <textarea name="catat" cols="30" rows="4" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="text-center mt-3">
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
@endsection
