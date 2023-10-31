<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Under Maintenance | {{ env('APP_NAME') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
<style>
    *{
        font-family: 'Open Sans', sans-serif;
        margin: 0;
        padding: 0;
    }

    .um-container{
        display: table-cell;
        text-align: center;
        vertical-align: middle;
        width: 100vw;
        height: 100vh;
    }

    .um-content{
        text-align: center;
        padding: 1rem;
    }

    .um-content img{
        width: 400px;
        max-width: 90%;
    }

    h1{
        font-weight: 800;
        color: #415b91;
    }

    p{
        width: 400px;
        max-width: 90%;
        margin: auto;
        color: #617aad;
    }
</style>
</head>
<body>
    <div class="um-container">
        <div class="um-content">
            <img src="{{ asset('images/503.svg') }}" alt="Under Maintenance">
            <h1>Under Maintenance</h1>
            <p>Saat ini website tidak bisa diakses karena sedang dalam pemeliharaan. Silahkan datang dilain waktu.</p>
        </div>
    </div>
</body>
</html>