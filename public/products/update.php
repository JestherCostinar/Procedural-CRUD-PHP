<?php
require_once "../../database.php";
require_once "../../functions.php";


$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$fetchProduct = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$fetchProduct->bindValue(':id', $id);
$fetchProduct->execute();
$product = $fetchProduct->fetch(PDO::FETCH_ASSOC);

$title = $product['title'];
$description = $product['description'];
$price = $product['price'];
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require_once "../../validate_product.php";

    if (empty($errors)) {
        $updateProduct = $pdo->prepare("UPDATE products SET title = :title, image = :image, 
        description = :description, price = :price WHERE id = :id");
        $updateProduct->bindValue(':title', $title);
        $updateProduct->bindValue(':image', $imagePath);
        $updateProduct->bindValue(':description', $description);
        $updateProduct->bindValue(':price', $price);
        $updateProduct->bindValue(':id', $id);
        $updateProduct->execute();
        header('Location: index.php');
    }
}

?>

<?php include_once "../../views/partials/header.php" ?>

<p>
    <a href="index.php" class="btn btn-success">Go back to Product</a>
</p>

<h1>Update Products <b><?php echo $product['title'] ?></b></h1>

<?php include_once "../../views/products/form.php" ?>
</body>

</html>