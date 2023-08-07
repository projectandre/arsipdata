<div class="row match-height">
    <div class="col-md-7 col-12">
        <?php
        // Notif gagal input
        echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '  <button type="button" style="color: #fff;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

        // notif data masuk db
        if ($this->session->flashdata('pesan')) {
            echo $this->session->flashdata('pesan');
        }
        ?>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Ubah Password</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form form-horizontal" enctype="multipart/form-data" action="<?= base_url('admin/UbahPassword/update_password') ?>" method="post">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Nama Lengkap</label>
                                </div>
                                <div class="col-md-7 form-group">
                                    <input type="text" id="nama" class="form-control" name="nama" value="<?= $this->session->userdata('nama'); ?>" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-7 form-group">
                                    <input type="email" id="email" class="form-control" name="email" value="<?= $this->session->userdata('email'); ?>" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label>Password Lama</label>
                                </div>
                                <div class="col-md-7 form-group">
                                    <input type="password" id="password_lama" class="form-control" name="password_lama" placeholder="Password Lama" required>
                                </div>
                                <div class="col-md-5">
                                    <label>Password Baru</label>
                                </div>
                                <div class="col-md-7 form-group">
                                    <input type="password" id="password1" class="form-control" name="password1" placeholder="Password Baru" required>
                                </div>
                                <div class="col-md-5">
                                    <label>Ulangi Password</label>
                                </div>
                                <div class="col-md-7 form-group">
                                    <input type="password" id="password2" class="form-control" name="password2" placeholder="Ulangi Password" required><br>
                                </div>
                                <div class="col-sm-12 d-flex justify-content-start">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>