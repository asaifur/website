<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title><?= htmlspecialchars($title ?? 'PT Solusi Dapur Restoran') ?></title>
  <meta name="description" content="<?= htmlspecialchars($description ?? '') ?>">
  <meta name="keywords" content="<?= htmlspecialchars($keywords ?? '') ?>">
  <meta name="google-adsense-account" content="<?= htmlspecialchars($domain->link_adsense ?? '') ?>">
  <?= $domain->link_google_tag ?? "" ?>
  <meta name="author" content="<?= htmlspecialchars($author ?? '') ?>">
  <link rel="canonical" href="<?= htmlspecialchars($url ?? base_url()) ?>">
  <link rel="icon" href="<?= base_url('assets/uploads/img/') . $this->domain->logo; ?>" type="image/png">

  <meta name="robots" content="index, follow">
  <!-- Open Graph -->
  <meta property="og:type" content="<?= htmlspecialchars($type ?? 'website') ?>">
  <meta property="og:url" content="<?= htmlspecialchars($url ?? base_url()) ?>">
  <meta property="og:title" content="<?= htmlspecialchars($title ?? '') ?>">
  <meta property="og:description" content="<?= htmlspecialchars($description ?? '') ?>">
  <meta property="og:image" content="<?= htmlspecialchars($image ?? '') ?>">

  <?php if (!empty($domain->geo_position)): ?>
    <meta name="geo.position" content="<?= htmlspecialchars($domain->geo_position) ?>">
  <?php endif; ?>
  <?php if (!empty($domain->geo_placename)): ?>
    <meta name="geo.placename" content="<?= htmlspecialchars($domain->geo_placename) ?>">
  <?php endif; ?>

  <!-- Latest Bootstrap min CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>bootstrap/css/bootstrap.min.css">
  <!-- Google Font -->
  <?php if (!empty($domain->meta_google_site_verification)) : ?>
    <meta name="google-site-verification" content="<?= $domain->meta_google_site_verification; ?>">
  <?php endif; ?>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>fonts/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>fonts/themify-icons.css">
  <!--- owl carousel Css-->
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>owlcarousel/css/owl.carousel.css">
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>owlcarousel/css/owl.theme.css">
  <!--materialdesignicons Css-->
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>css/fonts.css">
  <!-- animate CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!-- Venobox CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>css/venobox.css">
  <!-- MAGNIFIC CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>css/magnific-popup.css">
  <!-- Style CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>css/menu.css">
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>css/slider.css">
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>css/style.css">
  <link rel="stylesheet" href="<?= base_url('assets/monoline/assets/') ?>css/responsive.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
  <!-- Tambahan SEO -->
  <meta name="author" content="<?= $this->config->item('site_name') ?>">
  <meta http-equiv="Content-Language" content="id">


  <style>
    /* Counter Section Customization */
    .counter_feature {
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
      color: #fff;
      position: relative;
      overflow: hidden;
    }

    .single-project {
      padding: 30px 15px;
      transition: transform 0.3s ease;
    }

    .single-project:hover {
      transform: translateY(-5px);
    }

    .single-project img {
      width: 60px;
      height: 60px;
      margin-bottom: 15px;
      filter: brightness(0) invert(1);
      /* Ubah icon jadi putih */
    }

    .counter-num {
      font-size: 2.5rem;
      font-weight: 700;
      color: #f39c12;
      /* Warna emas untuk highlight */
      margin: 10px 0;
      line-height: 1;
    }

    .counter-desc {
      font-size: 0.9rem;
      color: rgba(255, 255, 255, 0.8);
      margin-top: 5px;
    }

    .video_btn {
      border-radius: 15px;
      padding: 60px 20px;
      position: relative;
    }

    .video-play {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 80px;
      height: 80px;
      background: #f39c12;
      border-radius: 50%;
      color: #fff;
      font-size: 2rem;
      transition: all 0.3s ease;
      box-shadow: 0 5px 20px rgba(243, 156, 18, 0.4);
    }

    .video-play:hover {
      transform: scale(1.1);
      background: #e67e22;
    }

    .video-caption {
      font-size: 1rem;
      opacity: 0.9;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .counter-num {
        font-size: 2rem;
      }

      .single-project {
        margin-bottom: 20px;
      }
    }
  </style>
</head>