 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Login</title>
     <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 </head>

 <body>
     <div class="flex-container">
         <div class="flex-item-left">
             <h3>Registrasi Akun</h3>



             <form action="<?= base_url('/registrasi') ?>" method="post">
                 <div class="form-group">
                     <label for="email">Email</label>
                     <input type="email" name="email" placeholder="Email" required>
                 </div>

                 <div class="form-group">
                     <label for="nama">Nama</label>
                     <input type="text" name="nama" placeholder="Nama" required>
                 </div>

                 <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" name="password" placeholder="Password" required>
                 </div>

                 <button type="submit" class="sign-in-button">Sign in</button>
             </form>

             <div class="signup-link">
                 Sudah punya akun? <a href="<?= base_url('/login') ?>">Login</a>
             </div>
         </div>
         <div class="flex-item-right"></div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <?php if (session()->getFlashdata('msg')) : ?>
         <script>
             Swal.fire({
                 title: "Registrasi Gagal",
                 text: "<?= session()->getFlashdata('msg'); ?>",
                 icon: "error"
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