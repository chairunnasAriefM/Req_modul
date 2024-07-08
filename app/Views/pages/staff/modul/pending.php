<?= $this->extend('layouts/LayoutDashboard.php') ?>

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
                            <th>Tanggal Request</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingModul as $modul) : ?>
                            <tr>
                                <td><?= $modul->judul_modul ?></td>
                                <td><?= $modul->tanggal_request ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#previewModal<?= $modul->modul_id ?>" title="Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-success" onclick="confirmAction('approve', <?= $modul->modul_id ?>)" title="Setuju">
                                        <i class="bi bi-clipboard2-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="confirmAction('reject', <?= $modul->modul_id ?>)" title="Tolak">
                                        <i class="bi bi-clipboard-x-fill"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- include modal -->
                            <?php
                            $modul_data = $modul;
                            echo view('layouts/modal/modalModul', ['modul' => $modul_data]);
                            ?>
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