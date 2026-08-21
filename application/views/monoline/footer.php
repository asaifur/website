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

 <div class="footer" style="background-image: url('<?= base_url('assets/monoline/assets/img/bg/footer.png'); ?>');  background-size:cover;">
     <div class="container">
         <div class="row footer_bg">
             <div class="col-lg-3 col-sm-6 col-xs-12">
                 <div class="footer_logo">
                     <img src="<?= base_url('assets/uploads/img/') . $this->domain->image_domain; ?>" alt="" />
                     <p><?= $this->domain->meta_description; ?></p>
                 </div>
                 <div class="social_profile">
                     <ul>
                         <li><a href="<?= $this->domain->link_facebook; ?>" class="f_facebook"><i class="fa fa-facebook" title="Facebook"></i></a></li>
                         <li><a href="<?= $this->domain->link_youtube; ?>" class="f_twitter"><i class="fa fa-youtube" title="youtube"></i></a></li>
                         <li><a href="<?= $this->domain->link_instagram; ?>" class="f_instagram"><i class="fa fa-instagram" title="Instagram"></i></a></li>
                         <li><a href="<?= $this->domain->link_twitter; ?>" class="f_twitter"><i class="fa fa-twitter" title="Twitter"></i></a></li>
                     </ul>
                 </div>

             </div><!--- END COL -->
             <div class="col-lg-3 col-sm-6 col-xs-12">
                 <div class="single_footer">
                     <h4>Aritikel & Blog</h4>
                     <?php $artikel = $this->Menu_model->fetch_data_pages_by_limit_order('table_pages', ['id_domain' => $this->domain->id, 'category' => '2'])->result();
                        ?>
                     <ul>
                         <?php foreach ($artikel as $row) {
                            ?>
                             <li><a href="<?= base_url('/') . $row->slug; ?>"><?= $row->title; ?></a></li>
                         <?php } ?>
                     </ul>
                 </div>
             </div><!--- END COL -->
             <div class="col-lg-3 col-sm-6 col-xs-1">
                 <div class="single_footer">
                     <h4>Navigasi</h4>
                     <ul>
                         <?php foreach ($menus as $menu): ?>
                             <li><a href="<?= base_url('') . $menu['slug']; ?>"><?= $menu['nama_menu']; ?></a></li>
                         <?php endforeach; ?>
                     </ul>
                 </div>
             </div><!--- END COL -->
             <div class="col-lg-3 col-sm-6 col-xs-12">
                 <div class="newsletter-form">
                     <h4>Kontak Kami</h4>
                     <form id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
                         <div class="input-group input-group-lg newsletter">
                             <input type="email" name="EMAIL" class="subscribe__input" placeholder="Email Address">
                             <button type="submit" class="subs_btn">Subscribe</button>
                         </div>

                         <div id="mce-responses">
                             <div class="response" id="mce-error-response" style="display:none"></div>
                             <div class="response" id="mce-success-response" style="display:none"></div>
                         </div>
                     </form>
                 </div>
             </div><!--- END COL -->
         </div><!--- END ROW -->
         <div class="row">
             <div class="col-lg-12 text-center">
                 <div class="footer_copyright">
                     <p>&copy; <?= date('Y') ?> <?= $domain->title; ?>. All Rights Reserved by <a href="#" target="_blank"><?= $domain->domain_name ?></a></p>
                     <p>Distributed by <a href="https://wa.me/6285283782281" target="_blank">Optima Digital Solution</a></p>
                 </div>
             </div>
         </div>
     </div><!--- END CONTAINER -->
 </div>

 <!-- Latest jQuery -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/jquery-1.12.4.min.js"></script>
 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- Owl Carousel JS -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

 <!-- Latest compiled and minified Bootstrap -->
 <script src="<?= base_url('assets/monoline/assets/') ?>bootstrap/js/bootstrap.min.js"></script>
 <!-- modernizer JS -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/modernizr-2.8.3.min.js"></script>
 <!-- owl-carousel min js  -->
 <script src="<?= base_url('assets/monoline/assets/') ?>owlcarousel/js/owl.carousel.min.js"></script>
 <!-- magnific-popup js -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/jquery.magnific-popup.min.js"></script>
 <!-- jquery mixitup js -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/jquery.mixitup.js"></script>
 <!-- jquery appear js -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/jquery.appear.js"></script>
 <!-- countTo js -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/jquery.inview.min.js"></script>
 <!-- jquery touchSwipe min JS -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/jquery.touchSwipe.min.js"></script>
 <!-- stellar js -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/jquery.stellar.min.js"></script>
 <!-- WOW - Reveal Animations When You Scroll -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/wow.min.js"></script>
 <!-- form contact js -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/form-contact.js"></script>
 <!-- scrolltopcontrol js -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/menu.js"></script>
 <script src="<?= base_url('assets/monoline/assets/') ?>js/jquery.sticky.js"></script>
 <script src="<?= base_url('assets/monoline/assets/') ?>js/scrolltopcontrol.js"></script>
 <!-- scripts js -->
 <script src="<?= base_url('assets/monoline/assets/') ?>js/scripts.js"></script>

 <script>
     const texts = [
         "Instalasi Ducting Exhaust Dapur Restoran",
         "Dan Manfaat Penggunaan Instalasi Ducting Exhaust"
     ];

     let textIndex = 0;
     let charIndex = 0;
     let isDeleting = false;
     const typingElement = document.getElementById("typing-text");

     function typeEffect() {
         const currentText = texts[textIndex];

         if (!isDeleting) {
             typingElement.textContent = currentText.substring(0, charIndex + 1);
             charIndex++;

             if (charIndex === currentText.length) {
                 setTimeout(() => isDeleting = true, 1500);
             }
         } else {
             typingElement.textContent = currentText.substring(0, charIndex - 1);
             charIndex--;

             if (charIndex === 0) {
                 isDeleting = false;
                 textIndex = (textIndex + 1) % texts.length;
             }
         }

         setTimeout(typeEffect, isDeleting ? 40 : 80);
     }

     typeEffect();
 </script>
 </body>

 </html>