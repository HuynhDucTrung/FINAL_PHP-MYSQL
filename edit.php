<?php
include 'db.php';
include 'utils.php';  // Bao gồm file utils.php

$errors = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$id]);
    $product = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $description = $_POST['description'];
        $price = isset($_POST['price']) && is_numeric($_POST['price']) ? intval($_POST['price']) : 0;
        $type = $_POST['type'];
        $image = $product['image'];

        // Check if name is empty
        if (empty($name)) {
            $errors[] = 'Product name is required.';
        }

        // Check if product name already exists
        $stmt = $pdo->prepare('SELECT * FROM products WHERE LOWER(REPLACE(name, " ", "")) = LOWER(REPLACE(?, " ", "")) AND id != ?');
        $stmt->execute([$name, $id]);
        if ($stmt->fetch()) {
            $errors[] = 'Product name already exists.';
        }

        if (empty($errors)) {
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image = 'images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $image);
            }

            $sql = "UPDATE products SET name = ?, description = ?, price = ?, type = ?, image = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $description, $price, $type, $image, $id]);

            header('Location: index.php');
            exit();
        }
    }
} else {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <title>Edit Product</title>
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
        }

        img {
            max-width: 100px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Edit Product</h1>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="edit.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price" class="form-label">Price (VND)</label>
                <input type="number" step="1" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <div class="form-group">
                <label for="type" class="form-label">Product Type</label>
                <input type="text" class="form-control" id="type" name="type" value="<?php echo htmlspecialchars($product['type']); ?>" required>
            </div>
            <div class="form-group">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <?php if ($product['image']) : ?>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>