<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usaha Baru</title>
</head>
<body>
    <p>Hallo {{ $data['employee1']->name }}, usaha anda {{ $data['business']->name }} telah terdaftar. Silahkan masuk menggunakan akun berikut :</p>
    <ul>
        <li>Username : {{ $data['employee1']->username }}</li>
        <li>Password : 12345678</li>
    </ul>
    @if (isset($data['store']))
        <p>Dikarenakan anda mendaftarkan usaha sebagai AGEN maka berikut adalah akun kasir dan petugas default anda.</p>
        <p>Kasir Toko :</p>
        <ul>
            <li>Username : {{ $data['employee2']->username }}</li>
            <li>Password : 12345678</li>
        </ul>
        <p>Petugas Gudang :</p>
        <ul>
            <li>Username : {{ $data['employee3']->username }}</li>
            <li>Password : 12345678</li>
        </ul>
    @endif
    <p>Pastikan anda segera mengubah password default akun tersebut demi keamanan akun anda.</p>
</body>
</html>