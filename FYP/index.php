<form action="index.php" method="post" >
    <input type="text" name="test" value="20RM">
    <input type="submit" name="submit" value="Upload">
</form>


<?php
	if(isset($_POST['submit']))
	{
		$test = substr($_POST['test'], 0,-2);
		
		echo $test;
	}

?>
