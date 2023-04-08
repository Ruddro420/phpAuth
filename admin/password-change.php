<?php

include_once '../classes/ChangePassword.php';

$cng = new ChangePassword();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ChangeP = $cng->changePass($_POST);
  
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Change </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <div class='row'>
            <div class='col'>

                <span>
                    <?php
                    if (isset($ChangeP)) {
                        ?>
                        <div class="w-50 m-auto shadow alert alert-warning alert-dismissible fade show mb-2" role="alert">
                            <?= $ChangeP ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php
                    }
                    ?>
                </span>

                <div class='card w-50 m-auto shadow'>
                    <div class='card-body'>
                        <div class='card-header text-center'>
                            <h2>Password Reset Form</h2>
                        </div>
                        <form method="POST">


                            <div class="mb-3">
                                <input name='token' type="hidden" class="form-control" value="<?php
                                if (isset($_GET['token'])) {
                                    echo $_GET['token'];
                                }
                                ?>">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input name='email' type="email" class="form-control" value="<?php
                                if (isset($_GET['email'])) {
                                    echo $_GET['email'];
                                }
                                ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">New Password</label>
                                <input name='n_password' type="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">COnfirm Password</label>
                                <input name='c_password' type="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-info">Change Password</button>
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