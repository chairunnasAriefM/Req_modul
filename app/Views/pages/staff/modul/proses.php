<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>

<h1>Modul dalam Proses Eksekusi</h1>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Modul dalam Proses Eksekusi</h5>
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
                                <td><?= esc($modul->judul_modul) ?></td>
                                <td><?= esc($modul->tanggal_request) ?></td>
                                <td>
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#previewModal<?= $modul->modul_id ?>">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <form action="<?= base_url('dashboard/editStatus/' . $modul->modul_id) ?>" method="post" style="display: inline-block;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="new_status" value="selesai">
                                        <button type="submit" class="btn btn-success">
                                            <i class="bi bi-clipboard2-check"></i> Selesaikan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade text-left" id="previewModal<?= $modul->modul_id ?>" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel<?= $modul->modul_id ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="previewModalLabel<?= $modul->modul_id ?>">Preview Modul</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="modul_id_<?= $modul->modul_id ?>" class="form-label">Modul ID</label>
                                                    <input type="text" class="form-control" id="modul_id_<?= $modul->modul_id ?>" value="<?= esc($modul->modul_id) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_anggota_request_<?= $modul->modul_id ?>" class="form-label">ID Anggota Request</label>
                                                    <input type="text" class="form-control" id="id_anggota_request_<?= $modul->modul_id ?>" value="<?= esc($modul->id_anggota_request) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="judul_modul_<?= $modul->modul_id ?>" class="form-label">Judul Modul</label>
                                                    <input type="text" class="form-control" id="judul_modul_<?= $modul->modul_id ?>" value="<?= esc($modul->judul_modul) ?>" readonly>
                                                </div>
                                                <?php if (!empty($modul->soft_file)) : ?>
                                                    <div class="mb-3">
                                                        <label for="soft_file_<?= $modul->modul_id ?>" class="form-label">Soft File</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="soft_file_<?= $modul->modul_id ?>" value="<?= esc($modul->soft_file) ?>" readonly>
                                                            <a href="<?= base_url('uploads/' . $modul->soft_file) ?>" class="btn btn-primary" target="_blank"><i class="bi bi-eye-fill"></i> Lihat PDF</a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="mb-3">
                                                    <label for="jumlah_cetak_<?= $modul->modul_id ?>" class="form-label">Jumlah Cetak</label>
                                                    <input type="text" class="form-control" id="jumlah_cetak_<?= $modul->modul_id ?>" value="<?= esc($modul->jumlah_cetak) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status_<?= $modul->modul_id ?>" class="form-label">Status</label>
                                                    <input type="text" class="form-control" id="status_<?= $modul->modul_id ?>" value="<?= esc($modul->status) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tanggal_request_<?= $modul->modul_id ?>" class="form-label">Tanggal Request</label>
                                                    <input type="text" class="form-control" id="tanggal_request_<?= $modul->modul_id ?>" value="<?= esc($modul->tanggal_request) ?>" readonly>
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
    function confirmAction(action, modul_id) {
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
                fetch(`/dashboard/editStatus/${modul_id}/${status}`, {
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
                    }
                });
            }
        });
    }
</script>

<?= $this->endSection() ?>