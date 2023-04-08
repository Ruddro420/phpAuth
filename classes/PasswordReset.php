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

class PasswordReset
{


    private $db;
    private $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function PasswordReset($email)
    {

        function send_password_reset($name, $email, $v_token)
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
    <a href='http://localhost/phpProject/phpBlog/admin/password-change.php?token=$v_token&email=$email'>Click Here</a>
";

            $mail->Body = $email_template;
            $mail->send();


        }

        $email = $this->fr->validation($email);
        $v_token = md5(rand());

        if (empty($email)) {
            $error = 'Email must not be empty';
            return $error;
        } else {
            $checkEmail = "SELECT * FROM tbl_user WHERE email = '$email'";
            $email_result = $this->db->select($checkEmail);

            if ($email_result > '0') {

                $row = mysqli_fetch_assoc($email_result);
                $name = $row['username'];
                $email = $row['email'];
                $query = "UPDATE tbl_user SET v_token = '$v_token' WHERE email = '$email' LIMIT 1";

                $update_token = $this->db->update($query);

                if ($update_token) {

                    send_password_reset($name, $email, $v_token);
                    $success = 'Password Reset Email send successfully';
                    return $success;

                } else {
                    $error = 'Something went wrong';
                    return $error;
                }

            } else {
                $error = 'Email not found';
                return $error;
            }
        }

    }


}



?>