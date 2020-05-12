<?php
    session_start();
    $_SESSION["girisKontrol"] = 1;
    unset($_SESSION["username"]);
    header("Location: index.php?i=cikis");
    session_destroy();
