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
      <title> Upload Vehicle | Catch a Ride </title>
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	  <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Roboto:wght@500&display=swap" rel="stylesheet">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   </head>
   <body>
   <?php 
		require('ownerHeader.php');
		
		
		$ownerID = $_SESSION['OwnerID'];
		$ownerName = $_SESSION['OwnerName'];
		$ownerPhone = $_SESSION['OwnerPhoneNumber'];
	?>
  
	<div class="bg-uploadVehicle">
      <div class="bg-editVehicle">
	   <div class="payment">
         <div class="content">
            <header>Upload Vehicle</header>
			
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
		if(isset($_POST["upload"]))
		{
			$vehicleName = mysqli_real_escape_string($conn, $_POST['car']);
			$vehiclePrice = $_POST['carPrice'];
			$vehicleType = mysqli_real_escape_string($conn, $_POST['cartype']);
			$vehicleSeat = $_POST['seat'];
			$image = addslashes(file_get_contents($_FILES['pic']['tmp_name']));
			$vehicleTrans = $_POST['trans'];
			$vehicleHP = $_POST['carHP'];
			$vehicleMileage = $_POST['carMileage'];
			$vehicleFuel = $_POST['carFuel'];
			$vehicleLuggage = $_POST['carluggage'];
			$vehicleBluetooth = $_POST['bluetooth'];
			$grantimage = addslashes(file_get_contents($_FILES['grant']['tmp_name']));
			$vehicleCategory = $_POST['category'];
			$status = $_POST['status'];
			
					// File upload path 
					$fileName = basename($_FILES["grant"]["name"]); 
					$targetFilePath = $targetDir . $fileName; 
					$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 
					 
					// Allow certain file formats 
					$allowTypes = array('jpg','png','jpeg'); 
					if(in_array($fileType, $allowTypes))
					{ 
						// Upload file to the server 
						if(move_uploaded_file($_FILES["grant"]["tmp_name"], $targetFilePath))
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
							
							
							$sql2 = "INSERT INTO vehicle (vehicleName, vehiclePrice, vehicleType, vehicleSeat, vehiclePic,  vehicleTrans, vehicleHP, vehicleMileage, vehicleFuel, vehicleLuggage, vehicleBluetooth, vehicleGrant, vehicleCategory, OwnerID, OwnerName, OwnerPhoneNumber, status) VALUES('$vehicleName', '$vehiclePrice', '$vehicleType', '$vehicleSeat', '$image', '$vehicleTrans','$vehicleHP','$vehicleMileage','$vehicleFuel','$vehicleLuggage','$vehicleBluetooth', '$targetFilePath', '$vehicleCategory', '$ownerID', '$ownerName', '$ownerPhone', '$status')";
			
								if(mysqli_query($conn, $sql2))
								{
									if(file_exists($targetFilePath))
									{ 
								
										$statusMsg = "Vehicle uploaded!"; 
										echo "<script> alert(\"$statusMsg\"); 
													window.location=\"OwnerHome.php\";
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
							$statusMsg = "Sorry, there was an error uploading your file."; 
						} 
					}
					else
					{ 
						$statusMsg = 'Sorry, only JPG, JPEG, and PNG files are allowed to upload.'; 
					} 
					
			
		}

		if(isset($_SESSION['OwnerID']))
		{
			
		?>	
			
            <form action="#" method="post" enctype="multipart/form-data" class="userForm">
			<div class="field">
				<span class="fa fa-car"></span>
				<input type="text" name="car"  placeholder="Enter the vehicle name" >
			</div>
			<div class="field space">
				<span class="fa fa-money"></span>
				<input type="number" name="carPrice"   placeholder="Enter the vehicle price per day" >
			</div>
			<div class="field space">
				<span class="fa fa-car"></span>
				<select name="cartype" id="cartype" required>
					<option value="" hidden >Enter the vehicle type</option>
					<option value="Coupe">Coupe</option>
					<option value="Sedan">Sedan</option>
					<option value="SUV">SUV</option>
					<option value="MPV">MPV</option>
				</select>
			</div>
               <div class="field space">
                  <span class="fa fa-group"></span>
                  <input type="number" name="seat" placeholder="Enter the number of seats of the vehicle" >
               </div>
			<div class="field space">
				<p> Upload your vehicle picture here: </p>
				<input type="file" name="pic" accept="image/*" required>
			</div>
			<div class="field space">
				<span class="fa fa-sliders"></span>
				<select name="trans" id="trans" required>
					<option value="" hidden>Transmission Type</option>
					<option value="Auto">Auto</option>
					<option value="Manual">Manual</option>
				</select>
			</div>
			   <div class="field space">
				<span class="fa fa-gear"></span>
				<input type="number" name="carHP"   placeholder="Enter the CC of the vehicle" >
				</div>
			   <div class="field space">
				<span class="fa fa-tachometer"></span>
				<input type="number" name="carMileage"   placeholder="Enter the mileage of the vehicle" >
				</div>
				<div class="field space">
				<span class="fas fa-gas-pump"></span>
				<input type="number" name="carFuel"   placeholder = "Enter the total amount fuel of the vehicle ">
				</div>
				<div class="field space">
					<span class="fa fa-suitcase"></span>
					<input type="number" name="carluggage"   placeholder="Enter the total amount luggage of the vehicle " >
				</div>
				<div class="field space">
					<span class="fa fa-bluetooth"></span>
					<select name="bluetooth" id="bluetooth" required>
						<option value="" hidden>Bluetooth</option>
						<option value="Bluetooth Available">Available</option>
						<option value="Bluetooth Not Available">Not Available</option>
					</select>
				</div>
				<<div class="field space">
					<p> Upload your vehicle grant here: </p>
					<input type="file" name="grant" accept="image/*" required>
				</div>
				<div class="field space">
					<span class="fa fa-car"></span>
					<select name="category" id="category" required>
						<option value="" hidden>Select your vehicle category</option>
						<option value="Toyota">Toyota</option>
						<option value="Honda">Honda</option>
						<option value="Nissan">Nissan</option>
						<option value="Mazda">Mazda</option>
					</select>
				</div>
				<div class="field space">
					<span class="fa fa-user"></span>
					<select name="status" id="status" required>
						<option value="" hidden>Vehicle Status</option>
						<option value="ONLINE">ONLINE</option>
						<option value="OFFLINE">OFFLINE</option>
						
					</select>
				</div> 				
				<div class="field space">
					<input type="submit" name="upload" value="Upload">
				</div>
			</form>
			
				<?php
			
			
		}
		mysqli_close($conn);
}
			?>
			
         </div>
		</div>
      </div>
	  </div>
	 
      <script>
	  </script>
   </body>
</html>