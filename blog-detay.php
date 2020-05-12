<?php
    require_once 'admin/inc-functions.php';
    @$id = intval($_GET["id"]);

    $cek = $db->prepare("SELECT * FROM `blog` WHERE `id` = :id LIMIT 1");
    $cek->bindValue(":id", $id, PDO::PARAM_INT);
    $cek->execute();

    $row = $cek->fetch(PDO::FETCH_ASSOC);

    if ($row["aktif"] == 0) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="tr">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $row["baslik"] ?></title>

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
  <header class="masthead" style="background-image: url('img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1><?= $row["baslik"] ?></h1>
            <h2 class="subheading"><?= $row["at_baslik"] ?></h2>
            <span class="meta">Posted by
              <a href="#">Admin</a>
              <?= $row["tarih"] ?><span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?= htmlspecialchars_decode($row["aciklama"]) ?>
        </div>
      </div>
    </div>
  </article>

  <hr>

  <!-- Footer -->
  <?php
    require 'includes/inc-footer.php';
  ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="js/clean-blog.min.js"></script>

</body>

</html>
