
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
      <title> Payment | Catch a Ride </title>
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
		
		if (!empty($_GET)) 
		{
			$ID = $_GET['id'];
		}
		
		$userID = $_SESSION['UserID'];
		
		if(!isset($_SESSION['UserID'])) 
		{ 
			header("Location: login.php");
		} 
	?>
  
      <div class="bg-Payment">
	   <div class="payment">
         <div class="content">
            <header>Payment page</header>
			
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";

$targetDir = "uploads/"; 
$watermarkImagePath = 'Sample.png'; 
 
$statusMsg = ''; 			
//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
			
//Check connection
if(!$conn)
{
	die("Connection failed: ".mysqli.connect_error());
}
else
{			
		if(isset($_POST["pay"]))
		{
			$userName = $_POST['name'];
			$userPhone = $_POST['phonenumber'];
			$userIC = $_POST['ic'];
			$userEmail = $_POST['email'];
			$pickupLocation = mysqli_real_escape_string($conn, $_POST['pickup']);
			$returnLocation = mysqli_real_escape_string($conn, $_POST['return']);
			$pickupDate = $_POST['pickupDate'];
			$pickupTime = $_POST['pickupTime'];
			$returnDate = $_POST['returnDate'];
			$returnTime = $_POST['returnTime'];
			$vehicleName = $_POST['car'];
			$vehicleType = $_POST['cartype'];
			$OwnerPhoneNumber = $_POST['ownerPhone'];
			$ownerName = $_POST['ownerName'];
			$vehiclePrice = $_POST['carPrice'];
			$payment = $_POST['payment'];
			
			$sql2 = "INSERT INTO invoice(userID, userName, userIC, userPhone, userEmail, pickupLocation, returnLocation, pickupDate, pickupTime, returnDate, returnTime, vehicleID, vehicleName, ownerName, vehicleType, vehiclePrice, OwnerPhoneNumber, payment, timerent, status ) VALUES ('$userID','$userName','$userIC','$userPhone','$userEmail', '$pickupLocation', '$returnLocation', '$pickupDate', '$pickupTime', '$returnDate', '$returnTime', '$ID', '$vehicleName', '$ownerName', '$vehicleType', '$vehiclePrice', '$OwnerPhoneNumber', '$payment', NOW(), 'PENDING' )";
			
			if(mysqli_query($conn, $sql2))
			{
			
				if(!empty($_FILES["file"]["name"]))
				{ 
					// File upload path 
					$fileName = basename($_FILES["file"]["name"]); 
					$targetFilePath = $targetDir . $fileName; 
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
					 
					// Allow certain file formats 
					$allowTypes = array('jpg','png','jpeg'); 
					if(in_array($fileType, $allowTypes))
					{ 
						// Upload file to the server 
						if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath))
						{ 
							// Load the stamp and the photo to apply the watermark to 
							$watermarkImg = imagecreatefrompng($watermarkImagePath); 
							switch($fileType){ 
								case 'jpg': 
									$im = imagecreatefromjpeg($targetFilePath); 
									break; 
								case 'jpeg': 
									$im = imagecreatefromjpeg($targetFilePath); 
									break; 
								case 'png': 
									$im = imagecreatefrompng($targetFilePath); 
									break; 
								default: 
									$im = imagecreatefromjpeg($targetFilePath); 
							} 
							 
							// Set the margins for the watermark 
							$marge_right = 10; 
							$marge_bottom = 10; 
							 
							// Get the height/width of the watermark image 
							$sx = imagesx($watermarkImg); 
							$sy = imagesy($watermarkImg); 
							 
							// Copy the watermark image onto our photo using the margin offsets and  
							// the photo width to calculate the positioning of the watermark. 
							imagecopy($im, $watermarkImg, (imagesx($im) - $sx )/2, (imagesy($im) - $sy )/2, 0, 0, imagesx($watermarkImg), imagesy($watermarkImg)); 
							 
							// Save image and free memory 
							imagepng($im, $targetFilePath); 
							imagedestroy($im); 
							
							$sql ="UPDATE user SET Licence ='$targetFilePath' WHERE UserID = '".$userID."' ";
							$sql2 = "UPDATE vehicle SET status = 'OFFLINE' WHERE vehicleID = '".$ID."' ";
							
							if (mysqli_query($conn, $sql)) 
							{
								if(mysqli_query($conn, $sql2))
								{
									if(file_exists($targetFilePath))
									{ 
								
										$statusMsg = "Payment Success"; 
										echo "<script> alert(\"$statusMsg\"); 
													window.location=\"home.php\";
										</script>";
									
									}
									else
									{ 
									$statusMsg = "Image upload failed, please try again."; 
									} 
								}
								else
								{
									echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
								}
							}
							else
							{
								echo "Error: " . $sql . "<br>" . mysqli_error($conn);
							}
							 
						}
						else
						{ 
							$statusMsg = "Sorry, there was an error uploading your file."; 
						} 
					}
					else
					{ 
						$statusMsg = 'Sorry, only JPG, JPEG, and PNG files are allowed to upload.'; 
					} 
				}
				else
				{ 
					$statusMsg = 'Please select a file to upload.'; 
				} 		
				
			}
			else
			{
				echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
			}
		}

		if(isset($_SESSION['UserID']))
		{
			
			$result1 = mysqli_query($conn, "SELECT * FROM user WHERE UserID='".$userID."' ");
						
			while($row = mysqli_fetch_assoc($result1))
			{
		?>	
			
            <form action="#" method="post" enctype="multipart/form-data" class="userForm">
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" name="name" value="<?php echo $row['UserName']?>" READONLY>
               </div>
			   <div class="field space">
                  <span class="fa fa-phone"></span>
                  <input type="number" name="phonenumber" value="<?php echo $row['UserPhone']?>" READONLY>
               </div>
			   <div class="field space">
                  <span class="fa fa-id-card"></span>
                  <input type="number" name="ic"  value="<?php echo $row['UserIC']?>" READONLY>
               </div>
			   <div class="field space">
                  <span class="fa fa-envelope"></span>
                  <input type="email" name="email" value="<?php echo $row['UserEmail']?> " READONLY>
               </div>
			  
			   
			   
			
            <?php
			}
			$result2 = mysqli_query($conn, "SELECT * FROM vehicle WHERE vehicleID='".$ID."' ");
							
			while($row = mysqli_fetch_assoc($result2))
				{
			   ?>
			   
					<!--<form action="#" method="post" enctype="multipart/form-data" class="carForm">-->
					   <div class="field space">
						  <p> Upload your licence picture here: </p>
						<input type="file" name="file" required>
					   </div>
					   
					   <div class="field space">
						  <span class="fa fa-map"></span>
						  <input type="text" name="pickup" required placeholder="Pickup Location" >
					   </div>
					   <div class="field space">
						  <span class="fa fa-map"></span>
						  <input type="text" name="return" required placeholder="Return Location">
					   </div>
					   <div class="field space">
						  <input type="date" name="pickupDate" id="pickup" required >
					   </div>
					   <div class="field space">
						  <input type="time" name="pickupTime" required >
					   </div>
					   <div class="field space">
						  <input type="date" name="returnDate" id="return" required >
					   </div>
					   <div class="field space">
						  <input type="time" name="returnTime" required>
					   </div>
					   <div class="field space">
						  <span class="fa fa-car"></span>
						  <input type="text" name="car"  value="<?php echo $row['vehicleName']?>" READONLY>
					   </div>
					   <div class="field space">
						  <span class="fa fa-car"></span>
						  <input type="text" name="cartype" value="<?php echo $row['vehicleType']?>" READONLY>
					   </div>
					   <div class="field space">
						  <span class="fa fa-user"></span>
						  <input type="text" name="ownerName" value="<?php echo $row['OwnerName']?>" READONLY>
					   </div>
					   <div class="field space">
						  <span class="fa fa-phone"></span>
						  <input type="text" name="ownerPhone" value="<?php echo $row['OwnerPhoneNumber']?>" READONLY>
					   </div>
					   <div class="field space">
						  <span class="fa fa-money"></span>
						  <input type="text" name="carPrice"   value="<?php echo $row['vehiclePrice']?>" READONLY>
					   </div>
					   <div class="field space">
						  <span class="fa fa-money"></span>
						  <select name="payment" id="payment" required>
							<option value="" hidden>Select a payment method</option>
							<option value="Cash">Cash</option>
							<option value="CreditCard">Credit Card</option>
							<option value="Ewallet">E-Wallet</option>
							<option value="FPX">FPX Banking</option>
						</select>
					   </div>
					   
					   <div class="field space">
						  <input type="submit" name="pay" value="Pay Now">
					   </div>
					</form>
					
					
					
					
					
				<?php
				}
			
		}
		mysqli_close($conn);
}
			?>
			
         </div>
		</div>
      </div>
      <script>
        var pickups = new Date();
		
		pickups = document.getElementById("pickup").value; 
		
		document.getElementById("return").setAttribute('min', pickups);
      </script>
	  <script>
		var today = new Date().toISOString().split('T')[0];
		document.getElementById("pickup").setAttribute('min', today);
	  </script>
	  <script>
	    var today = new Date().toISOString().split('T')[0];
		document.getElementById("return").setAttribute('min', today);
	  </script>
   </body>
</html>