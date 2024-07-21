<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-center align-items-center ">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="card-title mb-0">Input Data Modul</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('/dashboard/tambah-modul') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="judul-modul-horizontal" class="form-label">Judul Modul</label>
                        <input type="text" id="judul-modul-horizontal" class="form-control" name="judul_modul" placeholder="Judul Modul" required>
                    </div>
                    <div class="mb-3">
                        <label for="soft-file-horizontal" class="form-label">Soft File</label>
                        <input type="file" id="soft-file-horizontal" class="form-control" name="soft_file" placeholder="Soft File" required>
                        <small>Type file : pdf,word</small>
                    </div>
                    <div class="mb-3">
                        <label for="tahun-rilis-horizontal" class="form-label">Tahun Rilis</label>
                        <input type="number" id="tahun-rilis-horizontal" class="form-control" name="tahun_rilis" placeholder="Tahun Rilis" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if (session()->has('errors')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: '<?= implode("<br>", session('errors')) ?>',
        });
    </script>
<?php elseif (session()->has('success')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session('success') ?>',
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>