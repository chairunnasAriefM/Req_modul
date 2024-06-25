<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h1>Preview PDF: <?= esc($modul_id) ?></h1>
<iframe src="https://zuramai.github.io/mazer/demo/" style="width: 100%; height: 600px;"></iframe>

<?= $this->endSection() ?>
