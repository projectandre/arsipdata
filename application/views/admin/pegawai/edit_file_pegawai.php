<div class="row">
    <div class="col-10">
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
            <div class="card-body">
                <form action="<?= base_url('admin/Pegawai/update_file_pegawai/' . $pegawai_file->id_file . '/' . $id_pegawai . '/' . $id_bidang); ?>" method="post" class="form form-horizontal" enctype="multipart/form-data">
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <tbody>
                                <tr>
                                    <td class="text-bold-500">Nama File</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" id="nama_file" class="form-control" name="nama_file" placeholder="Nama File" value="<?= $pegawai_file->nama_file; ?>">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-bold-500">File</td>
                                    <td>:</td>
                                    <td>
                                        <div class="form-group">
                                            <input type="hidden" name="file_pegawai_lama" value="<?= $pegawai_file->file_pegawai;  ?>"><br>
                                            <input type="file" class="form-control" name="file_pegawai" id="file_pegawai" accept=".pdf" onchange="previewFile()">
                                            <label class="custom-file-labelFile" for="file_pegawai">File : <?= $pegawai_file->file_pegawai;  ?></label>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
                    <a href="<?= base_url('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang); ?>" class="btn btn-secondary me-1 mb-1">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>


<script>
    function previewFile() {
        const sampul = document.querySelector('#file_pegawai');
        const sampulLabel = document.querySelector('.custom-file-labelFile');
        // const imgPreview = document.querySelector('.img-previewProfile');

        sampulLabel.textContent = sampul.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);

        // fileSampul.onload = function(e) {
        //     imgPreview.src = e.target.result;
        // }
    }
</script>