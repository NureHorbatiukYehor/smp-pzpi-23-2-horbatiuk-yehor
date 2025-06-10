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
      echo '<table class="cart-table">';
      echo '<thead><tr><th>Product</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr></thead>';
      echo '<tbody>';
      $total = 0;
      foreach ($cart as $id => $qty):
        $product = $products[$id];
        $subtotal = $product['price'] * $qty;
        $total += $subtotal;
      ?>
        <tr>
          <td><?= htmlspecialchars($product['name']) ?></td>
          <td><?= $qty ?></td>
          <td>$<?= number_format($product['price'], 2) ?></td>
          <td>$<?= number_format($subtotal, 2) ?></td>
        </tr>
      <?php endforeach;
      echo '</tbody>';
      echo '</table>';
      echo '<p class="cart-total"><strong>Total: $' . number_format($total, 2) . '</strong></p>';
      echo '<form action="api/clear_cart.php" method="POST"><button type="submit">Clear Cart</button></form>';
    }
    ?>
  </main>
  <?php include 'includes/footer.php'; ?>
</body>
</html>
