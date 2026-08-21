 <?php if ($sec->section == 'about'): ?>

     <div class="container py-5">

         <div class="sec">

             <?php if ($sec->image != null) { ?>

                 <div class="col-lg-12">

                     <img src="<?= base_url('assets/uploads/img/' . $sec->image) ?>"
                         class="img-fluid rounded">

                 </div>

             <?php } ?>

             <div class="col-lg-12">

                 <h2><?= $sec->title ?></h2>

                 <?= $sec->content ?>

             </div>

         </div>

     </div>

 <?php endif; ?>