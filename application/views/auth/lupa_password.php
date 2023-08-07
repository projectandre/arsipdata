<!DOCTYPE html>
<html>

<head>
    <title>Password Baru</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="stylesheet" href="<?= base_url('tempApp/') ?>assets/css/main/app.css">
    <link rel="stylesheet" href="<?= base_url('tempApp/') ?>assets/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?= base_url('tempApp/') ?>assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url('tempApp/') ?>assets/images/logo/favicon.png" type="image/png">

    <style>
        form {
            max-width: 100%;
            padding: 2em;
            /* border: 1px dashed #ddd */
        }

        #pwd {
            border-radius: 50px;
            padding: 10px 20px;
            border: 2px solid #999;
        }

        #pwd2 {
            border-radius: 50px;
            padding: 10px 20px;
            border: 2px solid #999;
        }

        *:focus {
            outline-style: none;
        }

        input {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 6px;
            border: 1px solid #ddd;
        }

        #progressBar {
            height: 20px;
            width: 100%;
            margin-top: 0.6em;
            border-radius: 50px;
            border: 2px solid #ddd
        }

        #progress-bar {
            width: 0%;
            height: 100%;
            transition: width 500ms linear;
            border-radius: 50px;
            box-shadow: 0px 1px 5px #555
        }

        .progress-bar-danger {
            background: #d00;
        }

        .progress-bar-warning {
            background: #f50;
        }

        .progress-bar-success {
            background: #080;
        }

        #subBtn:hover {
            background-color: #212A3E;

        }

        #subBtn {
            color: aliceblue;
            background-color: #394867;
        }
    </style>
</head>

<body>

    <script>
        jQuery.strength = function(element, password) {
            var desc = [{
                'width': '0px'
            }, {
                'width': '20%'
            }, {
                'width': '40%'
            }, {
                'width': '60%'
            }, {
                'width': '80%'
            }, {
                'width': '100%'
            }];
            var descClass = ['', 'progress-bar-danger', 'progress-bar-danger', 'progress-bar-warning', 'progress-bar-success', 'progress-bar-success'];
            var score = 0;

            //Jika Password Lebih Dari 6 Karakter Tambah Skor
            if (password.length > 6) {
                score++;
            }

            //Jika Password Terdapat Huruf Kecil dan Besar Tambah Skor
            if ((password.match(/[a-z]/)) && (password.match(/[A-Z]/))) {
                score++;
            }


            //Jika Password Terdiri dari Angka
            if (password.match(/\d+/)) {
                score++;
            }

            //Jika Password Terdapat Simbol
            if (password.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) {
                score++;
            }

            //Jika Password Lebih dari 10 Karakter  
            if (password.length > 10) {
                score++;
            }

            element.removeClass(descClass[score - 1]).addClass(descClass[score]).css(desc[score]);
        };

        jQuery(function() {
            jQuery("#pwd").keyup(function() {
                jQuery.strength(jQuery("#progress-bar"), jQuery(this).val());
            });
        });
    </script>

    <!-- <div class="container"> -->
    <div class="d-flex justify-content-center align-items-center">
        <div class="card col-md-6 mt-5">
            <div class="card-header" style="background-color: #394867;">
                <h5 style="color: white;">Masukan Password Baru</h5>
            </div>
            <div class="card-body">
                <form name="passwordStrengthBox" action="<?= base_url('auth/changePassword') ?>" method="POST">
                    <input type="hidden" name="email" id="email" value="">
                    <div class="mb-3">
                        <div class="passBox">
                            <input type="text" name="password" id="pwd" autocomplete="off" placeholder="Masukkan Password Disini" required>
                            <div id="progressBar">
                                <div id="progress-bar"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="text" name="password2" id="pwd2" autocomplete="off" placeholder="Masukkan Ulang Password" required>
                    </div>

                    <button class="btn" id="subBtn" type="submit">Atur Ulang</button>
                </form>
            </div>
        </div>
        <!-- </div> -->
    </div>
    <script>
        $(document).ready(function() {
            $("#pwd2").on('keyup', function() {
                var password = $("#pwd").val();
                var confirmPassword = $("#pwd2").val();
                if (password != confirmPassword) {
                    $("#submit").prop('disabled', true);
                } else {
                    $("#submit").prop('disabled', false);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>