<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="card-title mb-0">Input Data Buku</h4>
            </div>
            <div class="card-body p-4">
                <form action="<?= base_url('/dashboard/tambah-buku') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="judul_buku" class="form-label">Judul Buku</label>
                        <input type="text" id="judul_buku" class="form-control" name="judul_buku" placeholder="Judul Buku" required>
                    </div>
                    <div class="mb-3">
                        <label for="edisi_tahun" class="form-label">Edisi Tahun</label>
                        <input type="number" id="edisi_tahun" class="form-control" name="edisi_tahun" placeholder="Edisi Tahun" required>
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="text" id="penerbit" class="form-control" name="penerbit" placeholder="Penerbit" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_buku" class="form-label">Jenis Buku</label>
                        <input type="text" id="jenis_buku" class="form-control" name="jenis_buku" placeholder="Jenis Buku" required>
                    </div>
                    <div class="mb-3">
                        <label for="pengarang" class="form-label">Pengarang</label>
                        <input type="text" id="pengarang" class="form-control" name="pengarang" placeholder="Pengarang" required>
                    </div>
                    <div class="mb-3">
                        <label for="cover" class="form-label">Cover</label>
                        <input type="file" id="cover" class="form-control" name="cover" accept="image/*" onchange="loadFile(event)">
                        <img id="preview" src="#" alt="Preview Cover" style="display:none; margin-top:10px; max-width:200px; height:auto;">
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary" onclick="resetPreview()">Reset</button>
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

<script>
    function loadFile(event) {
        var preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.onload = function() {
            URL.revokeObjectURL(preview.src)
        }
        preview.style.display = 'block';
    }

    function resetPreview() {
        var preview = document.getElementById('preview');
        preview.src = '#';
        preview.style.display = 'none';
    }
</script>

<?= $this->endSection() ?>