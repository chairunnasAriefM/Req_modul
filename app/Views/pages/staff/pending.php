<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->Section('content') ?>
<h1>Modul Menunggu Persetujuan</h1>

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
                                    <!-- Tombol untuk preview modul dengan logo Bootstrap -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#previewModal<?= $modul->modul_id ?>">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#previewModal<?= $modul->modul_id ?>">
                                        <i class="bi bi-clipboard2-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#previewModal<?= $modul->modul_id ?>">
                                        <i class="bi bi-clipboard-x-fill"></i>
                                    </button>

                                    <!-- Form untuk edit status -->
                                    <!-- <form action="<?= base_url('dashboard/editStatus/' . $modul->modul_id) ?>" method="post" style="display: inline-block;">
                        <select name="new_status" class="form-control">
                            <option value="ditolak">Ditolak</option>
                            <option value="diterima">Diterima</option>
                        </select>
                        <button type="submit" class="btn btn-warning">
                            <span class="glyphicon glyphicon-pencil"></span> Ubah Status
                        </button>
                    </form> -->
                                </td>
                            </tr>

                            <!-- Modal untuk preview modul -->
                                <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel33" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">Data </h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="#">
                                                <div class="modal-body">
                                                    <label for="email">Email: </label>
                                                    <div class="form-group">
                                                        <input id="email" type="text" placeholder="Email Address"
                                                            class="form-control">
                                                    </div>
                                                    <label for="password">Password: </label>
                                                    <div class="form-group">
                                                        <input id="password" type="password" placeholder="Password"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>
                                                    <button type="button" class="btn btn-primary ms-1"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">login</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

<?= $this->endSection() ?>