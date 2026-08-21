  <?php if ($sec->section == 'hero'):
    ?>

      <div class="container-fluid py-5"
          style="background-image:url('<?= base_url("assets/uploads/img/" . $sec->image) ?>');
background-size:cover;
background-position:center;
background-repeat:no-repeat;">

          <div class="container text-center text-white">

              <h1 class="display-3"><?= $sec->title ?></h1>

              <p><?= $sec->subtitle ?></p>

              <?= $sec->content ?>

          </div>

      </div>

  <?php endif; ?>