<?= $this->extend('layouts/LayoutDashboard') ?>

<?= $this->section('content') ?>

<div class="page-heading">
    <h1>Request Statistics</h1>
    <hr>
</div>

<div class="page-content">
    <div class="row">
        <!-- Total Request -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card bg-primary text-white shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Modul</div>
                            <div class="h5 mb-0 font-weight-bold"><?= $totalModulPending ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-list fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card bg-warning text-white shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Proses Modul</div>
                            <div class="h5 mb-0 font-weight-bold"><?= $totalModulProses ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Disetujui -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card bg-success text-white shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Buku</div>
                            <div class="h5 mb-0 font-weight-bold"><?= $totalBukuPending ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Proses Eksekusi -->
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card bg-danger text-white shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Proses Buku</div>
                            <div class="h5 mb-0 font-weight-bold"><?= $totalBukuProses ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-cogs fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>