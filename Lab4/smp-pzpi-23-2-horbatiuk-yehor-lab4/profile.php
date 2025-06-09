<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

// Завантажуємо поточний профіль
$profile = file_exists(__DIR__.'/data/profile.php')
         ? include __DIR__.'/data/profile.php'
         : [
             'first_name'=>'',
             'last_name'=>'',
             'birthdate'=>'',
             'about'=>'',
             'photo'=>'uploads/avatar.jpg'
           ];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <title>Профіль користувача</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include 'includes/header.php'; ?>

  <main>
    <h2>Профіль користувача</h2>

    <?php if (!empty($_SESSION['errors'])): ?>
      <div class="errors">
        <ul>
          <?php foreach ($_SESSION['errors'] as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <form action="save_profile.php" method="POST" enctype="multipart/form-data">
      <label>
        Ім’я:<br>
        <input type="text" name="first_name"
               value="<?= htmlspecialchars($profile['first_name']) ?>">
      </label><br><br>

      <label>
        Прізвище:<br>
        <input type="text" name="last_name"
               value="<?= htmlspecialchars($profile['last_name']) ?>">
      </label><br><br>

      <label>
        Дата народження:<br>
        <input type="date" name="birthdate"
               value="<?= htmlspecialchars($profile['birthdate']) ?>">
      </label><br><br>

      <label>
        Про себе:<br>
        <textarea name="about" rows="5" cols="50"><?= 
          htmlspecialchars($profile['about']) ?></textarea>
      </label><br><br>

      <label>
        Фото:<br>
        <input type="file" name="photo" accept="image/*">
      </label><br><br>

      <?php if (is_file($profile['photo'])): ?>
        <div>
          <p>Поточне фото:</p>
          <img src="<?= htmlspecialchars($profile['photo']) ?>"
               alt="avatar" width="150">
        </div><br>
      <?php endif; ?>

      <button type="submit">Зберегти зміни</button>
    </form>
  </main>

  <?php include 'includes/footer.php'; ?>
</body>
</html>

