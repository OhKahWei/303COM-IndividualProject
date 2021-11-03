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
		<div class="profile">
         <div class="content">
            <header>Profile</header>
			
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
					
					$result1 = mysqli_query($conn, "SELECT * FROM user WHERE UserID='".$userID."' ");
					           					
					while($row = mysqli_fetch_assoc($result1))
                    {
                        
        ?>		
            <form action="#" method="post">
			<div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="name" placeholder="Name: <?php echo $row['UserName']?>" READONLY>
               </div>
			   <div class="field space">
                  <span class="fa fa-phone"></span>
                  <input type="text" name="phonenumber" placeholder="Phone: <?php echo $row['UserPhone']?>" READONLY>
               </div>
			   <div class="field space">
                  <span class="fa fa-id-card"></span>
                  <input type="text" name="ic" placeholder="IC: <?php echo $row['UserIC']?>" READONLY>
               </div>
               <div class="field space">
                  <span class="fa fa-user"></span>
                  <input type="email" name="email" placeholder="Email: <?php echo $row['UserEmail']?>" READONLY>
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" class="pass-key" name="password" value="<?php echo $row['UserPassword']?>" >
                  <span class="show">SHOW</span>
               </div>
               <div class="field space">
                  <input type="button" value="EDIT" onClick="location.href='editprofile.php'; "/>
               </div>
			   <div class="field space">
                  <input type="button" value="LOGOUT" onClick="location.href='logout.php';"/>
               </div>
            </form>
			<?php
				}

                   
               }
                mysqli_close($conn);
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
      </script>
   </body>
</html>








