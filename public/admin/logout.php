<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
if ($session->is_logged_in()) {
	session_destroy() ;
	redirect_to("login.php");
}
?>
