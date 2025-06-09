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
  <title>Drink Shop</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include 'includes/header.php'; ?>
  <main>
    <h2>Choose Your Drink</h2>
    <div class="products">
      <?php
      $products = [
        1 => ['name' => 'Cola', 'price' => 2.5],
        2 => ['name' => 'Juice', 'price' => 3.0],
        3 => ['name' => 'Water', 'price' => 1.0]
      ];
      foreach ($products as $id => $product):
      ?>
        <div class="product">
          <h3><?= htmlspecialchars($product['name']) ?></h3>
          <p>Price: $<?= number_format($product['price'], 2) ?></p>
          <form action="api/add_to_cart.php" method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>Qty: <input type="number" name="qty" value="1" min="1"></label>
            <button type="submit">Buy</button>
          </form>
        </div>
      <?php endforeach; ?>
    </div>
  </main>
  <?php include 'includes/footer.php'; ?>
</body>
</html>
