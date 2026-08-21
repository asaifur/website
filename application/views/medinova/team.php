 <?php if ($row->section == 'team' && !empty($team)): ?>

     <div class="container py-5">

         <div class="text-center mx-auto mb-5" style="max-width:500px;">

             <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">
                 <?= $row->title ?>
             </h5>

             <h1 class="display-4"><?= $row->subtitle ?></h1>

         </div>


         <div class="owl-carousel team-carousel position-relative">

             <?php foreach ($team as $t): ?>

                 <div class="team-item">

                     <div class="row g-0 bg-light rounded overflow-hidden">

                         <div class="col-12 col-sm-5 h-100">

                             <img class="img-fluid h-100"
                                 src="<?= base_url('assets/uploads/img/' . $t->image) ?>"
                                 style="object-fit:cover;">

                         </div>

                         <div class="col-12 col-sm-7 h-100 d-flex flex-column">

                             <div class="mt-auto p-4">

                                 <h3><?= $t->title ?></h3>

                                 <h6 class="fw-normal fst-italic text-primary mb-4">
                                     <?= $t->subtitle ?>
                                 </h6>

                                 <p><?= $t->content ?></p>

                             </div>

                         </div>

                     </div>

                 </div>

             <?php endforeach; ?>

         </div>

     </div>

 <?php endif; ?>