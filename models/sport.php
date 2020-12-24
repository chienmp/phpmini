<?php
require_once 'db/connection.php';

class Sport
{
    public $id;
    public $category;
    public $name;
    public function __construct($id, $category, $name)
    {
        $this->id = $id;
        $this->category = $category;
        $this->name = $name;
    }
    public static function all()
    {
        $list = [];
        $db = DB::getInstance();
        $q = $db->query('SELECT * FROM sports order by id DESC');
        foreach ($q->fetchAll() as $item) {
            $list[] = new Sport($item['id'],$item['category'],$item['name']);
        }
        return $list;
    }
    static function find($id)
  {
    $db = DB::getInstance();
    $req = $db->prepare('SELECT * FROM sports WHERE id = :id');
    $req->execute(array('id' => $id));

    $item = $req->fetch();
    if (isset($item['id'])) {
      return new Sport($item['id'], $item['category'], $item['name']);
    }
    return null;
  }
    public static function update($id,$category,$name){
        echo $id,$category,$name;
        $db=DB::getInstance();
        $sql = "UPDATE sports SET category=?, name=? WHERE id=?";
        $q=$db->prepare($sql);
        $q->execute([$category,$name,$id]);
        $result= $q->fetch();
    }
    public static function insert($category,$name){
        $db=DB::getInstance();
        $sql = "INSERT INTO sports(category,name) VALUES(?,?)";
        $q=$db->prepare($sql);
        $q->execute([$category,$name]);
        $result=$q->fetch();
    }
    public static function destroy($id){
      $db=DB::getInstance();
      $sql="DELETE FROM sports where id= ?";
      $q=$db->prepare($sql);
      $q->execute([$id]);
      $result=$q->fetch();
    }
}
