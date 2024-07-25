<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <form action="/loginTes" method="post">
        <?= csrf_field() ?>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <span><?= session()->getFlashdata('msg') ?></span>

        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <span><?= session()->getFlashdata('msg') ?></span>

        <button type="submit">Login</button>
    </form>
</body>

</html>