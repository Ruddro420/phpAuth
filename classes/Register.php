<?php

include_once '../lib/Database.php';
include_once '../helpers/Format.php';
// php mailer specific
include_once '../PHPmailer/Exception.php';
include_once '../PHPmailer/PHPMailer.php';
include_once '../PHPmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Register
{

    public $db;
    public $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function AddUser($data)
    {

        function sendemail_varifi($name, $email, $v_token)
        {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
            $mail->isSMTP(); //Send using SMTP
            $mail->SMTPAuth = true; //Enable SMTP authentication

            $mail->Host = 'smtp.gmail.com';
            $mail->Username = 'aliruddro@gmail.com'; //SMTP username
            $mail->Password = 'hijqhflfddppapra';

            $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('aliruddro@gmail.com', $name);
            $mail->addAddress($email);

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Email Variations';

            $email_template = "
                <h2>You Have Register The System</h2>
                <h5>Please Verify your email address to login</h5>
                <a href='http://localhost/phpProject/phpBlog/admin/verify-email.php?token=$v_token'>Click Here</a>
            ";

            $mail->Body = $email_template;
            $mail->send();
        }

        $name = $this->fr->validation($data['name']);
        $phone = $this->fr->validation($data['phone']);
        $email = $this->fr->validation($data['email']);
        $password = $this->fr->validation(md5($data['password']));
        $v_token = md5(rand());

        if (empty($name) || empty($phone) || empty($email) || empty($password)) {
            $error = "Field Must Be Required";
            return $error;
        } else {
            // Email Checking
            $e_query = "SELECT * FROM `tbl_user` WHERE `email` = '$email'";

            $check_email = $this->db->select($e_query);

            if ($check_email > '0') {
                $error = 'Email already exists';
                return $error;
                header('location:register.php');
            } else {
                $insert_query = "INSERT INTO `tbl_user` (`username`, `email`, `phone`, `password`, `v_token`) VALUES ('$name','$email','$phone','$password','$v_token')";

                $insert_row = $this->db->insert($insert_query);

                if ($insert_row) {
                    sendemail_varifi($name, $email, $v_token);
                    $success = 'Registered successfully. Check your email address for valid email address';
                    return $success;
                } else {
                    $error = 'Something Went Wrong';
                    return $error;
                }
            }
        }
    }
}


?>