<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<html>
<head>
	<title>Cart | Catch a Ride </title>
</head>
<body>
<?php
	require('header.php');
	
	
	if (!empty($_GET)) 
	{
		
		$ID = $_GET['id'];
		array_push($_SESSION['cart'], $ID);
		$_SESSION['cart'] = array_unique($_SESSION['cart']);
	}
	
	
	
	
	
	
?>
<div id="car">
<div class="bg-cartimg">
</div>

<div class="headertitle">
Add To Cart
<p>Here you can see the cars that you added to the cart and made payment at here. </p>
</div>

<div class="container-fluid garage">
<div class="row">

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
$con = mysqli_connect($servername, $username, $password, $dbname);

	
	
	if(isset($_SESSION['UserName']) && isset($_SESSION['cart']) )
	{
			$i = 0;
		foreach ($_SESSION['cart'] as $result)
		{
			$realresult = substr($result,3);
			$res = mysqli_query($con,"Select * from vehicle WHERE vehicleID = '".$realresult."' ");
			$queryResult = mysqli_num_rows($res);
			
			while($row = mysqli_fetch_array($res))
			{
				
			?>
				<div class="col-6 outerbox">
				
					<div class="col-6">
					<?php echo '<img src="data:image;base64,'.base64_encode($row['vehiclePic']) .'" alt="image">'; ?>
					</div>
					
					<div class="col-5">
					
						<h4><?php echo $row['vehicleName'] ?></h4> 
						
						 <div class="carprice">
							RM <h4> <?php echo $row['vehiclePrice']?> </h4> Per Day
						 </div>
						 
						 <div class="rateyo" id= "rating"
							data-rateyo-rating="<?php echo $row['vehicleRating']?>"
							data-rateyo-num-stars="5"
							data-rateyo-score="3"
							style="padding-top:10px; color: #66FCF1;">
						</div>
						
						<div class="carinfo">
							<div class="col-5">
								<i class="fa fa-group"></i><h5> <?php echo $row['vehicleSeat']?> </h5>
								<br>
								<i class="fa fa-sliders"></i><h5><?php echo $row['vehicleTrans']?></h5>
								<br>
								<i class="fa fa-tachometer"></i><h5><?php echo $row['vehicleMileage']?>km </h5>
								<br>
								<i class="fa fa-suitcase"></i><h5> <?php echo $row['vehicleLuggage']?>litres</h5>
								<br>
							</div>
						
						
							<div class="col-6">
								<i class="fa fa-car"></i><h5><?php echo $row['vehicleType']?></h5>
								<br>
									<div class="carspacing">
										<i class="fa fa-gear"></i><h5><?php echo $row['vehicleHP']?>CC </h5>
										<br>
										<i class="fas fa-gas-pump"></i><h5><?php echo $row['vehicleFuel']?> litres</h5>
										<br>
										<i class="fa fa-bluetooth"></i><h5><?php echo $row['vehicleBluetooth']?></h5>
										<br>
									</div>
							
							</div>
						</div>
						
						<div class="ownerimage">
							<h2> Owned By: </h2>
							<h5><?php echo $row['OwnerName']?></h5>
							
						</div>
						
						
						<div class="filterbox2">
						<div class="searchbar2">
						<div class="redbutton">
							<input type="submit" value="Remove" onClick="location.href='removecart.php?id=<?php echo $i?>';" >
						</div>
							<input type="submit" value="Rent Now" onClick="location.href='payment.php?id=<?php echo $row['vehicleID'] ?>'">
						</div>
						</div>
						
						
					
					
					</div>
					
				</div>
			
				
				
				<?php
				$i++;
			}
							
		}
		
	}
	else
	{
		echo "<script> alert('You have to be logged in to add this vehicle into the cart!!!'); 
		window.history.back();
		</script>";
	}
	
	
	
?>
</div>
</div>
</div>
<?php
	require('footer.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
   $(function () {
 
  $(".rateYo").rateYo({
    
    readOnly: true
  });
});

</script>
<script>
function UnsetPreviousSession()
	{
		unset( $_SESSION['cart'][$result - 1] ); 
	}
</script>
</body>
</html>