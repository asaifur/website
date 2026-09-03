<?php
$payload = isset($row->data_payload) ? json_decode($row->data_payload) : null;
?>

<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <!-- Left Blog List & Live Search Results -->
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar" id="blogListContainer">
                    <!-- Dynamic Articles Rendered via PHP / Live Search -->
                    <article class="blog_item">
                        <div class="blog_item_img">
                            <img class="card-img rounded-0" src="<?= base_url('assets/img/blog/single_blog_1.png'); ?>" alt="">
                            <a href="#" class="blog_item_date">
                                <h3>15</h3>
                                <p>Jan</p>
                            </a>
                        </div>
                        <div class="blog_details">
                            <a class="d-inline-block" href="<?= base_url('latest_news'); ?>">
                                <h2>Google inks pact for new 35-storey office</h2>
                            </a>
                            <p>That dominion stars lights dominion divide years for fourth have don't stars is that he earth it first without heaven in place seed it second morning saying.</p>
                            <ul class="blog-info-link">
                                <li><a href="#"><i class="fa fa-user"></i> Travel, Lifestyle</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                            </ul>
                        </div>
                    </article>

                    <!-- Pagination -->
                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <!-- Live Search Widget -->
                    <aside class="single_sidebar_widget search_widget">
                        <form id="liveSearchForm" onsubmit="return false;">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="searchKeyword" placeholder="Cari Produk / Artikel..." onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cari Produk / Artikel...'">
                                    <div class="input-group-append">
                                        <button class="btns" type="button" id="btnSearch"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="button">Cari Data</button>
                        </form>
                    </aside>

                    <!-- Live Search Results Box -->
                    <aside class="single_sidebar_widget post_category_widget" id="searchResultsWidget" style="display: none;">
                        <h4 class="widget_title">Hasil Pencarian Produk</h4>
                        <ul class="list cat-list" id="searchResultsList">
                            <!-- Hasil AJAX table_product -->
                        </ul>
                    </aside>

                    <!-- Category Widget -->
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Category</h4>
                        <ul class="list cat-list">
                            <li><a href="#" class="d-flex">
                                    <p>Restaurant food</p>
                                    <p>(37)</p>
                                </a></li>
                            <li><a href="#" class="d-flex">
                                    <p>Travel news</p>
                                    <p>(10)</p>
                                </a></li>
                            <li><a href="#" class="d-flex">
                                    <p>Modern technology</p>
                                    <p>(03)</p>
                                </a></li>
                            <li><a href="#" class="d-flex">
                                    <p>Product</p>
                                    <p>(11)</p>
                                </a></li>
                        </ul>
                    </aside>

                    <!-- Recent Post Widget -->
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Recent Post</h3>
                        <div class="media post_item">
                            <img src="<?= base_url('assets/img/post/post_1.png'); ?>" alt="post">
                            <div class="media-body">
                                <a href="<?= base_url('latest_news'); ?>">
                                    <h3>From life was you fish...</h3>
                                </a>
                                <p>January 12, 2019</p>
                            </div>
                        </div>
                    </aside>

                    <!-- Tag Clouds -->
                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag Clouds</h4>
                        <ul class="list">
                            <li><a href="#">project</a></li>
                            <li><a href="#">love</a></li>
                            <li><a href="#">technology</a></li>
                            <li><a href="#">travel</a></li>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- AJAX Live Search Script for table_product -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchKeyword");
        const resultsWidget = document.getElementById("searchResultsWidget");
        const resultsList = document.getElementById("searchResultsList");

        searchInput.addEventListener("keyup", function() {
            let keyword = this.value.trim();

            if (keyword.length > 1) {
                fetch("<?= base_url('dashboard/live_search_product'); ?>", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: "keyword=" + encodeURIComponent(keyword) + "&id_domain=<?= isset($id_domain) ? $id_domain : 1; ?>"
                    })
                    .then(response => response.json())
                    .then(data => {
                        let html = "";
                        if (data.status === "success" && data.results.length > 0) {
                            data.results.forEach(item => {
                                html += `<li><a href="#" class="d-flex justify-content-between"><span>${item.product_name}</span><span class="text-muted">Rp ${item.price}</span></a></li>`;
                            });
                            resultsList.innerHTML = html;
                            resultsWidget.style.display = "block";
                        } else {
                            resultsList.innerHTML = `<li><p class="text-muted mb-0">Produk tidak ditemukan</p></li>`;
                            resultsWidget.style.display = "block";
                        }
                    })
                    .catch(error => console.error("Error:", error));
            } else {
                resultsWidget.style.display = "none";
            }
        });
    });
</script>