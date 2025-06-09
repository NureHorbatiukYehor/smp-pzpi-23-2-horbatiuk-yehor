<?php
session_start();
$profile = include 'data/profile.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Профіль</title>
</head>
<body>
  <h2>Редагувати профіль</h2>

  <?php if (!empty($_SESSION['errors'])): ?>
    <ul style="color: red;">
      <?php foreach ($_SESSION['errors'] as $error): ?>
        <li><?= htmlspecialchars($error) ?></li>
      <?php endforeach; unset($_SESSION['errors']); ?>
    </ul>
  <?php endif; ?>

  <form action="save_profile.php" method="POST" enctype="multipart/form-data">
    <label>Ім’я: <input type="text" name="first_name" value="<?= htmlspecialchars($profile['first_name']) ?>"></label><br>
    <label>Прізвище: <input type="text" name="last_name" value="<?= htmlspecialchars($profile['last_name']) ?>"></label><br>
    <label>Дата народження: <input type="date" name="birthdate" value="<?= $profile['birthdate'] ?>"></label><br>
    <label>Про себе:<br>
      <textarea name="about" rows="5" cols="40"><?= htmlspecialchars($profile['about']) ?></textarea>
    </label><br>
    <label>Фото: <input type="file" name="photo"></label><br>
    <?php if (is_file($profile['photo'])): ?>
      <p>Поточне фото:</p>
      <img src="<?= $profile['photo'] ?>" alt="Avatar" width="150">
    <?php endif; ?><br><br>
    <button type="submit">Зберегти</button>
  </form>
</body>
</html>