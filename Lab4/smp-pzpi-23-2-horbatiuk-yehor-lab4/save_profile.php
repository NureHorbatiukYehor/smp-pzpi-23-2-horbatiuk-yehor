<?php
session_start();

$errors = [];

$first_name = trim($_POST['first_name']  ?? '');
$last_name  = trim($_POST['last_name']   ?? '');
$birthdate  = $_POST['birthdate']        ?? '';
$about      = trim($_POST['about']       ?? '');
$photo_dest = 'uploads/avatar.jpg';

if (strlen($first_name) < 2) {
    $errors[] = 'Ім’я має містити щонайменше 2 символи.';
}

if (strlen($last_name) < 2) {
    $errors[] = 'Прізвище має містити щонайменше 2 символи.';
}

if (!strtotime($birthdate)) {
    $errors[] = 'Невірна дата народження.';
} else {
    $age = (int)((time() - strtotime($birthdate)) / (365.25 * 24 * 3600));
    if ($age < 16) {
        $errors[] = 'Користувачу має бути не менше 16 років.';
    }
}

if (strlen($about) < 50) {
    $errors[] = 'Про себе має містити не менше 50 символів.';
}

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $tmp   = $_FILES['photo']['tmp_name'];
    $ext   = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }
        move_uploaded_file($tmp, $photo_dest);
    } else {
        $errors[] = 'Фото повинно бути у форматі JPG або PNG.';
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: profile.php');
    exit;
}

$newProfile = [
    'first_name' => $first_name,
    'last_name'  => $last_name,
    'birthdate'  => $birthdate,
    'about'      => $about,
    'photo'      => $photo_dest,
];

file_put_contents(
    __DIR__ . '/data/profile.php',
    "<?php\nreturn " . var_export($newProfile, true) . ";\n"
);

header('Location: profile.php');
exit;


header('Location: profile.php');
exit;
