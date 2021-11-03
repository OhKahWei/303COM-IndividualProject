<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<html>
<head>
	<title>History | Catch a Ride </title>
</head>
<body>

<?php
	require('ownerHeader.php');
		
		
		$ownerID = $_SESSION['OwnerID'];
		$ownerName = $_SESSION['OwnerName'];
		$ownerPhone = $_SESSION['OwnerPhoneNumber'];
?>
<div id="ownerHistory">
<div id="history">
<div class="bg-img">
</div>

<div class="headertitle">
History
<p>We hope you have a great day and thanks for choosing us  </p>
</div>

<div class="container-fluid garage history-rated">
<div class="row">

	<h1> PENDING for Approval </h1> 

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
$con = mysqli_connect($servername, $username, $password, $dbname);


	if(isset($_POST['approve']))
	{
		$id = $_POST['id'];
		$carid = $_POST['carid'];
		
		$sql = "UPDATE invoice SET status = 'APPROVED' WHERE invoiceID = '$id'";
		$sql2 = "UPDATE vehicle SET status = 'OFFLINE' WHERE vehicleID = '$carid'";
		
		if (mysqli_query($con, $sql))
		{
			if (mysqli_query($con, $sql2))
			{
				echo "<script> alert('Order approved!'); 
				  window.location=\"ownerHistory.php\";
				  </script>";     
			}
			else
			{
				echo "<script> alert('Cannot update vehicle status '); </script>";  
			}
			
		}
		else
		{
			echo "<script> alert('Cannot approve order '); </script>";  
		}
	}
	
	if(isset($_POST['reject']))
	{
		$id = $_POST['id'];
		$carid = $_POST['carid'];
		
		$sql = "UPDATE invoice SET status = 'REJECTED' WHERE invoiceID = '$id'";
		$sql2 = "UPDATE vehicle SET status = 'ONLINE' WHERE vehicleID = '$carid'";
		
		if (mysqli_query($con, $sql))
		{
			if (mysqli_query($con, $sql2))
			{
				echo "<script> alert('Order rejected!'); 
					  window.location=\"ownerHistory.php\";
					  </script>";  
			}
			else
			{
				echo "<script> alert('Cannot update vehicle status '); </script>";  
			}			
		}
		else
		{
			echo "<script> alert('Cannot reject order '); </script>";  
		}
	}

	$res = mysqli_query($con,"Select * from invoice AS a INNER JOIN vehicle AS b WHERE a.vehicleID = b.vehicleID AND b.OwnerID = '".$ownerID."' AND a.rating = 0 AND a.status = 'PENDING' ");
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
						 
						 <div class="ownerimage">
							<h2> Rent By: </h2>
							<h5> <?php echo $row['userName']?> </h5>
						</div>
						
						<div class="carinfo">
							
								<h5> Invoice No	&emsp;&emsp;&emsp;&emsp;: <?php echo $row['invoiceID']?>	</h5>
								<h5> Pickup Location &emsp;						:<?php echo $row['pickupLocation']?></h5>
								<h5> Pickup Date&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['pickupDate']?></h5>
								<h5> Pickup Time&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['pickupTime']?>
								<h5> Return Location &emsp;						:<?php echo $row['returnLocation']?></h5>
								<h5> Return Date&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['returnDate']?> 	</h5>
								<h5> Return Time&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['returnTime']?>   </h5>
								<h5> Payment  &emsp;&emsp;&emsp;&emsp;&emsp; :	<?php echo $row['payment']?></h5>
								<h5> Time Rent&emsp;&emsp;&emsp;&emsp;&nbsp;	: <?php echo $row['timerent']?></h5>
								<h5> Rentee Phone&emsp;&emsp;&nbsp;&nbsp;		:<?php echo $row['userPhone']?> </h5>
								
				
						</div>
						
						<form action="" method="post">
						<div class="filterbox2">
						<div class="searchbar2">
						
							<input type="submit" name="approve" value="Approve">
							<input type="text" name="id" value="<?php echo $row['invoiceID'] ?>" style="display:none;">
							<input type="text" name="carid" value="<?php echo $row['vehicleID'] ?>" style="display:none;">
						</form>
						<form action="" method="post">
							<div class="redbutton">
								
								<input type="submit" name="reject" value="Reject">
								<input type="text" name="id" value="<?php echo $row['invoiceID'] ?>" style="display:none;">
								<input type="text" name="carid" value="<?php echo $row['vehicleID'] ?>" style="display:none;">
								
							</div>
							</form>
							
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

