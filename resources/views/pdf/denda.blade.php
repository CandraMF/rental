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
    <table class="table-desc" style=" margin-top: 42px">
        <tr>
            <td>Tanggal Pengembalian</td>
            <td style="width: 0px">:</td>
            <td>{{ \Carbon\Carbon::parse($penyewaan->pengembalian->tanggal_kembali)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td>Petugas</td>
            <td style="width: 0px">:</td>
            <td>{{ $penyewaan->pengembalian->petugas->nama }}</td>
        </tr>
        <tr>
            <td>Member</td>
            <td style="width: 0px">:</td>
            <td>{{ $penyewaan->member->nama }}</td>
        </tr>
        <tr>
            <td>Item</td>
            <td>:</td>
            <td>{{ $penyewaan->kendaraan->nama_kendaraan }} ({{ $penyewaan->lama_sewa }} Hari)</td>
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
            <td>{{ __('Sisa') }}</td>
            <td></td>
            <td></td>
            <td>Rp. {{ number_format($penyewaan->pengembalian->sisa_bayar) }}</td>
        </tr>
        <tr>
            <td>{{ __('Denda') }}</td>
            <td></td>
            <td></td>
            <td>Rp. {{ number_format($penyewaan->pengembalian->denda) }}</td>
        </tr>
        <tr>
            <th colspan="3">Subtotal</th>
            <td>Rp. {{ number_format($penyewaan->pengembalian->denda + $penyewaan->pengembalian->sisa_bayar) }}</td>
        </tr>
        <tr>
            <th colspan="3">Bayar</th>
            <td>Rp. {{ number_format($penyewaan->pengembalian->denda + $penyewaan->pengembalian->sisa_bayar) }}</td>
        </tr>
        <tr style="border-top: 3px solid black !important;">
            <th colspan="4" style="text-align:center">Lunas</th>
        </tr>
    </table>

</body>

</html>