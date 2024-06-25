<?= $this->extend('/layouts/page_layout') ?>

<?= $this->section('content') ?>

<style>
    .card {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 16px;
        margin: 16px;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.5em;
        margin-bottom: 8px;
    }

    .card-content {
        font-size: 1em;
        margin-bottom: 8px;
    }

    .card-footer {
        font-size: 0.9em;
        color: #555;
    }
</style>

<div class="cards">
    <?php if (!empty($moduls)) : ?>
        <?php foreach ($moduls as $buku) : ?>
            <div class="card">
                <div class="card-title"><?php echo $buku->judul_buku; ?></div>
                <div class="card-content"></div>
                <div class="card-footer">Author:</div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No books found.</p>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>