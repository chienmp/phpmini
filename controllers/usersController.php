<?php

require_once 'models/user.php';
require_once 'db/format.php';
require_once 'db/connection.php';

//check if session or cookie exists
if (isset($_SESSION['s1'])) {
    header('Location:index.php?controller=sports');

} else if (isset($_COOKIE['uname']) and isset($_COOKIE['psw'])) {
    $userid = ($_COOKIE['uname']);
    $pass = ($_COOKIE['psw']);
    $con = DB::getInstance();
    $query = $con->prepare("SELECT count(*) cntUser,id FROM person where username=? and password = ?");
    $query->execute([$userid, $pass]);
    $result = $query->fetch();
    $count = $result['cntUser'];
    if ($count > 0) {
        $_SESSION['s1'] = $userid;
        header('Location:index.php?controller=sports');
    }

} 

require_once 'controllers/BaseController.php';
class UsersController extends BaseController
{
    public function __construct()
    {
        $this->folder = 'logins';
    }
    public function index(){
        $this->render('login');
    }
    public function login()
    {
        /* if (isset($_SESSION['s1'])) {
            header('Location:index.php?controller=sports');
        
        } else if (isset($_COOKIE['uname']) and isset($_COOKIE['psw'])) {
            $userid = ($_COOKIE['uname']);
            $pass = ($_COOKIE['psw']);
            $con = DB::getInstance();
            $query = $con->prepare("SELECT count(*) cntUser,id FROM person where username=? and password = ?");
            $query->execute([$userid, $pass]);
            $result = $query->fetch();
            $count = $result['cntUser'];
            if ($count > 0) {
                $_SESSION['s1'] = $userid;
                header('Location:index.php?controller=sports');
            }
        
        } */
        if (isset($_POST['login'])) {
            $login = User::validateUser($_POST['uname'], $_POST['psw']);
            if ($login == 1) {
                //set cookie
                if (isset($_POST['remember'])) {
                    $hour = time() + 3600 * 24;
                    setcookie('uname', $_POST['uname'], $hour);
                    setcookie('psw', $_POST['psw'], $hour);
                    session_start();
                    $_SESSION['s1'] = $_POST['uname'];
                    header('Location:index.php?controller=sports');
                } else{
                    session_start();
                    $_SESSION['s1'] = $_POST['uname'];
                    header('Location:index.php?controller=sports');
                }
            } else {
                echo "<script>alert('Username and password is wrong')</script>";
            }
        }
    }
}
