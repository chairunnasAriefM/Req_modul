<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <?= $this->renderSection('content') ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <?php if (session()->getFlashdata('msg')) : ?>
        <script>
            Swal.fire({
                title: "Terjadi Galat!",
                text: "<?= session()->getFlashdata('msg'); ?>",
                icon: "error"
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "<?= session()->getFlashdata('success'); ?>",
                icon: "success"
            });
        </script>
    <?php endif; ?>

    <?php if (isset($validation) && $validation->getErrors()) : ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: "Gagal",
                    html: "<?= implode('<br>', $validation->getErrors()) ?>",
                    icon: "error"
                });
            });
        </script>
    <?php endif; ?>


</body>

</html>