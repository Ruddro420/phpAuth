<?php

include_once '../lib/Session.php';
Session::int(); // session start
include_once '../lib/Database.php';

$db = new Database; // database object

if (isset($_GET['token'])) {

    $token = $_GET['token'];

    $query = "SELECT v_token, v_status FROM tbl_user WHERE v_token = '$token'";

    $result = $db->select($query);

    if ($result != false) {


            $row = mysqli_fetch_assoc($result);

            if ($row['v_status'] == 0) {

                $click_token = $row['v_token'];
                $update_status = "UPDATE tbl_user SET v_status = 1 WHERE v_token = '$click_token'";

                $update_result = $db->update($update_status);

                if ($update_result) {
                    $_SESSION['status'] = 'Your Account Has Been Verified Successfully';
                    header('location:login.php');
                } else {
                    $_SESSION['status'] = 'Varification Failed';
                    header('location:login.php');
                }

            } else {
                $_SESSION['status'] = 'This Token Does Not Exist';
                header('location:login.php');
            }
        } else {
            $_SESSION['status'] = 'Not Allowed';
            header('location:login.php');
        }
    }

 else {
    $error = 'Not Allowed';
    return $error;
}




?>