<?php
include 'db.php';
session_start();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Kiểm tra tài khoản và mật khẩu
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? AND password = ?');
    $stmt->execute([$username, $password]);
    if ($user = $stmt->fetch()) {
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit();
    } else {
        $errors[] = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <style>
        .container {
            max-width: 500px;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Login</h1>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="register.php" class="btn btn-link">Don't have an account? Register</a>
        </form>
    </div>
</body>

</html>