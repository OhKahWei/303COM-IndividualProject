<?php
	session_start();
	
?>

    
    <?php
	for($i=0;  $i<3;  $i++)
	{
?>


    <form action="#"  method="POST">
	<input type="submit"  value="<?php echo $i?>" name="addToCart">
		<?php	
	}   
		?>
		
		<input type="submit" value="Clear session" name="clear">
        </form>
        
<?php 
    if (isset($_POST["addToCart"]))
    {
        $input = $_POST["addToCart"];
        echo "$input ";
        array_push($_SESSION['id'], $input);
        
    }

    if (isset($_POST["clear"]))
    {
		//$_SESSION['id']=array();
        unset($_SESSION['id'][2-1]);
    }

    echo "Number of Items in the cart = ".sizeof($_SESSION['id'])."<";
    print_r($_SESSION['id']);
?>
