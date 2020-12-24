<?php
require_once 'db/connection.php';

class User 
{
    public function __construct()
    {
        
    }
    public static function validateUser($username, $password)
    {
        $db=DB::getInstance();
        $sql="SELECT * FROM `person` WHERE username=? and password=? ";
        $para = $db->prepare($sql);
        $para->execute([$username,$password]);
        while ($para->fetch()) {
            return 1;
        }
        return 0;
    }
}
