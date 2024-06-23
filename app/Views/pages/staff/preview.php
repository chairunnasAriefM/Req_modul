<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preview Modul</title>
    <link rel="stylesheet" href="<?= base_url('assets2/compiled/css/app.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets2/compiled/css/app-dark.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets2/compiled/css/iconly.css'); ?>">
</head>

<body>
    <div id="app">
        <div id="main">
            <div class="page-heading">
                <h3>Detail Modul</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>ID Anggota Request</th>
                                            <td><?= $modul['id_anggota_request']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Judul Modul</th>
                                            <td><?= $modul['judul_modul']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah Cetak</th>
                                            <td><?= $modul['jumlah_cetak']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><?= $modul['status']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Request</th>
                                            <td><?= $modul['tanggal_request']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Staff ID Verifikasi</th>
                                            <td><?= $modul['staff_id_verifikasi']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Verifikasi</th>
                                            <td><?= $modul['tanggal_verifikasi']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <a href="<?= base_url('uploads/'.$modul['soft_file']); ?>" class="btn btn-primary" target="_blank">Lihat PDF</a>
                                </div>
                            </div>
                        </div>
                        <a href="<?= base_url('dashboard'); ?>" class="btn btn-secondary">Kembali</a>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="<?= base_url('assets2/static/js/initTheme.js'); ?>"></script>
</body>

</html>
