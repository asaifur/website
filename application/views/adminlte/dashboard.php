<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <i class="fas fa-chart-pie mr-1"></i>Jobdesk Harian</h3>

            </div>
            <div class="card-body">

                <div id="myfirstchart" style="height: 250px;"></div>
            </div>

        </div>
    </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
    $(function() {
        $.ajax({
            url: "<?= base_url('dashboard/chartJobdesk'); ?>",
            method: "GET",
            dataType: "json",
            success: function(data) {

                // Cek jika data kosong
                if (data.length === 0) {
                    $('#myfirstchart').html(
                        '<p class="text-center">Data belum tersedia</p>'
                    );
                    return;
                }

                // Render chart jika ada data
                new Morris.Line({
                    element: 'myfirstchart',
                    data: data,
                    xkey: 'tanggal',
                    ykeys: ['total'],
                    labels: ['Jumlah Jobdesk'],
                    lineWidth: 2,
                    parseTime: false,
                    resize: true
                });

            },
            error: function() {
                $('#myfirstchart').html(
                    '<p class="text-danger text-center">Gagal mengambil data</p>'
                );
            }
        });
    });
</script>