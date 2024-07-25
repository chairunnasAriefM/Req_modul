<?= $this->extend('/layouts/page_layout') ?>

<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<style>
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .btn-detail {
        background-color: #f0ad4e;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .table-dark th {
        color: white;
        background-color: #343a40;
    }

    .table-responsive {
        width: 100%;
        overflow-x: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .card-body {
        width: 80vw;
    }
</style>

<section class="section mt-5">
    <div class="card mt-5">
        <div class="card-header">
            <h5 class="card-title">Data Buku</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="table1">
                    <thead class="table-dark">
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
                                    <button type="button" class="btn btn-detail" data-bs-toggle="modal" title="Detail" data-bs-target="#previewModal<?= esc($buku->id_buku) ?>">
                                        Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Preview Modal -->
                            <div class="modal fade text-left" id="previewModal<?= esc($buku->id_buku) ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= esc($buku->id_buku) ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel<?= esc($buku->id_buku) ?>">Preview Buku</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                            <img src="<?= base_url('uploads/cover_buku/' . esc($buku->cover)) ?>" class="img-thumbnail" style="max-height: 200px;">
                                                        <?php else : ?>
                                                            <p>No cover available</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                Close
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

<!-- jQuery and DataTables scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table1').DataTable({
            "pagingType": "simple_numbers",
            "language": {
                "paginate": {
                    "previous": "Previous",
                    "next": "Next"
                }
            }
        });
    });
</script>

<?= $this->endSection(); ?>