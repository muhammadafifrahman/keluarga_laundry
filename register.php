<?php

session_start();
// Connect to database
include 'koneksi.php';

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    // Validate username
    if (empty($_POST['username'])) {
        $_SESSION['error'] = 'Username harus diisi!';
        header('Location: register.php');
        exit();
    }

    // Validate password
    if (empty($_POST['password'])) {
        $_SESSION['error'] = 'Password harus diisi!';
        header('Location: register.php');
        exit();
    }

    // Validate confirm password
    if ($_POST['password'] != $_POST['confirm_password']) {
        $_SESSION['error'] = 'Password tidak cocok!';
        header('Location: register.php');
        exit();
    }



    // Check if username already exists
    $query = "SELECT * FROM admin WHERE username = '" . $_POST['username'] . "'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = 'Username sudah terdaftar!';
        header('Location: register.php');
        exit();
    }

    // Hash password
    $password = md5($_POST['password'], PASSWORD_DEFAULT);

    // Insert new user into database
    $query = "INSERT INTO admin (username, password) VALUES ('" . $_POST['username'] . "', '" . $password . "')";
    mysqli_query($koneksi, $query);

    // Set session variables
    $_SESSION['username'] = $username;  // Set the username in the session
    $_SESSION['status'] = "login";     // Set the status as logged in

    // Redirect to login page
    header("location:admin/index.php");
    exit();
}

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
    unset($_SESSION['error']);
}
?>

<form action="register.php" method="post">
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="confirm_password">
    </div>
    <input type="submit" class="btn btn-primary" value="Register">
</form>