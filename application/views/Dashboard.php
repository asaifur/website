<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Penjualan Harian</span>
                        <span class="info-box-number">Rp <?= number_format($penjualan_harian ?? 1250000, 0, ',', '.'); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-cash-register"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Penjualan Bulanan</span>
                        <span class="info-box-number">Rp <?= number_format($penjualan_bulanan ?? 38400000, 0, ',', '.'); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-chart-line"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Penjualan Tahunan</span>
                        <span class="info-box-number">Rp <?= number_format($penjualan_tahunan ?? 456200000, 0, ',', '.'); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3 mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-user-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">User Aktif</span>
                        <span class="info-box-number">
                            <?= $this->session->userdata('nama_user') ?? 'Ahmad Kasir'; ?>
                            <small class="badge badge-secondary d-inline-block ml-1">
                                <?= $this->session->userdata('level') ?? 'Admin'; ?>
                            </small>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar mr-1"></i> Grafik Tren Penjualan Bulanan
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="salesChart" style="min-height: 290px; height: 290px; max-height: 290px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-history mr-1"></i> Batch FIFO Terlama (Keluar Duluan)</h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li class="item">
                                <div class="product-info ml-2">
                                    <a href="javascript:void(0)" class="product-title">Minyak Goreng 2L
                                        <span class="badge badge-danger float-right">Batch #019</span>
                                    </a>
                                    <span class="product-description text-xs text-muted">
                                        Tgl Masuk: 10 Juni 2026 | Sisa Stok Batch: 12 Pcs
                                    </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-info ml-2">
                                    <a href="javascript:void(0)" class="product-title">Beras Pandan Wangi 5kg
                                        <span class="badge badge-danger float-right">Batch #014</span>
                                    </a>
                                    <span class="product-description text-xs text-muted">
                                        Tgl Masuk: 12 Juni 2026 | Sisa Stok Batch: 5 Karung
                                    </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-info ml-2">
                                    <a href="javascript:void(0)" class="product-title">Gula Pasir 1kg
                                        <span class="badge badge-warning float-right">Batch #022</span>
                                    </a>
                                    <span class="product-description text-xs text-muted">
                                        Tgl Masuk: 15 Juni 2026 | Sisa Stok Batch: 40 Pcs
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer text-center text-xs">
                        <span class="text-danger"><i class="fas fa-exclamation-circle"></i> Sistem otomatis memotong stok dari batch terlama di atas.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-secondary card-outline">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-boxes mr-1"></i> Status Real-time Stok Gudang (Berdasarkan Batch Masuk)</h3>
                    </div>
                    <div class="card-body">
                        <table id="tableStokGudang" class="table table-bordered table-striped table-hover responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>Kode Produk</th>
                                    <th>Nama Barang</th>
                                    <th>Nomor Batch</th>
                                    <th>Tgl Masuk Gudang</th>
                                    <th>Harga Beli (Modal)</th>
                                    <th>Total Stok Tersedia</th>
                                    <th>Status Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PRD-001</td>
                                    <td>Minyak Goreng 2L</td>
                                    <td><span class="badge badge-secondary">Batch #019</span></td>
                                    <td>10/06/2026</td>
                                    <td>Rp 28.000</td>
                                    <td>12 Pcs</td>
                                    <td><span class="badge badge-danger">Prioritas Jual (FIFO)</span></td>
                                </tr>
                                <tr>
                                    <td>PRD-001</td>
                                    <td>Minyak Goreng 2L</td>
                                    <td><span class="badge badge-secondary">Batch #025</span></td>
                                    <td>16/06/2026</td>
                                    <td>Rp 29.000</td>
                                    <td>50 Pcs</td>
                                    <td><span class="badge badge-secondary">Antrean Berikutnya</span></td>
                                </tr>
                                <tr>
                                    <td>PRD-002</td>
                                    <td>Beras Pandan Wangi 5kg</td>
                                    <td><span class="badge badge-secondary">Batch #014</span></td>
                                    <td>12/06/2026</td>
                                    <td>Rp 62.000</td>
                                    <td>5 Karung</td>
                                    <td><span class="badge badge-danger">Prioritas Jual (FIFO)</span></td>
                                </tr>
                                <tr>
                                    <td>PRD-003</td>
                                    <td>Gula Pasir 1kg</td>
                                    <td><span class="badge badge-secondary">Batch #022</span></td>
                                    <td>15/06/2026</td>
                                    <td>Rp 13.500</td>
                                    <td>40 Pcs</td>
                                    <td><span class="badge badge-danger">Prioritas Jual (FIFO)</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url('assets/plugins/') ?>chart.js/Chart.bundle.js"></script>
<script>
    $(function() {
        // 1. Inisialisasi DataTables Stok Gudang
        $("#tableStokGudang").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "order": [
                [0, "asc"],
                [3, "asc"]
            ] // Diurutkan berdasarkan kode barang lalu tanggal masuk terlama (FIFO)
        });

        // 2. Inisialisasi Chart.js (Grafik Tren Penjualan Bulanan)
        var salesChartCanvas = $('#salesChart').get(0).getContext('2d');

        var salesChartData = {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'],
            datasets: [{
                label: 'Total Omset Penjualan',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: true,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [28000000, 32000000, 45000000, 39000000, 41000000, 38400000] // Dummy Data bulanan
            }]
        };

        var salesChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                display: true,
                position: 'top'
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: true,
                        color: '#f3f3f3',
                        zeroLineColor: '#efefef'
                    },
                    ticks: {
                        callback: function(value, index, values) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        return data.datasets[tooltipItem.datasetIndex].label + ': Rp ' + tooltipItem.yLabel.toLocaleString('id-ID');
                    }
                }
            }
        };

        // Render Chart ke Canvas
        var salesChart = new Chart(salesChartCanvas, {
            type: 'line', // Jenis grafik garis untuk melihat tren
            data: salesChartData,
            options: salesChartOptions
        });
    });
</script>