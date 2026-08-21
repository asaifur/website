<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Proteksi Halaman
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
        $this->load->model('User_model');
    }

    // READ: Menampilkan Data
    public function index()
    {
        $data['title'] = 'Master Agenda Kegiatan';

        // Mengambil data dari tabel 'kegiatan'
        $data['kegiatan'] = $this->User_model->fetch_data('kegiatan')->result();

        // Menggunakan library template Anda
        $this->template->load('kegiatan/index', $data);
    }

    // CREATE: Tambah Data
    public function tambahKegiatan($action)
    {

        $data['action'] = $action;
        $data['format'] = $this->User_model->format_action('format_kegiatan', $action)->result();

        if ($action <> "insert") {
            $id = $this->input->post('id');
            $data['dtKolom'] = $this->User_model->fetch_data('kegiatan', ['id_kegiatan' => $id])->row();
        }
        $this->load->view('kegiatan/tambahKegiatan', $data);
    }

    // UPDATE: Ubah Data
    public function ubah()
    {
        $id_kegiatan = $this->input->post('id_kegiatan');
        $data = [
            'nama_kegiatan' => $this->input->post('nama_kegiatan'),
            'tanggal'       => $this->input->post('tanggal'),
            'lokasi'        => $this->input->post('lokasi'),
            'kuota'         => $this->input->post('kuota'),
            'status'        => $this->input->post('status')
        ];

        $this->db->where('id_kegiatan', $id_kegiatan);
        $this->db->update('kegiatan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-info"></i> Sukses!</h5> Data kegiatan berhasil diperbarui.</div>');
        redirect('kegiatan');
    }

    // DELETE: Hapus Data
    public function hapus($id)
    {
        $this->db->where('id_kegiatan', $id);
        $this->db->delete('kegiatan');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h5><i class="icon fas fa-ban"></i> Dihapus!</h5> Data kegiatan telah dihapus.</div>');
        redirect('kegiatan');
    }

    public function insertKegiatanAction()
    {
        $action = $this->input->post('action');


        $data = [];
        $format = $this->Halal_model->format_action('format_kegiatan', $action)->result();
        foreach ($format as $kolom) {

            // FILE
            if ($kolom->type == "FILE") {
                $config['upload_path']   = './assets/uploads/';
                $config['allowed_types'] = 'pdf|jpg|png|jpeg';
                $config['max_size']      = 2048; // 2MB
                $config['file_name']     = 'ACA-' . time();

                $this->load->library('upload', $config);

                $file_name = '';

                if (!empty($_FILES['file']['name'])) {
                    if ($this->upload->do_upload('file')) {
                        $file_name = $this->upload->data('file_name');
                    } else {
                        echo json_encode([
                            'status'  => false,
                            'message' => $this->upload->display_errors()
                        ]);
                        return;
                    }
                }
                $data[$kolom->code] = $file_name;
            }

            // USER LOGIN
            else if ($kolom->type == "USER") {
                $data[$kolom->code] = $_SESSION['email'];
            } else if ($kolom->type == "DATETIME") {
                $data[$kolom->code] = date('Y-m-d H:i:s');
            }

            // INPUT BIASA
            else {
                $data[$kolom->code] = $this->input->post($kolom->code);
            }
        }
        if ($action == "insert") {

            $proses = $this->User_model->insertData('kegiatan', $data);
        } else if ($action == "update") {

            $where = ['id_kegiatan' => $this->input->post('id_kegiatan')];

            $proses = $this->User_model->updateData('kegiatan', $data, $where);
        } else if ($action == "delete") {

            $where = ['id_kegiatan' => $this->input->post('id_kegiatan')];

            $proses = $this->User_model->deleteData('kegiatan', $where);
        }
        if ($proses) {
            echo json_encode([
                'status'  => true,
                'message' => 'Data berhasil diproses'
            ]);
        } else {
            echo json_encode([
                'status'  => false,
                'message' => 'Gagal memproses data'
            ]);
        }
    }
}
