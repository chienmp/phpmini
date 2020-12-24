<?php
//check whether user logout or not
session_start();
if (isset($_REQUEST['c'])) {
    if (isset($_COOKIE['uname']) and isset($_COOKIE['psw'])) {
        setcookie('uname', $_COOKIE['uname'], time() - 1);
        setcookie('psw', $_COOKIE['psw'], time() - 1);
        session_destroy();
        header('Location:index.php?controller=users');
    } else {
        session_destroy();
        header('Location:index.php?controller=users');
    }
}

//login and logout
if ($_SESSION['s1']) {
    echo "Hello@" . $_SESSION['s1'];
    echo "<a href='index.php?controller=sports&c=1'>Logout</a>";
} else {
    header('Location:index.php?controller=users');
}

require_once 'controllers/BaseController.php';
require_once 'models/sport.php';
require_once 'db/format.php';

class SportsController extends BaseController
{

    public function __construct()
    {
        $this->folder = 'sports';
    }
    //check validation
    public function checkValidation($cate, $name)
    {
        $noerror = true;
        $cate_msg = "";
        $name_msg = "";
        // Validate category
        if (empty($cate)) {
            $cate_msg = "Field is empty.";
            $noerror = false;
        } elseif (!filter_var($cate, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $cate_msg = "Invalid entry.";
            $noerror = false;
        } else { $cate_msg = "";}
        // Validate name
        if (empty($name)) {
            $name_msg = "Field is empty.";
            $noerror = false;
        } elseif (!filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
            $name_msg = "Invalid entry.";
            $noerror = false;
        } else { $name_msg = "";}
        return $noerror;
    }
    //Read data
    public function index()
    {
        $sports = Sport::all();
        $data = array('sports' => $sports);
        $this->render('index', $data);
    }

    //redirect to update page
    public function edit()
    {
        $sports = Sport::find($_GET['id']);
        $data = array('sports' => $sports);
        $this->render('update', $data);
    }

    //update data
    public function update()
    {
        if (isset($_POST['updatebtn'])) {
            $cate = trim($_POST['category']);
            $name = trim($_POST['name']);
            $chk = $this->checkValidation($cate, $name);
            if ($chk) {
                $sports = Sport::update($_POST['id'], $_POST['category'], $_POST['name']);
                $data = array('sports' => $sports);
            }else{
                echo "something is wrong... try again";
            }
                header('Location:index.php?controller=sports');
        }
    }

    //Insert data
    public function insert()
    {
        $this->render('insert');
        if (isset($_POST['addbtn'])) {
            $cate = trim($_POST['category']);
            $name = trim($_POST['name']);
            $chk = $this->checkValidation($cate, $name);
            if($chk){
            $sports = Sport::insert($_POST['category'], $_POST['name']);
            $data = array('sports' => $sports);
            }else{
                echo "Something is wrong...try again";
            }
            header('Location:index.php?controller=sports');
        }
    }

    //delete data
    public function delete()
    {
        $sports = Sport::find($_GET['id']);
        $sports = Sport::destroy($_GET['id']);
        header('Location:index.php?controller=sports');
    }
}
