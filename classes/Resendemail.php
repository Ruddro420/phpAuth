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

class Resendemail
{


    private $db;
    private $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }
    public function resendEmail($email)
    {

        function resend_email_varifi($name, $email, $v_token)
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

        $email = $this->fr->validation($email);
        $email = mysqli_real_escape_string($this->db->link, $email);

        if (empty($email)) {
            $error = 'Email Must not be empty';
            return $error;
        } else {
            $checkEmail = "SELECT * FROM tbl_user WHERE email = '$email'";
            $emailResult = $this->db->select($checkEmail);

            if ($emailResult > '0') {
                $row = mysqli_fetch_assoc($emailResult);
                if ($row['v_status'] == 0) {

                    $name = $row['username'];
                    $email = $row['email'];
                    $v_token = $row['v_token'];

                    resend_email_varifi($name, $email, $v_token);

                    $success = 'Varification Email Link Has Been Sent in your email address';
                    return $success;

                } else {
                    $error = 'Email already varified please login';
                    return $error;
                }
            } else {
                $error = 'Email is not register please register the email address';
                return $error;
            }
        }
    }


}


?>