<?= $this->extend('/layouts/page_layout') ?>

<?= $this->section('title') ?>
Request Modul
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Form Container -->
<div class="form-container" style="margin-top: 100px;">
    <div class="form-group">
        <h2>Pengajuan Modul</h2>
        <label for="jenis_modul">Jenis Modul</label>
        <select class="form-control" name="jenis_modul" id="jenis_modul">
            <option value="modul_baru">Modul Terbaru</option>
            <option value="modul_lama">Modul Lama</option>
        </select>
    </div>

    <form id="modern-form" method="post" action="<?= base_url() ?>/request_modul" enctype="multipart/form-data">
        <?= csrf_field() ?> <!-- CSRF protection -->

        <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <select class="form-control select2" id="jurusan" name="jurusan" style="width: 100%;">
                <option value="" disabled selected>Pilih Jurusan</option>
                <?php foreach ($jurusans as $jurusan => $prodis) : ?>
                    <option value="<?= $jurusan ?>"><?= $jurusan ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="prodi">Prodi</label>
            <select class="form-control" id="prodi" name="prodi" disabled>
                <option value="" disabled selected>Pilih Prodi</option>
            </select>
        </div>

        <div class="form-group">
            <label for="judul_modul">Judul Modul</label>
            <select class="form-control" id="judul_modul" name="id_modul" disabled>
                <option value="" disabled selected>Pilih Judul Modul</option>
            </select>
        </div>

        <div class="form-group">
            <label for="jumlah_cetak">Jumlah Cetak</label>
            <input type="number" id="jumlah_cetak" name="jumlah_cetak" value="<?= old('jumlah_cetak') ?>">
        </div>

        <div class="form-group" id="soft-file-group">
            <label for="soft_file">Upload Soft File (PDF)</label>
            <input type="file" id="soft_file" name="soft_file" class="form-control" accept=".pdf">
        </div>

        <div class="form-group">
            <button type="submit">Tambah</button>
        </div>
    </form>
</div>

<!-- Include jQuery and Select2 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            title: "Good job!",
            text: "<?= session()->getFlashdata('success') ?>",
            icon: "success"
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function() {
        console.log("Document ready");

        $('#jurusan').on('change', function() {
            console.log("Jurusan changed");
            var jurusan = $(this).val();
            var prodis = <?= json_encode($jurusans) ?>;

            if (prodis[jurusan]) {
                $('#prodi').empty().prop('disabled', false);
                $('#prodi').append('<option value="" disabled selected>Pilih Prodi</option>');
                $.each(prodis[jurusan], function(index, value) {
                    $('#prodi').append('<option value="' + value + '">' + value + '</option>');
                });
            } else {
                $('#prodi').empty().prop('disabled', true);
            }
        });

        $('#prodi').on('change', function() {
            console.log("Prodi changed");
            var jurusan = $('#jurusan').val();
            var prodi = $(this).val();
            if (jurusan && prodi) {
                $.ajax({
                    url: '<?= base_url() ?>/modul-request/judul-modul',
                    type: 'POST',
                    data: {
                        jurusan: jurusan,
                        prodi: prodi
                    },
                    success: function(data) {
                        console.log("AJAX success", data);
                        $('#judul_modul').empty().prop('disabled', false);
                        $('#judul_modul').append('<option value="" disabled selected>Pilih Judul Modul</option>');
                        $.each(data, function(index, modul) {
                            $('#judul_modul').append('<option value="' + modul.id_modul + '">' + modul.judul_modul + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error", status, error);
                    }
                });
            }
        });

        $('#jenis_modul').on('change', function() {
            console.log("Jenis Modul changed");
            var jenis_modul = $(this).val();
            if (jenis_modul === 'modul_baru') {
                $('#soft-file-group').show();
            } else {
                $('#soft-file-group').hide();
            }
        });

        // Trigger initial state
        $('#jenis_modul').trigger('change');
    });
</script>

<?= $this->endSection() ?>