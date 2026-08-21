<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">

                <!-- Pages -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Pages</h5>
                    </div>

                    <div class="card-body" style="max-height:300px; overflow:auto">

                        <?php foreach ($pages as $p): ?>

                            <div class="form-check">
                                <input class="form-check-input page-check"
                                    type="checkbox"
                                    value="<?= $p->id_page ?>">

                                <label class="form-check-label">
                                    <?= $p->title ?>
                                </label>
                            </div>

                        <?php endforeach; ?>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary btn-sm" id="addPageMenu">
                            Add to Menu
                        </button>
                    </div>
                </div>


                <!-- Custom Link -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Custom Link</h5>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" class="form-control" id="custom_url">
                        </div>

                        <div class="form-group">
                            <label>Link Text</label>
                            <input type="text" class="form-control" id="custom_text">
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-success btn-sm" id="addCustomMenu">
                            Add to Menu
                        </button>
                    </div>
                </div>

            </div>


            <!-- RIGHT PANEL -->
            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title">Menu Structure</h5>
                    </div>

                    <div class="card-body">

                        <div class="dd" id="menu-builder">

                            <ol class="dd-list">

                                <?= $menu_tree ?>

                            </ol>

                        </div>

                    </div>

                    <div class="card-footer">

                        <button class="btn btn-primary" id="saveMenu">
                            Save Menu
                        </button>

                    </div>

                </div>

            </div>

        </div>
    </div>
    </div>


    <?php $this->load->view('template/scriptes'); ?>
    <script>
        $(document).ready(function() {

            $('#menu-builder').nestable({
                maxDepth: 5
            });


            /* ADD PAGE MENU */

            $('#addPageMenu').click(function(e) {
                e.preventDefault();
                let pages = [];

                $('.page-check:checked').each(function() {

                    pages.push($(this).val())
                });

                $.ajax({

                    url: "<?= base_url('Dashboard/add_page_menu') ?>",

                    type: "POST",

                    data: {
                        pages: pages
                    },

                    success: function(res) {
                        console.log(res);

                    }

                });

            });


            /* ADD CUSTOM MENU */

            $('#addCustomMenu').click(function() {

                let url = $('#custom_url').val();
                let text = $('#custom_text').val();

                $.ajax({

                    url: "<?= base_url('Dashboard/add_custom_menu') ?>",

                    type: "POST",

                    data: {
                        url: url,
                        title: text
                    },

                    success: function() {

                        location.reload();

                    }

                });

            });


            /* SAVE DRAG MENU */

            $('#saveMenu').click(function() {

                let data = $('#menu-builder').nestable('serialize');
                console.log(data); // lihat isi array
                $.ajax({

                    url: "<?= base_url('Dashboard/save_menu') ?>",

                    type: "POST",

                    data: {
                        menu: JSON.stringify(data)
                    },

                    success: function(res) {

                        alert('Menu berhasil disimpan');

                    }

                });

            });

        });
    </script>