<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 8px; font-size: 12px; }
        th { background: #eee; }
        .kop-surat {
            width: 100%;
            text-align: center;
            margin-bottom: 24px;
        }
        .kop-surat .info {
            display: inline-block;
            text-align: center;
            margin: 0 auto;
        }
        .kop-surat hr {
            border: 1px solid #333;
            margin-top: 8px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="kop-surat">
        <div class="info">
            <h2 style="margin:0; font-size:22px;">Alief Smart Wifi</h2>
            <p style="margin:0; font-size:13px;">
                Jl. Nangka No.1, Dusun Jurang Jero, Kalirejo, Kec. Kabat, Kabupaten Banyuwangi, Jawa Timur 68461<br>
                Telp: 085730902001 | Email: Faturalief15@gmail.com
            </p>
        </div>
        <hr>
    </div>

    <h2 style="text-align:center; margin-bottom:16px;">Customer List</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $i => $user)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address ?? '-' }}</td>
                <td>{{ $user->phone ?? '-' }}</td>
                <td>{{ $user->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>