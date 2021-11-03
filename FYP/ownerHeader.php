<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Audiowide&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div id="navbar">
  <a href="home.php" id="logo">Catch a Ride</a>
  <div id="navbar-right">
	
    <a href="OwnerHome.php">Home</a>
    <a id="nav" href="uploadcar.php">Upload Cars</a>
	<a id="nav" href="ownerHistory.php">History</a>
	
<?php
		if( isset ($_SESSION['OwnerName']))
		{
			echo "<a id='nav' href='ownerProfile.php'>" .$_SESSION['OwnerName']. "</a>";
		}
		else
		{
				header("Location: ownerlogin.php");
		}
?>	
	
  </div>
</div>


<script>
// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("navbar").style.padding = "10px 10px";
    document.getElementById("logo").style.fontSize = "55px";
  } else {
    document.getElementById("navbar").style.padding = "20px 10px";
    document.getElementById("logo").style.fontSize = "67px";
  }
}



</script>
