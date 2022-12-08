<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>ARSIP SURAT KPU KOTA JAMBI - SURAT MASUK - {{ $invoice->hal }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            /* border: 2px solid #eee; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }

        #project {
            float: left;
        }

        #company {
            float: right;
        }

    </style>
</head>

<body>

    <div class="invoice-box">

        <table cellpadding="0" cellspacing="0">
            <caption>
                <img src="kpu.png" class="center" style="width: 100%; max-width: 100px">
            </caption>
            <caption>
                <br>
                <h2>KOMISI PEMILIHAN UMUM KOTA JAMBI</h2>
            </caption>
            {{-- @foreach ($invoice->disposisi as $item)
                <tr class="item">
                    <td>Disposisi</td>
                    <td>:</td>
                    <td>{{ $item->user->name ?? '' }}</td>
                </tr>
            @endforeach --}}
            <tr class="item">
                <td>Dari</td>
                <td>:</td>
                <td>{{ $invoice->dari }}</td>
            </tr>
            <tr class="item">
                <td>No. Surat</td>
                <td>:</td>
                <td>{{ $invoice->no }}</td>
            </tr>
            <tr class="item">
                <td>Tanggal Surat</td>
                <td>:</td>
                <td><?= Date('d-m-Y', strtotime($invoice->tgl_surat ?? '')) ?></td>
            </tr>
            <tr class="item">
                <td>Perihal</td>
                <td>:</td>
                <td>{{ $invoice->hal }}</td>
            </tr>
            <tr class="item">
                <td>Tanggal Masuk</td>
                <td>:</td>
                <td><?= Date('d-m-Y', strtotime($invoice->tgl_masuk ?? '')) ?></td>
            </tr> 
            <tr class="item">
                <td>No Agenda</td>
                <td>:</td>
                <td>{{ $invoice->agenda }}</td>
            </tr>
            <tr class="item">
                <td>Sifat</td>
                <td>:</td>
                <td>{{ $invoice->sifat }}</td>
            </tr>
            <tr class="item">
                <td>Mohon Bantuan Saudara Untuk</td>
                <td>:</td>
                <td>{{ $invoice->keperluan->nama }}</td>
            </tr>
            <tr class="item">
                <td>Catatan</td>
                <td>:</td>
                <td>{{ $invoice->catat }}</td>
            </tr>
        </table>
        <br>
        <div id="details" class="clearfix">
            <div id="project"> 
                    <div>
                        <div><b>Diteruskan Kepada</b></div>
                    </div>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    <p><u>{{ $invoice->user->name }}</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
            </div>
            <div id="company">
                <div>
                    <div><b>Jambi, {{ $tgl['now'] }}</b></div>
                </div>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </p>
                    <p><u>{{ $invoice->ket_sek }}</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
            </div>
        </div>
    </div>
</body>

</html>
