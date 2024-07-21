<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Buku Disetujui</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Jenis Buku</th>
                            <th>Judul Buku</th>
                            <th>Penerbit</th>
                            <th>Pengarang</th>
                            <th>Perkiraan Harga</th>
                            <th>Total Request</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($disetujuiBuku as $buku) : ?>
                            <?php $encodedJudulBuku = md5($buku->judul_buku); ?>
                            <tr>
                                <td><?= esc($buku->jenis_buku) ?></td>
                                <td><?= esc($buku->judul_buku) ?></td>
                                <td><?= esc($buku->penerbit) ?></td>
                                <td><?= esc($buku->pengarang) ?></td>
                                <td><?= esc($buku->perkiraan_harga) ?></td>
                                <td><?= esc($buku->total_requests) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#previewModal<?= $encodedJudulBuku ?>" title="Detail">
                                            <i class="bi bi-eye-fill"></i> Detail
                                        </button>
                                        <button type="button" class="btn btn-success" onclick="confirmAction('<?= esc($buku->judul_buku) ?>')">
                                            <i class="bi bi-gear-fill"></i> Jalankan Proses Eksekusi
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade text-left" id="previewModal<?= $encodedJudulBuku ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= $encodedJudulBuku ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel<?= $encodedJudulBuku ?>">Preview Buku</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="jenis_buku_<?= $encodedJudulBuku ?>" class="form-label">Jenis Buku</label>
                                                    <input type="text" class="form-control" id="jenis_buku_<?= $encodedJudulBuku ?>" value="<?= esc($buku->jenis_buku) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="judul_buku_<?= $encodedJudulBuku ?>" class="form-label">Judul Buku</label>
                                                    <input type="text" class="form-control" id="judul_buku_<?= $encodedJudulBuku ?>" value="<?= esc($buku->judul_buku) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edisi_tahun_<?= $encodedJudulBuku ?>" class="form-label">Edisi Tahun</label>
                                                    <input type="text" class="form-control" id="edisi_tahun_<?= $encodedJudulBuku ?>" value="<?= esc($buku->edisi_tahun) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="penerbit_<?= $encodedJudulBuku ?>" class="form-label">Penerbit</label>
                                                    <input type="text" class="form-control" id="penerbit_<?= $encodedJudulBuku ?>" value="<?= esc($buku->penerbit) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pengarang_<?= $encodedJudulBuku ?>" class="form-label">Pengarang</label>
                                                    <input type="text" class="form-control" id="pengarang_<?= $encodedJudulBuku ?>" value="<?= esc($buku->pengarang) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="link_beli_<?= $encodedJudulBuku ?>" class="form-label">Link Beli</label>
                                                    <input type="text" class="form-control" id="link_beli_<?= $encodedJudulBuku ?>" value="<?= esc($buku->link_beli) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="perkiraan_harga_<?= $encodedJudulBuku ?>" class="form-label">Perkiraan Harga</label>
                                                    <input type="text" class="form-control" id="perkiraan_harga_<?= $encodedJudulBuku ?>" value="<?= esc($buku->perkiraan_harga) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="total_requests_<?= $encodedJudulBuku ?>" class="form-label">Total Request</label>
                                                    <input type="text" class="form-control" id="total_requests_<?= $encodedJudulBuku ?>" value="<?= esc($buku->total_requests) ?>" readonly>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmAction(judul_buku) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak bisa mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, proses eksekusi ini!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/dashboard/editStatusBuku/${encodeURIComponent(judul_buku)}/proses eksekusi`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json()).then(data => {
                    if (data.status === 'success') {
                        Swal.fire(
                            'Updated!',
                            'Status telah diperbarui.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan: ' + data.message,
                            'error'
                        );
                    }
                }).catch(error => {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan: ' + error.message,
                        'error'
                    );
                });
            }
        });
    }
</script>

<?= $this->endSection() ?>