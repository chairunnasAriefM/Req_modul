<?= $this->extend('/layouts/page_layout') ?>


<?= $this->section('content') ?>

<div class="form-container" style=" margin-top: 120px;">
    <form id="modern-form" method="post" action="/buku_request">
        <h2>Sign Up</h2>


        <?php

        if (!session()->has('id_anggota')) {
            echo ' <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" id="nim" name="nim">
        </div>';
        }


        ?>


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
            <select id="yearSelect" name="edisi_tahun"></select>
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
            <label for="harga_buku">Harga Buku</label>
            <input type="number" id="harga_buku" name="harga_buku">
        </div>


        <div class="form-group">
            <button type="submit">Tambah</button>
        </div>
    </form>
</div>





<script>
    document.addEventListener('DOMContentLoaded', () => {
        const yearSelect = document.getElementById('yearSelect');
        const currentYear = new Date().getFullYear();
        const startYear = 2000; // atau tahun awal yang Anda inginkan

        for (let year = startYear; year <= currentYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
    });
</script>




<?= $this->endSection(); ?>