<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Modul</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Judul Modul</th>
                            <th>Soft File</th>
                            <th>Tahun Rilis</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($BanyakModul as $modul) : ?>
                            <tr>
                                <td><?= esc($modul->judul_modul) ?></td>
                                <td><?= esc($modul->soft_file) ?></td>
                                <td><?= esc($modul->tahun_rilis) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" title="Detail" data-bs-target="#previewModal<?= esc($modul->id_modul) ?>">
                                            <i class="bi bi-eye-fill"></i> Detail
                                        </button>
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" title="Edit" data-bs-target="#editModal<?= esc($modul->id_modul) ?>">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="deleteAction(<?= $modul->id_modul ?>)">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Preview Modal -->
                            <div class="modal fade text-left" id="previewModal<?= esc($modul->id_modul) ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= esc($modul->id_modul) ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel<?= esc($modul->id_modul) ?>">Preview Modul</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="id_modul_<?= esc($modul->id_modul) ?>" class="form-label">Modul ID</label>
                                                    <input type="text" class="form-control" id="id_modul_<?= esc($modul->id_modul) ?>" value="<?= esc($modul->id_modul) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="judul_modul_<?= esc($modul->id_modul) ?>" class="form-label">Judul Modul</label>
                                                    <input type="text" class="form-control" id="judul_modul_<?= esc($modul->id_modul) ?>" value="<?= esc($modul->judul_modul) ?>" readonly>
                                                </div>
                                                <?php if (!empty($modul->soft_file)) : ?>
                                                    <div class="mb-3">
                                                        <label for="soft_file_<?= $modul->id_modul ?>" class="form-label">Soft File</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="soft_file_<?= $modul->id_modul ?>" value="<?= $modul->soft_file ?>" readonly>
                                                            <a href="<?= base_url('uploads/modul/' . $modul->soft_file) ?>" class="btn btn-primary" target="_blank"><i class="bi bi-eye-fill"></i> Lihat PDF</a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="mb-3">
                                                    <label for="tahun_rilis_<?= esc($modul->id_modul) ?>" class="form-label">Tahun Rilis</label>
                                                    <input type="text" class="form-control" id="tahun_rilis_<?= esc($modul->id_modul) ?>" value="<?= esc($modul->tahun_rilis) ?>" readonly>
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

                            <!-- Edit Modal -->
                            <div class="modal fade text-left" id="editModal<?= esc($modul->id_modul) ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= esc($modul->id_modul) ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="editModalLabel<?= esc($modul->id_modul) ?>">Edit Modul</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm<?= esc($modul->id_modul) ?>" action="/dashboard/update-modul/<?= esc($modul->id_modul) ?>" method="post" onsubmit="return submitEditForm(<?= esc($modul->id_modul) ?>)">
                                                <?= csrf_field() ?>
                                                <div class="mb-3">
                                                    <label for="judul_modul_edit_<?= esc($modul->id_modul) ?>" class="form-label">Judul Modul</label>
                                                    <input type="text" class="form-control" name="judul_modul" id="judul_modul_edit_<?= esc($modul->id_modul) ?>" value="<?= esc($modul->judul_modul) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="soft_file_edit_<?= esc($modul->id_modul) ?>" class="form-label">Soft File</label>
                                                    <input type="file" class="form-control" name="soft_file" id="soft_file_edit_<?= esc($modul->id_modul) ?>" value="<?= esc($modul->soft_file) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tahun_rilis_edit_<?= esc($modul->id_modul) ?>" class="form-label">Tahun Rilis</label>
                                                    <input type="number" class="form-control" name="tahun_rilis" id="tahun_rilis_edit_<?= esc($modul->id_modul) ?>" value="<?= esc($modul->tahun_rilis) ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Save changes</span>
                                                    </button>
                                                </div>
                                            </form>
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
    function deleteAction(id_modul) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak bisa mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, hapus itu!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/dashboard/hapus-modul/${id_modul}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json()).then(data => {
                    if (data.status === 'success') {
                        Swal.fire(
                            'Deleted!',
                            data.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            data.message,
                            'error'
                        );
                    }
                }).catch(error => {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan dalam menghapus modul.',
                        'error'
                    );
                });
            }
        });
    }

    function submitEditForm(id_modul) {
        event.preventDefault(); // Prevent default form submission
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan mengupdate data modul ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, edit!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(`editForm${id_modul}`);
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                }).then(response => response.json()).then(data => {
                    if (data.status === 'success') {
                        Swal.fire(
                            'Updated!',
                            data.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            data.message,
                            'error'
                        );
                    }
                }).catch(error => {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan dalam mengupdate modul.',
                        'error'
                    );
                });
            }
        });
        return false;
    }
</script>

<?= $this->endSection() ?>