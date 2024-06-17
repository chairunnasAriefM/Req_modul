<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookFetch</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
</head>

<body>
    <header>
        <div class="logo">logo pcr</div>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Request Buku</a></li>
                <!-- <li><a href="#">Community</a></li> -->
                <li><a href="#">About Us</a></li>
            </ul>
        </nav>
        <div class="auth-buttons">
            <button class="sign-in">Sign in</button>
            <button class="get-started">Get Started</button>
        </div>
    </header>
    <main>
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
    </main>
</body>

</html>