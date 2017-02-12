<?php
require_once("../../includes/initialize.php");

if($session->is_logged_in()){redirect_to("index.php");}

if(isset($_POST['submit'])){
  $username = trim($_POST['email']);
  $password = trim($_POST['password']);
  $found_user = User::authenticate($username, $password);
  if($found_user){
    $session->login($found_user);
    log_action('login',"{$found_user->username} logged in.");
    redirect_to("index.php");
  } else {
    $message = "Username / Password combination incorrect.";
  }
} else {
  $message = "";
  $username = "";
  $password = "";
}
?>
<?php include_layout_template("admin_header"); ?>
<section class="main-content">
  <div class="container">
    <div class="login-form">
      <h3>Login</h3>
      <?php if(!empty($message)) { ?>
      <div class="alert alert-warning" role="alert"><?php echo $message; ?></div>
  <?php } ?>
      <form action="" method="post" class="">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="text" class="form-control" id="exampleInputEmail1" name="email" placeholder="Email" value="<?php echo htmlentities($username);?>">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" value="<?php echo htmlentities($password);?>">
        </div>
        <button type="submit" name="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</section>
<?php include_layout_template("admin_footer"); ?>
<?php if(isset($db)){$db->close_connection();}?>
