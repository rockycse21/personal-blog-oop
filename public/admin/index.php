<?php
require_once("../../includes/initialize.php");

if(!$session->is_logged_in()){ redirect_to('login.php'); }
?>

<?php include_layout_template("admin_header"); ?>

<section class="main-content">
    <div class="container">
        Hello        
      	<ul>
      		<li><a href="logfile.php">View Log file</a></li>
      		<li><a href="logout.php">Logout</a></li>
      	</ul>
    </div>
</section>

<?php include_layout_template("admin_footer"); ?>
