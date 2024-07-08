<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Data Modul Sedang Dalam Proses Eksekusi</h5>
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
                                <td><?= $modul->judul_modul ?></td>
                                <td><?= $modul->tanggal_request ?></td>
                                <td>

                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" title="Preview" data-bs-target="#previewModal<?= $modul->modul_id ?>" title="Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-success" onclick="confirmAction(<?= $modul->modul_id ?>)">
                                        <i class="bi bi-check-circle-fill"></i> Selesaikan Proses
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
    function confirmAction(modul_id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak bisa mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Selesaikan proses'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/dashboard/editStatus/${modul_id}/sudah dieksekusi`, {
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
                            'Terjadi kesalahan dalam memperbarui status.',
                            'error'
                        );
                    }
                }).catch(error => {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan dalam memperbarui status.',
                        'error'
                    );
                });
            }
        });
    }
</script>

<?= $this->endSection() ?>