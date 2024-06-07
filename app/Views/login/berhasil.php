<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Berhasil Login</h1>
    <p>Nama Lengkap : <?= session()->get('nama_user') ?></p>
    <p>Email : <?= session()->get('email') ?></p>
    <a href="<?= base_url('login/keluar'); ?>" class="btn btn-danger">logout</a>
</body>

</html>