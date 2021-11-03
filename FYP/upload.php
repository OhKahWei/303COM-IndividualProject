<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
$con = mysqli_connect($servername, $username, $password, $dbname);

$res = mysqli_query($con, "SELECT * from user WHERE userID = '1'  ");
$queryResult = mysqli_num_rows($res);
			
			while($row = mysqli_fetch_array($res))
			{
				?>
				<img src="<?phpecho $row['Licence']?>">
				<?php
			}
?>