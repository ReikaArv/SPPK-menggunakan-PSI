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
                            <td><?= $d['psi_total'] ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-xl" data-sw="<?= $d['name'] ?>">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>

                    <?php endforeach ?>
                </tbody>
            </table>
        </div>