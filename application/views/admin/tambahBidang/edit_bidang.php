<section class="row">
    <div class="container-fluid">
        <div class="col-md-6 col-12">
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
                    <h4 class="card-title">Form Edit Bidang</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form form-horizontal" action="<?= base_url('admin/Bidang/update_bidang/' . $jenis->id_bidang); ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Bidang</label>
                                    </div>

                                    <div class="col-md-8 form-group">
                                        <input type="text" id="nama_bidang" class="form-control" name="nama_bidang" placeholder="Nama Bidang" value="<?= $jenis->nama_bidang; ?>">
                                        <br><br>
                                    </div>

                                    <div class=" col-sm-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <a href="<?= base_url('admin/Bidang'); ?>" class="btn btn-secondary me-1 mb-1">Kembali</a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>