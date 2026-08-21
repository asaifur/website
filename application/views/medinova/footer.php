 <style>
     .floating-contact {
         position: fixed;
         left: 15px;
         bottom: 25px;
         z-index: 9999;

         display: flex;
         flex-direction: column;
         gap: 12px;
     }

     /* tombol utama */
     .float-btn {
         display: flex;
         align-items: center;
         background: white;
         border-radius: 50px;
         padding: 5px 12px 5px 5px;
         box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);

         text-decoration: none;
         transition: all .3s ease;
         animation: bounce 2s infinite;
     }

     /* icon */
     .float-btn img {
         width: 50px;
         height: auto;
     }

     /* label */
     .float-btn .label {
         margin-left: 8px;
         font-size: 14px;
         font-weight: 600;
         color: #333;
     }

     /* hover */
     .float-btn:hover {
         transform: translateY(-3px);
         box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
     }

     /* bounce animation */
     @keyframes bounce {

         0%,
         20%,
         50%,
         80%,
         100% {
             transform: translateY(0);
         }

         40% {
             transform: translateY(-6px);
         }

         60% {
             transform: translateY(-3px);
         }
     }

     /* responsive */
     @media(max-width:768px) {

         .float-btn img {
             width: 45px;
         }

         .float-btn .label {
             display: none;
         }

     }
 </style>

 <div class="floating-contact">

     <!-- WhatsApp -->
     <a href="<?= $domain->wa_link; ?>"
         target="_blank"
         class="float-btn wa">

         <img src="<?= base_url('assets/uploads/img/') ?>fd14d9811e056a03b44e7c3e043b2476.png">

     </a>

     <!-- Call -->
     <a href="tel:<?= $domain->telepon; ?>"
         class="float-btn call">

         <img src="<?= base_url('assets/uploads/img/') ?>b06f39c95463db9183a5d3fa912777ee.png">

     </a>

 </div>

 <div class="container-fluid bg-dark text-light mt-5 py-5">
     <div class="container py-5">
         <div class="row g-5">
             <div class="col-lg-3 col-md-6">
                 <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">
                     <?= $domain->domain_name; ?></h4>
                 <p class="mb-4"><?= $domain->meta_title ?></p>
                 <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i><?= $domain->alamat ?></p>
                 <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i><?= $domain->email ?></p>
                 <p class="mb-0"><i class="fa fa-phone-alt text-primary me-3"></i><?= $domain->telepon ?></p>
             </div>
             <div class="col-lg-3 col-md-6">
                 <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">
                     Navigasi</h4>
                 <div class="d-flex flex-column justify-content-start">
                     <?php $menu_nav =  $this->Menu_model->getMenuTree($this->domain->id);
                        ?>
                     <?php $menu_nav =  $this->Menu_model->getMenuTree($this->domain->id);
                        ?>
                     <?php foreach ($menu_nav as $kolom): ?>

                         <a class="text-light mb-2" href="<?= base_url('/') .  $kolom['slug']; ?>"><i class="fa fa-angle-right me-2"></i><?= $kolom['nama_menu'] ?></a>
                     <?php endforeach; ?>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6">
                 <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">
                     News & Articles</h4>
                 <div class="d-flex flex-column justify-content-start">
                     <?php $menu_nav = $this->Menu_model->fetch_data_by_limit('table_pages', ['id_domain' => $domain->id], ['category' => '2'])->result();  ?>
                     <?php foreach ($menu_nav as $kolom): ?>

                         <a class="text-light mb-2" href="<?= base_url('/') . $kolom->slug ?>"><i class="fa fa-angle-right me-2"></i><?= $kolom->meta_title ?></a>
                     <?php endforeach; ?>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6">
                 <h4 class="d-inline-block text-primary text-uppercase border-bottom border-5 border-secondary mb-4">
                     Directions</h4>
                 <?= $domain->iframe ?>
             </div>
         </div>
     </div>
 </div>
 <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
     <div class="container">
         <div class="row g-5">
             <div class="col-md-6 text-center text-md-start">
                 <p class="mb-md-0">&copy; <a class="text-primary" href="<?= base_url('') ?>"><?= $domain->title ?></a>. All Rights Reserved.
                 </p>
             </div>
             <div class="col-md-6 text-center text-md-end">
                 <p class="mb-0">Designed by <a class="text-primary" href="https://wa.me/6285283782281?text=Halo%20www.optimadigitalsolution.com%0A%0ASaya%20ingin%20Konsultasi%20kebutuhan%20website"
                         target="_blank">OPTIMA DIGITAL SOLUTION</a></p>
             </div>
         </div>
     </div>
 </div>

 <!-- JavaScript Libraries -->
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
 <script src="<?= base_url('assets/medinova/lib/') ?>easing/easing.min.js"></script>
 <script src="<?= base_url('assets/medinova/lib/') ?>waypoints/waypoints.min.js"></script>
 <script src="<?= base_url('assets/medinova/lib/') ?>owlcarousel/owl.carousel.min.js"></script>
 <script src="<?= base_url('assets/medinova/lib/') ?>tempusdominus/js/moment.min.js"></script>
 <script src="<?= base_url('assets/medinova/lib/') ?>tempusdominus/js/moment-timezone.min.js"></script>
 <script src="<?= base_url('assets/medinova/lib/') ?>tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

 <!-- Template Javascript -->
 <script src="<?= base_url('assets/medinova/js/') ?>main.js"></script>
 </body>

 </html>