<?= $this->extend('layouts/LayoutDashboard.php') ?>

<?= $this->section('content') ?>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Data Dosen Baru</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <?php if (session()->getFlashdata('msg')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('msg') ?>
                            </div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('swal')) : ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('swal') ?>
                            </div>
                        <?php endif; ?>
                        <form class="form" action="<?= base_url('') ?>dashboard/tambahDosen" method="post">
                            <?= csrf_field() ?>
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" id="nama" class="form-control" placeholder="Nama" name="nama" value="<?= old('nama') ?>">
                                        <?php if (isset($validation) && $validation->getError('nama')) : ?>
                                            <div class="alert alert-danger mt-2"><?= $validation->getError('nama') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="asal_prodi">Asal Prodi</label>
                                        <input type="text" id="asal_prodi" class="form-control" placeholder="Asal Prodi" name="asal_prodi" value="<?= old('asal_prodi') ?>">
                                        <?php if (isset($validation) && $validation->getError('asal_prodi')) : ?>
                                            <div class="alert alert-danger mt-2"><?= $validation->getError('asal_prodi') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control" placeholder="Email" name="email" value="<?= old('email') ?>">
                                        <?php if (isset($validation) && $validation->getError('email')) : ?>
                                            <div class="alert alert-danger mt-2"><?= $validation->getError('email') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" class="form-control" placeholder="Password" name="password">
                                        <?php if (isset($validation) && $validation->getError('password')) : ?>
                                            <div class="alert alert-danger mt-2"><?= $validation->getError('password') ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>