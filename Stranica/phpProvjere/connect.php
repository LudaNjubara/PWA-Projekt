<?php
    header('Content-Type: text/html; charset=utf-8');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $basename = "pwa_projekt";

    // Create connection
    $sqlConnect = mysqli_connect($servername, $username, $password, $basename) or die("Could not connect to SQL Server! " . mysqli_connect_error());
    mysqli_set_charset($sqlConnect, "utf8");
?>
