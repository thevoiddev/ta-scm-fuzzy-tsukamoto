<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usaha Baru</title>
</head>

<body>
    <p>Hallo {{ $data['employee']->name }}, anda telah didaftarkan sebagai pegawai pada usaha
        {{ $data['business']->name }} dengan jabatan {{ $data['role']->name }}. Berikut akun anda :</p>
    <ul>
        <li>Username : {{ $data['employee']->username }}</li>
        <li>Password : 12345678</li>
    </ul>
    <p>Pastikan anda segera mengubah password default akun tersebut demi keamanan akun anda.</p>
</body>

</html>
