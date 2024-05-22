<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    test

    <div class="container">
        <div class="table-responsive">
            <table class="table table-success table-striped-columns table-hover table-bordered table-align-middle">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <?php foreach ($kategori as $k) : ?>
                            <th scope="col"><?= $k['nama_kategori']; ?></th>
                        <?php endforeach ?>
                        <th scope="col">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($showData as $s) : ?>
                        <tr>
                            <th id="id" scope="row"><?= $s['id']; ?></th>
                            <td id="nama">><?= $s['nama']; ?></td>
                            <td id="c1"><?= $s['c1']; ?></td>
                            <td id="c2"><?= $s['c2']; ?></td>
                            <td id="c3"><?= $s['c3']; ?></td>
                            <td id="c4"><?= $s['c4']; ?></td>
                            <td id="c5"><?= $s['c5']; ?></td>
                            <td id="c6"><?= $s['c6']; ?></td>
                            <td id="c7"><?= $s['c7']; ?></td>
                            <td class="col-2">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#siswaModal<?= $s['id'] ?>">
                                    <i class=" bi bi-pencil"></i>
                                </button>

                                <button type="button" class="btn btn-danger"> <i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <?= form_open('siswa/updateData') ?>
                        <div class="modal fade" id="siswaModal<?= $s['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-3 col-form-label">ID :</label>
                                            <div class="col-sm-7 ">
                                                <input type="text" readonly class="form-control" id="id" name="id" value="<?= $s['id'] ?>">
                                            </div>
                                            <label for="nama" class="col-sm-3 col-form-label">Nama :</label>
                                            <div class="col-sm-7 ">
                                                <input type="text" readonly class="form-control" id="nama" name="nama" value="<?= $s['nama'] ?>">
                                            </div>
                                            <label for="c1" class="col-sm-8 col-form-label">Nilai rapor :</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="c1" name="c1" value=<?= $s['c1'] ?>>
                                            </div>
                                            <label for="c2" class="col-sm-8 col-form-label">Kemampuan Akademik :</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="c2" name="c2" value="<?= $s['c2'] ?>">
                                            </div>
                                            <label for="c3" class="col-sm-8 col-form-label">Keterampilan Motorik :</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="c3" name="c3" value="<?= $s['c3'] ?>">
                                            </div>
                                            <label for="c4" class="col-sm-8 col-form-label">Keterampilan Menulis KTI :</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="c4" name="c4" value="<?= $s['c4'] ?>">
                                            </div>
                                            <label for="c5" class="col-sm-8 col-form-label">Kemampuan Presentasi :</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="c5" name="c5" value="<?= $s['c5'] ?>">
                                            </div>
                                            <label for="c6" class="col-sm-8 col-form-label">Kemampuan Public Speaking :</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="c6" name="c6" value="<?= $s['c6'] ?>">
                                            </div>
                                            <label for="c7" class="col-sm-8 col-form-label">Perilaku di Sekolah :</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="c7" name="c7" value="<?= $s['c7'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?= form_close() ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>


</body>

</html>