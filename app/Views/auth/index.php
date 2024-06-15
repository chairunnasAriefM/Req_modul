<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>


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
            <form action="<?= base_url('/login') ?> " method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password">
                </div>

                <button type="submit" class="sign-in-button">Sign in</button>

            </form>


            <div class="signup-link">
                Belum punya akun? <a href="<?= base_url('registrasi') ?>">Daftar</a>
            </div>



        </div>
        <div class="flex-item-right"></div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <?php if (session()->getFlashdata('msg')) : ?>
        <script>
            Swal.fire({
                title: "Login Gagal",
                text: "<?= session()->getFlashdata('msg'); ?>",
                icon: "error"
            });
        </script>
    <?php endif; ?>


</body>

</html>