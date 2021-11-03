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
      <title> User Login | Catch a Ride </title>
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
      <div class="bg-img">
         <div class="content">
            <header>User Login Form</header>
			
		<?php
			if(isset($_POST["login"]))
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
					die("Connection failed: ".mysqli_connect_error());
				}
				else
				{
					$email = strtolower($_POST['email']);
					$password = $_POST['password'];
					
					$result1 = mysqli_query($conn, "SELECT * FROM user WHERE UserEmail='".$email."' AND UserPassword = '".$password."'  ");
					           					
					while($row = mysqli_fetch_assoc($result1))
                    {
                        $checkEmail = $row['UserEmail'];
                        $checkPass = $row['UserPassword'];
						$getUserID = $row['UserID'];
						$getUserName = $row['UserName'];
                    }

                    if( $email == $checkEmail && $password == $checkPass)
                    {
						$_SESSION['loggedin'] = true; 
						$_SESSION['UserName'] = $getUserName ;
						$_SESSION['UserID'] = $getUserID;
						$_SESSION['cart'] = array();
                        header("Location: home.php");
                    }
                    else
                    {
                       $alert = 'Invalid account! \nPlease check your email and password!';
                        echo "<script> alert(\"$alert\");
						  window.history.back();
                            </script>";
						
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
                  <input type="email" name="email" required placeholder="Email ">
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" name="password" class="pass-key" required placeholder="Password">
                  <span class="show">SHOW</span>
               </div>
               <div class="pass">
                  <a href="forgetpass.php">Forgot Password?</a>
               </div>
               <div class="field">
                  <input type="submit" name="login" value="LOGIN">
               </div>
            </form>
			<?php
			}
			?>
			
            <div class="signup"><br>
               Don't have account?
               <a href="UserRegister.php">Register Now</a>
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
      </script>
   </body>
</html>