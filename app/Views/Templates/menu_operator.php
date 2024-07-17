<h6 class="collapse-header">Menu Operator :</h6>
<a class="collapse-item" href="<?= base_url('siswa') ?>">Kelola Siswa</a>
<a class="collapse-item" href="<?= base_url('kategori') ?>">Kelola Kriteria</a>
<a class="collapse-item" href="<?= base_url('hasil') ?>">Lihat Hasil Perhitungan</a>
<hr class="sidebar-divider">
<?php if (session('authority') == 2) : ?>
    <h6 class="collapse-header">Menu Superadmin :</h6>
    <a class="collapse-item" href="<?= base_url('superadmin') ?>">Kelola Operator</a>
<?php endif ?>