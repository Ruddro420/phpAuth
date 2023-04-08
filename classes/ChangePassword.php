<?php
include_once '../lib/Database.php';
include_once '../helpers/Format.php';


class ChangePassword
{
    private $db;
    private $fr;

    public function __construct()
    {
        $this->db = new Database();
        $this->fr = new Format();
    }


    public function changePass($data)
    {
        $email = $this->fr->validation($data['email']);
        $n_password = $this->fr->validation(md5($data['n_password']));
        $c_password = $this->fr->validation(md5($data['c_password']));
        $token = $this->fr->validation($data['token']);



        if (!empty($token)) {

            if (!empty($email) || !empty($n_password) || !empty($c_password)) {

                $token_q = "SELECT v_token FROM tbl_user WHERE v_token = '$token'";

                $token_result = $this->db->select($token_q);


                if(!empty($token_result) && $token_result !== true)
                {
                    if (mysqli_num_rows($token_result) > 0) {


                        if ($n_password == $c_password) {
    
                            $update_pass = "UPDATE tbl_user SET `password` = '$n_password' WHERE v_token = '$token'";
    
                            $up_result = $this->db->update($update_pass);
                            if ($up_result) {
    
    
                                $new_token = md5(rand());
                                $up_token = "UPDATE tbl_user SET `v_token` = '$new_token' WHERE v_token = '$token'";
    
                                $up_result = $this->db->update($up_token);
    
                                $success = 'Password change successfully';
                                return $success;
                            } else {
                                $error = 'Password not Change';
                                return $error;
                            }
                        } else {
                            $error = 'Password not  match';
                            return $error;
                        }
    
                    } else {
                        $error = 'Invalid Token';
                        return $error;
                    }
                }else{
                    $error = 'Invalid Token';
                    return $error;
                }

               

            } else {
                $error = 'Filds Must not be empty';
                return $error;
            }
        } else {
            $error = 'Token is not avaiable';
            return $error;
        }


    }
}


?>