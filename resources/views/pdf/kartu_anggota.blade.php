<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style media="screen">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            padding: 20px;
            text-align: center;
            border: 1.5px solid rgba(0, 0, 0, 0.1);
        }

        .card h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .card p {
            margin: 10px 0;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-content">
            <div>
                <h1>{{ $member->nama }}</h1>
                <p>berlaku s/d : {{ \Carbon\Carbon::parse($member->create_at)->format('d/m/Y') }}</p>
                <p>{{ $member->alamat }}</p>
                <p>{{ $member->no_telp }}</p>
            </div>

        </div>
    </div>

</body>

</html>