<?php
include_once '../config.php';
$data = data_submitted();
$url = $_GET['url'];


if (isset($data['idrol'])) {
  $_SESSION['rol'] = $_GET['idrol'];
}

header("Status: 301 Moved Permanently");
header("Location: $url");
