<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Fetch - <?= $this->renderSection('title') ?></title>


    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/css/form.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/nav.css') ?>">

    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</head>

<body>

    <header>
        <div class="logo">
            <img src="<?= base_url('/assets/images/logo_pcr_biasa.png') ?>" alt="Logo" class="logo-img">
        </div>
        <nav>
            <ul class="navbar-menu" id="nav">
                <li><a href="<?= base_url('') ?>" class="<?= uri_string() == '' ? 'active' : '' ?>">Home</a></li>
                <li><a href="<?= base_url('') ?>#kontak" class="">Kontak</a></li>
                <li><a href="<?= base_url('') ?>daftar-buku" class="<?= uri_string() == 'daftar-buku' ? 'active' : '' ?>">Daftar Buku</a></li>
                <li><a href="<?= base_url('') ?>buku_request" class="<?= uri_string() == 'buku_request' ? 'active' : '' ?>">Pengajuan Buku</a></li>
                <?php if (session()->get('is_dosen') == TRUE) : ?>
                    <li> <a href="<?= base_url('') ?>modul_request" class="<?= uri_string() == 'modul_request' ? 'active' : '' ?>">Cetak Modul</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-buttons">
            <?php if (!session()->get('logged_in') == TRUE) : ?>
                <button class="sign-in"><a href="<?= base_url(); ?>login">Sign in</a></button>
                <button class="get-started"><a href="<?= base_url(); ?>registrasi">Registrasi</a></button>
            <?php else : ?>
                <button class="get-started"><a href="<?= base_url(); ?>logout" onclick="confirmLogout(event)">Logout</a></button>
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

    <!-- Jquery dan swal -->
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

    <script>
        function confirmLogout(event) {
            event.preventDefault(); // Mencegah link default action

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url('logout') ?>'; // Redirect ke URL logout
                }
            });
        }
    </script>


</body>

</html>