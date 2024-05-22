<!-- Tabel Hasil -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-center">
            <h6 class="font-weight-bold text-primary">Hasil Perankingan PSI</h6>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">Rank</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <?php foreach ($kategori as $c) : ?>
                            <th scope="col"><?= $c['name'] ?></th>
                        <?php endforeach ?>
                        <th scope="col">Total</th>
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
                            <th scope="row"><?= $d['id'] ?></th>
                            <td><?= $d['name'] ?></td>
                            <?php foreach ($d['psi'] as $psi) : ?>
                                <td><?= $psi ?></td>
                            <?php endforeach ?>
                            <td><?= $d['psi_total'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>