<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
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
        $data['title'] = 'Master Daftar Produk';

        // Mengambil data dari tabel 'Umkm'
        $data['Produk'] = $this->User_model->fetch_data('produk')->result();

        // Menggunakan library template Anda
        $this->template->load('Produk/index', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Produk';

        // Validasi Form
        $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan form tambah
            $this->template->load('Produk/tambah', $data);
        } else {
            // Jika validasi berhasil, simpan data ke database
            $data_produk = [
                'nama_produk' => $this->input->post('nama_produk'),
                'harga' => $this->input->post('harga'),
                'deskripsi' => $this->input->post('deskripsi')
            ];

            $this->User_model->insert_data('Produk', $data_produk);
            redirect('Produk');
        }
    }


}