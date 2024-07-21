<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Fetch - Home</title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">

    <!-- swiper js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- remix icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">

    <!-- myjs -->
    <script src="<?= base_url('assets/js/home.js') ?>"></script>

    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="header">
        <div class="logo">
            <img src="<?= base_url('/assets/images/logo_pcr.png') ?>" alt="Logo" class="logo-img">
            <span>Politeknik Caltex Riau</span>
        </div>
        <nav>
            <ul class="navbar-menu" id="nav">
                <li><a href="<?= base_url('') ?>" class="<?= uri_string() == '' ? 'active' : '' ?>">Home</a></li>
                <li><a href="<?= base_url('') ?>buku_request" class="<?= uri_string() == 'buku_request' ? 'active' : '' ?>">Kontak</a></li>
                <li><a href="<?= base_url('') ?>buku_request" class="<?= uri_string() == 'buku_request' ? 'active' : '' ?>">Daftar Buku</a></li>
                <li><a href="<?= base_url('') ?>buku_request" class="<?= uri_string() == 'buku_request' ? 'active' : '' ?>">Request Buku</a></li>
                <?php if (session()->get('is_dosen') == TRUE) : ?>
                    <li> <a href="<?= base_url('') ?>modul_request" class="<?= uri_string() == 'modul_request' ? 'active' : '' ?>">Request Modul</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-buttons">
            <?php if (!session()->get('logged_in')) : ?>
                <button class="sign-in"><a href="<?= base_url(); ?>login">Sign in</a></button>
            <?php else : ?>
                <div class="dropdown">
                    <button class="dropbtn" onclick="myFunction()"><i class="bi bi-person"></i> hi, <?= esc(session('nama')) ?>
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content" id="myDropdown">
                        <a href="<?= base_url() ?>historyBuku" class="history"><i class="bi bi-clock-history"></i> Cek History</a>
                        <a href="<?= base_url('logout') ?>" class="logout" style="color: white;"><i class="bi bi-box-arrow-left"></i> Logout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="navbar-burger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>

    <aside class="sidebar">
        <ul>
            <li><a href="<?= base_url('') ?>" class="<?= uri_string() == '' ? 'active' : '' ?>">Home</a></li>
            <li><a href="<?= base_url('') ?>buku_request" class="<?= uri_string() == 'buku_request' ? 'active' : '' ?>">Request Buku</a></li>
            <?php if (session()->get('is_dosen') == TRUE) : ?>
                <li> <a href="<?= base_url('') ?>modul_request" class="<?= uri_string() == 'modul_request' ? 'active' : '' ?>">Request Modul</a></li>
            <?php endif; ?>
            <?php if (!session()->get('logged_in')) : ?>
                <li><a href="<?= base_url(); ?>registrasi">Sign in</a></li>
            <?php else : ?>
                <li><a href="<?= base_url(); ?>logout">Logout</a></li>
            <?php endif; ?>
        </ul>
    </aside>

    <main>
        <!-- top image -->
        <div class="top-image" id="top-image">
            <div class="overlay">
                <div class="title">
                    <h1 class="animate-text">Perpustakaan PCR</h1>
                    <div class="line-container">
                        <div class="line"></div>
                    </div>
                    <div class="underline animate-underline"></div>
                </div>
                <div class="hero">
                    <div class="hero-text">
                        <h1>Buku Favorit Anda di Perpustakaan</h1>
                        <p>Bantu kami memperluas koleksi dengan merekomendasikan buku favorit Anda.</p>
                        <button class="request-books"><a href="<?= base_url() ?>/buku_request" style="text-decoration: none; color:white">📚 Request Buku</a></button>
                    </div>
                </div>
            </div>
        </div>


        <!-- show new book -->
        <h1>Daftar Buku Terbaru</h1>
        <div class="container">
            <div class="books">
                <?php foreach ($data as $buku) : ?>
                    <div class="banner_wrapper">
                        <div class="banner">
                            <img src="<?= $buku->cover ? base_url('uploads/cover_buku/' . esc($buku->cover)) : base_url('assets/images/noCover.png') ?>" alt="Cover Buku" class="banner__image">
                        </div>
                        <div class="card__wrapper">
                            <div class="card">
                                <div class="card__info">
                                    <div>
                                        <span><?= $buku->judul_buku ?></span>
                                        <p>Pengarang: <?= $buku->pengarang ?></p>
                                    </div>
                                </div>
                                <button onclick="window.location.href='/buku/detail/'">Lihat Detail</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="pagination">
                <button id="prev" onclick="prevPage()">Previous</button>
                <button id="next" onclick="nextPage()">Next</button>
            </div>
        </div>



    </main>

    <!-- footer -->
    <footer class="footer">
        <div id="footer">
            <div class="waktu-layanan">
                <h4>Waktu Layanan Perpustakaan</h4>
                <p><i class="bi bi-clock"></i>Senin - Jum`at (08:00 - 15:30 WIB)</p>
                <p><i class="bi bi-clock"></i>Break (12:00 - 13:00 WIB)</p>
            </div>
            <div class="kontak">
                <h4>Kontak</h4>
                <p><i class="bi bi-geo-alt-fill"></i> Address : <br> Jl. Umban Sari (Patin) No. 1 Rumbai, Pekanbaru-Riau 28265</p>
                <p><i class="bi bi-telephone-fill"></i> Phone Number : <br> (0761) - 53939</p>
                <p><i class="bi bi-telephone-fill"></i> Fax Number : <br> (0761) - 554224</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const books = document.querySelectorAll('.banner_wrapper');
            const booksPerPage = 5;
            let currentPage = 1;

            function showPage(page) {
                let start = (page - 1) * booksPerPage;
                let end = start + booksPerPage;

                books.forEach((book, index) => {
                    if (index >= start && index < end) {
                        book.style.display = 'block';
                    } else {
                        book.style.display = 'none';
                    }
                });

                document.getElementById('prev').style.display = page === 1 ? 'none' : 'inline-block';
                document.getElementById('next').style.display = end >= books.length ? 'none' : 'inline-block';
            }

            window.nextPage = function() {
                if ((currentPage * booksPerPage) < books.length) {
                    currentPage++;
                    showPage(currentPage);
                }
            };

            window.prevPage = function() {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                }
            };

            showPage(currentPage);
        });
    </script>
</body>

</html>