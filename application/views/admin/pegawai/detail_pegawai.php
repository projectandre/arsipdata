<section class="row">
    <div class="container-fluid">
        <div class="col-md- col-12">
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
                    <h4 class="card-title">Detail Data Pegawai</h4>
                    <div class="text-center">
                        <?php if ($pegawai->foto_pegawai == '' || $pegawai->foto_pegawai == null) { ?>
                            <img src="<?= base_url('uploads/'); ?>default.png" alt="Photo Profile" width="170" class="img-thumbnail rounded-circle">
                        <?php } else { ?>
                            <img src="<?= base_url('uploads/'); ?><?= $pegawai->foto_pegawai; ?>" alt="Photo Profile" width="170" class="img-thumbnail rounded-circle">
                        <?php } ?>
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
                                            <td><?= $pegawai->nama_pegawai; ?></td>
                                            <td class="text-bold-500">NIP</td>
                                            <td>:</td>
                                            <td><?= $pegawai->nip_pegawai; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Email</td>
                                            <td>:</td>
                                            <td><?= $pegawai->email_pegawai; ?></td>
                                            <td class="text-bold-500">Jenis Kelamin</td>
                                            <td>:</td>
                                            <td><?= $pegawai->jenis_kelamin_pegawai; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Bidang</td>
                                            <td>:</td>
                                            <td><?= $pegawai->nama_bidang; ?></td>
                                            <td class="text-bold-500">Jabatan</td>
                                            <td>:</td>
                                            <td><?= $pegawai->jabatan_pegawai; ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Alamat</td>
                                            <td>:</td>
                                            <td colspan="4"><?= $pegawai->alamat_pegawai; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><br>
                            <a href="<?= base_url('admin/Pegawai/edit_pegawai/' . $pegawai->id_pegawai . '/' . $id_bidang); ?>" class="btn btn-primary">Ubah Data Pegawai</a>


                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    Tabel Detail File Pegawai
                    <a class='btn btn-sm btn-info' style="margin-left: 10px; float: right;" data-bs-toggle="modal" data-bs-target="#tambahTO">Tambah File</a>
                    <a href="<?= base_url('admin/Pegawai/download_all_file/' . $pegawai->id_pegawai . '/' . $pegawai->nama_pegawai); ?>" class='btn btn-sm btn-danger <?= $pegawai_file == false ? 'disabled' : ''; ?>' style="margin-left: 10px; float: right;" target="_blank">Cetak ZIP</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama File</th>
                                    <th>File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pegawai_file as $pf) :
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $pf['nama_file']; ?></td>
                                        <td><a href="<?= base_url('admin/Pegawai/lihat_dtfile_pegawai/' . $pf['id_file']); ?>" target="_blank" style="text-decoration: none;"><?= $pf['file_pegawai']; ?></a></td>
                                        <td>
                                            <a onclick='return confirm("Apakah anda yakin mengedit data ini?")' class='btn btn-sm btn-outline-success' href='<?= base_url('admin/Pegawai/edit_file_pegawai/' . $pf['id_file'] . '/' . $pegawai->id_pegawai . '/' . $id_bidang); ?>'>Edit</a>
                                            <a onclick='return confirm("Apakah anda yakin menghapus data ini?")' class='btn btn-sm btn-outline-danger' href='<?= base_url('admin/Pegawai/hapus_file_pegawai/' . $pf['id_file'] . '/' . $pegawai->id_pegawai . '/' . $id_bidang);  ?>'>Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal -->
<div class="modal fade" id="tambahTO" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/Pegawai/tambah_file_Pegawai/' . $pegawai->id_pegawai . '/' . $id_bidang); ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama_file">Nama File</label>
                        <input type="text" name="nama_file" id="nama_file" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="file_pegawai">File Pegawai</label>
                        <input type="file" class="form-control" name="file_pegawai" id="file_pegawai" accept=".pdf">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>