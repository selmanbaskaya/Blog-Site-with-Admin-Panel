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

    <title>Bloglar | Admin Yönetim Paneli</title>

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
    $id = intval($_GET["id"]);
    if (@$_GET["is"] == "aktif") {
        if ($_GET["durum"] == 1) {
            $durum = 0;
        } else {
            $durum = 1;
        }

        $aktif =  $db->prepare("UPDATE `blog` SET `aktif` = :a WHERE `id` = :i");
        $aktif->bindValue(":a", $durum, PDO::PARAM_INT);
        $aktif->bindValue(":i", $id, PDO::PARAM_INT);
        if ($aktif->execute()) {
            header("Location: tables.php?i=ekle");
        } else {
            header("Location: tables.php?i=hata");
        }
    }

    if (@$_GET["is"] == "sil") {
        $sil = $db->prepare("DELETE FROM `blog` WHERE `id` = :i");
        $sil->bindValue(":i", $id, PDO::PARAM_INT);
        if ($sil->execute()) {
            header("Location: tables.php?i=ekle");
        } else {
            header("Location: tables.php?i=ekle");
        }
    }
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
                <h1 class="h3 mb-2 text-gray-800">Blog Yazıları</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="blog_ekle.php" class="btn btn-success mr-3">Blog Ekle +</a>
                        <?php
                            if (@$_GET["i"] == "ekle") {
                                echo "<span class='text-success'>Ekleme İşlemi Başarılı</span>";
                            } elseif (@$_GET["i"] == "hata") {
                                echo "<span class='text-danger'>Ekleme İşlemi Gerçekleştirilemedi</span>";
                            }
                        ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Başlık</th>
                                    <th>Tarih</th>
                                    <th>Aktif</th>
                                    <th>Araçlar</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Başlık</th>
                                    <th>Tarih</th>
                                    <th>Aktif</th>
                                    <th>Araçlar</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                    $sql = $db->prepare("SELECT * FROM `blog` ORDER BY `id` DESC");
                                    $sql->execute();
                                    while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <tr>
                                    <td><?= $row["id"] ?></td>
                                    <td><?= $row["baslik"] ?></td>
                                    <td><?= $row["tarih"] ?></td>
                                    <td>
                                        <?php
                                            if ($row["aktif"] == 1) { ?>
                                                <a href="tables.php?is=aktif&id=<?= $row['id'] ?>&durum=<?= $row['aktif'] ?>"
                                                    onclick="return confirm('Aktiflik durumunu değiştirmek istediğinize emin misiniz?')"
                                                    class="btn btn-success btn-xs">Aktif</a>
                                        <?php } else { ?>
                                            <a href="tables.php?is=aktif&id=<?= $row['id'] ?>&durum=<?= $row['aktif'] ?>"
                                               onclick="return confirm('Aktiflik durumunu değiştirmek istediğinize emin misiniz?')"
                                               class="btn btn-danger btn-xs">Pasif</a>
                                        <?php } ?>
                                    </td>
                                    <td><a href="blog_duzenle.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-xs mr-3">Düzenle</a>
                                        <a href="tables.php?is=sil&id=<?= $row['id'] ?>" onclick="return confirm('Silmek İstediğinize Emin Misiniz?')"
                                           class="btn btn-danger btn-xs">Sil</a>
                                    </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
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

</body>

</html>
