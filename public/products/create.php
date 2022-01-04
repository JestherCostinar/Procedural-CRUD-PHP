<?php
require_once "../../database.php";
require_once "../../functions.php";
$title = "";
$description = "";
$price = "";
$errors = [];
$product = [
    'image' => ''
];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once "../../validate_product.php";

    if (empty($errors)) {     
        $statement = $pdo->prepare("INSERT INTO products(image, title, description, price, create_date)
        VALUES (:image, :title, :description, :price, :date)");
        $statement->bindValue(':image', $imagePath);
        $statement->bindValue(':title', $title);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', date('Y-m-d h:i:s'));
        $statement->execute();
        header("Location: index.php");
    }
}


?>

<?php include_once "../../views/partials/header.php" ?>

<h1>Create Product</h1>

<p>
    <a href="index.php" class="btn btn-success">Go back to Product</a>
</p>

<?php include_once "../../views/products/form.php" ?>

</body>

</html>