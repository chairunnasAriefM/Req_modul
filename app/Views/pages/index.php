<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Req Modul</title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/css/index.css') ?>">

    <!-- swiper js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- myjs -->
    <script src="<?= base_url('assets/js/home.js') ?>"></script>

    <!-- Bootsrap icon -->
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
                <li><a href="<?= base_url('') ?>buku_request" class="<?= uri_string() == 'buku_request' ? 'active' : '' ?>">Request Buku</a></li>
                <?php if (session()->get('role') == 'dosen') : ?>
                    <li><a href="<?= base_url('') ?>modul_request" class="<?= uri_string() == 'modul_request' ? 'active' : '' ?>">Request Modul</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <div class="auth-buttons">
            <?php if (!session()->get('logged_in')) : ?>
                <button class="sign-in"><a href="<?= base_url(); ?>registrasi">Sign in</a></button>
            <?php else : ?>
                <button class="sign-in"><a href="<?= base_url(); ?>logout">Logout</a></button>
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
            <?php if (session()->get('role') == 'dosen') : ?>
                <li><a href="<?= base_url('') ?>modul_request" class="<?= uri_string() == 'modul_request' ? 'active' : '' ?>">Request Modul</a></li>
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
                        <button class="request-books"><a href="<?= base_url() ?>/buku_request" style="text-decoration: none; color:white">📚 Request Books</a></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- show new book -->
        <div class="container" id="show-book">
            <button onclick="prevBook()">←</button>
            <div class="cover-container">
                <div class="cover" id="prev-book-cover">
                    <div class="skeleton skeleton-img"></div>
                    <img id="prev-book-img" alt="Previous Book Cover" style="display: none;">
                </div>
                <div class="cover" id="current-book-cover">
                    <div class="skeleton skeleton-img" id="book-cover-skeleton"></div>
                    <img id="book-cover" alt="Book Cover" style="display: none;">
                </div>
                <div class="cover" id="next-book-cover">
                    <div class="skeleton skeleton-img"></div>
                    <img id="next-book-img" alt="Next Book Cover" style="display: none;">
                </div>
            </div>
            <button onclick="nextBook()">→</button>
            <div class="info">
                <div class="book-details">
                    <h1>Buku Baru</h2>
                        <div class="separator">
                            <div class="separator-line"></div>
                        </div>
                        <div class="section-title">Judul</div>
                        <div class="detail" id="book-title"></div>
                        <div class="section-title">Penulis/Pengarang</div>
                        <div class="detail" id="book-authors"></div>
                        <div class="section-title">Penerbit</div>
                        <div class="detail" id="book-publisher"></div>
                        <div class="section-title">Tahun Terbit</div>
                        <div class="detail" id="book-year">2024</div>
                </div>
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
        let currentIndex = 0;
        const books = [
            <?php if (!empty($moduls)) : ?>
                <?php foreach ($moduls as $buku) : ?> {
                        title: "<?php echo $buku->judul_buku; ?>",
                        authors: "<?php echo $buku->pengarang; ?>",
                        publisher: "<?php echo $buku->penerbit; ?>",
                        year: "<?php echo $buku->edisi_tahun; ?>"
                    },
                <?php endforeach; ?>
            <?php endif; ?>
        ];

        function fetchBookCover(title) {
            return fetch(`https://openlibrary.org/search.json?title=${encodeURIComponent(title)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.docs && data.docs.length > 0) {
                        const coverId = data.docs[0].cover_i;
                        if (coverId) {
                            return `https://covers.openlibrary.org/b/id/${coverId}-L.jpg`;
                        } else {
                            return '<?= base_url('assets/images/noCover.png') ?>';
                        }
                    } else {
                        return '<?= base_url('assets/images/noCover.png') ?>';
                    }
                })
                .catch(() => {
                    return '<?= base_url('assets/images/noCover.png') ?>';
                });
        }

        function updateBookDetails() {
            const skeleton = document.getElementById('book-cover-skeleton');
            const img = document.getElementById('book-cover');
            const prevImg = document.getElementById('prev-book-img');
            const nextImg = document.getElementById('next-book-img');

            skeleton.style.display = 'block';
            img.style.display = 'none';
            prevImg.style.display = 'none';
            nextImg.style.display = 'none';

            const currentBook = books[currentIndex];
            const prevBook = books[(currentIndex - 1 + books.length) % books.length];
            const nextBook = books[(currentIndex + 1) % books.length];

            document.getElementById('book-title').textContent = currentBook.title;
            document.getElementById('book-authors').textContent = currentBook.authors;
            document.getElementById('book-publisher').textContent = currentBook.publisher;
            document.getElementById('book-year').textContent = currentBook.year;

            fetchBookCover(currentBook.title).then(coverUrl => {
                img.src = coverUrl;
                skeleton.style.display = 'none';
                img.style.display = 'block';
            });

            fetchBookCover(prevBook.title).then(coverUrl => {
                prevImg.src = coverUrl;
                prevImg.style.display = 'block';
            });

            fetchBookCover(nextBook.title).then(coverUrl => {
                nextImg.src = coverUrl;
                nextImg.style.display = 'block';
            });
        }

        function prevBook() {
            currentIndex = (currentIndex - 1 + books.length) % books.length;
            updateBookDetails();
        }

        function nextBook() {
            currentIndex = (currentIndex + 1) % books.length;
            updateBookDetails();
        }

        // Initial update
        updateBookDetails();
    </script>
</body>

</html>