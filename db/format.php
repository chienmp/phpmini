<?php
// define variables and set to empty values
function checkValidation($cate, $name)
{
   $error=false;
    $cterr = $nameerr = "";
    $namechk = $categorychk = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($cate)) {
            $cterr = "Category is required";$error=true;
        } else {
            $categorychk = test_input(($cate));
            if (!preg_match("/^[a-zA-Z ]*$/", $categorychk)) {
                $cterr = "Only letters and white space allowed";
                $error=true;
            }
        }
        if (empty($name)) {
            $nameerr = "Name is required";$error=true;
        } else {
            $namechk = test_input($name);
            if (!preg_match("/^[a-zA-Z ]*$/", $namechk)) {
                $nameerr = "Only letters and white space allowed";
                $error=true;
            }
        }
    }
    return $error;
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
