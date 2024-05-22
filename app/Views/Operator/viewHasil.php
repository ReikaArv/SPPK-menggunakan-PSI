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
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="getNilai(<?= $d['id'] ?>)" data-target=".bd-example-modal-xl" data-sw="<?= $d['id'] ?>" data-name="<?= $d['name'] ?>">
                                                        Lihat Detail
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog  modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>Hasil Penghitungan PSI</h5>
                                            <input type="text" id="value_sw" hidden>
                                            <table class="table table-bordered table-responsive table-sm" id="tableDetailPsi" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <?php foreach ($kategori as $c) : ?>
                                                            <th scope="col"><?= $c['name'] ?></th>
                                                        <?php endforeach ?>
                                                        <th scope="col">Total Nilai</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($data as $d) : ?>
                                                        <tr class="<?= $tableColor ?>">
                                                            <td hidden><?= $d['id'] ?></td>
                                                            <?php foreach ($d['psi'] as $psi) : ?>
                                                                <td><?= $psi ?></td>
                                                            <?php endforeach ?>
                                                            <td><?= $d['psi_total'] ?></td>
                                                        </tr>

                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                            <!-- separator  -->
                                            <h5>Nilai Siswa</h5>
                                            <input type="text" id="value_sw" hidden>
                                            <table class="table table-bordered table-responsive table-sm" id="tableDetailRaw" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <?php foreach ($kategori as $c) : ?>
                                                            <th scope="col"><?= $c['name'] ?></th>
                                                        <?php endforeach ?>

                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
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
    <script>
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('sw')
            var name = button.data('name')
            var modal = $(this)
            modal.find('.modal-body input').val(recipient)
            modal.find('.modal-title').text('Detail Nilai ' + name)

            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("value_sw");

            filter = input.value.toUpperCase();
            table = document.getElementById("tableDetailPsi");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue == filter) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        })

        function getNilai(id) {
            $.ajax({
                url: '<?= base_url('nilai') ?>' + `/${id}`,
                type: 'GET',
                success: function(dataRaw) {
                    let data = JSON.parse(dataRaw);
                    var table = $("#tableDetailRaw")

                    if (table[0].rows.length > 1) {
                        for (let i = 1; i < table[0].rows.length; i++) {
                            table[0].deleteRow(i);
                        }
                    }
                    var newRow = table[0].insertRow();
                    data.forEach(function(entry) {
                        var newCell = newRow.insertCell();
                        newCell.textContent = entry.nilai;
                    });
                }
            })
        }
    </script>

</body>

</html>