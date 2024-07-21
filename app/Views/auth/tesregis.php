<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <form action="<?= base_url() ?>regisTes" method="post">
        <?= csrf_field() ?>
        <label for="nama">nama</label>
        <input type="text" name="nama" id="nama">

        <label for="email">Email</label>
        <input type="text" name="email" id="email">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button type="submit">Register</button>
    </form>
</body>

</html>