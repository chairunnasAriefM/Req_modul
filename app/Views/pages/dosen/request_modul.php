<?= $this->extend('/layouts/page_layout') ?>

<?= $this->section('content') ?>

<div class="form-container" style="margin-top: 100px;">

    <div class="form-group">

        <h2>Pengajuan Modul</h2>

        <label for="jenis_modul">Jenis Modul</label>
        <select name="jenis_modul" id="jenis_modul">
            <option value="modul_baru">Modul Baru</option>
            <option value="modul_lama">Modul Lama</option>
        </select>
    </div>

    <form id="modern-form" method="post" action="<?= base_url() ?>/request_modul" enctype="multipart/form-data">
        <?= csrf_field() ?> <!-- CSRF protection -->

        <div class="form-group">
            <label for="asal_prodi">Prodi</label>
            <input type="text" id="asal_prodi" name="asal_prodi" value="<?= old('asal_prodi') ?>">
        </div>

        <div class="form-group">
            <label for="judul_modul">Judul Modul</label>
            <input type="text" id="judul_modul" name="judul_modul" value="<?= old('judul_modul') ?>">
        </div>

        <div class="form-group" id="soft_file_group">
            <label for="soft_file">Soft File</label>
            <input type="file" id="soft_file" name="soft_file">
        </div>

        <div class="form-group">
            <label for="jumlah_cetak">Jumlah Cetak</label>
            <input type="number" id="jumlah_cetak" name="jumlah_cetak" value="<?= old('jumlah_cetak') ?>">
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

<!-- JavaScript to Show/Hide Soft File Input -->
<script>
    document.getElementById('jenis_modul').addEventListener('change', function() {
        var softFileGroup = document.getElementById('soft_file_group');
        if (this.value === 'modul_baru') {
            softFileGroup.style.display = 'block';
        } else {
            softFileGroup.style.display = 'none';
        }
    });

    // Trigger the change event on page load to set the correct initial state
    document.getElementById('jenis_modul').dispatchEvent(new Event('change'));
</script>

<?= $this->endSection() ?>