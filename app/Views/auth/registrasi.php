<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

<div class="flex-container">
    <div class="flex-item-left">
        <h3>Registrasi Akun</h3>

        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger">
                <?= $validation->listErrors() ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/registrasi') ?>" method="post">
        <?= csrf_field() ?>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" value="<?= old('email') ?>" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" placeholder="Nama" value="<?= old('nama') ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="sign-in-button">Sign up</button>
        </form>

        <div class="signup-link">
            Sudah punya akun? <a href="<?= base_url('/login') ?>">Login</a>
        </div>
    </div>
    <div class="flex-item-right"></div>
</div>

<?= $this->endSection('content') ?>