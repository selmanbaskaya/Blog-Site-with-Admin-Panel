<?php
    require_once 'admin/inc-functions.php';

    if (@$_POST["submit"]) {
        $ad = htmlspecialchars( $_POST["name"], ENT_QUOTES, 'UTF-8' );
        $email = htmlspecialchars( $_POST["email"], ENT_QUOTES, 'UTF-8' );
        $tel = htmlspecialchars( $_POST["phone"], ENT_QUOTES, 'UTF-8' );
        $mesaj = htmlspecialchars( $_POST["message"], ENT_QUOTES, 'UTF-8' );

        $ekle = $db->prepare("INSERT INTO `iletisim` (`ad`, `email`, `telefon`, `mesaj`)
VALUES (:ad, :email, :telefon, :mesaj)");
        $ekle->bindValue(":ad", $ad, PDO::PARAM_STR);
        $ekle->bindValue(":email", $email, PDO::PARAM_STR);
        $ekle->bindValue(":telefon", $tel, PDO::PARAM_STR);
        $ekle->bindValue(":mesaj", $mesaj, PDO::PARAM_STR);

        if ($ekle->execute()) {
            header("Location: contact.php?i=ok");
        } else {
            header("Location: contact.php?i=hata");
        }
    }
?>

<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Udemy PHP - İletişim</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="css/clean-blog.min.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <?php
    require 'includes/inc-nav.php';
  ?>

  <!-- Page Header -->
  <header class="masthead" style="background-image: url('img/contact-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="page-heading">
            <h1>Bizimle İletişime Geçin!</h1>
            <span class="subheading">Sizlerden gelen geri dönüşler ile büyüyoruz.</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
        <p>Lütfen Formu Doğru Şekilde Doldurunuz! En Kısa Sürede Geri Dönüş Sağlanacaktır..</p>
        <!-- Contact Form - Enter your email address on line 19 of the mail/contact_me.php file to make this form work. -->
        <!-- WARNING: Some web hosts do not allow emails to be sent through forms to common mail hosts like Gmail or Yahoo. It's recommended that you use a private domain email address! -->
        <!-- To use the contact form, your site must be on a live web host with PHP! The form will not work locally! -->
        <form action="contact.php#bildirim" method="post" enctype="multipart/form-data" >
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Name</label>
              <input type="text" class="form-control" placeholder="Ad (*)"   name="name" required data-validation-required-message="Lütfen adınızı giriniz.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Email Address</label>
              <input type="email" class="form-control" placeholder="E-Posta (*)" name="email" required data-validation-required-message="Lütfen e-posta adresinizi giriniz.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
              <label>Phone Number</label>
              <input type="tel" class="form-control" placeholder="Telefon Numarası (*)" name="phone" required data-validation-required-message="Lütfen telefon numaranızı giriniz.">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Message</label>
              <textarea rows="5" class="form-control" name="message" placeholder="Mesaj (*)" required data-validation-required-message="Lütfen mesajınızı giriniz."></textarea>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <br>
          <div id="success"></div>
          <div class="form-group">
              <input type="submit" name="submit" value="Gönder" class="btn btn-primary">
          </div>
            <div id="bildirim"></div>
            <?php
                if ($_GET["i"] == "ok") {
                    echo '<p class="text-success alert-success text-center p-2 rounded-pill">Mesajınız başarıyla iletilmiştir.</p>';
                } elseif ($_GET["i"] == "hata") {
                    echo '<p class="text-danger alert-danger text-center p-2 rounded-pill">Mesajınız iletilemedi.</p>';
                }
            ?>

        </form>
      </div>
    </div>
  </div>

  <hr>

  <!-- Footer -->
  <?php
    require 'includes/inc-footer.php';
  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Contact Form JavaScript -->
  <script src="js/jqBootstrapValidation.js"></script>
  <!--<script src="js/contact_me.js"></script>-->

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
