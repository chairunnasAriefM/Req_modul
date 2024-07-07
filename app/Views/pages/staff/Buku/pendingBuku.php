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
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#previewModal<?= $buku->buku_id ?>">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-success" onclick="confirmAction('approve', <?= $buku->buku_id ?>)">
                                        <i class="bi bi-clipboard2-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="confirmAction('reject', <?= $buku->buku_id ?>)">
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
    <div class="modal fade text-left" id="previewModal<?= $buku_item->buku_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= $buku_item->buku_id ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel<?= $buku_item->buku_id ?>">Preview Buku</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="buku_id_<?= $buku_item->buku_id ?>" class="form-label">Buku ID</label>
                            <input type="text" class="form-control" id="buku_id_<?= $buku_item->buku_id ?>" value="<?= $buku_item->buku_id ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="id_anggota_request<?= $buku_item->buku_id ?>" class="form-label">ID Anggota Request</label>
                            <input type="text" class="form-control" id="id_anggota_request<?= $buku_item->buku_id ?>" value="<?= $buku_item->id_anggota_request ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="judul_buku<?= $buku_item->buku_id ?>" class="form-label">Judul Buku</label>
                            <input type="text" class="form-control" id="judul_buku<?= $buku_item->buku_id ?>" value="<?= $buku_item->judul_buku ?>" readonly>
                        </div>
                        <?php if (!empty($buku_item->soft_file)) : ?>
                            <div class="mb-3">
                                <label for="soft_file_<?= $buku_item->buku_id ?>" class="form-label">Soft File</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="soft_file_<?= $buku_item->buku_id ?>" value="<?= $buku_item->soft_file ?>" readonly>
                                    <a href="<?= base_url('uploads/' . $buku_item->soft_file) ?>" class="btn btn-primary" target="_blank"><i class="bi bi-eye-fill"></i> Lihat PDF</a>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="jumlah_cetak<?= $buku_item->buku_id ?>" class="form-label">Jumlah Cetak</label>
                            <input type="text" class="form-control" id="jumlah_cetak<?= $buku_item->buku_id ?>" value="<?= $buku_item->jumlah_cetak ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="status<?= $buku_item->buku_id ?>" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status<?= $buku_item->buku_id ?>" value="<?= $buku_item->status ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_request<?= $buku_item->buku_id ?>" class="form-label">Tanggal Request</label>
                            <input type="text" class="form-control" id="tanggal_request<?= $buku_item->buku_id ?>" value="<?= $buku_item->tanggal_request ?>" readonly>
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
            title: 'Apakah anda yakin?',
            text: "Anda tidak bisa mengembalikan nilai",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: `Yes, ${actionText} it!`
        }).then((result) => {
            if (result.isConfirmed) {
                let status = action === 'approve' ? 'diterima' : 'ditolak';
                fetch(`/dashboard/editStatus/${buku_id}/${status}`, {
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