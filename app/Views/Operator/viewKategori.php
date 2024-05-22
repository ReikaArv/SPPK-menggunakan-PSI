<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title ?></title>

    <!-- Custom fonts for this template -->
    <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?= base_url('vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

    <!-- boostrap icon  -->
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>


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
                                <h6 class="font-weight-bold text-primary">Kriteria Seleksi Calon Peserta LKS</h6>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Button Tambah Data siswa baru -->
                                <div class="">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalNewSiswa">
                                        + Tambah Kriteria Baru
                                    </button>
                                </div>

                                <!-- Modal Tambah Siswa baru -->
                                <div class="modal fade" id="modalNewSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Tambah Kriteria Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?= form_open('operator/addKategori'); ?>
                                            <div class="modal-body">
                                                <div class="form-group row">
                                                    <label for="id" class="col-sm-3 col-form-label">ID :</label>
                                                    <div class="col-sm-7 ">
                                                        <input type="text" readonly class="form-control" id="id" name="id">
                                                    </div>
                                                    <label for="name" class="col-sm-3 col-form-label">Kriteria :</label>
                                                    <div class="col-sm-7 ">
                                                        <input type="text" class="form-control" id="name" name="name" required="" oninvalid="this.setCustomValidity('Nama kriteria harus diisi')" oninput="setCustomValidity('')">
                                                    </div>
                                                    <label for="description" class="col-sm-8 col-form-label">Deskripsi :</label>
                                                    <div class="col-sm-10">
                                                        <textarea type="text" class="form-control" id="description" name="description" required="" oninvalid="this.setCustomValidity('Deskripsi kriteria harus diisi')" oninput="setCustomValidity('')"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            <?= form_close();  ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Kriteria</th>
                                    <th scope="col">Deskripsi</th>
                                    <?php if (session('authority') == 99) : ?>
                                        <th scope="col">Aksi</th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($kategori as $k) : ?>
                                    <th scope="row"><?= $k['id'] ?></th>
                                    <td><?= $k['name'] ?></td>
                                    <td><?= $k['description'] ?></td>
                                    <td class="col-2">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editKategori<?= $k['id'] ?>">
                                            <i class=" bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteKategori<?= $k['id'] ?>">
                                            <i class=" bi bi-trash"></i>
                                        </button>
                                        <!-- <button type="button" class="btn btn-danger"> <i class="bi bi-trash"></i></button> -->
                                    </td>
                                    </tr>

                                    <!-- Modal Update Data -->
                                    <div class="modal fade" id="editKategori<?= $k['id'] ?>" tabindex="-1" aria-labelledby="editKategoriModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="editKategoriModal">Ubah Data Kriteria</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                </div>
                                                <?= form_open('operator/updateKategori'); ?>
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="id" class="col-sm-3 col-form-label">ID :</label>
                                                        <div class="col-sm-7 ">
                                                            <input type="text" readonly class="form-control" id="id" name="id" value="<?= $k['id'] ?>">
                                                        </div>
                                                        <label for="name" class="col-sm-3 col-form-label">Kriteria :</label>
                                                        <div class="col-sm-7 ">
                                                            <input type="text" class="form-control" id="name" name="name" value="<?= $k['name'] ?>">
                                                        </div>
                                                        <label for="description" class="col-sm-8 col-form-label">Deskripsi :</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="description" name="description" value="<?= $k['description'] ?>"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                                <?= form_close();  ?>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- moodal delete data -->
                                    <div class="modal fade" id="deleteKategori<?= $k['id'] ?>" tabindex="-1" aria-labelledby="deleteKategoriModal" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title fs-4" id="deleteKategoriModal"> <i class="bi bi-exclamation-triangle"></i> Hapus Data Kategori</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                </div>
                                                <?= form_open('operator/deleteKategori'); ?>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="<?= $k['id'] ?>">
                                                    <h5>Anda yakin ingin menghapus Kriteria "<?= $k['name']; ?>" ?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                                <?= form_close();  ?>
                                            </div>
                                        </div>
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

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="<?= base_url('vendor/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>

        <!-- Page level plugins -->
        <script src="<?= base_url('vendor/datatables/jquery.dataTables.min.js') ?>"></script>
        <script src="<?= base_url('vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

        <!-- Page level custom scripts -->
        <script src="<?= base_url('js/demo/datatables-demo.js') ?>"></script>

        <!-- popper.js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>