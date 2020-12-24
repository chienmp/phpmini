<?php
require_once('db/connection.php');
require_once('sport.php');

class sportModel extends DBConnect
{
    public $error = "";
    public function __construct()
    {
        parent::__construct();
    }
    public function getSport()
    {
        $res = $this->con->query("SELECT * FROM `sports` ");
        $r = array();
        while ($row = $res->fetch_assoc()) {
            $sp = new Sport($row["id"], $row["category"], $row["name"]);
            $r[] = $sp;
        }
        return $r;
    }
    public function insertSport($sp)
    {
        try {
            $para = $this->con->prepare("INSERT INTO sports(category,name) VALUES(?,?)");
            $para->bind_param('ss', $a, $b);
            $a = $sp->getCategory();
            $b = $sp->getName();
            $para->execute();

        } catch (Exception $ex) {
            return $ex;
        } finally {
            $para->close();
        }

    }

    public function updateSport($sp)
    {
        try {
            $para = $this->con->prepare("UPDATE sports SET category=?, name=? where id= ?");
            $para->bind_param('sss', $a, $b, $c);
            $a = $sp->getCategory();
            $b = $sp->getName();
            $c = $sp->getID();
            $para->execute();
        } catch (Exception $ex) {
            return $ex;
        } finally {
            $para->close();
        }
    }
    public function deleteSport($sp)
    {
        try {
            $para = $this->con->prepare("DELETE FROM sports WHERE id=?");
            $para->bind_param('i', $a);
            $a = $sp->getID();
            $para->execute();
        } catch (Exception $ex) {
            return $ex;
        } finally {
            $para->close();
        }
    }
}
