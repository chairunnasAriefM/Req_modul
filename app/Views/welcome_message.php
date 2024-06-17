<?= $this->extend('layouts/page_layout') ?>

<?= $this->section('content') ?>

<section class="hero">
    <div class="hero-text">
        <p>⭐ Start requesting your favorite books today</p>
        <h1>Buku kesayanganmu di Perpustakaan</h1>
        <p>Our library is dedicated to meeting the needs of our readers. Request your favorite books and help us expand our collection to better serve you and our community. Start requesting now and enjoy a personalized reading experience.</p>
        <button class="request-books">📚 Request Books</button>
    </div>
    <div class="hero-image">
        <img src="<?= base_url('assets/images/book.jpg') ?>" alt="Stack of books">
    </div>
</section>



<?php
//  if (!$isLoggedIn) : 
?>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    </script> -->
<?php
//  endif; 
?>

<?= $this->endSection() ?>