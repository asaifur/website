<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-bars"></i> Data <?= $title ?>
                        </h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-success"
                                id="btnTambahMenu">
                                <i class="fas fa-plus"></i> Tambah <?= $title ?>
                            </button>
                        </div>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="tableMenu"
                            class="table table-bordered table-striped table-hover">

                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Menu</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>
</section>