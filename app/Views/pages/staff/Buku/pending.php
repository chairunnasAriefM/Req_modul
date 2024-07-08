<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>
<h1>Buku Menunggu Persetujuan</h1>

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
                            <th>Judul Buku</th>
                            <th>Tanggal Request</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingBuku as $buku) : ?>
                            <tr>
                                <td><?= $buku->judul_buku ?></td>
                                <td><?= $buku->tanggal_request ?></td>
                                <td>
                                    <!-- Tombol untuk preview buku dengan logo Bootstrap -->
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#previewModal<?= $buku->id_buku ?>">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-success" onclick="confirmAction('approve', <?= $buku->id_buku ?>)">
                                        <i class="bi bi-clipboard2-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="confirmAction('reject', <?= $buku->id_buku ?>)">
                                        <i class="bi bi-clipboard-x-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal untuk preview buku -->
<?php foreach ($pendingBuku as $buku_item) : ?>
    <div class="modal fade text-left" id="previewModal<?= $buku_item->id_buku ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= $buku_item->id_buku ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel<?= $buku_item->id_buku ?>">Preview Buku</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="id_buku_<?= $buku_item->id_buku ?>" class="form-label">Buku ID</label>
                            <input type="text" class="form-control" id="id_buku_<?= $buku_item->id_buku ?>" value="<?= $buku_item->id_buku ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="judul_buku_<?= $buku_item->id_buku ?>" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judul_buku_<?= $buku_item->id_buku ?>" value="<?= $buku_item->judul_buku ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="edisi_tahun_<?= $buku_item->id_buku ?>" class="form-label">Edisi Tahun</label>
                            <input type="text" class="form-control" id="edisi_tahun_<?= $buku_item->id_buku ?>" value="<?= $buku_item->edisi_tahun ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="pengarang_<?= $buku_item->id_buku ?>" class="form-label">Pengarang</label>
                            <input type="text" class="form-control" id="pengarang_<?= $buku_item->id_buku ?>" value="<?= $buku_item->pengarang ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_request_<?= $buku_item->id_buku ?>" class="form-label">Tanggal Request</label>
                            <input type="text" class="form-control" id="tanggal_request_<?= $buku_item->id_buku ?>" value="<?= $buku_item->tanggal_request ?>" readonly>
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

<!-- Script SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmAction(action, buku_id) {
        let actionText = action === 'approve' ? 'approve' : 'reject';
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak bisa mengembalikan nilai",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, ${actionText} it!`
        }).then((result) => {
            if (result.isConfirmed) {
                let status = action === 'approve' ? 'diterima' : 'ditolak';
                fetch(`/dashboard/editStatusBuku/${buku_id}/${status}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json()).then(data => {
                    if (data.status === 'success') {
                        Swal.fire(
                            'Updated!',
                            'Status telah diperbarui',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    }
                });
            }
        });
    }
</script>

<?= $this->endSection() ?>