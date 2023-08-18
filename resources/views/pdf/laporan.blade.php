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

        table {
            font-size: 9pt;
        }
    </style>
</head>

@php
    $namaBulan = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];
@endphp
<body>
    <caption>Laporan {{ $bulan == 'all' ? '' : $namaBulan[$bulan-1] }} {{ $tahun }}</caption>

    <div style="margin-top: 21px">
        Petugas : {{ \Auth::user()->name }} <br>
        Tanggal : {{ \Carbon\Carbon::now()->format('d/m/Y') }}
    </div>
    <table style="width: 100%; margin-top: 21px" id="myTable">

        <thead>
            <tr>
                <th>No</th>
                <th>Member</th>
                <th>Kendaraan</th>
                <th>Lama Sewa</th>
                <th>Tanggal Sewa</th>
                <th>Tanggal Kembali</th>
                <th>Sub Total</th>
                <th>Uang Muka</th>
                <th>Denda</th>
                <th>Sisa</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        @php
        $carbon = new \Carbon\Carbon;
        $total_sisa = 0;
        $total_denda = 0;
        $total_bayar = 0;
        $total_selesai = 0;
        $total_berlangsung = 0;

        @endphp
        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($penyewaans as $penyewaan)

                @php
                    $denda = !$penyewaan->pengembalian->denda || $penyewaan->pengembalian->denda == 0 ? 0 : $penyewaan->pengembalian->denda;
                    $sisa = $penyewaan->status == 2 ? 0 : $penyewaan->pengembalian->sisa_bayar;
                    $total = $penyewaan->status == 2 ? $penyewaan->total_bayar + $penyewaan->pengembalian->denda : $penyewaan->uang_muka;

                    $total_bayar += $total;
                    $total_denda += $denda;
                    $total_sisa += $sisa;

                    if ($penyewaan->status == 2) $total_selesai++;
                    else $total_berlangsung++;
                @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $penyewaan->member->nama }}</td>
                <td>{{ $penyewaan->kendaraan->nama_kendaraan }}</td>
                <td>{{ $penyewaan->lama_sewa }} Hari</td>
                <td>{{ $carbon->parse($penyewaan->tanggal_sewa)->format('d/m/Y') }}</td>
                <td>{{ $penyewaan->pengembalian->tanggal_kembali ? $carbon->parse($penyewaan->pengembalian->tanggal_kembali)->format('d/m/Y') : '-' }}</td>
                <td>Rp. {{ number_format($penyewaan->total_bayar) }}</td>
                <td>Rp. {{ number_format($penyewaan->uang_muka) }}</td>
                <td>Rp. {{ number_format($denda) }}</td>
                <td>Rp. {{ $sisa == 0 ? '-' : number_format($sisa) }}</td>
                <td>Rp. {{ number_format($total) }}</td>
                <td>{{ $penyewaan->status == 1 ? 'Berlangsung' : 'Selesai' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th colspan="7"></th>
                <th >
                    Rp. {{ number_format($total_denda) }}
                </th>
                <th >
                    Rp. {{ number_format($total_sisa) }}
                </th>
                <th >
                    Rp. {{ number_format($total_bayar) }}
                </th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 21px">
        Selesai : {{ $total_selesai }} <br>
        Berlangsung : {{ $total_berlangsung }} <br>
    </div>

</body>

</html>