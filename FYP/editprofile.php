<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title> User Profile | Catch a Ride </title>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	  <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Roboto:wght@500&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body>
<?php
	require('header.php');
	
	$userID = $_SESSION['UserID'];
?>
      <div class="bg-profile">
		<div class="editprofile">
         <div class="content">
            <header>Edit Profile</header>
			
		<?php
		
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "carrental";
				
		//Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		//Check connection
		if(!$conn)
		{
			die("Connection failed: ".mysqli_connect_error());
		}
		
		else
		{
			if(isset($_POST["save"]))
			{

					if($_POST['password'] != $_POST['repassword'])
					{
						echo "<script> alert('Please enter same password!');
						     window.history.back();
							 </script>";
					}
					else
					{
								$name = $_POST['name'];
								$phone = $_POST['phonenumber'];
								$ic = $_POST['ic'];
								$email = strtolower($_POST['email']);
								$password = $_POST['password'];
								$repassword = $_POST['repassword'];
								
								$sql ="UPDATE user SET UserName='".$name."', UserPassword='".$password."', UserPhone='".$phone."', UserEmail='".$email."', UserIC='".$ic."' WHERE UserID='".$userID."' ";
								
								if(mysqli_query($conn, $sql))
								{
									echo"<script> alert('Profile has been updated successfully!!!');
													window.location=\"profile.php\";
										 </script>";
								}
								else
								{
										echo "Error: " .$sql."<br>" .mysqli_error($conn);
										
								}
							
					}
			
				mysqli_close($conn);
			}
			else
			{
				$result = mysqli_query($conn, "SELECT * FROM user WHERE UserID='".$userID."' ");
					           					
					while($row = mysqli_fetch_assoc($result))
                    {
							
			?>		
						<form action="#" method="post">
						<div class="field">
							  <span class="fa fa-user"></span>
							  <input type="text" name="name" value="<?php echo $row['UserName']?>" required>
						   </div>
						   <div class="field space">
							  <span class="fa fa-phone"></span>
							  <input type="text" name="phonenumber" value="<?php echo $row['UserPhone']?>" required>
						   </div>
						   <div class="field space">
							  <span class="fa fa-id-card"></span>
							  <input type="text" name="ic" value="<?php echo $row['UserIC']?>" required>
						   </div>
						   <div class="field space">
							  <span class="fa fa-user"></span>
							  <input type="email" name="email" value="<?php echo $row['UserEmail']?>" READONLY>
						   </div>
						   <div class="field space">
							  <span class="fa fa-lock"></span>
							  <input type="password" class="pass-key" name="password" value="<?php echo $row['UserPassword']?>" required >
							  <span class="show">SHOW</span>
						   </div>
						   <div class="field space">
							  <span class="fa fa-lock"></span>
							  <input type="password" class="Cpass-key" name="repassword" required value="<?php echo $row['UserPassword']?>">
							  <span class="Cshow">SHOW</span>
						   </div>
						   <div class="field space">
							  <input type="submit" value="SAVE" name="save"/>
						   </div>
						   
						</form>
			<?php
					}
			}
		}

			?>
			
         </div>
		 </div>
      </div>
	  
	 
	  
      <script>
         const pass_field = document.querySelector('.pass-key');
         const showBtn = document.querySelector('.show');
         showBtn.addEventListener('click', function(){
          if(pass_field.type === "password"){
            pass_field.type = "text";
            showBtn.textContent = "HIDE";
            showBtn.style.color = "#3498db";
          }else{
            pass_field.type = "password";
            showBtn.textContent = "SHOW";
            showBtn.style.color = "#222";
          }
         });
		 
		 const Cpass_field = document.querySelector('.Cpass-key');
         const showCBtn = document.querySelector('.Cshow');
         showCBtn.addEventListener('click', function(){
          if(Cpass_field.type === "password"){
            Cpass_field.type = "text";
            showCBtn.textContent = "HIDE";
            showCBtn.style.color = "#3498db";
          }else{
            Cpass_field.type = "password";
            showCBtn.textContent = "SHOW";
            showCBtn.style.color = "#222";
          }
         });
      </script>
   </body>
</html>








