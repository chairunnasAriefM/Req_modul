<?= $this->extend('/layouts/page_layout') ?>

<?= $this->section('content') ?>

<div class="form-container" >
    <form id="modern-form" method="post" action="<?= base_url() ?>/request_modul" enctype="multipart/form-data">
        <h2>Pengajuan Modul</h2>

        <div class="form-group">
            <label for="judul_modul">Judul Modul</label>
            <input type="text" id="judul_modul" name="judul_modul">
        </div>

        <div class="form-group">
            <label for="soft_file">Soft File</label>
            <input type="file" id="soft_file" name="soft_file">
        </div>

        <div class="form-group">
            <label for="jumlah_cetak">Jumlah Cetak</label>
            <input type="number" id="jumlah_cetak" name="jumlah_cetak">
        </div>

        <div class="form-group">
            <button type="submit">Tambah</button>
        </div>
    </form>
</div>



<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            title: "Good job!",
            text: "<?= session()->getFlashdata('success') ?>",
            icon: "success"
        });
    </script>
<?php endif; ?>


<?= $this->endSection() ?>