<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('email')) {

            redirect('auth');
        }
    }

    // Menampilkan halaman utama manajemen penjualan
    public function index()
    {
        $data['title'] = " Penjualan Harian";
        $data['no_faktur_otomatis'] = $this->Penjualan_model->generate_faktur();
        $data['barang'] = $this->db->get('master_barang')->result_array();

        // Panggil view Anda (sesuaikan dengan struktur template header/footer Anda)
        $this->template->load('penjualan/v_penjualan', $data);
    }

    // Mendapatkan semua list penjualan (API DataTables / List)
    public function get_all_data()
    {
        $data = $this->Penjualan_model->get_all_penjualan();
        echo json_encode($data);
    }

    // Mendapatkan detail satu transaksi untuk diedit
    public function get_detail($no_faktur)
    {
        $this->db->where('no_faktur', $no_faktur);
        $penjualan = $this->db->get('penjualan')->row_array();
        $detail = $this->Penjualan_model->get_detail_penjualan($no_faktur);

        echo json_encode([
            'penjualan' => $penjualan,
            'detail' => $detail
        ]);
    }

    // Proses Tambah / Simpan Penjualan
    public function simpan()
    {
        $no_faktur   = $this->Penjualan_model->generate_faktur(); // Mengambil faktur terbaru secara realtime
        $total_bayar = $this->input->post('total_bayar');
        $nominal_uang = $this->input->post('nominal_uang');
        $kembalian   = $this->input->post('kembalian');
        $cart        = $this->input->post('cart'); // Array barang dari JavaScript
        $jenis_transaksi = $this->input->post('jenis_transaksi');

        // Kalkulasi Jatuh Tempo Otomatis
        $tanggal_sekarang = date('Y-m-d H:i:s');
        $jatuh_tempo      = NULL;

        if ($jenis_transaksi == 'tempo_2_minggu') {
            $jatuh_tempo = date('Y-m-d', strtotime('+2 weeks'));
        } else if ($jenis_transaksi == 'tempo_1_bulan') {
            $jatuh_tempo = date('Y-m-d', strtotime('+1 month'));
        }

        $data_penjualan = [
            'no_faktur'   => $no_faktur,
            'tanggal'     => date('Y-m-d H:i:s'),
            'total_bayar' => $total_bayar,
            'nominal_uang' => $nominal_uang,
            'kembalian'   => $kembalian,
            'jenis_transaksi' => $jenis_transaksi, // <--- TAMBAHAN
            'jatuh_tempo'     => $jatuh_tempo
        ];

        $data_detail = [];
        foreach ($cart as $item) {
            $data_detail[] = [
                'no_faktur'   => $no_faktur,
                'kode_barang' => $item['kode_barang'],
                'nama_barang' => $item['nama_barang'],
                'harga'       => $item['harga'],
                'qty'         => $item['qty'],
                'subtotal'    => $item['subtotal']
            ];
        }

        $simpan = $this->Penjualan_model->simpan_transaksi($data_penjualan, $data_detail);

        if ($simpan) {
            echo json_encode(['status' => true, 'msg' => 'Transaksi berhasil disimpan!', 'no_faktur' => $no_faktur]);
        } else {
            echo json_encode(['status' => false, 'msg' => 'Gagal menyimpan transaksi.']);
        }
    }

    // Proses Update Penjualan
    public function update()
    {
        $no_faktur       = $this->input->post('no_faktur');
        $total_bayar     = $this->input->post('total_bayar');
        $nominal_uang   = $this->input->post('nominal_uang');
        $kembalian       = $this->input->post('kembalian');
        $jenis_transaksi = $this->input->post('jenis_transaksi'); // <--- Tangkap input jenis_transaksi
        $cart            = $this->input->post('cart');

        // Kalkulasi ulang tanggal jatuh tempo berdasarkan jenis transaksi
        $jatuh_tempo = NULL;
        if ($jenis_transaksi == 'tempo_2_minggu') {
            $jatuh_tempo = date('Y-m-d', strtotime('+2 weeks'));
        } else if ($jenis_transaksi == 'tempo_1_bulan') {
            $jatuh_tempo = date('Y-m-d', strtotime('+1 month'));
        }

        $data_penjualan = [
            'total_bayar'     => $total_bayar,
            'nominal_uang'   => $nominal_uang,
            'kembalian'       => $kembalian,
            'jenis_transaksi' => $jenis_transaksi, // <--- Tambahkan ke array update
            'jatuh_tempo'     => $jatuh_tempo      // <--- Tambahkan ke array update
        ];

        $data_detail = [];
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $data_detail[] = [
                    'no_faktur'   => $no_faktur,
                    'kode_barang' => $item['kode_barang'],
                    'nama_barang' => $item['nama_barang'],
                    'harga'       => $item['harga'],
                    'qty'         => $item['qty'],
                    'subtotal'    => $item['subtotal']
                ];
            }
        }

        $update = $this->Penjualan_model->update_transaksi($no_faktur, $data_penjualan, $data_detail);

        if ($update) {
            echo json_encode([
                'status'    => true,
                'msg'       => 'Transaksi ' . $no_faktur . ' berhasil diperbarui!',
                'no_faktur' => $no_faktur
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'msg'    => 'Gagal memperbarui transaksi.'
            ]);
        }
    }

    // Proses Delete Penjualan
    public function hapus($no_faktur)
    {
        $hapus = $this->Penjualan_model->hapus_transaksi($no_faktur);
        if ($hapus) {
            echo json_encode(['status' => true, 'msg' => 'Transaksi berhasil dihapus!']);
        } else {
            echo json_encode(['status' => false, 'msg' => 'Gagal menghapus transaksi.']);
        }
    }
    // Tambah endpoint ini ke dalam class Penjualan Anda
    public function simpan_master_produk()
    {
        // 1. Ambil Input Data Master Produk
        $kode      = $this->input->post('kode_barang');
        $nama      = $this->input->post('nama_barang');
        $jenis     = $this->input->post('jenis');
        $kategori  = $this->input->post('kategori');
        $merk      = $this->input->post('merk');
        $satuan    = $this->input->post('satuan');
        $hbeli     = $this->input->post('harga_beli');
        $hjual     = $this->input->post('harga');
        $bpom      = $this->input->post('no_bpom');
        $tgl_bpom  = $this->input->post('tgl_berlaku_bpom');
        $pabrik    = $this->input->post('pabrik');
        $komposisi = $this->input->post('komposisi');
        $is_active = $this->input->post('is_active');

        // 2. Ambil Input Data Batch Awal
        $no_batch     = $this->input->post('no_batch');
        $stok_batch   = $this->input->post('stok_batch');
        $tgl_produksi = $this->input->post('tgl_produksi');
        $tgl_expired  = $this->input->post('tgl_kadaluarsa');

        if (empty($kode) || empty($nama) || empty($no_batch) || empty($tgl_expired)) {
            echo json_encode(['status' => false, 'msg' => 'Gagal! Kolom Utama (Nama, Batch & Kadaluarsa) wajib diisi!']);
            return;
        }

        // Mulai DB Transaction CI3 agar jika salah satu tabel gagal, data dicancel otomatis
        $this->db->trans_begin();

        // Insert ke tabel master_barang
        $data_barang = [
            'kode_barang'      => $kode,
            'nama_barang'      => $nama,
            'jenis'            => $jenis,
            'kategori'         => (!empty($kategori)) ? $kategori : null,
            'merk'             => (!empty($merk)) ? $merk : null,
            'satuan'           => $satuan,
            'harga_beli'       => $hbeli,
            'harga'            => $hjual,
            'no_bpom'          => (!empty($bpom)) ? $bpom : null,
            'tgl_berlaku_bpom' => (!empty($tgl_bpom)) ? $tgl_bpom : null,
            'pabrik'           => (!empty($pabrik)) ? $pabrik : null,
            'komposisi'        => (!empty($komposisi)) ? $komposisi : null,
            'is_active'        => $is_active
        ];
        $this->db->insert('master_barang', $data_barang);

        // Insert ke tabel barang_batch
        $data_batch = [
            'kode_barang'    => $kode,
            'no_batch'       => $no_batch,
            'tgl_produksi'   => (!empty($tgl_produksi)) ? $tgl_produksi : null,
            'tgl_kadaluarsa' => $tgl_expired,
            'stok_batch'     => $stok_batch
        ];
        $this->db->insert('barang_batch', $data_batch);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode(['status' => false, 'msg' => 'Gagal menyimpan rekaman data kompleks produk.']);
        } else {
            $this->db->trans_commit();
            echo json_encode(['status' => true, 'msg' => 'Produk Alkes/Farmasi & Batch Berhasil Didaftarkan!']);
        }
    }
    // Tambahkan endpoint ini ke dalam class Penjualan Anda
    public function generate_kode_barang()
    {
        $kode_baru = $this->Penjualan_model->generate_kode_barang_otomatis();

        echo json_encode([
            'status' => true,
            'kode_otomatis' => $kode_baru
        ]);
    }
    // 1. Fungsi render view master barang utama
    public function master_barang()
    {
        $data['title'] = "Manajemen Master Barang";
        $data['barang'] = $this->db->get('master_barang')->result_array();


        // Memuat layout template view khusus master barang
        $this->template->load('penjualan/v_master_barang', $data);
    }

    // Mengubah nama function dari addJobdesk menjadi addMasterBarang
    public function addMasterBarang()
    {
        // Tangkap data POST dari AJAX
        $id = $this->input->post('id');
        $action = $this->input->post('action');

        $this->load->model('Penjualan_model');
        $this->load->model('Laporan_model');

        // Ambil format action sesuai request Anda
        $data['format_master_barang'] = $this->Laporan_model->format_action('format_master_barang', $action)->result();

        // Ambil data kategori untuk dropdown select
        $data['kategori_list'] = $this->Laporan_model->fetch_data('master_kategori_barang')->result();

        if ($action == 'insert') {
            // Generate nomor kode barang otomatis baru
            $data['kode_otomatis'] = $this->Penjualan_model->generate_kode_barang_otomatis();
            $data['barang'] = null;
        } else {
            // Jika action == 'update'
            $data['dtKolom'] = $this->Penjualan_model->fetch_data('master_barang', ['kode_barang' => $id])->row();
            $data['barang'] = $this->db->get_where('master_barang', ['kode_barang' => $id])->row_array();
        }

        $data['action'] = $action;

        // Render ke view parsial form modal
        $this->load->view('penjualan/v_modal_form_barang', $data);
    }

    // 2. Proses edit/update data master produk
    public function update_master_produk()
    {
        $format_master_barang = $this->Laporan_model->format_action('format_master_barang')->result();
        $kode  = $this->input->post('kode_barang');
        $nama  = $this->input->post('nama_barang');
        $harga = $this->input->post('harga');

        $data_update = [
            'nama_barang' => $nama,
            'harga'       => $harga
        ];

        $this->db->where('kode_barang', $kode);
        $update = $this->db->update('barang', $data_update);

        if ($update) {
            echo json_encode(['status' => true, 'msg' => 'Data produk berhasil diperbarui!']);
        } else {
            echo json_encode(['status' => false, 'msg' => 'Gagal memperbarui data produk.']);
        }
    }

    // 3. Proses hapus data master produk
    public function hapus_master_produk($kode)
    {
        $this->db->where('kode_barang', $kode);
        $hapus = $this->db->delete('barang');

        if ($hapus) {
            echo json_encode(['status' => true, 'msg' => 'Produk berhasil dihapus dari sistem master!']);
        } else {
            echo json_encode(['status' => false, 'msg' => 'Gagal menghapus produk.']);
        }
    }
    public function cetak_invoice($no_faktur = NULL)
    {
        // Validasi parameter no_faktur
        if (empty($no_faktur)) {
            show_404();
            return;
        }

        // Ambil data header transaksi dari model
        $penjualan = $this->Laporan_model->fetch_data('penjualan', ['no_faktur' => $no_faktur])->row();

        if (!$penjualan) {
            show_404();
            return;
        }

        // Ambil data item/detail barang transaksi dari model
        $detail = $this->Laporan_model->fetch_data('penjualan_detail', ['no_faktur' => $no_faktur])->result();

        $data = [
            'title'     => 'Cetak Invoice - ' . $no_faktur,
            'penjualan' => $penjualan,
            'detail'    => $detail
        ];

        // Return view berupa HTML murni untuk kebutuhan AJAX print window
        $this->load->view('penjualan/v_cetak_invoice', $data);
    }
}
