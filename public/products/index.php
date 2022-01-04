<?php
require_once "../../database.php";

$search = $_GET['search'] ?? null;

if ($search) {
    $statement = $pdo->prepare("SELECT * FROM products WHERE title LIKE :title ORDER BY create_date");
    $statement->bindValue(":title", "%$search%");
} else {
    $statement = $pdo->prepare("SELECT * FROM products ORDER BY create_date");
}
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);


?>

<?php include_once "../../views/partials/header.php" ?>

<h1>Product CRUD</h1>

<p>
    <a href="create.php" class="btn btn-success">Create Product</a>
</p>
<form>
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="search" placeholder="Search Product" value="<?php echo $search ?>">
        <input type="submit" class="input-group-text">
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
            <th scope="col">Date Created</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $i => $product) : ?>
            <tr>
                <th scope="row"><?php echo $i + 1 ?></th>
                <td><img src="/<?php echo $product['image'] ?>" class="thumb-img" alt=""></td>
                <td><?php echo $product['title'] ?></td>
                <td><?php echo $product['description'] ?></td>
                <td><?php echo $product['price'] ?></td>
                <td><?php echo $product['create_date'] ?></td>
                <td>
                    <a href="delete.php?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                    <a href="update.php?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-success">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>

</html>