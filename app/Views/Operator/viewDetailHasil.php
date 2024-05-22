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
        <?php if (session('authority') > 2) : ?>
            <?= $this->include('Templates/sidebar') ?>
        <?php endif ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php if (session('authority') > 2) : ?>
                    <?= $this->include('Templates/navbar.php') ?>
                <?php endif ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Tabel Hasil -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-flex justify-content-center">
                                <h6 class="font-weight-bold text-primary">Hasil Perankingan PSI</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <div>
                                    <h1>Selamat kepada ananda "<?= $data[0]['name']; ?>" </h1>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div>
                                    <h2 class="text-success ">Telah lolos tahap seleksi calon peserta LKS SMKN 1 Prajekan </h2>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Rank</th>
                                            <?php if (session('authority') > 10) : ?>
                                                <th scope="col">ID</th>
                                            <?php endif ?>
                                            <th scope="col">Nama</th>
                                            <?php if (session('authority') > 10) : ?>
                                                <?php foreach ($kategori as $c) : ?>
                                                    <th scope="col"><?= $c['name'] ?></th>
                                                <?php endforeach ?>
                                            <?php endif ?>

                                            <th scope="col">Total Nilai</th>
                                            <th scope="col">Detail</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($data as $d) : ?>
                                            <?php if ($i == 1) :
                                                $tableColor = 'table-success';
                                            else : $tableColor = 'table';
                                            endif ?>
                                            <tr class="<?= $tableColor ?>">
                                                <th scope="row"><?= '#' . $i++ ?></th>
                                                <?php if (session('authority') > 10) : ?>
                                                    <th scope="row"><?= $d['id'] ?></th>
                                                <?php endif ?>
                                                <td><?= $d['name'] ?></td>
                                                <?php foreach ($d['psi'] as $psi) : ?>
                                                    <td><?= $psi ?></td>
                                                <?php endforeach ?>
                                                <td><?= $d['psi_total'] ?></td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="lihatNilai<?= $d['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <label for="id" class="col-sm-3 col-form-label">ID :</label>
                                                            <div class="col-sm-7 ">
                                                                <input type="text" readonly class="form-control" id="id" name="id" value="<?= $d['id'] ?>">
                                                            </div>
                                                            <label for="name" class="col-sm-3 col-form-label">Nama :</label>
                                                            <div class="col-sm-7 ">
                                                                <input type="text" class="form-control" id="name" name="name" value="<?= $d['name'] ?>">
                                                            </div>
                                                            <?php foreach ($kategori as $c) : ?>
                                                                <input type="hidden" name="kategori_id" value="<?= $c['id'] ?>">
                                                                <label for="nilai" class="col-sm-3 col-form-label"><?= $c['name'] ?> :</label>
                                                                <div class="col-sm-7 ">
                                                                    <?php
                                                                    $countr = 0;
                                                                    foreach ($d['psi'] as $psi) {
                                                                        if ($countr == $c['id']) {
                                                                            $nilai = $psi;
                                                                        }
                                                                        $countr++;
                                                                    }
                                                                    ?>
                                                                    <input type="text" class="form-control" id="nilai<?= $c['id'] ?>" name="nilai<?= $c['id'] ?>" value="<?= $nilai ?>">
                                                                </div>
                                                            <?php endforeach ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <?php if (session('authority') < 1) : ?>
                            <a class="btn btn-primary btn-xl" href="<?= base_url('landing') ?>">Kembali ke Halaman Awal</a>
                        <?php endif ?>
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