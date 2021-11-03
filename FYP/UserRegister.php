<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title> User Register | Catch a Ride </title>
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
	?>

      <div class="bg-imgRegister">
         <div class="content">
            <header>User Register Form</header>
			
	<?php
		if(isset($_POST["register"]))
		{
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "carrental";
			
			//Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			//Check connection
			if(!$conn)
			{
				die("Connection failed: ".mysqli.connect_error());
			}
			else
			{
					if($_POST['password'] != $_POST['repassword'])
					{
						echo "<script> alert('Please enter same password!');
						     window.history.back();
							 </script>";
					}
					else
					{
						$email = strtolower($_POST['email']);
						
						$result1 = mysqli_query($conn, "SELECT UserEmail FROM user WHERE UserEmail='".$email."' ");
						
						while($row = mysqli_fetch_assoc($result1))
						{
                        $checkEmail = $row['UserEmail'];
                        
						}
						
						if($email == $checkEmail)
						{
							echo"<script> alert('The email has been registered, please login!');
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
							
							$sql = "INSERT INTO user(UserName, UserPassword, UserPhone, UserEmail, UserIC) VALUES ('$name','$password','$phone','$email', '$ic')";
							
							if(mysqli_query($conn, $sql))
							{
								echo"<script> alert('Thanks for register!');
												window.location=\"login.php\";
									 </script>";
							}
							else
							{
									echo "Error: " .$sql."<br>" .mysqli_error($conn);
									
							}
						}
					}
			}
			mysqli_close($conn);
		}
		else
		{
		?>	
    	
            <form action="#" method="post">
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="name" required placeholder="Name">
               </div>
			   <div class="field space">
                  <span class="fa fa-phone"></span>
                  <input type="number" name="phonenumber" required placeholder="Phone Number">
               </div>
			   <div class="field space">
                  <span class="fa fa-id-card"></span>
                  <input type="number" name="ic" required placeholder="IC Number">
               </div>
			   <div class="field space">
                  <span class="fa fa-envelope"></span>
                  <input type="email" name="email" required placeholder="Email ">
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" class="pass-key" name="password" required placeholder="Password">
                  <span class="show">SHOW</span>
               </div>
			   <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" class="Cpass-key" name="repassword" required placeholder="Confirm your password">
                  <span class="Cshow">SHOW</span>
               </div>
               
               <div class="field space">
                  <input type="submit" name="register" value="REGISTER">
               </div>
            </form>
            <?php
		}
			?>
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