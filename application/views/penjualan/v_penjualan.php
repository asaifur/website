<link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">

<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #modal-invoice,
        #modal-invoice * {
            visibility: visible;
        }

        #modal-invoice {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .d-print-none {
            display: none !important;
        }

        .modal-header {
            display: none !important;
        }
    }
</style>

<div class="content-wrapper" style="margin-left: 0px !important; padding: 20px;">

    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0 text-dark"><i class="fas fa-shopping-cart"></i> Pengelolaan Penjualan</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <!-- Nav Tabs -->
            <ul class="nav nav-tabs mb-3" id="salesTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-tab-btn nav-link active" id="input-tab" data-toggle="tab" href="#input-pane" role="tab" onclick="resetForm()"><i class="fas fa-plus"></i> Kasir (Tambah Penjualan)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-tab-btn nav-link" id="list-tab" data-toggle="tab" href="#list-pane" role="tab" onclick="loadRiwayat()"><i class="fas fa-list"></i> Tampilan / Riwayat Penjualan</a>
                </li>
            </ul>

            <div class="tab-content" id="salesTabContent">

                <!-- TAB 1: FORM TAMBAH/EDIT PENJUALAN -->
                <div class="tab-pane fade show active" id="input-pane" role="tabpanel">
                    <div class="row">
                        <!-- Form Samping Kiri -->
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Informasi Transaksi</h3>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="action_mode" value="insert"> <!-- insert atau update -->
                                    <div class="form-group">
                                        <label>No. Faktur</label>
                                        <input type="text" class="form-control" id="no_faktur" value="<?= $no_faktur_otomatis ?>" readonly style="background-color: #e9ecef; font-weight: bold;">
                                    </div>
                                    <hr>
                                    <h5>Tambah Barang</h5>
                                    <div class="form-group">
                                        <label>Pilih Barang Contoh</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="select_barang_mock" onchange="pilihBarangMock()" style="width: 100%;">
                                                <option value=""></option>
                                                <?php if (!empty($barang)): ?>
                                                    <?php foreach ($barang as $b): ?>
                                                        <option value="<?= $b['kode_barang'] ?>|<?= $b['nama_barang'] ?>|<?= $b['harga_jual'] ?>">
                                                            <?= $b['kode_barang'] ?> - <?= $b['nama_barang'] ?> (Rp <?= number_format($b['harga_jual'], 0, ',', '.') ?>)
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-tambah-produk" title="Tambah Master Produk Baru">
                                                    <i class="fas fa-plus-circle"></i> Beri Produk
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel Keranjang Belanja -->
                        <div class="col-md-8">
                            <div class="card card-outline card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Keranjang Belanja</h3>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-bordered m-0" id="table-cart">
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                                <th>Nama Barang</th>
                                                <th style="width: 120px;">Harga</th>
                                                <th style="width: 100px;">Qty</th>
                                                <th style="width: 150px;">Subtotal</th>
                                                <th style="width: 50px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cart-items">
                                            <tr>
                                                <td colspan="6" class="text-center text-muted">Keranjang masih kosong. Pilih barang di menu samping kiri.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer bg-light">
                                    <div class="row text-right">
                                        <div class="col-md-7">
                                            <h3>TOTAL AKHIR :</h3>
                                        </div>
                                        <div class="col-md-5">
                                            <h3 class="text-danger font-weight-bold" id="text-total">Rp 0</h3>
                                        </div>
                                    </div>
                                    <hr>

                                    <!-- DROPDOWN JENIS TRANSAKSI -->
                                    <div class="form-group mb-3">
                                        <label>Jenis Transaksi <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-lg font-weight-bold" id="jenis_transaksi" onchange="handleJenisTransaksiChange()">
                                            <option value="cash" selected>CASH / TUNAI</option>
                                            <option value="tempo_2_minggu">TEMPO 2 MINGGU</option>
                                            <option value="tempo_1_bulan">TEMPO 1 BULAN</option>
                                        </select>
                                    </div>

                                    <!-- AREA PEMBAYARAN TUNAI (AKAN HIDDEN JIKA TEMPO) -->
                                    <div class="row" id="area-pembayaran-cash">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nominal Bayar (Rp)</label>
                                                <input type="number" class="form-control form-control-lg text-success" id="nominal_uang" oninput="hitungKembalian()" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Uang Kembalian</label>
                                                <input type="text" class="form-control form-control-lg font-weight-bold text-muted" id="kembalian" value="Rp 0" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-block btn-lg btn-success shadow-sm mt-2" id="btn-submit-transaksi" onclick="prosesSimpanTransaksi()"><i class="fas fa-save"></i> SELESAIKAN TRANSAKSI</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 2: TAMPILAN RIWAYAT PENJUALAN -->
                <div class="tab-pane fade" id="list-pane" role="tabpanel">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h3 class="card-title">Data Seluruh Transaksi Penjualan</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover w-100" id="table-riwayat">
                                    <thead>
                                        <tr>
                                            <th>No. Faktur</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Jenis Transaksi</th>
                                            <th>Total Item</th>
                                            <th>Total Bayar</th>
                                            <th>Uang Tunai</th>
                                            <th>Kembalian</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="riwayat-items">
                                        <!-- Diisi via AJAX -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
