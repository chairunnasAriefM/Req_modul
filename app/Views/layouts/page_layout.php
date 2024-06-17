<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Req Modul</title>


    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/css/form.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
</head>

<body>

    <header>
        <div class="logo">logo pcr</div>
        <nav>
            <ul>
                <li> <a href="<?= base_url('') ?>" class="<?= uri_string() == '' ? 'active' : '' ?>">Home</a></li>
                <li> <a href="<?= base_url('') ?>buku_request" class="<?= uri_string() == 'buku_request' ? 'active' : '' ?>">Request Buku</a></li>
                <?php if (session()->get('role') == 'dosen') : ?>
                    <li> <a href="<?= base_url('') ?>modul_request" class="<?= uri_string() == 'modul_request' ? 'active' : '' ?>">Request Buku</a></li>
                <?php endif; ?>
                <li><a href="#">About Us</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <?php if (!session()->get('logged_in') == TRUE) : ?>
                <button class="sign-in"><a href="<?= base_url(); ?>login">Sign in</a></button>
                <button class="get-started"><a href="<?= base_url(); ?>registrasi">Registrasi</a></button>
            <?php else : ?>
                <button class="get-started"><a href="<?= base_url(); ?>logout">Logout</a></button>
            <?php endif; ?>

        </div>
    </header>
    <main>
        <?= $this->renderSection('content') ?>
    </main>



    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navbarBurger = document.querySelector('.navbar-burger');
            const navbarMenu = document.querySelector('.navbar-menu');

            navbarBurger.addEventListener('click', () => {
                navbarBurger.classList.toggle('is-active');
                navbarMenu.classList.toggle('is-active');
            });
        });
    </script>

    <!-- Jquery dan Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        <?php if (session()->getFlashdata('error')) : ?>
            Swal.fire({
                title: "Error",
                text: "<?= session()->getFlashdata('error'); ?>",
                icon: "error"
            });
        <?php endif; ?>
    </script>

    <?php if (session()->has('validation')) : ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Errors',
                    html: '<ul>' +
                        <?php $validation = session()->get('validation'); ?>
                    <?php foreach ($validation->getErrors() as $error) : ?> '<?= '<li>' . esc($error) . '</li>' ?>' +
                    <?php endforeach; ?> '</ul>',
                });
            });
        </script>
    <?php endif; ?>


</body>

</html>