<div class="container-fluid garage history-rated">
<div class="row">

	<h1> Reserved Cars </h1> 

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
$con = mysqli_connect($servername, $username, $password, $dbname);

	$res = mysqli_query($con,"Select * from invoice AS a INNER JOIN vehicle AS b WHERE a.vehicleID = b.vehicleID AND b.OwnerID = '".$ownerID."' AND a.rating = 0  AND a.status = 'APPROVED'");
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
						 
						 <div class="ownerimage">
							<h2> Rent By: </h2>
							<h5> <?php echo $row['userName']?> </h5>
						</div>
						
						<div class="carinfo">
							
								<h5> Invoice No	&emsp;&emsp;&emsp;&emsp;: <?php echo $row['invoiceID']?>	</h5>
								<h5> Pickup Location &emsp;						:<?php echo $row['pickupLocation']?></h5>
								<h5> Pickup Date&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['pickupDate']?></h5>
								<h5> Pickup Time&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['pickupTime']?>
								<h5> Return Location &emsp;						:<?php echo $row['returnLocation']?></h5>
								<h5> Return Date&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['returnDate']?> 	</h5>
								<h5> Return Time&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['returnTime']?>   </h5>
								<h5> Payment  &emsp;&emsp;&emsp;&emsp;&emsp; :	<?php echo $row['payment']?></h5>
								<h5> Time Rent&emsp;&emsp;&emsp;&emsp;&nbsp;	: <?php echo $row['timerent']?></h5>
								
				
						</div>
						
						<h5 style="margin-top: 20px; width:400px; letter-spacing:2px;"> Rentee Phone &emsp;&emsp;	:<?php echo $row['userPhone']?>  </h5>
					
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


<div class="container-fluid garage history-notrated">
<div class="row">

	<h1> History </h1>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
$con = mysqli_connect($servername, $username, $password, $dbname);

	$res = mysqli_query($con,"Select * from invoice AS a INNER JOIN vehicle AS b WHERE a.vehicleID = b.vehicleID AND b.OwnerID = '".$ownerID."' AND a.status = 'APPROVED' ");
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
						 
						 <div class="ownerimage">
							<h2> Rent By: </h2>
							<h5> <?php echo $row['userName']?> </h5>
						</div>
						
						<div class="carinfo">
							
								<h5> Invoice No	&emsp;&emsp;&emsp;&emsp;: <?php echo $row['invoiceID']?>	</h5>
								<h5> Pickup Location &emsp;						:<?php echo $row['pickupLocation']?></h5>
								<h5> Pickup Date&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['pickupDate']?></h5>
								<h5> Pickup Time&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['pickupTime']?>
								<h5> Return Location &emsp;						:<?php echo $row['returnLocation']?></h5>
								<h5> Return Date&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['returnDate']?> 	</h5>
								<h5> Return Time&emsp;&emsp;&emsp;&nbsp;		:<?php echo $row['returnTime']?>   </h5>
								<h5> Payment  &emsp;&emsp;&emsp;&emsp;&emsp; :	<?php echo $row['payment']?></h5>
								<h5> Time Rent&emsp;&emsp;&emsp;&emsp;&nbsp;	: <?php echo $row['timerent']?></h5>
								<h5> Rating &emsp;&emsp;&nbsp;&nbsp;			:<?php echo $row['rating']?> </h5>
				
						</div>
					
					<h5 style="margin-top: 20px; width:400px; letter-spacing:2px;"> Rentee Phone &emsp;&emsp;	:<?php echo $row['userPhone']?>  </h5>
					
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
	require('footer.php');
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>
   $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
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