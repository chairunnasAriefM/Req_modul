<?php if (isset($modul)) : ?>
    <div class="modal fade text-left" id="previewModal<?= $modul->id_request_modul ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= $modul->id_request_modul ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <?php if (!empty($modul->soft_file)) : ?>
                        <h4 id="myModalLabel<?= $modul->id_request_modul ?>">Modul Update</h4>
                    <?php endif; ?>
                    <!-- <h4 class="modal-title" id="myModalLabel<?= $modul->id_request_modul ?>"> Preview Modul</h4> -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="judul_modul_<?= $modul->id_request_modul ?>" class="form-label">Judul Modul</label>
                            <input type="text" class="form-control" id="judul_modul_<?= $modul->id_request_modul ?>" value="<?= $modul->judul_modul ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="judul_modul_<?= $modul->id_request_modul ?>" class="form-label">Nama Pemohon</label>
                            <input type="text" class="form-control" id="judul_modul_<?= $modul->id_request_modul ?>" value="<?= $modul->nama_pemohon ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="judul_modul_<?= $modul->id_request_modul ?>" class="form-label">Jumlah Cetak </label>
                            <input type="text" class="form-control" id="judul_modul_<?= $modul->id_request_modul ?>" value="<?= $modul->jumlah_cetak ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="judul_modul_<?= $modul->id_request_modul ?>" class="form-label">Tanggal Request</label>
                            <input type="text" class="form-control" id="judul_modul_<?= $modul->id_request_modul ?>" value="<?= $modul->tanggal_request ?>" readonly>
                        </div>
                        <?php if (!empty($modul->soft_file)) : ?>
                            <div class="mb-3">
                                <label for="soft_file_<?= $modul->id_request_modul ?>" class="form-label">Soft File</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="soft_file_<?= $modul->id_request_modul ?>" value="<?= $modul->soft_file ?>" readonly>
                                    <a href="<?= base_url('uploads/modul/' . $modul->soft_file) ?>" class="btn btn-primary" target="_blank"><i class="bi bi-eye-fill"></i> Lihat PDF</a>
                                </div>
                            </div>
                        <?php endif; ?>
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
<?php endif; ?>