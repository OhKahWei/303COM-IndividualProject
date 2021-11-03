<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	
	
	<title>Catch a Ride </title>
</head>
<body>

<script>
        function printDiv() {
            var divContents = document.getElementById("printsales").innerHTML;
            var a = window.open();
            a.document.write('<html>');
            a.document.write('<body > <h1>&emsp;&emsp;&emsp;&emsp;Catch a Ride Sales Report<br><br><br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
<?php
	require('ownerHeader.php');
	
	$ownerID = $_SESSION['OwnerID'];
	$ownerName=$_SESSION['OwnerName'];
?>
<div id="ownerHome">
<div id="car">
<div id="bg-Ownerimg">
</div>

<div class="headertitle">
Welcome, <?php echo $ownerName ?>
<p style="color: black;">We hope you are doing great and enjoy our system</p>
</div>


<form action="" method="post" >
<div class="container" >
	<div class="row">
		<div class="filterbox">
		<div class="searchbar">
		<h4> Print Sales: </h4>
		<select name="filter" id="cars">
			<option value="vehicleID">Top Sales</option>
			<option value="vehicleRating">Top Rating</option>
		</select>
		<input type="submit" name="filtersearch" value="Print" >
		</div>
		</div>
	</div>
</div>
</form>

<div id="printsales" style="display:none">
                            <table class="sales">
                                <thead>
                                    <tr>
                                        
                                        <th>Vehicle ID</th>
                                        <th>Name</th>
                                        <th>Vehicle Price</th>
										<th>Vehicle Category</th>
										<th>Vehicle Type </th>
                                        <th>Vehicle Rating</th>
										
                                       
	
                                    </tr>
                                </thead>    
                                <tbody>
                             <?php

                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "carrental";
                                $con = mysqli_connect($servername, $username, $password, $dbname);
                                
                                if(isset($_POST['filtersearch']))
								{
                                    $filter = $_POST['filter'];
								
									if($filter == "vehicleID")
									{
										$res = mysqli_query($con,"Select * from invoice AS a INNER JOIN vehicle AS b WHERE a.vehicleID = b.vehicleID AND b.OwnerID = '".$ownerID."' GROUP BY a.vehicleName ORDER BY COUNT(a.vehicleID) DESC ");
									}
									elseif($filter == "vehicleRating")
									{
										$res = mysqli_query($con,"Select * from invoice AS a INNER JOIN vehicle AS b WHERE a.vehicleID = b.vehicleID AND b.OwnerID = '".$ownerID."' GROUP BY a.vehicleName ORDER BY b.vehicleRating DESC ");
									}
                                
                                
                                
                                $queryResult = mysqli_num_rows($res);
                                if($queryResult > 0)
								{
                                    while($row =mysqli_fetch_array($res))
									{

                            ?>

                                    <tr>
                                        
                                        <td><?php echo $row['vehicleID']?></td>
                                        <td><?php echo $row['vehicleName']?></td>
                                        <td><?php echo $row['vehiclePrice']?></td>
										<td><?php echo $row['vehicleCategory']?></td>
										<td><?php echo $row['vehicleType']?></td>
										<td><?php echo $row['vehicleRating']?></td>
										
										
                                        
                                    </tr>

                            <?php
                                    }
									
                                }
								echo "<script> 
										printDiv();
									</script>";
								
								}
								
                            
                            ?>
                                </tbody>
                            </table>
				</div>



				

<div class="container-fluid garage">
<div class="row">

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
$con = mysqli_connect($servername, $username, $password, $dbname);

	$res = mysqli_query($con,"Select * from vehicle WHERE OwnerID = '".$ownerID."' ");
	$queryResult = mysqli_num_rows($res);


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
							
							<div class="displaystatus">
								<h5> Status: <?php echo $row['status']?> </h5>
							</div>
						</div>
						
						
						
						<form action="" method="post">
						<div class="filterbox2">
						<div class="searchbar2">
							<input type="button" value="Edit" onClick="location.href='editvehicle.php?id=<?php echo $row['vehicleID']?>'; " >
							<div class="redbutton">
								<input type="submit" name="remove" value="Remove">
								<input type="text" name="id" value="<?php echo $row['vehicleID'] ?>" style="display:none;">
							</div>
						</div>
						</div>
						</form>
						
					
					
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
</div>

<?php
if(isset($_POST['remove']))
{
	$id = $_POST['id'];
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "carrental";
	$con = mysqli_connect($servername, $username, $password, $dbname);
	
	
	$sql ="DELETE FROM vehicle WHERE vehicleID = '$id' ";
	

	if (mysqli_query($con, $sql))
	{
		
		echo "<script> alert('Vehicle removed!'); 
			  window.location=\"OwnerHome.php\";
			  </script>";   
	}
	else
	{
		echo "<script> alert('Cannot remove '); </script>";  
	}
}
	

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