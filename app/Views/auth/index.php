<?= $this->extend('layouts/auth_layout') ?>

<?= $this->section('content') ?>

<div class="flex-container">
    <div class="flex-item-left">
        <h3>Sign up or Login with</h3>
        <a href="<?= $link; ?>">
            <button class="social-login-button">
                <img src="<?= base_url('assets/images/google.png') ?>" alt="Google Logo">
                Login with Google
            </button>
        </a>
        <div class="or-divider">OR</div>
        <form action="<?= base_url('/login') ?>" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="sign-in-button">Sign in</button>
        </form>
        <div class="signup-link">
            Belum punya akun? <a href="<?= base_url('registrasi') ?>">Daftar</a>
        </div>
    </div>
    <div class="flex-item-right"></div>
</div>


<?= $this->endSection('content') ?>