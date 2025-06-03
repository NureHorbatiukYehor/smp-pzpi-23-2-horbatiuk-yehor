<?php
session_start();

$id = intval($_POST['id']);
$qty = intval($_POST['qty']);

if ($id > 0 && $qty > 0) {
  if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
  }
  if (!isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = 0;
  }
  $_SESSION['cart'][$id] += $qty;
}

http_response_code(200);
