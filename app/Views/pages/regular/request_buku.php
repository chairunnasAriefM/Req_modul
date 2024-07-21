<?= $this->extend('/layouts/page_layout') ?>

<?= $this->section('content') ?>


<section class="form-section">
    <div class="form-container">
        <form id="modern-form" method="post" action="/buku_request">
            <h2>Request Buku</h2>

            <div class="form-group">
                <label for="jenis_buku">Jenis Buku</label>
                <select name="jenis_buku" id="jenis_buku">
                    <option value="Hobi">Hobi</option>
                    <option value="Refrensi">Refrensi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="judul_buku">Judul Buku</label>
                <input type="text" id="judul_buku" name="judul_buku">
            </div>

            <div class="form-group">
                <label for="edisi_tahun">Edisi Tahun</label>
                <input type="number" id="edisi_tahun" name="edisi_tahun">
            </div>

            <div class="form-group">
                <label for="penerbit">Penerbit</label>
                <input type="text" id="penerbit" name="penerbit">
            </div>

            <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" id="pengarang" name="pengarang">
            </div>

            <div class="form-group">
                <label for="link_beli">Link Pembelian</label>
                <input type="url" id="link_beli" name="link_beli">
            </div>

            <div class="form-group">
                <label for="perkiraan_harga">Perkiraan Harga</label>
                <input type="number" id="perkiraan_harga" name="perkiraan_harga">
            </div>

            <div class="form-group">
                <button type="submit">Tambah</button>
            </div>
        </form>
    </div>
</section>



<!-- SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            title: "Good job!",
            text: "<?= session()->getFlashdata('success') ?>",
            icon: "success"
        });
    </script>
<?php endif; ?>


<script type="text/javascript">
    window.onload = function() {
        // Cek apakah URL mengandung 'code' sebagai parameter
        if (window.location.search.indexOf('code') > -1) {

            var newUrl = window.location.href.split('?')[0];
            window.history.replaceState(null, '', newUrl);
            // window.location.reload();
        }
    };
</script>

<?= $this->endSection(); ?>