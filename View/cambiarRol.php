<?php
include_once '../config.php';
$data = data_submitted();
$url = $_GET['url'];



header("Status: 301 Moved Permanently");
if (isset($data['idrol'])) {
  $_SESSION['rol'] = $_GET['idrol'];
  header("Location: $url");
}