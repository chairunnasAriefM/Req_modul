<?= $this->extend('layouts/layoutDashboard') ?>

<?= $this->section('content') ?>

<h1>Preview PDF: <?= esc($buku_id) ?></h1>
<iframe src="https://zuramai.github.io/mazer/demo/" style="width: 100%; height: 600px;"></iframe>

<?= $this->endSection() ?>
