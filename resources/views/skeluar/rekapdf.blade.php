<html>

<head>
    <title>Rekap Surat Keluar / ARSIP SURAT KPU KOTA JAMBI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h4>Daftar Surat Keluar KPU Kota Jambi</h4>
    </center>
    <center>
        <h6>Dari Tanggal <?= Date('d-m-Y', strtotime($awal)) ?> sd Tanggal <?= Date('d-m-Y', strtotime($akhir)) ?></h4>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No Agenda</th>
                <th>No Surat</th>
                <th>Tanggal Surat</th>
                <th>Tanggal Keluar</th>
                <th>Tujuan</th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($keluar as $pdf)
                <tr>
                    <td>{{ $pdf->agenda }}</td>
                    <td>{{ $pdf->no }}</td>
                    <td><?= Date('d-m-Y', strtotime($pdf->tgl_surat ?? '')) ?></td>
                    <td><?= Date('d-m-Y', strtotime($pdf->tgl_keluar ?? '')) ?></td>
                    <td>{{ $pdf->tujuan }}</td>
                    <td>{{ $pdf->hal }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="7" align="center">Belum Ada Laporan Tanggal Yang Dipilih</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
