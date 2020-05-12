<?php
    require_once 'inc-functions.php';
?>

<!DOCTYPE html>
<html lang="tr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hakkımızda | Admin Yönetim Paneli</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
<?php
    if (@$_POST["submit"]) {
        $sil = $db->prepare("DELETE FROM `hakkimizda`");
        $sil->execute();

        $aciklama = htmlspecialchars($_POST["aciklama"], ENT_QUOTES, 'UTF-8');
        $ekle = $db->prepare("INSERT INTO `hakkimizda` (`aciklama`) VALUES (:aciklama) ");
        $ekle->bindValue(":aciklama", $aciklama, PDO::PARAM_STR);

        if ($ekle->execute()) {
            header("Location: hakkimizda.php?i=ekle");
        } else {
            //Hata varsa ekranda göstermek için
            //print_r($ekle->errorInfo());
            header("Location: hakkimizda.php?i=hata");
        }
    }

    $cek = $db->prepare("SELECT * FROM `hakkimizda` ORDER BY `id` DESc LIMIT 1");
    $cek->execute();
    $row = $cek->fetch(PDO::FETCH_ASSOC);
?>

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    require_once 'inc-sidebar.php';
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            require_once 'inc-menu.php';
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Hakkımızda</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="anasayfa.php" class="btn btn-warning"><b>< </b>Geri Dön </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="col-lg-6">
                                <form role="form" action="" method="post">
                                    <div class="form-group">
                                        <label>Açıklama</label>
                                        <textarea class="form-control" id="mytextarea" name="aciklama" rows="3" placeholder="Açıklama Giriniz">
                                            <?= $row["aciklama"] ?>
                                        </textarea>
                                    </div>
                                    <input type="submit" name="submit" value="Kaydet" class="btn btn-success">
                                    <button type="reset" class="btn btn-warning">Temizle</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<script src="./js/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>
</body>

</html>
