<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style media="screen">
        .page-break {
            page-break-after: always;
        }

        body {
            font-family: 'Nunito', sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }

        th,
        td {
            padding: 6px 0;
        }

        th {
            text-align: left;
            padding-left: 4px;
            background-color: #F1F1F1;
        }

        td {
            padding-left: 4px;
        }

        .table-desc {
            border: 0px !important;
        }

        .table-desc tr td {
            border: none !important;
        }

        .table-desc tr {
            border: none !important;
        }
    </style>
</head>

<body>
    <caption>Kwitansi Pembayaran</caption>
    <table class="table-desc" style="margin-top: 42px">
        <tr>
            <td>Tanggal</td>
            <td style="width: 0px">:</td>
            <td>{{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>Petugas</td>
            <td style="width: 0px">:</td>
            <td>{{ $penyewaan->petugas->nama }}</td>
        </tr>
        <tr>
            <td>Member</td>
            <td style="width: 0px">:</td>
            <td>{{ $penyewaan->member->nama }}</td>
        </tr>
    </table>
    <table style="width: 100%; margin-top: 42px">
        <tr>
            <th>Item / Desc</th>
            <th>Qty.</th>
            <th>@</th>
            <th>Total Harga</th>
        </tr>
        <tr>
            <td>{{ $penyewaan->kendaraan->nama_kendaraan }}</td>
            <td>{{ $penyewaan->lama_sewa }} Hari</td>
            <td>Rp. {{ number_format($penyewaan->kendaraan->harga_sewa) }}</td>
            <td>Rp. {{ number_format($penyewaan->kendaraan->harga_sewa * $penyewaan->lama_sewa) }}</td>
        </tr>
        <tr>
            <th colspan="3">Uang Muka</th>
            <td>Rp. {{ number_format($penyewaan->uang_muka) }}</td>
        </tr>
        <tr>
            <th colspan="3">Sisa</th>
            <td>Rp. {{ number_format(($penyewaan->kendaraan->harga_sewa * $penyewaan->lama_sewa) - $penyewaan->uang_muka) }}</td>
        </tr>
    </table>

</body>

</html>