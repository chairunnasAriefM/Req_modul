<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Buku</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>Judul Buku</th>
                            <th>Edisi Tahun</th>
                            <th>Penerbit</th>
                            <th>Pengarang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($BanyakBuku as $buku) : ?>
                            <tr>
                                <td><?= esc($buku->judul_buku) ?></td>
                                <td><?= esc($buku->edisi_tahun) ?></td>
                                <td><?= esc($buku->penerbit) ?></td>
                                <td><?= esc($buku->pengarang) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" title="Detail" data-bs-target="#previewModal<?= esc($buku->id_buku) ?>">
                                            <i class="bi bi-eye-fill"></i> Detail
                                        </button>
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" title="Edit" data-bs-target="#editModal<?= esc($buku->id_buku) ?>">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="deleteAction(<?= $buku->id_buku ?>)">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Preview Modal -->
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
                                                    <label for="jenis_<?= esc($buku->id_buku) ?>" class="form-label">Jenis Buku</label>
                                                    <input type="text" class="form-control" id="jenis_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->jenis_buku) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Cover</label>
                                                    <div id="coverPreviewContainer_<?= esc($buku->id_buku) ?>">
                                                        <?php if (!empty($buku->cover)) : ?>
                                                            <img src="<?= base_url('uploads/cover_buku/' . esc($buku->cover)) ?>" class="img-thumbnail" style="max-height :200px;">
                                                        <?php else : ?>
                                                            <p>No cover available</p>
                                                        <?php endif; ?>
                                                    </div>
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
                            <div class="modal fade text-left" id="editModal<?= esc($buku->id_buku) ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= esc($buku->id_buku) ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="editModalLabel<?= esc($buku->id_buku) ?>">Edit Buku</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editForm<?= esc($buku->id_buku) ?>" action="/dashboard/update-buku/<?= esc($buku->id_buku) ?>" method="post" enctype="multipart/form-data" onsubmit="return submitEditForm(<?= esc($buku->id_buku) ?>)">
                                                <?= csrf_field() ?>
                                                <div class="mb-3">
                                                    <label for="judul_buku_edit_<?= esc($buku->id_buku) ?>" class="form-label">Judul Buku</label>
                                                    <input type="text" class="form-control" name="judul_buku" id="judul_buku_edit_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->judul_buku) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edisi_tahun_edit_<?= esc($buku->id_buku) ?>" class="form-label">Edisi Tahun</label>
                                                    <input type="number" class="form-control" name="edisi_tahun" id="edisi_tahun_edit_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->edisi_tahun) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="penerbit_edit_<?= esc($buku->id_buku) ?>" class="form-label">Penerbit</label>
                                                    <input type="text" class="form-control" name="penerbit" id="penerbit_edit_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->penerbit) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pengarang_edit_<?= esc($buku->id_buku) ?>" class="form-label">Pengarang</label>
                                                    <input type="text" class="form-control" name="pengarang" id="pengarang_edit_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->pengarang) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="jenis_edit_<?= esc($buku->id_buku) ?>" class="form-label">Jenis Buku</label>
                                                    <input type="text" class="form-control" name="jenis_buku" id="jenis_edit_<?= esc($buku->id_buku) ?>" value="<?= esc($buku->jenis_buku) ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="cover_edit_<?= esc($buku->id_buku) ?>" class="form-label">Cover Buku</label>
                                                    <input type="file" class="form-control" name="cover" id="cover_edit_<?= esc($buku->id_buku) ?>" onchange="previewCover(event, <?= esc($buku->id_buku) ?>)">
                                                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah cover.</small>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Preview Cover</label>
                                                    <div id="coverPreviewContainer_<?= esc($buku->id_buku) ?>">
                                                        <?php if (!empty($buku->cover)) : ?>
                                                            <img src="<?= base_url('uploads/cover_buku/' . esc($buku->cover)) ?>" class="img-thumbnail" style="max-height :200px;">
                                                        <?php else : ?>
                                                            <p>No cover available</p>
                                                        <?php endif; ?>
                                                    </div>
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

                            <script>
                                function previewCover(event, id) {
                                    var input = event.target;
                                    var previewContainer = document.getElementById('coverPreviewContainer_' + id);

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                                        reader.onload = function(e) {
                                            previewContainer.innerHTML = '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px;">';
                                        };
                                        reader.readAsDataURL(input.files[0]);
                                    } else {
                                        previewContainer.innerHTML = 'No cover available';
                                    }
                                }
                            </script>


                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function deleteAction(id_buku) {
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
                fetch(`/dashboard/hapus-buku/${id_buku}`, {
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
                        'Terjadi kesalahan dalam menghapus buku.',
                        'error'
                    );
                });
            }
        });
    }

    function submitEditForm(id_buku) {
        event.preventDefault(); // Prevent default form submission
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan mengupdate data buku ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, edit!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(`editForm${id_buku}`);
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
                        'Terjadi kesalahan dalam mengupdate buku.',
                        'error'
                    );
                });
            }
        });
        return false;
    }
</script>

<?= $this->endSection() ?>