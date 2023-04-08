<?php

include_once '../classes/AdminLogin.php';

$al = new AdminLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkLogin = $al->LoginUser($email, $password);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class='row'>
            <div class='col'>

                <span>
                    <?php
                    if (isset($_SESSION['status'])) {
                        ?>
                        <div class="w-50 m-auto shadow alert alert-warning alert-dismissible fade show mb-2" role="alert">
                            <?= $_SESSION['status'] ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                    ?>
                </span>
                <span>
                    <?php
                    if (isset($checkLogin)) {
                        ?>
                        <div class="w-50 m-auto shadow alert alert-warning alert-dismissible fade show mb-2" role="alert">
                            <?= $checkLogin ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                    ?>
                </span>


                <div class='card w-50 m-auto shadow'>
                    <div class='card-body'>
                        <div class='card-header text-center'>
                            <h2>Login</h2>
                        </div>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input name='email' type="email" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input name='password' type="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="register.php" name='register' type="submit" class="btn btn-primary">Register</a>
                            <a class="text-right" href="password-reset.php">Forgott your password</a>
                        </form>
                        <hr>
                        <h5>Did not receive your varification email? <a href="resend-email.php">Resend</a></h5>
                    </div>
                </div>
            </div>

            <!-- Boostartp JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
                crossorigin="anonymous"></script>
</body>

</html>