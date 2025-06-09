<?php

function displayMenu() {
    echo "################################\n";
    echo "# ПРОДОВОЛЬЧИЙ МАГАЗИН \"ВЕСНА\" #\n";
    echo "################################\n";
    echo "1 Вибрати товари\n";
    echo "2 Отримати підсумковий рахунок\n";
    echo "3 Налаштувати свій профіль\n";
    echo "0 Вийти з програми\n";
    echo "Введіть команду: ";
}

function displayProducts() {
    echo "№  НАЗВА                 ЦІНА\n";
    echo "1  Молоко пастеризоване  12\n";
    echo "2  Хліб чорний           9\n";
    echo "3  Сир білий             21\n";
    echo "4  Сметана 20%           25\n";
    echo "5  Кефір 1%              19\n";
    echo "6  Вода газована         18\n";
    echo "7  Печиво \"Весна\"        14\n";
    echo "   -----------\n";
    echo "0  ПОВЕРНУТИСЯ\n";
    echo "Виберіть товар: ";
}

function displayCart($cart) {
    if (empty($cart)) {
        echo "КОШИК ПОРОЖНІЙ\n";
        return;
    }
    echo "У КОШИКУ:\n";
    echo "НАЗВА                 КІЛЬКІСТЬ\n";
    foreach ($cart as $item => $quantity) {
        echo "$item  $quantity\n";
    }
}

function displayBill($cart, $products) {
    if (empty($cart)) {
        echo "КОШИК ПОРОЖНІЙ\n";
        return;
    }
    echo "№  НАЗВА                 ЦІНА  КІЛЬКІСТЬ  ВАРТІСТЬ\n";
    $total = 0;
    $index = 1;
    foreach ($cart as $item => $quantity) {
        $price = $products[$item];
        $cost = $price * $quantity;
        $total += $cost;
        echo "$index  $item  $price  $quantity  $cost\n";
        $index++;
    }
    echo "РАЗОМ ДО CПЛАТИ: $total\n";
}

function validateName($name) {
    return !empty($name) && preg_match('/[a-zA-Zа-яА-Я]/u', $name);
}

function validateAge($age) {
    return $age >= 7 && $age <= 150;
}

$products = [
    "Молоко пастеризоване" => 12,
    "Хліб чорний" => 9,
    "Сир білий" => 21,
    "Сметана 20%" => 25,
    "Кефір 1%" => 19,
    "Вода газована" => 18,
    "Печиво \"Весна\"" => 14
];

$cart = [];
$userName = null;
$userAge = null;

while (true) {
    displayMenu();
    $command = trim(fgets(STDIN));

    switch ($command) {
        case "1":
            while (true) {
                displayProducts();
                $productCommand = trim(fgets(STDIN));
                if ($productCommand === "0") {
                    break;
                }
                if (!array_key_exists(array_keys($products)[$productCommand - 1] ?? null, $products)) {
                    echo "ПОМИЛКА! ВКАЗАНО НЕПРАВИЛЬНИЙ НОМЕР ТОВАРУ\n";
                    continue;
                }
                $productName = array_keys($products)[$productCommand - 1];
                echo "Вибрано: $productName\n";
                echo "Введіть кількість, штук: ";
                $quantity = (int)trim(fgets(STDIN));
                if ($quantity < 0 || $quantity >= 100) {
                    echo "ПОМИЛКА! НЕКОРЕКТНА КІЛЬКІСТЬ\n";
                    continue;
                }
                if ($quantity === 0) {
                    echo "ВИДАЛЯЮ З КОШИКА\n";
                    unset($cart[$productName]);
                } else {
                    $cart[$productName] = $quantity;
                }
                displayCart($cart);
            }
            break;

        case "2":
            displayBill($cart, $products);
            break;

        case "3":
            echo "Ваше імʼя: ";
            $name = trim(fgets(STDIN));
            if (!validateName($name)) {
                echo "ПОМИЛКА! Імʼя не може бути порожнім і повинно містити хоча б одну літеру\n";
                continue;
            }
            echo "Ваш вік: ";
            $age = (int)trim(fgets(STDIN));
            if (!validateAge($age)) {
                echo "ПОМИЛКА! Вік повинен бути від 7-ми до 150-ти років\n";
                continue;
            }
            $userName = $name;
            $userAge = $age;
            echo "Профіль оновлено: Імʼя - $userName, Вік - $userAge\n";
            break;

        case "0":
            echo "Дякуємо за використання програми! До побачення!\n";
            exit;

        default:
            echo "ПОМИЛКА! Введіть правильну команду\n";
    }
}