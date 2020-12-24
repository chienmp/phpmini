
<?php
require_once('controllers/BaseController.php');

class PagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'pages';
  }

  public function home()
  {
    $data = array(
      'name' => 'Pham Minh Chien',
      'age' => 23
    );
    $this->render('home', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}
