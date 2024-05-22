<?= $this->extends() ?>

<?= $this->section('content') ?>
<h6 class="collapse-header">Login Screens:</h6>
<a class="collapse-item" href="<?= base_url('siswa') ?>">Kelola Siswa</a>
<a class="collapse-item" href="register.html">Kelola Kategori</a>
<a class="collapse-item" href="<?= base_url('hasil') ?>">Lihat Hasil Perhitungan</a>
<div class="collapse-divider"></div>
<h6 class="collapse-header">Other Pages:</h6>
<a class="collapse-item" href="404.html">404 Page</a>
<a class="collapse-item" href="blank.html">Blank Page</a>
<?= $this->endSection('content') ?>