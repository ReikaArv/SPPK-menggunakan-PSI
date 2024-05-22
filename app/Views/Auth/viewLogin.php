<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $pageTitle ?></title>

    <link href="<?= base_url('assets/css/style_auth.css') ?>" rel="stylesheet">
    <?= $this->include('Templates/header') ?>



</head>

<body class="bg-auth">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-3">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                                    </div>
                                    <!-- get error data -->
                                    <?php if (session()->getFlashdata('error')) : ?>
                                        <div class="alert alert-danger alert-dismissable show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">
                                                    x
                                                </button>
                                                <b>Error</b>
                                                <?= session()->getFlashdata('error') ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <!-- end get error data -->

                                    <?= form_open('auth/loginProcess') ?>
                                    <form class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" required="" oninvalid="this.setCustomValidity('Silahkan masukkan Username')" oninput="setCustomValidity('')">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user required" id="password" name="password" placeholder="Password" required="" oninvalid="this.setCustomValidity('Silahkan masukkan Password')" oninput="setCustomValidity('')">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                    <?= form_close() ?>

                                    <div class="text-center">
                                        <a class="small" href="<?= site_url('landing'); ?>">Kembali ke Halaman Awal</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?= $this->include('Templates/footer') ?>

</body>

</html>