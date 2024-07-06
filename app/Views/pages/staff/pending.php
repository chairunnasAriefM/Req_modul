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
                                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#inlineForm">
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
                            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Data </h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <form action="#">
                                            <div class="modal-body">
                                                <label for="email">Email: </label>
                                                <div class="form-group">
                                                    <input id="email" type="text" placeholder="Email Address" class="form-control">
                                                </div>
                                                <label for="password">Password: </label>
                                                <div class="form-group">
                                                    <input id="password" type="password" placeholder="Password" class="form-control">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Close</span>
                                                </button>
                                                <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
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
<!-- Form and scrolling Components start -->
<section id="form-and-scrolling-components">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-group">
                            <h4 class="card-title">Modal with Dynamic Data</h4>
                            <p> Select ID to Load Data into Modal.</p>

                            <!-- Select ID -->
                            <select id="dataSelect" class="form-control">
                                <option value="1">ID 1</option>
                                <option value="2">ID 2</option>
                                <option value="3">ID 3</option>
                            </select>

                            <!-- Button trigger for data modal -->
                            <button type="button" class="btn btn-outline-success mt-3" data-bs-toggle="modal" data-bs-target="#dataModal">
                                Launch Modal
                            </button>

                            <!-- Data Modal -->
                            <div class="modal fade text-left" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="dataModalLabel">Data Details</h4>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="modalBody">
                                            <!-- Data will be loaded here dynamically -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                                <span class="d-none d-sm-block">OK</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Button to cekPdf page -->
                            <button type="button" class="btn btn-info mt-3" id="cekPdfButton">
                                Cek PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    // Data simulation
    const data = {
        1: {
            name: "John Doe",
            email: "john@example.com"
        },
        2: {
            name: "Jane Smith",
            email: "jane@example.com"
        },
        3: {
            name: "Mike Johnson",
            email: "mike@example.com"
        }
    };

    $('#dataModal').on('show.bs.modal', function(event) {
        const selectedId = $('#dataSelect').val();
        const selectedData = data[selectedId];
        const modalBody = $('#modalBody');

        // Clear previous data
        modalBody.empty();

        // Load new data
        modalBody.append(`<p><strong>Name:</strong> ${selectedData.name}</p>`);
        modalBody.append(`<p><strong>Email:</strong> ${selectedData.email}</p>`);
    });

    $('#cekPdfButton').on('click', function() {
        window.location.href = "cekPdf.html";
    });
</script>
</section>
<!-- Form and scrolling Components end -->

</section>

<?= $this->endSection() ?>