<?= $this->extend('layouts/historyLayout.php') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Modul Menunggu Persetujuan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Judul Modul</th>
                            <th>Status</th>
                            <th>Tanggal Request</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($modul_history as $modul) : ?>
                            <tr>
                                <td><?= $modul->judul_modul ?></td>
                                <td><?= $modul->status ?></td>
                                <td><?= $modul->tanggal_request ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#previewModal<?= $modul->id_request_modul ?>" title="Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- include modal -->
                            <!-- Display the modals -->
                            <?php foreach ($modul_history as $modul) : ?>
                                <div class="modal fade text-left" id="previewModal<?= $modul->id_request_modul ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= $modul->id_request_modul ?>" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel<?= $modul->id_request_modul ?>">Preview Modul</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form>
                                                    <div class="mb-3">
                                                        <label for="judul_modul_<?= $modul->id_request_modul ?>" class="form-label">Judul Modul</label>
                                                        <input type="text" class="form-control" id="judul_modul_<?= $modul->id_request_modul ?>" value="<?= $modul->judul_modul ?>" readonly>
                                                    </div>
                                                    <?php if (!empty($modul->soft_file)) : ?>
                                                        <div class="mb-3">
                                                            <label for="soft_file_<?= $modul->id_request_modul ?>" class="form-label">Soft File</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" id="soft_file_<?= $modul->id_request_modul ?>" value="<?= $modul->soft_file ?>" readonly>
                                                                <a href="<?= base_url('uploads/' . $modul->soft_file) ?>" class="btn btn-primary" target="_blank"><i class="bi bi-eye-fill"></i> Lihat PDF</a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="mb-3">
                                                        <label for="jumlah_cetak_<?= $modul->id_request_modul ?>" class="form-label">Jumlah Cetak</label>
                                                        <input type="text" class="form-control" id="jumlah_cetak_<?= $modul->id_request_modul ?>" value="<?= $modul->jumlah_cetak ?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="status_<?= $modul->id_request_modul ?>" class="form-label">Status</label>
                                                        <input type="text" class="form-control" id="status_<?= $modul->id_request_modul ?>" value="<?= $modul->status ?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="tanggal_request_<?= $modul->id_request_modul ?>" class="form-label">Tanggal Request</label>
                                                        <input type="text" class="form-control" id="tanggal_request_<?= $modul->id_request_modul ?>" value="<?= $modul->tanggal_request ?>" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nama_pemohon_<?= $modul->id_request_modul ?>" class="form-label">Nama Pemohon</label>
                                                        <input type="text" class="form-control" id="nama_pemohon_<?= $modul->id_request_modul ?>" value="<?= $modul->nama_pemohon ?>" readonly>
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


                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmAction(action, id_request_modul) {
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
                fetch(`/dashboard/editStatus/${id_request_modul}/${status}`, {
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