<?php
include_once '../lib/Session.php';
Session::loginCheck();
include_once '../lib/Database.php';
include_once '../helpers/Format.php';



class AdminLogin{


    private $db;
    private $fr;

    public function __construct(){
        $this->db = new Database();
        $this->fr = new Format();
    }

    public function LoginUser($email, $password){

        $email = $this->fr->validation($email);
        $password = $this->fr->validation(md5($password));

        if(empty($email) || empty($password)){
            $error = "Fildes Must Not Be empty";
            return $error;
        }

        else{
            $select = "SELECT * FROM tbl_user WHERE `email` = '$email' AND `password` = '$password'";
            $result = $this->db->select($select);

            if($result){
                $row = mysqli_fetch_assoc($result);

                if($row['v_status'] == 1){
                    
                    Session::set('login',true);
                    Session::set('username',$row['username']);
                    $_SESSION['userName'] = $row['username'];
                    header('location:index.php');

                }else{
                    $error = "Please Varify Your Email";
                    return $error;
                }
            }
            else{
                $error = "Invalid Email Or Password";
                return $error;
            }
        }
    }
}


?>