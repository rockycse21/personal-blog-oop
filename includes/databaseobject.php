<?php
require_once(SITE_ROOT.DS.'database.php');

class DatabaseObject {
//late static binding which is used from php 5.3 (~_~)
    public static $table_name = "";

//Common database Method
    public static function find_all() {
        return self::find_by_sql("SELECT * FROM".static::$table_name);
    }

    public static function find_by_id($id=0) {
        global $db;
        $result_array = self::find_by_sql("SELECT * FROM ".static::$table_name." where id={$id}");
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

    private static function instantiate($record){
        //could check that $recorn exist and is an array
        $class_name = get_called_class();
        $object = new $class_name;
        // more dynamic sort form appoach
        foreach ($record as $attribute => $value) {
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
        //we don't care about value , we just want to know if the key exist
        //will return true or false
        return array_key_exists($attribute, $object_vars);
    }

}