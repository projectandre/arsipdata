<div class="row">
    <div class="col-8">
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
            <div class="card-header text-center">
                <img src="<?= base_url('tempApp/'); ?>assets/images/faces/1.jpg" alt="Photo Profile" width="170" class="img-thumbnail rounded-circle">
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/Profile/update_profile'); ?>" method="post" class="form form-horizontal" enctype="multipart/form-data">
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <tbody>
                                <tr>
                                    <td class="text-bold-500">Nama Lengkap</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" value="<?= $profile->nama; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500">Email</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="<?= $profile->email; ?>">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="<?= base_url('admin/Profile'); ?>" class="btn btn-outline-secondary ">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>