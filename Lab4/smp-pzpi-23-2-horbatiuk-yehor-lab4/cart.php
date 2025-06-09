<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include 'includes/header.php'; ?>
  <main>
    <h2>Your Cart</h2>
    <?php
    $products = [
      1 => ['name' => 'Cola', 'price' => 2.5],
      2 => ['name' => 'Juice', 'price' => 3.0],
      3 => ['name' => 'Water', 'price' => 1.0]
    ];
    $cart = $_SESSION['cart'] ?? [];
    if (empty($cart)) {
      echo '<p>Your cart is empty. <a href="index.php">Continue Shopping</a></p>';
    } else {
      echo '<ul class="cart-items">';
      $total = 0;
      foreach ($cart as $id => $qty):
        $product = $products[$id];
        $subtotal = $product['price'] * $qty;
        $total += $subtotal;
      ?>
        <li><?= htmlspecialchars($product['name']) ?> — Qty: <?= $qty ?> — $<?= number_format($subtotal, 2) ?></li>
      <?php endforeach;
      echo '</ul>';
      echo '<p><strong>Total: $' . number_format($total, 2) . '</strong></p>';
      echo '<form action="api/clear_cart.php" method="POST"><button type="submit">Clear Cart</button></form>';
    }
    ?>
  </main>
  <?php include 'includes/footer.php'; ?>
</body>
</html>
