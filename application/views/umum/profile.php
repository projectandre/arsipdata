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
                <div class="table-responsive">
                    <table class="table table-lg">
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Nama Lengkap</td>
                                <td>:</td>
                                <td><?= $profile->nama; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Email</td>
                                <td>:</td>
                                <td><?= $profile->email; ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold-500">Role</td>
                                <td>:</td>
                                <td><?= ucwords($profile->role); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div><br>
                <a href="<?= base_url('admin/Profile/edit_profile'); ?>" class="btn btn-primary">Ubah Profile</a>
            </div>
        </div>
    </div>
</div>