<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }

        $this->load->model('M_Pegawai');

        $this->load->model('M_Bidang');
        $data['side_bidang'] = $this->M_Bidang->tampil_data_bidang();
    }

    public function pegawai($id_bidang)
    {
        $data = array(
            'judul' => 'Data Pegawai',
            'page' => 'admin/pegawai/pegawai',
            'pegawai' => $this->M_Pegawai->tampil_data_pegawai($id_bidang),
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),
            'id_bidang' => $id_bidang
        );
        $this->load->view('tempApp', $data, false);
    }

    public function tambah_Pegawai()
    {
        $nama_pegawai = htmlspecialchars($this->input->post('nama_pegawai', true));
        $nip_pegawai = htmlspecialchars($this->input->post('nip_pegawai', true));
        $email_pegawai = htmlspecialchars($this->input->post('email_pegawai', true));
        $jenis_kelamin_pegawai = htmlspecialchars($this->input->post('jenis_kelamin_pegawai', true));
        $alamat_pegawai = htmlspecialchars($this->input->post('alamat_pegawai', true));
        $jabatan_pegawai = htmlspecialchars($this->input->post('jabatan_pegawai', true));
        $foto_pegawai = $_FILES['foto_pegawai'];


        $id_bidang = htmlspecialchars($this->input->post('id_bidang', true));
        $id_bidang_url = htmlspecialchars($this->input->post('id_bidang_url', true));

        if ($foto_pegawai = '' || $foto_pegawai = null) {
            $data = array(
                'nama_pegawai' => $nama_pegawai,
                'nip_pegawai' => $nip_pegawai,
                'email_pegawai' => $email_pegawai,
                'jenis_kelamin_pegawai' => $jenis_kelamin_pegawai,
                'alamat_pegawai' => $alamat_pegawai,
                'jabatan_pegawai' => $jabatan_pegawai,
                'id_bidang' => $id_bidang
            );

            $this->M_Pegawai->tambah_pegawai($data);
            $this->session->set_flashdata('pesan',  '<div class="alert alert-success">Berhasil, pas foto tidak berhasil ditambah !!</div>');
            redirect('admin/Pegawai/pegawai/' . $id_bidang_url);
        } else {
            $config['upload_path'] = './uploads';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto_pegawai')) {
                $data = array(
                    'nama_pegawai' => $nama_pegawai,
                    'nip_pegawai' => $nip_pegawai,
                    'email_pegawai' => $email_pegawai,
                    'jenis_kelamin_pegawai' => $jenis_kelamin_pegawai,
                    'alamat_pegawai' => $alamat_pegawai,
                    'jabatan_pegawai' => $jabatan_pegawai,
                    'id_bidang' => $id_bidang
                );

                $this->M_Pegawai->tambah_pegawai($data);
                $this->session->set_flashdata('pesan',  '<div class="alert alert-success">Berhasil, Pas foto tidak berhasil di upload !! Silahkan gunakan tipe gambar jpg, jpeg, png, atau gif</div>');
                redirect('admin/Pegawai/pegawai/' . $id_bidang_url);
            } else {
                $foto_pegawai = $this->upload->data('file_name');

                $data = array(
                    'nama_pegawai' => $nama_pegawai,
                    'nip_pegawai' => $nip_pegawai,
                    'email_pegawai' => $email_pegawai,
                    'jenis_kelamin_pegawai' => $jenis_kelamin_pegawai,
                    'alamat_pegawai' => $alamat_pegawai,
                    'jabatan_pegawai' => $jabatan_pegawai,
                    'foto_pegawai' => $foto_pegawai,
                    'id_bidang' => $id_bidang
                );

                $this->M_Pegawai->tambah_pegawai($data);
                $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Pegawai Berhasil Ditambah !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

                redirect('admin/Pegawai/pegawai/' . $id_bidang_url);
            }
        }
    }

    public function delete_pegawai($id_pegawai, $id_bidang)
    {

        $pegawai = $this->M_Pegawai->detail_pegawai($id_pegawai);
        if ($pegawai->foto_pegawai != "") {
            unlink('./uploads/' . $pegawai->foto_pegawai);
        }

        $data = array(
            'id_pegawai' => $id_pegawai,
        );
        $this->M_Pegawai->hapus_pegawai($data);
        $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Pegawai Berhasil Dihapus !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/Pegawai/pegawai/' . $id_bidang);
    }

    public function edit_pegawai($id_pegawai, $id_bidang)
    {

        $data = array(
            'judul' => 'Edit Data Pegawai',
            'page' => 'admin/pegawai/edit_pegawai',
            'pegawai' => $this->M_Pegawai->detail_pegawai($id_pegawai),
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),
            'id_bidang' => $id_bidang,
            'id_pegawai' => $id_pegawai

        );
        $this->load->view('tempApp', $data, false);
    }

    public function update_pegawai($id_pegawai, $id_bidang_url)
    {

        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        $this->form_validation->set_rules('nip_pegawai', 'NIP Pegawai', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        $this->form_validation->set_rules('email_pegawai', 'Email Pegawai', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        $this->form_validation->set_rules('jenis_kelamin_pegawai', 'Jenis Kelamin Pegawai', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        $this->form_validation->set_rules('jabatan_pegawai', 'Jabatan Pegawai', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        $this->form_validation->set_rules('alamat_pegawai', 'Alamat Pegawai', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));

        $this->form_validation->set_rules('id_bidang', 'Nama Bidang', 'required', array(
            'required' => 'Nama Bidang Wajib Diisi !'
        ));

        if ($this->form_validation->run() == false) {
            $data = array(
                'judul' => 'Edit Data Pegawai',
                'page' => 'admin/pegawai/edit_pegawai',
                'pegawai' => $this->M_Pegawai->detail_pegawai($id_pegawai),
                'side_bidang' => $this->M_Bidang->tampil_data_bidang(),
                'id_bidang' => $id_bidang_url
            );
            $this->load->view('tempApp', $data, false);
        } else {
            $nama_pegawai = htmlspecialchars($this->input->post('nama_pegawai', true));
            $nip_pegawai = htmlspecialchars($this->input->post('nip_pegawai', true));
            $email_pegawai = htmlspecialchars($this->input->post('email_pegawai', true));
            $jenis_kelamin_pegawai = htmlspecialchars($this->input->post('jenis_kelamin_pegawai', true));
            $jabatan_pegawai = htmlspecialchars($this->input->post('jabatan_pegawai', true));
            $alamat_pegawai = htmlspecialchars($this->input->post('alamat_pegawai', true));
            $foto_pegawai = $_FILES['foto_pegawai'];



            $id_bidang = htmlspecialchars($this->input->post('id_bidang', true));


            if ($foto_pegawai = '') {
            } else {
                $config['upload_path'] = './uploads';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('foto_pegawai')) {
                    $data = array(
                        'id_pegawai' => $id_pegawai,
                        'nama_pegawai' => $nama_pegawai,
                        'nip_pegawai' => $nip_pegawai,
                        'email_pegawai' => $email_pegawai,
                        'jenis_kelamin_pegawai' => $jenis_kelamin_pegawai,
                        'jabatan_pegawai' => $jabatan_pegawai,
                        'alamat_pegawai' => $alamat_pegawai,
                        'id_bidang' => $id_bidang,
                    );

                    $this->M_Pegawai->update_pegawai($data);

                    // Data berhasil diubah di db
                    $this->session->set_flashdata('pesan',  '<div class="alert alert-success">Data pegawai berhasil diubah !!</div>');
                    redirect('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang_url);
                } else {
                    $foto = $this->M_Pegawai->detail_pegawai($id_pegawai);
                    if ($foto->foto_pegawai != "") {
                        unlink('./uploads/' . $foto->foto_pegawai);
                    }
                    $foto_pegawai = $this->upload->data('file_name');

                    $data = array(
                        'id_pegawai' => $id_pegawai,
                        'nama_pegawai' => $nama_pegawai,
                        'nip_pegawai' => $nip_pegawai,
                        'email_pegawai' => $email_pegawai,
                        'jenis_kelamin_pegawai' => $jenis_kelamin_pegawai,
                        'jabatan_pegawai' => $jabatan_pegawai,
                        'alamat_pegawai' => $alamat_pegawai,
                        'id_bidang' => $id_bidang,
                        'foto_pegawai' => $foto_pegawai,

                    );

                    $this->M_Pegawai->update_pegawai($data);
                    $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Data pegawai berhasil diubah !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    redirect('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang_url);
                }
            }
        }
    }

    public function detail_pegawai($id_pegawai, $id_bidang)
    {

        $data = array(
            'judul' => 'Detail Data Pegawai',
            'page' => 'admin/pegawai/detail_pegawai',
            'pegawai' => $this->M_Pegawai->detail_pegawai($id_pegawai),
            'pegawai_file' => $this->M_Pegawai->tampil_file_pegawai($id_pegawai),
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),
            'id_bidang' => $id_bidang
        );
        $this->load->view('tempApp', $data, false);
    }


    public function tambah_file_Pegawai($id_pegawai, $id_bidang)
    {
        $nama_file = htmlspecialchars($this->input->post('nama_file', true));
        $file_pegawai = $_FILES['file_pegawai'];


        if ($file_pegawai = '' || $file_pegawai = null) {
            $data = array(
                'nama_file' => $nama_file,
                'id_pegawai' => $id_pegawai
            );

            $this->M_Pegawai->tambah_file_pegawai($data);
            $this->session->set_flashdata('pesan',  '<div class="alert alert-success">Berhasil, dokumen tidak berhasil ditambah !!</div>');
            redirect('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang);
        } else {
            $config['upload_path'] = './dokumen';
            $config['allowed_types'] = 'pdf';

            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file_pegawai')) {
                $data = array(
                    'nama_file' => $nama_file,
                    'file_pegawai' => $file_pegawai,
                    'id_pegawai' => $id_pegawai
                );

                $this->M_Pegawai->tambah_file_pegawai($data);
                $this->session->set_flashdata('pesan',  '<div class="alert alert-success">Berhasil, dokumen tidak berhasil di upload !! Silahkan gunakan tipe file pdf.</div>');
                redirect('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang);
            } else {
                $file_pegawai = $this->upload->data('file_name');

                $data = array(
                    'nama_file' => $nama_file,
                    'file_pegawai ' => $file_pegawai,
                    'id_pegawai' => $id_pegawai
                );

                $this->M_Pegawai->tambah_file_pegawai($data);
                $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Data dokumen Berhasil Ditambah !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');

                redirect('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang);
            }
        }
    }

    public function hapus_file_pegawai($id_file, $id_pegawai, $id_bidang)
    {

        $file_pegawai = $this->M_Pegawai->detail_file_pegawai($id_file);
        if ($file_pegawai->file_pegawai != "") {
            unlink('./dokumen/' . $file_pegawai->file_pegawai);
        }

        $data = array(
            'id_file' => $id_file,
        );
        $this->M_Pegawai->hapus_file_pegawai($data);
        $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Dokumen Berhasil Dihapus !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang);
    }

    public function lihat_file_pegawai()
    {
        $this->load->library('Pdf');

        // cek apakah ada session yang sudah masuk
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('MLayanan');
        $pdf->SetTitle('File Dokumen');
        // $pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->setMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->SetAuthor('MPegawai');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // $html = view('Admin/Layanan/print_permohonan_domain', $data);
        // $html = $this->view->render('Admin/Layanan/print_layanan_domain');

        // $pdf->writeHTML(null, true, false, true, false, '');
        // $this->response->setContentType('application/pdf'); //untuk validasi tampilan berupa file pdf
        // $pdfFiles = glob('./dokumen/*.pdf'); // Make sure your path is correct

        // // Merge PDF files
        // foreach ($pdfFiles as $file) {
        //     $pdf->AddPage();
        //     $page = $pdf->importPage(1);
        //     $pdf->useTemplate($page);
        // }

        $pdf->Output('surat permohonan domain.pdf', 'I'); //menampilkan pdf
    }

    public function edit_file_pegawai($id_file, $id_pegawai, $id_bidang)
    {

        $data = array(
            'judul' => 'Edit Data File Pegawai',
            'page' => 'admin/pegawai/edit_file_pegawai',
            'pegawai_file' => $this->M_Pegawai->detail_file_pegawai($id_file),
            'side_bidang' => $this->M_Bidang->tampil_data_bidang(),
            'id_bidang' => $id_bidang,
            'id_pegawai' => $id_pegawai

        );
        $this->load->view('tempApp', $data, false);
    }

    public function update_file_pegawai($id_file, $id_pegawai, $id_bidang_url)
    {

        $this->form_validation->set_rules('nama_file', 'Nama File', 'required', array(
            'required' => '%s Wajib Diisi !'
        ));


        if ($this->form_validation->run() == false) {
            $data = array(
                'judul' => 'Edit Data File Pegawai',
                'page' => 'admin/pegawai/edit_file_pegawai',
                'pegawai_file' => $this->M_Pegawai->detail_file_pegawai($id_file),
                'side_bidang' => $this->M_Bidang->tampil_data_bidang(),
                'id_bidang' => $id_bidang_url,
                'id_pegawai' => $id_pegawai
            );
            $this->load->view('tempApp', $data, false);
        } else {
            $nama_file = htmlspecialchars($this->input->post('nama_file', true));

            $file_pegawai = $_FILES['file_pegawai'];

            if ($file_pegawai = '') {
            } else {
                $config['upload_path'] = './dokumen';
                $config['allowed_types'] = 'pdf';

                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file_pegawai')) {
                    $data = array(
                        'id_file' => $id_file,
                        'nama_file' => $nama_file,
                    );

                    $this->M_Pegawai->update_file_pegawai($data);

                    // Data berhasil diubah di db
                    $this->session->set_flashdata('pesan',  '<div class="alert alert-success">Data file pegawai berhasil diubah !!</div>');
                    redirect('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang_url);
                } else {
                    $pegawai_file = $this->M_Pegawai->detail_file_pegawai($id_file);
                    if ($pegawai_file->file_pegawai != "") {
                        unlink('./dokumen/' . $pegawai_file->file_pegawai);
                    }
                    $file_pegawai = $this->upload->data('file_name');

                    $data = array(
                        'id_file' => $id_file,
                        'nama_file' => $nama_file,
                        'file_pegawai' => $file_pegawai,
                    );

                    $this->M_Pegawai->update_file_pegawai($data);
                    $this->session->set_flashdata('pesan',  '<div class="alert alert-success alert-dismissible fade show" role="alert">Data file pegawai berhasil diubah !!   <button type="button" style="color : white;" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    redirect('admin/Pegawai/detail_pegawai/' . $id_pegawai . '/' . $id_bidang_url);
                }
            }
        }
    }


    public function download_all_file($id_pegawai, $nama_pegawai)
    {
        $this->load->library('zip');
        $this->load->helper('download');
        $this->load->helper('file');

        // Load the model to fetch the file names or paths from the database
        $file_pegawai = $this->M_Pegawai->detail_xfile_pegawai($id_pegawai);

        // Directory path where the PDF files are stored
        $pdf_folder = './dokumen/';

        // Create a temporary file to store the zip
        $zip_name = $nama_pegawai . '.zip';

        // Loop through the files and add them to the zip
        foreach ($file_pegawai as $file) {
            $file_path = $pdf_folder . $file->file_pegawai; // Adjust the path to your actual filename column in the database
            if (file_exists($file_path)) {
                $this->zip->read_file($file_path);
            }
        }

        // Save the zip file
        $this->zip->archive($zip_name);

        // Force download the zip file
        force_download($zip_name, NULL);
    }


    public function lihat_dtfile_pegawai($id_file)
    {
        $this->load->library('Pdf');

        $file_pegawai = $this->M_Pegawai->detail_file_pegawai($id_file);


        // cek apakah ada session yang sudah masuk
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator('MLayanan');
        $pdf->SetTitle('File Dokumen');
        $pdf->setHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->setFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->setMargins(PDF_MARGIN_LEFT, 20, PDF_MARGIN_RIGHT);
        $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $pdf->SetAuthor('MPegawai');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        $pdf_path = './dokumen/' . $file_pegawai->file_pegawai;

        if (file_exists($pdf_path)) {
            // Set header untuk menampilkan sebagai file PDF
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $file_pegawai->nama_file . '.pdf' . '"');

            // Outputkan isi file PDF langsung ke output (browser)
            readfile($pdf_path);
        } else {
            // Handle jika file PDF tidak ditemukan
            echo "File PDF tidak ditemukan.";
        }
    }
}
