<?php
require_once(SITE_ROOT.DS.'database.php');

class User extends DatabaseObject {

  public static $table_name = "users";
  public $id;
  public $username;
  public $password;
  public $first_name;
  public $last_name;



public function full_name() {
    if(isset($this->first_name) && isset($this->last_name)) {
      return $this->first_name." ".$this->last_name;
    }  else {
      return "";
    }
  }

public static function authenticate($username = "", $password = ""){
    global $db;
    $username = $db->escape_value($username);
    $password = $db->escape_value($password);
    $sql = "SELECT * FROM users";
    $sql .= " WHERE username = '{$username}'  ";
    $sql .= " AND password = '{$password}' ";
    $sql .= "LIMIT 1";
    $result_array = self::find_by_sql($sql);
    return !empty($result_array) ? array_shift($result_array) : false ;

  }


//Common database Method moved to database object as LATE STATIC BINDING
/*
  public static function find_all() {
    return self::find_by_sql("SELECT * FROM".self::$table_name);
  }

  public static function find_by_id($id=0) {
    global $db;
    $result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." where id={$id}");
    return !empty($result_array) ? array_shift($result_array) : false ;
  }

  public static function find_by_sql($sql="") {
    global $db;
    $result_set = $db->query($sql);
    $object_array = array();
    while ($row = $db->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

  private static function instantiate($recornd){
    //could check that $recorn exist and is an array
    //$class_name = get_called_class();
    $object = new self;
    // more dynamic sort form appoach
    foreach ($recornd as $attribute => $value) {
      if($object->has_attribute($attribute)) {
        $object->$attribute = $value;
      }
    }
    return $object;
  }

  private function has_attribute($attribute) {
    //get_object_vars return an associative array with all attribute
    //(incl. privat ones) as the key and their current value as  value
    $object_vars = get_object_vars($this);
    //we dont care about value , we just want to know if the key exist
    //will retuen true or false
    return array_key_exists($attribute, $object_vars);
  }
*/
}
?>
