<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <?= $this->include('Templates/header') ?>



</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?= $this->include('Templates/sidebar') ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?= $this->include('Templates/navbar.php') ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-center">
                                <h6 class="font-weight-bold text-primary">Daftar Siswa Yang Mengikuti Seleksi LKS</h6>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Button Tambah Data siswa baru -->
                                <div class="">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewSiswa">
                                        + Tambah Siswa Baru
                                    </button>
                                </div>

                                <!-- Modal Tambah Siswa baru -->
                                <div class="modal fade" id="modalNewSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Siswa Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?= form_open('operator/addSiswa'); ?>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="id" class="col-sm-3 col-form-label">ID :</label>
                                                    <div class="col-sm-7 ">
                                                        <input type="text" readonly class="form-control" id="id" name="id">
                                                    </div>
                                                    <label for="name" class="col-sm-3 col-form-label">Nama :</label>
                                                    <div class="col-sm-7 ">
                                                        <input type="text" class="form-control" id="name" name="name" required="" oninvalid="this.setCustomValidity('Nama harus diisi')" oninput="setCustomValidity('')">
                                                    </div>
                                                    <?php foreach ($kategori as $c) : ?>
                                                        <label for=" nilai" class="col-sm-3 col-form-label"><?= $c['name'] ?> :</label>
                                                        <div class="col-sm-7 ">
                                                            <input type="number" class="form-control" id="nilai" name="nilai<?= $c['id'] ?>" required="" oninvalid="this.setCustomValidity('Nilai harus diisi')" oninput="setCustomValidity('')">
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            <?= form_close();  ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- end -->
                                <br>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nama</th>
                                            <?php foreach ($kategori as $c) : ?>
                                                <th scope="col"><?= $c['name']; ?></th>
                                            <?php endforeach ?>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $row) : ?>
                                            <tr>
                                                <td><?= $row['id']; ?></td>
                                                <td><?= $row['name']; ?></td>
                                                <?php foreach ($kategori as $c) : ?>
                                                    <td>
                                                        <?php
                                                        $found = false;
                                                        foreach ($row['meta'] as $meta) {
                                                            if ($meta['kategori_id'] == $c['id']) {
                                                                echo $meta['nilai'];
                                                                $found = true;
                                                                break;
                                                            }
                                                        }
                                                        if (!$found) {
                                                            echo 0;
                                                        }
                                                        ?>
                                                    </td>
                                                <?php endforeach ?>

                                                <td>
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSiswa<?= $row['id'] ?>">
                                                        <i class=" bi bi-pencil"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteSiswa<?= $row['id'] ?>">
                                                        <i class=" bi bi-trash"></i>
                                                    </button>
                                                </td>

                                            </tr>
                                            <!-- modal update data -->
                                            <div class="modal fade" id="editSiswa<?= $row['id'] ?>" tabindex="-1" aria-labelledby="editSiswaModal" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="editSiswaModal">Ubah Data Siswa</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                        </div>
                                                        <?= form_open('operator/updateSiswa'); ?>
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label for="id" class="col-sm-3 col-form-label">ID :</label>
                                                                <div class="col-sm-7 ">
                                                                    <input type="text" readonly class="form-control" id="id" name="id" value="<?= $row['id'] ?>">
                                                                </div>
                                                                <label for="name" class="col-sm-3 col-form-label">Nama :</label>
                                                                <div class="col-sm-7 ">
                                                                    <input type="text" class="form-control" id="name" name="name" value="<?= $row['name'] ?>"    required="" oninvalid=" this.setCustomValidity('Nama harus diisi')" oninput="setCustomValidity('')">
                                                                </div>
                                                                <?php foreach ($kategori as $c) : ?>
                                                                    <?php foreach ($row['meta'] as $meta) : ?>
                                                                        <?php if ($meta['kategori_id'] == $c['id']) : ?>
                                                                            <input type="hidden" name="kategori_id" value="<?= $c['id'] ?>">
                                                                            <label for="nilai" class="col-sm-3 col-form-label"><?= $c['name'] ?> :</label>
                                                                            <div class="col-sm-7 ">
                                                                                <input type="text" class="form-control" id="nilai<?= $c['id'] ?>" name="nilai<?= $c['id'] ?>" value="<?= $meta['nilai'] ?>" required="" oninvalid="this.setCustomValidity('Nilai harus diisi')" oninput="setCustomValidity('')">
                                                                            </div>
                                                                        <?php endif ?>
                                                                    <?php endforeach ?>
                                                                <?php endforeach ?>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                    <?= form_close() ?>
                                                </div>
                                            </div>
                                            <!-- end modal update data -->

                                            <!-- modal delete data -->
                                            <div class="modal fade" id="deleteSiswa<?= $row['id'] ?>" tabindex="-1" aria-labelledby="deleteSiswaModal" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title fs-4" id="deleteSiswaModal"> <i class="bi bi-exclamation-triangle"></i> Hapus Data Siswa</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                        </div>
                                                        <?= form_open('operator/deleteSiswa'); ?>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                            <h5>Anda yakin ingin menghapus "<?= $row['name']; ?>" ?</h5>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                        <?= form_close();  ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- end modal delete data -->
                                        <?php endforeach ?>
                                    </tbody>
                                </table>


                            </div>
                            <!-- /.container-fluid -->

                        </div>
                        <!-- End of Main Content -->

                        <!-- Footer -->
                        <footer class="sticky-footer bg-white">
                            <div class="container my-auto">
                                <div class="copyright text-center my-auto">
                                    <span>Copyright &copy; Your Website 2020</span>
                                </div>
                            </div>
                        </footer>
                        <!-- End of Footer -->

                    </div>
                    <!-- End of Content Wrapper -->

                </div>
                <!-- End of Page Wrapper -->

                <?= $this->include('Templates/footer') ?>
</body>

</html>