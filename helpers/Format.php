<?php

class Format
{
    public function validation($data)
    {
        $data = trim($data); // remove duplicates
        $data = stripslashes($data);
        return $data;
    }
}

?>