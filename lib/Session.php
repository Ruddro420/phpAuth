<?php
class Session
{
    //create a new session
    public static function int()
    {
        session_start();
    }
    //set the session
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    // get the session
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

       // without login redirect to login page
       public static function checkSession()
       {
           self::int(); // stat the session
           if (self::get('login') == false) {
               self::destroy();
               header('Location:login.php');
           }
       }

    // login check and access index page
    public static function loginCheck()
    {
        self::int(); // stat the session

        if (self::get('login') == true) {
            header('Location:index.php');
        }
    }

    // session distroying
    public static function destroy()
    {
        session_destroy();
        header('location:login.php');
    }
}

?>