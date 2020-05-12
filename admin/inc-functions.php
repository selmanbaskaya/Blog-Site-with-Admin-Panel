<?php
    header("Content-Type: text/html; charset=utf-8");
    error_reporting(0);
    setlocale(LC_ALL, 'tr_TR.UTF-8', 'tr_TR', 'tr', 'turkish');

    $DBHOST = "localhost";
    $DBUser = "root";
    $DBPass = "";
    $DBName = "udemy";

    try {
        $db = new PDO("mysql:host=$DBHOST;dbname=$DBName", $DBUser, $DBPass);
    } catch (PDOException $exception) {
        echo $exception->getMessage();
    }
    $db->exec("SET NAMES utf-8; SET CHARSET 'utf-8'");

    define("_URL", "http://localhost:8080/udemy/");
?>

