<?php
/*
  * Session class for storing data in session
 * store database related data in the session
  * */
class Session{
    public $user_id;
    private $logged_in = false;
    function __construct(){
        session_start();
        $this->check_login();
        if($this->logged_in){
        // action to take right away if user is logged in
        } else {
        //action to take right away if user is not logged in
        }
    }
    /*
     *
     * */
    public function is_logged_in(){
       return $this->logged_in;
    }
    /*
     *@param $user
     * */
    public function login($user){
        //database should find user on username and password
        if($user){
        $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->logged_in = true;
        }
    }
    /*
     * logout
     * */
    public function logout(){
        unset($_SESSION['user_id']);
        $this->logged_in = false;
    }
    /*
     * check user login or not
     * */
    private function  check_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->logged_in = true;
        } else {
            unset($this->user_id);
            $this->logged_in = false;
        }

    }
}
$session = new Session();
?>