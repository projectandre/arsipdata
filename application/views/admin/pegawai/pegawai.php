<section class="section row">
    <div class="container-fluid">
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
                Tabel Pegawai
                <a class='btn btn-sm btn-info' style="float: right;" data-bs-toggle="modal" data-bs-target="#tambahPaket">Tambah Pegawai</a>
                <!-- <a class='btn btn-sm btn-warning' style="margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#tambahSoal">Tambah Soal</a> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Bidang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pegawai as $pg) :
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $pg['nama_pegawai']; ?></td>
                                    <td><?= $pg['nama_bidang']; ?></td>
                                    <td>
                                        <a class='btn btn-sm btn-primary' href='<?= base_url('admin/Pegawai/detail_pegawai/' . $pg['id_pegawai'] . '/' . $id_bidang); ?>'>Detail</a>
                                        <a onclick='return confirm("Apakah anda yakin mengedit data ini?")' class='btn btn-sm btn-outline-success' href='<?= base_url('admin/Pegawai/edit_pegawai/' . $pg['id_pegawai'] . '/' . $id_bidang); ?>'>Edit</a>
                                        <a onclick='return confirm("Apakah anda yakin menghapus data ini?")' class='btn btn-sm btn-outline-danger' href='<?= base_url('admin/Pegawai/delete_pegawai/' . $pg['id_pegawai'] . '/' . $id_bidang);  ?>'>Delete</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>



<!-- Modal Paket -->
<div class="modal fade" id="tambahPaket" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Pegawai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/Pegawai/tambah_pegawai'); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id_bidang_url" value="<?= $id_bidang; ?>">
                    <div class="mb-3">
                        <label for="nama_pegawai">Nama Lengkap *</label>
                        <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="nip_pegawai">NIP *</label>
                        <input type="number" name="nip_pegawai" id="nip_pegawai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_pegawai">Email *</label>
                        <input type="email" name="email_pegawai" id="email_pegawai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_kelamin_pegawai">Jenis Kelamin *</label>
                        <select class="form-select" name="jenis_kelamin_pegawai" id="jenis_kelamin_pegawai" required>
                            <option value="" selected disabled>Pilih Jenis Kelamin</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="alamat_pegawai" class="form-label">Alamat *</label>
                        <textarea class="form-control" id="alamat_pegawai" name="alamat_pegawai" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="id_bidang">Bidang *</label>
                        <select class="form-select" name="id_bidang" id="id_bidang" required>
                            <option value="" selected disabled>Pilih Bidang</option>
                            <?php foreach ($side_bidang as $sb) { ?>
                                <option value="<?= $sb['id_bidang']; ?>" <?= ($sb['id_bidang'] == $id_bidang) ? 'selected' : ''; ?>><?= $sb['nama_bidang']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan_pegawai">Jabatan *</label>
                        <input type="text" name="jabatan_pegawai" id="jabatan_pegawai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto_pegawai">Pas Foto</label>
                        <input type="file" class="form-control" name="foto_pegawai" id="foto_pegawai">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Close Paket -->