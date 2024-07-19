<?php if (isset($modul)) : ?>
    <div class="modal fade text-left" id="previewModal<?= $modul->modul_id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel<?= $modul->modul_id ?>" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel<?= $modul->modul_id ?>">Preview Modul</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="modul_id_<?= $modul->modul_id ?>" class="form-label">Modul ID</label>
                            <input type="text" class="form-control" id="modul_id_<?= $modul->modul_id ?>" value="<?= $modul->modul_id ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="judul_modul_<?= $modul->modul_id ?>" class="form-label">Judul Modul</label>
                            <input type="text" class="form-control" id="judul_modul_<?= $modul->modul_id ?>" value="<?= $modul->judul_modul ?>" readonly>
                        </div>
                        <?php if (!empty($modul->soft_file)) : ?>
                            <div class="mb-3">
                                <label for="soft_file_<?= $modul->modul_id ?>" class="form-label">Soft File</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="soft_file_<?= $modul->modul_id ?>" value="<?= $modul->soft_file ?>" readonly>
                                    <a href="<?= base_url('uploads/' . $modul->soft_file) ?>" class="btn btn-primary" target="_blank"><i class="bi bi-eye-fill"></i> Lihat PDF</a>
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