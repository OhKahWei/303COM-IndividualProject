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
	require('header.php');
	
	$userID = $_SESSION['UserID'];
	
	if(!isset($_SESSION['UserID'])) 
		{ 
			echo"<script> alert('Please login to view this page');
				window.location=\"login.php\";
				</script>";
			
		}
?>
<div id="history">
<div class="bg-img">
</div>

<div class="headertitle">
History
<p>We are appreciate for the feedbacks and hope you enjoy your ride  </p>
</div>


<div class="container-fluid garage history-rated">
<div class="row">

	<h1> Rate your experience </h1> 

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
$con = mysqli_connect($servername, $username, $password, $dbname);

	$res = mysqli_query($con,"Select * from invoice AS a INNER JOIN vehicle AS b WHERE a.vehicleID = b.vehicleID AND a.userID = '".$userID."' AND a.rating = 0 AND a.status='APPROVED' ");
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
							<h2> Owned By: </h2>
							<h5> <?php echo $row['ownerName']?> </h5>
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
								<h5> Owner Phone&emsp;&emsp;&nbsp;&nbsp;		:<?php echo $row['OwnerPhoneNumber']?> </h5>
				
						</div>
						
						<form action="" method="post">
						<h5 style="margin-top: 20px;"> Rate : </h5>
						<div class="rateyo" id= "rating"
							data-rateyo-rating="<?php echo $row['rating']?>"
							data-rateyo-num-stars="5"
							data-rateyo-score="3"
							style="margin-top:-37px; color: #66FCF1; margin-left: 65px; ">
						</div>
						<input type="hidden" name="rating"> 
						<input type="text" name="id" value="<?php echo $row['invoiceID']?>" style='display:none;'>
						<input type="text" name="vehicleid" value="<?php echo $row['vehicleID']?>" style='display:none;'>
						<input type ="submit" name="submit" value="Submit">
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


<div class="container-fluid garage history-notrated">
<div class="row">

	<h1> History </h1>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrental";
$con = mysqli_connect($servername, $username, $password, $dbname);

	$res = mysqli_query($con,"Select * from invoice AS a INNER JOIN vehicle AS b WHERE a.vehicleID = b.vehicleID AND a.userID = '".$userID."' AND a.rating != 0 AND a.status = 'APPROVED' ");
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
							<h2> Owned By: </h2>
							<h5> <?php echo $row['ownerName']?> </h5>
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
								<h5> Owner Phone&emsp;&emsp;&nbsp;&nbsp;		:<?php echo $row['OwnerPhoneNumber']?> </h5>
								<h5> Rating &emsp;&emsp;&nbsp;&nbsp;			:<?php echo $row['rating']?> </h5>
				
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
if(isset($_POST['submit']))
{
	
	$rating = $_POST['rating'];
	$id = $_POST['id'];
	$vehicleid = $_POST['vehicleid'];
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "carrental";
	$con = mysqli_connect($servername, $username, $password, $dbname);
	
	
	$sql ="UPDATE invoice SET rating = '$rating' WHERE invoiceID = '$id' ";
	$sql2= "SELECT AVG(rating) AS myAvg FROM invoice WHERE vehicleID='$vehicleid' GROUP BY vehicleID";

	if (mysqli_query($con, $sql))
{
	$result = mysqli_query($con, $sql2);
	while($row = mysqli_fetch_array($result)) 
	{
		$sql= "UPDATE vehicle SET status='ONLINE', vehicleRating='".$row["myAvg"]."' WHERE vehicleID='$vehicleid'";
		
		if (mysqli_query($con, $sql)) 
		{
			echo "<script> alert('Thanks for your feedback !'); 
					window.location=\"history.php\";
			</script>";   
		}
		else
		{
			echo "<script> alert('Cannot calculate the average rating'); </script>";  
		}
	}
	
}
else
{
	echo "<script> alert('Cannot update'); </script>";  
		
}



}


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