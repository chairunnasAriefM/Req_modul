<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->Section('content') ?>

<h2>Halaman Pending Buku</h2>
<table class="table">
    <thead>
        <tr>
            <th>Judul Buku</th>
            <th>Tanggal Request</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pendingBuku as $Buku) : ?>
            <tr>
                <td><?= $Buku->judul_buku ?></td>
                <td><?= $Buku->tanggal_request ?></td>
                <td>
                    <!-- Tombol untuk preview modul dengan logo Bootstrap -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#previewModal<?= $Buku->buku_id ?>">
                        <span class="glyphicon glyphicon-eye-open"></span> Preview
                    </button>

                    <!-- Form untuk edit status -->
                    <form action="<?= base_url('dashboard/editStatus/' . $Buku->buku_id) ?>" method="post" style="display: inline-block;">
                        <select name="new_status" class="form-control">
                            <option value="ditolak">Ditolak</option>
                            <option value="diterima">Diterima</option>
                        </select>
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil"></span> Ubah Status
                        </button>
                    </form>
                </td>
            </tr>

            <!-- Modal untuk preview modul -->
            <div class="modal fade" id="previewModal<?= $Buku->buku_id ?>" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel<?= $Buku->buku_id ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="previewModalLabel<?= $Buku->buku_id ?>">Preview Modul: <?= $Buku->judul_buku ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Tempatkan konten preview modul di sini -->
                            <p>Judul Buku: <?= $Buku->judul_buku ?></p>
                            <p>Tanggal Request: <?= $Buku->tanggal_requestBuku ?></p>
                            <!-- Tambahkan informasi lain yang ingin ditampilkan -->
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </tbody>
</table>