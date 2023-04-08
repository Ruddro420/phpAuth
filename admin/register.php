<?php

include_once '../classes/Register.php';
$re = new Register(); // create the object

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addUser = $re->AddUser($_POST);
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class='row'>
            <div class='col'>
                <span>
                    <?php
                    if (isset($addUser)) {
                        ?>
                        <div class="w-50 m-auto shadow alert alert-warning alert-dismissible fade show mb-2" role="alert">
                            <?=$addUser?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                    ?>
                </span>
                <div class='card w-50 m-auto shadow'>
                    <div class='card-body'>
                        <div class='card-header text-center'>
                            <h2>Register</h2>
                        </div>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name</label>
                                <input name='name' type="text" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone</label>
                                <input name='phone' type="number" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp">

                            </div>
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
                            <button  type="submit" class="btn btn-primary">Register</button>
                            <a class="btn btn-success" href="login.php">Login</a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Boostartp JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
                crossorigin="anonymous"></script>
</body>

</html>