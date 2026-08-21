<?php
class Halal_model extends CI_Model
{
    public function Transaksi_NIB()
    {
        $today_start = date('Y-m-d 00:00:00');
        $today_end   = date('Y-m-d 23:59:59');

        $this->datatables->select('id, nib, ppph, noTelepon, source_image, user, namaPU, nik, produk1, produk2, created_at, qc');

        $email_user = $this->session->userdata('email');
        $referal = $this->session->userdata('referal');
        $this->datatables->from('jobdesk');
        $this->datatables->where('user', $email_user);
        $this->datatables->where('id_referal', $referal);
        // $this->datatables->where("created_at BETWEEN '$today_start' AND '$today_end'");
        // Pastikan order_by diletakkan sebelum generate
        $this->db->order_by('id', 'DESC');
        return $this->datatables->generate();
    }

    public function get_sppl_datatables()
    {
        // 1. Pilih kolom yang diperlukan
        $this->datatables->select('id, no_sppl, namaPU, noTelepon, created_date, noNIB, nomorNKU');
        $this->datatables->from('sppl');
        $email_user = $this->session->userdata('email');
        $this->datatables->where('created_by', $email_user);

        // 3. Tambahkan kolom aksi
        // Perbaikan: Ganti #1 menjadi $1 agar ID terisi otomatis
        $this->datatables->add_column('aksi', '
        <button type="button" class="btn btn-sm btn-info btn-view" data-id="$1">
            <i class="fas fa-eye"></i> Detail
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="$1">
            <i class="fa fa-trash"></i> Hapus
        </button>
        <button type="button" class="btn btn-sm btn-info btn-print" data-id="$1">
            <i class="fas fa-print"></i> Print SPPL
        </button>
    ', 'id');
        $this->db->order_by('id DESC');
        return $this->datatables->generate();
    }

    public function getById($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('jobdesk')
            ->row();
    }

    public function format_action($table, $action)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($action, '1');
        $this->db->order_by('urut', 'ASC');
        $query = $this->db->get();
        return $query;
    }

    public function get_daftar_pu()
    {
        $this->datatables->select('id,userP3H,namaPU,alamat,noHP,nik,email,pass,tempatUsahaName,tempatUsahaAlamat,provinsi_id,provinsi_nama,kabupaten_id,kabupaten_nama,kecamatan_id,kecamatan_nama,kelurahan_id,kelurahan_nama,kodepos,fotoKtp,fotoProduk1,fotoProduk2,fotoProduk3,VideoProduk,fotoVerval,fotoProduk4,fotoProduk5,fotoProduk6,fotoProduk7,nameProduk1,nameProduk2,nameProduk3,nameProduk4,nameProduk5,nameProduk6,nameProduk7');
        $this->datatables->from('pemilikusaha');
        $email_user = $this->session->userdata('email');
        $this->datatables->where('userP3H', $email_user);
        $this->datatables->add_column('aksi', '
        <button type="button" class="btn btn-sm btn-info btn-view" data-id="$1">
            <i class="fas fa-eye"></i> Detail
        </button>
        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="$1">
            <i class="fa fa-trash"></i> Hapus
        </button>
        <button type="button" class="btn btn-sm btn-info btn-print" data-id="$1">
            <i class="fas fa-print"></i> Print PU
        </button>
    ', 'id');
        $this->db->order_by('id DESC');
        return $this->datatables->generate();
    }
}