</div>

<!-- MODAL TAMBAH PRODUK -->
<div class="modal fade" id="modal-tambah-produk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title"><i class="fas fa-box"></i> Tambah Master Produk Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-master-produk">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="p_kode">Kode Barang / Barcode <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="p_kode" name="kode_barang" readonly style="background-color: #e9ecef; font-weight: bold; text-transform: uppercase;">
                    </div>
                    <div class="form-group">
                        <label for="p_nama">Nama Barang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="p_nama" name="nama_barang" placeholder="Contoh: KOPI SUSU GULA AREN" required="" style="text-transform: uppercase;" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label for="p_harga">Harga Jual (Rp) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="p_harga" name="harga" placeholder="Contoh: 8000" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Produk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/plugins/') ?>jquery/jquery.js"></script>
<script src="<?= base_url('assets/plugins/') ?>bootstrap/js/bootstrap.bundle.js"></script>
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.18/dist/sweetalert2.all.min.js"></script>

<script>
    const baseUrl = "<?= site_url('penjualan/') ?>";
    let cart = [];
    let totalBayar = 0;

    // --- FUNGSI FOKUS PENCARIAN PRODUK ---
    function fokusSearchProduk() {
        setTimeout(function() {
            $('#select_barang_mock').select2('open');
        }, 150);
    }

    $(document).ready(function() {
        // Inisialisasi Select2
        $('#select_barang_mock').select2({
            theme: 'bootstrap4',
            placeholder: "-- Cari / Pilih Barang (Ketik & Tekan Enter) --",
            allowClear: true
        });

        // Auto Focus kursor saat Select2 terbuka
        $(document).on('select2:open', function() {
            let searchField = document.querySelector('.select2-search__field');
            if (searchField) {
                searchField.focus();
            }
        });

        // Buka pencarian otomatis saat halaman dimuat
        fokusSearchProduk();

        // Submit Form Master Produk Baru
        $('#form-master-produk').on('submit', function(e) {
            e.preventDefault();
            const kode = $('#p_kode').val().trim();
            const nama = $('#p_nama').val().trim();
            const harga = $('#p_harga').val().trim();

            $.ajax({
                url: baseUrl + 'simpan_master_produk',
                type: 'POST',
                data: {
                    kode_barang: kode,
                    nama_barang: nama,
                    harga: harga
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response.status) {
                        Swal.fire('Berhasil!', response.msg, 'success');
                        $('#select_barang_mock').append(
                            `<option value="${kode}|${nama}|${harga}">${kode} - ${nama} (Rp ${parseInt(harga).toLocaleString('id-ID')})</option>`
                        );
                        $('#form-master-produk')[0].reset();
                        $('#modal-tambah-produk').modal('hide');
                        fokusSearchProduk();
                    } else {
                        Swal.fire('Gagal!', response.msg, 'error');
                    }
                }
            });
        });
    });

    // Generate kode otomatis modal
    $('#modal-tambah-produk').on('show.bs.modal', function() {
        $.ajax({
            url: baseUrl + 'generate_kode_barang',
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                if (response.status) {
                    $('#p_kode').val(response.kode_otomatis);
                } else {
                    Swal.fire('Gagal!', 'Tidak dapat membuat kode produk otomatis.', 'error');
                }
            }
        });
    });

    // --- LOGIKA TOGGLE PEMBAYARAN CASH VS TEMPO ---
    function handleJenisTransaksiChange() {
        const jenis = $('#jenis_transaksi').val();
        if (jenis === 'cash') {
            $('#area-pembayaran-cash').slideDown(200);
        } else {
            // Jika Tempo, sembunyikan input tunai & set nilai 0
            $('#area-pembayaran-cash').slideUp(200);
            $('#nominal_uang').val(0);
            hitungKembalian();
        }
    }

    // --- LOGIKA KERANJANG KASIR ---
    function pilihBarangMock() {
        const val = $('#select_barang_mock').val();
        if (!val) return;

        const split = val.split('|');
        const kode = split[0];
        const nama = split[1];
        const harga = parseInt(split[2]);

        const existing = cart.find(item => item.kode_barang === kode);
        if (existing) {
            existing.qty += 1;
            existing.subtotal = existing.qty * existing.harga;
        } else {
            cart.push({
                kode_barang: kode,
                nama_barang: nama,
                harga: harga,
                qty: 1,
                subtotal: harga
            });
        }

        // Reset dropdown & update tampilan
        $('#select_barang_mock').val('').trigger('change');
        renderCart();

        // Fokus kembali ke pencarian produk untuk scan/ketik selanjutnya
        fokusSearchProduk();
    }

    function renderCart() {
        const $body = $('#cart-items');
        $body.empty();
        totalBayar = 0;

        if (cart.length === 0) {
            $body.append('<tr><td colspan="6" class="text-center text-muted">Keranjang masih kosong. Pilih barang di menu samping kiri.</td></tr>');
            $('#text-total').text('Rp 0');
            hitungKembalian();
            return;
        }

        cart.forEach((item, index) => {
            totalBayar += item.subtotal;
            $body.append(`
                <tr>
                  <td>${item.kode_barang}</td>
                  <td>${item.nama_barang}</td>
                  <td>Rp ${item.harga.toLocaleString('id-ID')}</td>
                  <td>
                    <input type="number" class="form-control form-control-sm text-center" value="${item.qty}" min="1" onchange="updateQty(${index}, this.value)">
                  </td>
                  <td class="font-weight-bold">Rp ${item.subtotal.toLocaleString('id-ID')}</td>
                  <td class="text-center">
                    <button class="btn btn-sm btn-danger" onclick="hapusItemCart(${index})"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
            `);
        });

        $('#text-total').text('Rp ' + totalBayar.toLocaleString('id-ID'));
        hitungKembalian();
    }

    function updateQty(index, val) {
        let qty = parseInt(val);
        if (isNaN(qty) || qty < 1) qty = 1;
        cart[index].qty = qty;
        cart[index].subtotal = qty * cart[index].harga;
        renderCart();
    }

    function hapusItemCart(index) {
        cart.splice(index, 1);
        renderCart();
        fokusSearchProduk();
    }

    function hitungKembalian() {
        const jenis = $('#jenis_transaksi').val();
        if (jenis !== 'cash') {
            $('#kembalian').val('Rp 0');
            return;
        }

        const bayar = parseInt($('#nominal_uang').val()) || 0;
        const sisa = bayar - totalBayar;
        if (sisa >= 0) {
            $('#kembalian').val('Rp ' + sisa.toLocaleString('id-ID')).removeClass('text-danger').addClass('text-success');
        } else {
            $('#kembalian').val('Kurang: Rp ' + Math.abs(sisa).toLocaleString('id-ID')).removeClass('text-success').addClass('text-danger');
        }
    }

    function resetForm() {
        cart = [];
        totalBayar = 0;
        $('#action_mode').val('insert');
        $('#nominal_uang').val('');
        $('#jenis_transaksi').val('cash').trigger('change');
        $('#btn-submit-transaksi').html('<i class="fas fa-save"></i> SELESAIKAN TRANSAKSI').removeClass('btn-warning').addClass('btn-success');
        renderCart();
        fokusSearchProduk();
    }

    // --- AJAX CRUD PROCESS ---
    function prosesSimpanTransaksi() {
        if (cart.length === 0) {
            Swal.fire('Oops!', 'Keranjang belanja Anda kosong!', 'warning');
            return;
        }

        const jenisTransaksi = $('#jenis_transaksi').val();
        const bayar = parseInt($('#nominal_uang').val()) || 0;

        // Validasi nominal bayar hanya untuk CASH
        if (jenisTransaksi === 'cash' && bayar < totalBayar) {
            Swal.fire('Peringatan!', 'Nominal uang pembayaran kurang!', 'warning');
            return;
        }

        const mode = $('#action_mode').val();
        const urlTarget = (mode === 'insert') ? baseUrl + 'simpan' : baseUrl + 'update';

        $.ajax({
            url: urlTarget,
            type: 'POST',
            data: {
                no_faktur: $('#no_faktur').val(),
                total_bayar: totalBayar,
                nominal_uang: bayar,
                kembalian: (jenisTransaksi === 'cash' && bayar >= totalBayar) ? (bayar - totalBayar) : 0,
                jenis_transaksi: jenisTransaksi,
                cart: cart
            },
            dataType: 'JSON',
            success: function(response) {
                if (response.status) {
                    Swal.fire('Berhasil!', response.msg, 'success').then(() => {
                        prosesPrintInvoice(response.no_faktur);
                    });
                } else {
                    Swal.fire('Gagal!', response.msg, 'error');
                }
            }
        });
    }

    function prosesPrintInvoice(no_faktur) {
        $.ajax({
            url: baseUrl + 'cetak_invoice/' + no_faktur,
            type: 'GET',
            dataType: 'HTML',
            success: function(html) {
                const printWindow = window.open('', '_blank');
                printWindow.document.write(html);
                printWindow.document.close();
                printWindow.focus();
                printWindow.print();
                printWindow.close();

                resetForm();
            }
        });
    }

    function loadRiwayat() {
        $.ajax({
            url: baseUrl + 'get_all_data',
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                const $tableBody = $('#riwayat-items');
                $tableBody.empty();

                if (data.length === 0) {
                    // Colspan diubah dari 7 menjadi 8 karena ada penambahan 1 kolom Jenis Transaksi
                    $tableBody.append('<tr><td colspan="8" class="text-center text-muted">Belum ada riwayat transaksi penjualan.</td></tr>');
                    return;
                }

                data.forEach(row => {
                    // Logika pembuat badge visual jenis transaksi
                    let badgeJenis = '';
                    if (row.jenis_transaksi === 'tempo_2_minggu') {
                        badgeJenis = '<span class="badge badge-warning">TEMPO 2 MINGGU</span>';
                    } else if (row.jenis_transaksi === 'tempo_1_bulan') {
                        badgeJenis = '<span class="badge badge-danger">TEMPO 1 BULAN</span>';
                    } else {
                        badgeJenis = '<span class="badge badge-success">CASH</span>';
                    }

                    $tableBody.append(`
                    <tr>
                      <td><span class="badge badge-secondary font-weight-bold">${row.no_faktur}</span></td>
                      <td>${row.tanggal}</td>
                      <td>${badgeJenis}</td> <!-- KOLOM JENIS TRANSAKSI BARU -->
                      <td>${row.total_item} Item</td>
                      <td class="font-weight-bold">Rp ${parseInt(row.total_bayar).toLocaleString('id-ID')}</td>
                      <td>Rp ${parseInt(row.nominal_uang).toLocaleString('id-ID')}</td>
                      <td>Rp ${parseInt(row.kembalian).toLocaleString('id-ID')}</td>
                      <td class="text-center">
                        <button class="btn btn-sm btn-info" onclick="prosesPrintInvoice('${row.no_faktur}')" title="Cetak Ulang Invoice"><i class="fas fa-print"></i></button>
                        <button class="btn btn-sm btn-warning" onclick="editPenjualan('${row.no_faktur}')"><i class="fas fa-edit"></i> Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="hapusPenjualan('${row.no_faktur}')"><i class="fas fa-trash"></i> Hapus</button>
                      </td>
                    </tr>
                `);
                });
            }
        });
    }

    function editPenjualan(no_faktur) {
        $.ajax({
            url: baseUrl + 'get_detail/' + no_faktur,
            type: 'GET',
            dataType: 'JSON',
            success: function(response) {
                $('#input-tab').tab('show');
                $('#action_mode').val('update');
                $('#no_faktur').val(response.penjualan.no_faktur);
                $('#nominal_uang').val(response.penjualan.nominal_uang);
                $('#jenis_transaksi').val(response.penjualan.jenis_transaksi).trigger('change');

                cart = response.detail.map(item => {
                    return {
                        kode_barang: item.kode_barang,
                        nama_barang: item.nama_barang,
                        harga: parseInt(item.harga),
                        qty: parseInt(item.qty),
                        subtotal: parseInt(item.subtotal)
                    };
                });

                $('#btn-submit-transaksi').html('<i class="fas fa-edit"></i> UPDATE DATA TRANSAKSI').removeClass('btn-success').addClass('btn-warning');
                renderCart();
            }
        });
    }

    function hapusPenjualan(no_faktur) {
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Transaksi " + no_faktur + " akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: baseUrl + 'hapus/' + no_faktur,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(response) {
                        if (response.status) {
                            Swal.fire('Dihapus!', response.msg, 'success');
                            loadRiwayat();
                        } else {
                            Swal.fire('Gagal!', response.msg, 'error');
                        }
                    }
                });
            }
        });
    }
</script>