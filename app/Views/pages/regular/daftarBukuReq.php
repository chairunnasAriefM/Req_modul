<?= $this->extend('/layouts/page_layout') ?>

<?= $this->section('content') ?>

<style>
    .container {
        display: flex;
        justify-content: space-between;
        background-color: #f0f4f8;
        padding: 20px;
    }

    .carousel {
        flex: 1;
        display: flex;
        align-items: center;
    }

    .carousel img {
        max-width: 100%;
        height: auto;
    }

    .carousel-nav {
        display: flex;
        justify-content: center;
        margin-top: 10px;
    }

    .carousel-nav button {
        margin: 0 5px;
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    .book-details {
        flex: 1;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .book-details h2 {
        margin-top: 0;
    }

    .book-details p {
        margin: 5px 0;
    }
</style>

<div class="container">
    <div class="carousel">
        <button onclick="prevBook()">←</button>
        <img id="book-cover" src="/mnt/data/image.png" alt="Book Cover">
        <button onclick="nextBook()">→</button>
    </div>
    <div class="book-details">
        <h2 id="book-title"></h2>
        <p id="book-authors"></p>
        <p id="book-publisher"></p>
        <p id="book-year"></p>
    </div>
</div>

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

    function updateBookDetails() {
        document.getElementById('book-title').innerText = books[currentIndex].title;
        document.getElementById('book-authors').innerText = `Authors: ${books[currentIndex].authors}`;
        document.getElementById('book-publisher').innerText = `Publisher: ${books[currentIndex].publisher}`;
        document.getElementById('book-year').innerText = `Year: ${books[currentIndex].year}`;
    }

    function prevBook() {
        currentIndex = (currentIndex - 1 + books.length) % books.length;
        updateBookDetails();
    }

    function nextBook() {
        currentIndex = (currentIndex + 1) % books.length;
        updateBookDetails();
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (books.length > 0) {
            updateBookDetails();
        }
    });
</script>

<?= $this->endSection() ?>