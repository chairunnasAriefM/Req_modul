<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Request </title>

    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.ico') ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?= base_url('assets2/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets2/compiled/css/app-dark.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets2/compiled/css/iconly.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets2/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets2/compiled/css/table-datatable-jquery.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets2/compiled/css/app.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets2/compiled/css/app-dark.css') ?>">
    <!-- font awesome -->
    <link rel="stylesheet" href="<?= base_url('assets2/extensions/@fortawesome/fontawesome-free/css/all.min.css') ?>">


</head>

<body>
    <script src="<?= base_url('assets2/static/js/initTheme.js') ?>"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo_pcr_biasa.png') ?>" alt="Logo" srcset=""></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item <?= uri_string() == '' ? 'active' : '' ?> ">
                            <a href="<?= base_url() ?>" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Home</span>
                            </a>
                        </li>

                        <?php if (session()->get('is_dosen') == TRUE) : ?>
                            <li class="sidebar-item <?= uri_string() == 'historyModul' ? 'active' : '' ?> ">
                                <a href="<?= base_url() ?>historyModul" class='sidebar-link'>
                                    <i class="bi bi-journal"></i> <span>Modul</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="sidebar-item <?= uri_string() == 'historyBuku' ? 'active' : '' ?> ">
                            <a href="<?= base_url() ?>historyBuku" class='sidebar-link'>
                                <i class="bi bi-book"></i>
                                <span>Buku</span>
                            </a>
                        </li>

                    </ul>


                </div>
            </div>
        </div>
        <div id="main" class='layout-navbar navbar-fixed'>
            <header>
                <nav class="navbar navbar-expand navbar-light navbar-top">

                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>


                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">
                                <li class="nav-item dropdown me-1">

                                </li>
                            </ul>
                            <div class="dropdown" style="margin-left: 20px;">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h4 class="mb-0 text-gray-600"><?= esc(session()->get('nama')) ?></h4>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">

                                                <img src="<?= base_url('assets2/compiled/jpg/2.jpg') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, <?= esc(session()->get('nama')) ?></h6>
                                    </li>
                                    <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-bg-danger" href="<?= base_url() ?>logout" onclick="confirmLogout(event)"><i class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">
                <?php $this->renderSection('content') ?>
            </div>
            <!-- footer -->
            <footer style="bottom: 0;">
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2024 &copy; Politeknik Caltex Riau</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>




    <script src="<?= base_url('assets2/static/js/components/dark.js') ?>"></script>
    <script src="<?= base_url('assets2/extensions/perfect-scrollbar/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('assets2/compiled/js/app.js') ?>"></script>

    <!-- Need: Apexcharts -->
    <script src="<?= base_url('assets2/extensions/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets2/static/js/pages/dashboard.js') ?>"></script>


    <script src="<?= base_url('assets2/extensions/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= base_url('assets2/static/js/pages/dashboard.js') ?>"></script>

    <script src="<?= base_url('assets2/extensions/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets2/extensions/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets2/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') ?>"></script>
    <script src="<?= base_url('assets2/static/js/pages/datatables.js') ?>"></script>

    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

    <script>
        function confirmLogout(event) {
            event.preventDefault(); // Mencegah link default action

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan keluar dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url('logout') ?>'; // Redirect ke URL logout
                }
            });
        }
    </script>


</body>

</html>