<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<html>
<head>
	<title>Car | Catch a Ride </title>
</head>
<body>

<?php
	require('header.php');
?>
<div id="car">
<div class="bg-img">
</div>

<div class="headertitle">
Find Car by Type 
<p>We offer professional car rental & limousine services in our range of high-end vehicles </p>
</div>

<form action="" method="post">
<div class="container" >
	<div class="row">
		<div class="filterbox">
		<div class="searchbar">
		
		<select name="cars" id="cars">
			<option value="" hidden>Category</option>
			<option value="toyota">Toyota</option>
			<option value="honda">Honda</option>
			<option value="nissan">Nissan</option>
			<option value="mazda">Mazda</option>
		</select>
		<select name="type" id="cars">
			<option value="" hidden>Type</option>
			<option value="Coupe">Coupe</option>
			<option value="Sedan">Sedan</option>
			<option value="SUV">SUV</option>
			<option value="MPV">MPV</option>
		</select>
		<select name="filter" id="cars">
			<option value="vehiclePrice">Sort by Price</option>
			<option value="vehicleRating">Sort by Review</option>
		</select>
		<input type="submit" name="filtersearch" value="Search">
		</div>
		</div>
	</div>
</div>
</form>

<div class="container-fluid garage">
<div class="row">

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
$con = mysqli_connect($servername, $username, $password, $dbname);

if(isset ($_POST['filtersearch']))
{
	$cars = mysqli_real_escape_string($con, $_POST['cars']);
	$carsfilter = true;
	$type = mysqli_real_escape_string($con,$_POST['type']);
	$typefilter = true;
	$filter = mysqli_real_escape_string($con,$_POST['filter']);
	
	if( empty($cars) )
	{
		$carsfilter = false;
	}
	if( empty($type) )
	{
		$typefilter = false;
	}
	
	if($carsfilter == false && $typefilter == false)
	{
		$res = mysqli_query($con,"Select * from vehicle WHERE status = 'ONLINE' ORDER BY $filter DESC ");
	}
	elseif($carsfilter == false && $typefilter == true)
	{
		$res = mysqli_query($con,"Select * from vehicle WHERE vehicleType = '".$type."' AND status = 'ONLINE' ORDER BY $filter DESC ");
	}
	elseif($carsfilter == true && $typefilter == false)
	{
		$res = mysqli_query($con,"Select * from vehicle WHERE vehicleCategory = '".$cars."' AND status = 'ONLINE' ORDER BY $filter DESC ");
	}
	else
	{
		$res = mysqli_query($con,"Select * from vehicle WHERE vehicleCategory = '".$cars."' AND vehicleType = '".$type."' AND status = 'ONLINE' ORDER BY $filter DESC ");
	}
	
	$queryResult = mysqli_num_rows($res);
}
else
{
	$res = mysqli_query($con,"Select * from vehicle WHERE status = 'ONLINE' ");
	$queryResult = mysqli_num_rows($res);
}

	if($queryResult > 0)
	{
		while($row =mysqli_fetch_array($res))
		{
		?>

				<div class="col-6 outerbox">
				
					<div class="col-6">
					<?php echo '<img src="data:image;base64,'.base64_encode($row['vehiclePic']) .'" alt="image">'; ?>
					</div>
					
					<div class="col-5">
					
						<h4><?php echo $row['vehicleName']?></h4> 
						
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
							<input type="submit" value="Add to Cart" onClick="location.href='cart.php?id=car<?php echo $row['vehicleID']?>'; " >
							<input type="submit" value="Rent Now" onClick="location.href='payment.php?id=<?php echo $row['vehicleID'] ?>'">
						</div>
						</div>
						
						
					
					
					</div>
					
				</div>
			
			

		<?php
		}
		
	}
	else
	{
		echo "No results found!!!";
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
 function alertbox()
 {
	 alert("Add to cart successfully!");
 }
</script>
</body>
</html>