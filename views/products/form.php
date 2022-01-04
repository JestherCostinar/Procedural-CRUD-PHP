<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error) {
            echo $error . '<br>';
        } ?>
    </div>
<?php endif; ?>
<form action="" method="post" enctype="multipart/form-data">
    <img src="/<?php echo $product['image'] ?>" alt="">
    <div class="mb-3">
        <label class="form-label">
            Image
        </label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="mb-3">
        <label class="form-label">
            Title
        </label>
        <input type="text" class="form-control" name="title" value="<?php echo $title ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">
            Description
        </label>
        <textarea type="text" class="form-control" name="description"><?php echo $description ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">
            Price
        </label>
        <input type="number" step=".01" class="form-control" name="price" value="<?php echo $price ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>