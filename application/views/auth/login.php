<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Arsip Data</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
    <link rel="stylesheet" href="<?= base_url('tempApp/') ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?= base_url('tempApp/') ?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?= base_url('tempApp/') ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url('tempApp/') ?>assets/images/logo/favicon.png" type="image/png">


    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('templogin/') ?>css/main.css">
    <!--===============================================================================================-->
    <style>
        #subBtn:hover {
            background-color: #212A3E;

        }

        #subBtn {
            width: 100%;
            padding: 12px;
            color: aliceblue;
            background-color: #394867;
        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <span class="login100-form-title p-b-48">
                    <!-- <img src="<?= base_url('gambar/') ?>logo1.png" alt="logo" height="50"> -->
                    ARSIP DATA
                </span>

                <?= $this->session->flashdata('message'); ?>


                <form method="POST" action="<?= base_url('auth'); ?>">
                    <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                        <input class="input100" type="email" name="email">
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div> <?= form_error('email', '<small class="text-danger">', '</small>'); ?>


                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div> <?= form_error('password', '<small class="text-danger">', '</small>'); ?>


                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">

                            <button id="subBtn" class="" type="submit">
                                Login
                            </button>
                        </div>
                    </div>
                </form>

                <div class="text-center p-t-90">
                    <!-- <span class="txt1">
                        Belum punya akun?
                    </span>

                    <a class="txt2" href="<?= base_url('auth/daftar') ?>">
                        Daftar
                    </a>
                    |
                    <a class="txt2" href="<?= base_url('user/') ?>">
                        Kembali
                    </a> -->

                    <span class="txt1">
                        Klik link ini untuk
                    </span><br>

                    <a class="txt2" href="<?= base_url('home') ?>">
                        |
                    </a>
                    <a class="txt2" href="<?= base_url('auth/email_lupa_password') ?>">
                        Lupa Password? |
                    </a>
                </div>

            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="<?= base_url('templogin/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('templogin/') ?>vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('templogin/') ?>vendor/bootstrap/js/popper.js"></script>
    <script src="<?= base_url('templogin/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('templogin/') ?>vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('templogin/') ?>vendor/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url('templogin/') ?>vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('templogin/') ?>vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('templogin/') ?>js/main.js"></script>

</body>

</html>