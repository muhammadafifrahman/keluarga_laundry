<!DOCTYPE html>
<html>

<head>
    <title>SISTEM INFORMASI KELUARGA LAUNDRY</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
</head>

<body style="background: #f0f0f0">
    <br /><br />
    <center>
        <h2>SISTEM INFORMASI KELUARGA LAUNDRY</h2>
    </center>
    <br /><br />

    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <?php
                session_start();
                if (isset($_GET['pesan'])) {
                    if ($_GET['pesan'] == "gagal") {
                        echo "<div class='alert alert-danger'>Login gagal! username dan password salah!</div>";
                    } else if ($_GET['pesan'] == "logout") {
                        echo "<div class='alert alert-info'>Anda telah berhasil logout</div>";
                    } else if ($_GET['pesan'] == "belum_login") {
                        echo "<div class='alert alert-danger'>Anda harus login untuk mengakses halaman admin</div>";
                    }
                }
                ?>

                <div class="panel">
                    <br />
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="login" class="tab-pane active">
                                <form action="login.php" method="post">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Log In">
                                </form>
                            </div>

                            <div id="register" class="tab-pane">
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
                            </div>
                        </div>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
</body>

</html>