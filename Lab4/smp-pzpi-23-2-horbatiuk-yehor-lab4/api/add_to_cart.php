<?php
session_start();
$id = (int)($_POST['id'] ?? 0);
$qty = max(1, (int)($_POST['qty'] ?? 1));
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
$_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
header('Content-Type: application/json');
echo json_encode(['success' => true]);
exit;
