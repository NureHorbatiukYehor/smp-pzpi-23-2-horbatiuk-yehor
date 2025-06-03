<?php
session_start();

$products = [
  1 => ['name' => 'Cola', 'price' => 2.0],
  2 => ['name' => 'Pepsi', 'price' => 1.8],
  3 => ['name' => 'Sprite', 'price' => 1.5]
];

$cart = $_SESSION['cart'] ?? [];
$total = 0;
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>Your Cart</h1>
    <a href="index.html">Continue Shopping</a>
  </header>

  <main>
    <?php if (empty($cart)): ?>
      <p>Your cart is empty. <a href="index.html">Go to shopping</a></p>
    <?php else: ?>
      <table>
        <tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr>
        <?php foreach ($cart as $id => $qty): ?>
          <?php
            $item = $products[$id];
            $sum = $item['price'] * $qty;
            $total += $sum;
          ?>
          <tr>
            <td><?= $item['name'] ?></td>
            <td>$<?= number_format($item['price'], 2) ?></td>
            <td><?= $qty ?></td>
            <td>$<?= number_format($sum, 2) ?></td>
          </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="3"><strong>Total:</strong></td>
          <td><strong>$<?= number_format($total, 2) ?></strong></td>
        </tr>
      </table>
      <form method="POST" action="api/clear_cart.php">
        <button type="submit">Clear Cart</button>
      </form>
    <?php endif; ?>
  </main>

  <footer>
    <p>&copy; 2025 Drink Shop</p>
  </footer>
</body>
</html>
