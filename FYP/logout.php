<?php
   
   
   session_start();
   session_unset();
   
   $statusMsg = "Account has been logged out";
   echo "<script> alert(\"$statusMsg\"); 
		window.location=\"home.php\";
		</script>";
   



?>