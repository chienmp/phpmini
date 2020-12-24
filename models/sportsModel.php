
$cterr = $nameerr = "";
$namechk = $categorychk = "";
if($_SERVER["REQUEST_METHOD"]=="POST"){
if (empty($_REQUEST["category"])) {
    $cterr = "Category is required";
} else {
    $categorychk = test_input(($_REQUEST["category"]));
    if (preg_match("/^[a-zA-Z ]*$/",$categorychk)) {
        $cterr = "Only letters and white space allowed";

      }
}
if (empty($_REQUEST["name"])) {
    $nameerr = "Name is required";
} else {
    $namechk = test_input($_REQUEST["name"]);
    if (preg_match("/^[a-zA-Z ]*$/",$namechk)) {
        $nameerr = "Only letters and white space allowed"; 
      }
}
}
