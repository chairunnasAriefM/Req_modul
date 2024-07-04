<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->Section('content') ?>

<h1>Modul dalam Proses Eksekusi</h1>


<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                Data Pending
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Judul Modul</th>
                            <th>Tanggal Request</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($prosesModul as $modul) : ?>
                            <tr>
                                <td><?= $modul->judul_modul ?></td>
                                <td><?= $modul->tanggal_request ?></td>
                                <td>
                                    <!-- Tombol untuk preview modul dengan logo Bootstrap -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#previewModal<?= $modul->modul_id ?>">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>

                                    <!-- Form untuk edit status -->
                                    <form action="<?= base_url('dashboard/editStatus/' . $modul->modul_id) ?>" method="post" style="display: inline-block;">
                                        <select name="new_status" class="form-control">
                                            <option value="ditolak">Ditolak</option>
                                            <option value="proses eksekusi">Proses Eksekusi</option>
                                            <option value="selesai">Eksekusi Selesai</option> <!-- Opsi baru untuk status selesai -->
                                        </select>
                                        <button type="submit" class="btn btn-warning">
                                            <span class="glyphicon glyphicon-pencil"></span> Ubah Status
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal untuk preview modul -->
                            <div class="modal fade" id="previewModal<?= $modul->modul_id ?>" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel<?= $modul->modul_id ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="previewModalLabel<?= $modul->modul_id ?>">Preview Modul: <?= $modul->judul_modul ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Tempatkan konten preview modul di sini -->
                                            <p>Judul Modul: <?= $modul->judul_modul ?></p>
                                            <p>Tanggal Request: <?= $modul->tanggal_request ?></p>
                                            <!-- Tambahkan informasi lain yang ingin ditampilkan -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
<?= $this->endSection() ?>