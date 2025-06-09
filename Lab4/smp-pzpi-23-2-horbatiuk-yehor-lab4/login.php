<?php
session_start();
if (isset($_SESSION['user'])) {
  header('Location: index.php');
  exit;
}
$users = ['admin' => '123'
          , 'user' => '456']; 
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';
  if (isset($users[$username]) && $users[$username] === $password) {
    $_SESSION['user'] = $username;
    header('Location: index.php');
    exit;
  } else {
    $error = 'Invalid credentials';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <main>
    <h2>Login</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <?php if ($error): ?>
      <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
  </main>
</body>
</html>
