<?php
$title = $product['title'];
$description = $product['description'];
$price = $product['price'];
$imagePath = '';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (!$title) {
        $errors[] = 'Title is required';
    }

    if (!$price) {
        $errors[] = 'Price is required';
    }

    if (!is_dir(__DIR__ . '/public/images')) {
        mkdir(__DIR__ . '/public/images');
    }

    if (empty($errors)) {
        $image = $_FILES['image'] ?? null;
        $imagePath = $product['image'];


        if ($image && $image['tmp_name']) {
            if ($product['image']) {
                unlink(__DIR__ . '/public/' . $product['image']);
            }

            $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
            mkdir(dirname(__DIR__ . '/public/' . $imagePath));
            move_uploaded_file($image['tmp_name'], __DIR__ . '/public/' . $imagePath);
        }
    }
}
