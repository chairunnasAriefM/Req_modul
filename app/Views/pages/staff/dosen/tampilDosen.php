<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Dosen</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dosens as $dosen) : ?>
                            <tr>
                                <td><?= esc($dosen->id_anggota) ?></td>
                                <td><?= esc($dosen->nama) ?></td>
                                <td><?= esc($dosen->email) ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" title="Detail" data-bs-target="#previewModal<?= esc($dosen->id_anggota) ?>">
                                            <i class="bi bi-eye-fill"></i> Detail
                                        </button>
                                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" title="Edit" data-bs-target="#editModal<?= esc($dosen->id_anggota) ?>">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('<?= esc($dosen->id_anggota) ?>')">
                                            <i class="bi bi-trash-fill"></i> Delete
                                        </button>

                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade text-left" id="previewModal<?= esc($dosen->id_anggota) ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= esc($dosen->id_anggota) ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel<?= esc($dosen->id_anggota) ?>">Preview Dosen</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label for="id_anggota_<?= esc($dosen->id_anggota) ?>" class="form-label">Dosen ID</label>
                                                    <input type="text" class="form-control" id="id_anggota_<?= esc($dosen->id_anggota) ?>" value="<?= esc($dosen->id_anggota) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nama_dosen_<?= esc($dosen->id_anggota) ?>" class="form-label">Nama Dosen</label>
                                                    <input type="text" class="form-control" id="nama_dosen_<?= esc($dosen->id_anggota) ?>" value="<?= esc($dosen->nama) ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email_dosen_<?= esc($dosen->id_anggota) ?>" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="email_dosen_<?= esc($dosen->id_anggota) ?>" value="<?= esc($dosen->email) ?>" readonly>
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

<!-- Edit Modal -->
<div class="modal fade text-left" id="editModal<?= esc($dosen->id_anggota) ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= esc($dosen->id_anggota) ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editModalLabel<?= esc($dosen->id_anggota) ?>">Edit Dosen</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('/dashboard/dosen/update') ?>" method="post">
                    <input type="hidden" name="id_anggota" value="<?= esc($dosen->id_anggota) ?>">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= esc($dosen->nama) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= esc($dosen->email) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="password">New Password (optional)</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password if changing">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/dashboard/dosen/delete/${id}`;
            }
        });
    }
</script>

<?= $this->endSection() ?>