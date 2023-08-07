<section class="row">
    <div class="container-fluid">
        <div class="col-md-12 col-12">
            <?php
            // Notif gagal input
            echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert">', '  <button type="button" style="color: #fff;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>');

            // notif data masuk db
            if ($this->session->flashdata('pesan')) {
                echo $this->session->flashdata('pesan');
            }
            ?>
            <!-- <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Form Edit Data Pegawai</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" action="<?= base_url('admin/Pegawai/update_pegawai/' . $pegawai->id_pegawai . '/' . $id_bidang); ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nama Pegawai</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" id="nama_pegawai" class="form-control" name="nama_pegawai" placeholder="Nama Pegawai" value="<?= $pegawai->nama_pegawai; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Nama Bidang</label>
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <select class="form-control" name="id_bidang" id="id_bidang" required>
                                            <option value="" disabled>Pilih Bidang</option>
                                            <?php foreach ($side_bidang as $sb) { ?>
                                                <option value="<?= $sb['id_bidang']; ?>" <?= ($sb['id_bidang'] == $pegawai->id_bidang) ? 'selected' : ''; ?>><?= $sb['nama_bidang']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <br><br>
                                    </div>

                                    <div class=" col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <a href="<?= base_url('admin/Pegawai/pegawai/' . $id_bidang); ?>" class="btn btn-secondary me-1 mb-1">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->

            <div class="card">
                <div class="card-header">
                    <form class="form form-horizontal" action="<?= base_url('admin/Pegawai/update_pegawai/' . $pegawai->id_pegawai . '/' . $id_bidang); ?>" method="POST" enctype="multipart/form-data">

                        <h4 class="card-title">Edit Data Pegawai</h4>
                        <div class="text-center">
                            <?php if ($pegawai->foto_pegawai == '' || $pegawai->foto_pegawai == null) { ?>
                                <img src="<?= base_url('uploads/'); ?>default.png" alt="Photo Profile" width="170" class="img-thumbnail rounded-circle">
                            <?php } else { ?>
                                <img src="<?= base_url('uploads/'); ?><?= $pegawai->foto_pegawai; ?>" alt="Photo Profile" width="170" class="img-thumbnail rounded-circle">
                            <?php } ?>
                            <input type="hidden" name="foto_pegawai_lama" value="<?= $pegawai->foto_pegawai;  ?>"><br>
                            <div class="custom-file d-flex justify-content-center mt-2">
                                <input type="file" style="width: 45%; display: block;" class="form-control" id="foto_pegawai" name="foto_pegawai" onchange="previewImgProfile()"><br>
                            </div>
                            <label class="custom-file-labelProfile" for="foto_pegawai"><?= $pegawai->foto_pegawai;  ?></label>
                        </div>

                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="form-body">
                            <div class="table-responsive">
                                <table class="table table-lg">
                                    <tbody>
                                        <tr>
                                            <td class="text-bold-500">Nama</td>
                                            <td>:</td>
                                            <td><input type="text" class="form-control" name="nama_pegawai" value="<?= $pegawai->nama_pegawai; ?>"></td>
                                            <td class="text-bold-500">NIP</td>
                                            <td>:</td>
                                            <td><input type="number" class="form-control" name="nip_pegawai" value="<?= $pegawai->nip_pegawai; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Email</td>
                                            <td>:</td>
                                            <td><input type="email" class="form-control" name="email_pegawai" value="<?= $pegawai->email_pegawai; ?>"></td>
                                            <td class="text-bold-500">Jenis Kelamin</td>
                                            <td>:</td>
                                            <td>
                                                <select class="form-select" name="jenis_kelamin_pegawai" id="jenis_kelamin_pegawai" required>
                                                    <option value="" disabled>Pilih Bidang</option>
                                                    <option value="Laki-Laki" <?= ($pegawai->jenis_kelamin_pegawai == 'Laki-Laki') ? 'selected' : ''; ?>>Laki-Laki</option>
                                                    <option value="Perempuan" <?= ($pegawai->jenis_kelamin_pegawai == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Bidang</td>
                                            <td>:</td>
                                            <td>
                                                <select class="form-select" name="id_bidang" id="id_bidang" required>
                                                    <option value="" disabled>Pilih Bidang</option>
                                                    <?php foreach ($side_bidang as $sb) { ?>
                                                        <option value="<?= $sb['id_bidang']; ?>" <?= ($sb['id_bidang'] == $pegawai->id_bidang) ? 'selected' : ''; ?>><?= $sb['nama_bidang']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td class="text-bold-500">Jabatan</td>
                                            <td>:</td>
                                            <td><input type="text" class="form-control" name="jabatan_pegawai" value="<?= $pegawai->jabatan_pegawai; ?>"></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Alamat</td>
                                            <td>:</td>
                                            <td colspan="4">
                                                <textarea class="form-control" id="alamat_pegawai" name="alamat_pegawai" rows="4"><?= $pegawai->alamat_pegawai; ?></textarea>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><br>
                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                            <a href="<?= base_url('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang); ?>" class="btn btn-secondary me-1 mb-1">Kembali</a>

                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>


<script>
    function previewImgProfile() {
        const sampul = document.querySelector('#foto_pegawai');
        const sampulLabel = document.querySelector('.custom-file-labelProfile');
        const imgPreview = document.querySelector('.img-previewProfile');

        sampulLabel.textContent = sampul.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>