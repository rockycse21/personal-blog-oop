<?php
require_once(SITE_ROOT.DS.'config.php');

//

class MySQLDatabase {

private $connection;
public $last_query;
private $magic_quotes_active;
private $reale_scape_string_exist;
// alwyes open connection
function __construct() {
  $this->open_connection();
  $this->magic_quotes_active = get_magic_quotes_gpc();
  $this->reale_scape_string_exist = function_exists( "mysql_real_escape_string" );
}
// Open connection
  public function open_connection() {
    $this->connection = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
    if(!$this->connection){
      die("Database connection failed: " . mysql_error());
    } else {
      $db_select = mysql_select_db(DB_NAME, $this->connection);
      if(!$db_select) {
        die("Database selection failed: " . mysql_error());
      }
    }
  }
  // Close Connection
  public function close_connection() {
    if(isset($this->connection)) {
      mysql_close($this->connection);
      unset($this->connection);
    }
  }
// Perform query method
  public function query($sql){
    $this->last_query = $sql;
    $result = mysql_query($sql, $this->connection);
    $this->confirm_query($result);
    return $result;

  }

  public function escape_value( $value ) {
  	//$magic_quotes_active = get_magic_quotes_gpc();
  	//$new_enough_php = function_exists( "mysql_real_escape_string" );
  	if( $this->reale_scape_string_exist ) { // PHP v4.3.0 or higher
  		// undo any magic quote effects so mysql_real_escape_string can do the work
  		if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
  		$value = mysql_real_escape_string( $value );
  	} else { // before PHP v4.3.0
  		// if magic quotes aren't already on then add slashes manually
  		if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
  		// if magic quotes are active, then the slashes already exist
  	}
  	return $value;
  }
// database nuterald methos
  public function fetch_array($result_set){
  return  mysql_fetch_array($result_set);
  }
  public function num_rows($result_set){
  return  mysql_num_rows($result_set);
  }
  // Get the last id inserted over the current database connection
  public function insert_id(){
  return  mysql_insert_id($this->connection);
  }
  public function affected_rows(){
  return  mysql_affected_rows($this->connection);
  }


  private function confirm_query($result) {
    if(!$result) {
      $output = "Database query failed: " . mysql_error().'<br/><br/>';
      $output .= "Last SQL Query: " .$this->last_query;
      die($output);
    }
  }

}

$databade = new MySQLDatabase();
$db =& $databade;
?>
