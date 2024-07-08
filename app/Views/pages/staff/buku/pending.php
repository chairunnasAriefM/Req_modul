<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>
<!-- <h1>Buku Menunggu Persetujuan</h1> -->

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Buku Menunggu Persetujuan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Judul Buku</th>
                            <th>Edisi Tahun</th>
                            <th>Pengarang</th>
                            <th>Tanggal Request</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingBuku as $buku) : ?>
                            <tr>
                                <td><?= esc($buku->judul_buku) ?></td>
                                <td><?= esc($buku->edisi_tahun) ?></td>
                                <td><?= esc($buku->pengarang) ?></td>
                                <td><?= esc($buku->tanggal_request) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#previewModal<?= esc($buku->id_buku) ?>">
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                        <button type="button" class="btn btn-success me-2" onclick="confirmAction('approve', <?= esc($buku->id_buku) ?>)">
                                            <i class="bi bi-clipboard2-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="confirmAction('reject', <?= esc($buku->id_buku) ?>)">
                                            <i class="bi bi-clipboard-x-fill"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade text-left" id="previewModal<?= esc($buku->id_buku) ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= esc($buku->id_buku) ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel<?= esc($buku->id_buku) ?>">Preview Buku</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="id_buku_<?= esc($buku->id_buku) ?>" class="form-label">Buku ID</label>
                                                    <input type="text" class="form-control" id="id_buku_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->id_buku) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_anggota_request_<?= esc($buku->id_buku) ?>" class="form-label">ID Anggota Request</label>
                                                    <input type="text" class="form-control" id="id_anggota_request_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->id_anggota_request) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="judul_buku_<?= esc($buku->id_buku) ?>" class="form-label">Judul Buku</label>
                                                    <input type="text" class="form-control" id="judul_buku_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->judul_buku) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edisi_tahun_<?= esc($buku->id_buku) ?>" class="form-label">Edisi Tahun</label>
                                                    <input type="text" class="form-control" id="edisi_tahun_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->edisi_tahun) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="penerbit_<?= esc($buku->id_buku) ?>" class="form-label">Penerbit</label>
                                                    <input type="text" class="form-control" id="penerbit_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->penerbit) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pengarang_<?= esc($buku->id_buku) ?>" class="form-label">Pengarang</label>
                                                    <input type="text" class="form-control" id="pengarang_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->pengarang) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_buku_<?= esc($buku->id_buku) ?>" class="form-label">Jenis Buku</label>
                                                    <input type="text" class="form-control" id="jenis_buku_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->jenis_buku) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="link_beli_<?= esc($buku->id_buku) ?>" class="form-label">Link Beli</label>
                                                    <input type="text" class="form-control" id="link_beli_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->link_beli) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="perkiraan_harga_<?= esc($buku->id_buku) ?>" class="form-label">Perkiraan Harga</label>
                                                    <input type="text" class="form-control" id="perkiraan_harga_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->perkiraan_harga) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tanggal_request_<?= esc($buku->id_buku) ?>" class="form-label">Tanggal Request</label>
                                                    <input type="text" class="form-control" id="tanggal_request_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->tanggal_request) ?>" readonly>
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
    function confirmAction(action, id_buku) {
        let actionText = action === 'approve' ? 'approve' : 'reject';
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak bisa mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, ${actionText} it!`
        }).then((result) => {
            if (result.isConfirmed) {
                let status = action === 'approve' ? 'diterima' : 'ditolak';
                fetch(`/dashboard/editStatusBuku/${id_buku}/${status}`, {
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