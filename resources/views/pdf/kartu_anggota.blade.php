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
    <caption>Kartu Member</caption>
    <table style="width: 100%; margin-top: 42px">
        <tr>
            <th style="width: 40% !important;">Nama</th>
            <td>{{ $member->nama }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $member->no_telp }}</td>
        </tr>
        <tr>
            <th>Tanggal Bergabung</th>
            <td>{{ \Carbon\Carbon::parse($member->create_at)->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Berlaku Sampai</th>
            <td>{{ \Carbon\Carbon::parse($member->create_at)->addYear(3)->format('d/m/Y') }}</td>
        </tr>
    </table>

</body>

</html>