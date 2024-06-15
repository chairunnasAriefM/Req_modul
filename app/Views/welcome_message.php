<?= $this->extend('layouts/page_layout') ?>

<?= $this->section('content') ?>

<?php if (!$isLoggedIn) : ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: 'Apakah Anda ingin login?',
                showDenyButton: true,
                confirmButtonText: 'Login',
                denyButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url() ?>/login';
                }
            });
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>