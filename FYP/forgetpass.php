<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title> Forget Password | Catch a Ride </title>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	  <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Roboto:wght@500&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body>
      <div class="bg-imgForgetPass">
         <div class="content">
            <header>Forget Password</header>
			
			<?php
    //Include required phpmailer files
        require 'includes/PHPMailer.php';
        require 'includes/SMTP.php';
        require 'includes/Exception.php';
    //Define name spaces
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        if(isset($_POST["submit"]))
		{

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "carrental";

            // Create connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                // Check connection
                if (!$conn) 
				{
                     die("Connection failed: " . mysqli_connect_error());
                }
                else 
				{

                $email = $_POST['email'];
                $result = mysqli_query($conn, "SELECT * FROM user WHERE UserEmail='".$email."' ");

                while($row = mysqli_fetch_assoc($result))
				{
                            $getUserEmail = $row['UserEmail'];
                            $getUserPassword = $row['UserPassword'];
                            $getUserName = $row['UserName'];
                }
                 

                if (mysqli_num_rows($result) == 0)
				{
					echo "<script> alert('Invalid email found! Please make sure your email is registered.'); window.history.back();</script>";
				}
				else
				{
                    //Create instance of phpmailer
                    $mail = new PHPMailer();
                    //set mailer to use smtp
                    $mail -> isSMTP();
                    //define smtp host
                    $mail -> Host = "smtp.gmail.com";
                    //enable smptp authentication
                    $mail -> SMTPAuth= "true";
                    //set type of encription(ssl/tls)
                    $mail -> SMTPSecure = "tls";
                    //set port to connect smptp
                    $mail -> Port = "587";
                    //set gmail username
                    $mail -> Username = "fyp303com@gmail.com";
                    //set gmail password
                    $mail -> Password = "createforfyp_1";
                    //set email subject
                    $mail -> Subject = "Catch a Ride Password Retrieve";
                    //set sender email
                    $mail -> setFrom("fyp303com@gmail.com");
                    //enable html
                    $mail -> isHTML(true);
                    //email body
                    $mail -> Body = "<h2>Hi $getUserName,</h2> <h3>This is your password: </h3> <h1 style=\"color: red; font-size:20px; font-weight:bold;\" > <br/>$getUserPassword</h1> <br/> <h3> For this email $getUserEmail.</h3> <h4><br/>Please login to your account and change the password under the profile page.</h4>";
                    //add recipent
                    $mail -> addAddress($getUserEmail);
                    //finally send email
                    if ($mail->Send())
					{
                        echo "<script> alert('Please check your email spam folder to retrieve your password!'); window.location=\"login.php\";</script>";
                    }
                    else 
					{
                        echo "<script> alert('Failed to send email.'); window.location=\"forgetpass.php\";</script>";
                    }
                    //closing smtp
                    $mail ->smtpClose(); 
                }
                    
                }
        }
        else 
		{
        
?>
            <form action="#" method="post">
			
			<div class="signup" text-align="justify"><br>
               Enter your email address and we will send you the password. <br><br>  
            </div>
               
			   <div class="field space">
                  <span class="fa fa-envelope"></span>
                  <input type="email" name="email" required placeholder="Email ">
               </div>      
               
               <div class="field space">
                  <input type="submit" name="submit" value="SUBMIT">
               </div>
            </form>
            <?php
		}
			?>
			
         </div>
      </div>
      <script>
         
      </script>
   </body>
</html>