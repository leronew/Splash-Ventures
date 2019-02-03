<?php

    if(isset($_SERVER["HTTP_REFERER"]) & (strpos($_SERVER["HTTP_REFERER"], "book.php"))) {
    	session_start();
    	include_once './header.php';
	    include_once './php-includes/dbConnection.php';

	
	    $splash_id = $_GET['custom'];//get custom string returned in the url from JAD. Custom string is the $splash_id created in sumit-to-jad.php. If it returns here, it means the pay was succesful on Jad's end

	   
  			$sqlSelect = "SELECT * FROM unpaidguests WHERE splash_id = '$splash_id'";
		  	$results = mysqli_query($conn, $sqlSelect);
		  	$resultCheck = mysqli_num_rows($results);
		  	$row = mysqli_fetch_assoc($results);

		  	$sqlCopy = "INSERT INTO paidguests " . $sqlSelect;
			$sqlDelete = "DELETE FROM unpaidguests WHERE splash_id = '$splash_id'";

		    mysqli_query($conn, $sqlCopy);
		    mysqli_query($conn, $sqlDelete);
  		
	  	
	    $conn->close();

$receipt = "<p class='thanks'>Thank you for choosing Splash Ventures for your fun in the sun.</p>
		    	<img class='success-icon' src='./resources/images/icons/payment-success.png'/>
		    	<p class='thanks'>Here are the details of your appointment.</p>
		    	<p class='thanks'>Your SplashID is " .$row['splash_id']. ".</p>
		    	<div class='a'>
				   	<div><img class='success-icon' src='./resources/images/icons/icons8-event-48.png'/></div>
				   	<span id=''>" . $row['selectedDate']. "</span>
				</div>
		    	
		    	<div class='a'>
		    			<div><img class='success-icon' src='./resources/images/icons/id-icon.jpg'/></div>
		   				<span id='table_name'>" . $row['fname'] . " " .  $row['lname'] . "</span>
		   		</div>
		   		<div class='a'>
		    			<div><img class='success-icon' src='./resources/images/icons/People_icon.svg'/></div>
						<span>" . " " . $row['noOfGuests']. " " . "guests</span>
		    	</div>
		    	<div class='a'>
		    			<div><img class='success-icon' src='./resources/images/icons/dollar-flat/64x64.png'/></div>
						<span>" . $row['total'] . "</span>
				</div>
				<a href='./book.php'>
					<button class='btn btn-success'>New Booking</button>
				</a>";

echo "<div class='success-page'>" . $receipt . "</div>";

} elseif(isset($_SERVER["HTTP_REFERER"]) & ($_GET['instruction'] == 'update' OR 'refund')) { 
	session_start();
    include_once './header.php';
	include_once './php-includes/dbConnection.php';
	$splash_id = $_SESSION['$splash_id'];
	$updatedOrRefund;
	if($_GET['instruction'] == 'update'){
		$updatedOrRefund  = '';
	} elseif($_GET['instruction'] == 'refund') {
		$updatedOrRefund = 'You will be refunded $' . $_SESSION['$difference'];
	}

	$sqlSelect = "SELECT * FROM paidguests WHERE splash_id = '$splash_id'";
	$results = mysqli_query($conn, $sqlSelect);
	$resultCheck = mysqli_num_rows($results);
	$row = mysqli_fetch_assoc($results);

$receipt1 = "<p class='thanks'>You have updated your booking.</p>
		    	<img class='success-icon' src='./resources/images/icons/payment-success.png'/>
		    	<p class='thanks'>Here are the details of your appointment.</p>
		    	<p class='thanks'>" . $updatedOrRefund . "</p>
		    	<p class='thanks'>Your SplashID is " .$row['splash_id']. ".</p>
		    	<div class='a'>
				   	<div><img class='success-icon' src='./resources/images/icons/icons8-event-48.png'/></div>
				   	<span id=''>" . $row['selectedDate']. "</span>
				</div>
		    	
		    	<div class='a'>
		    			<div><img class='success-icon' src='./resources/images/icons/id-icon.jpg'/></div>
		   				<span id='table_name'>" . $row['fname'] . " " .  $row['lname'] . "</span>
		   		</div>
		   		<div class='a'>
		    			<div><img class='success-icon' src='./resources/images/icons/People_icon.svg'/></div>
						<span>" . " " . $row['noOfGuests']. " " . "guests</span>
		    	</div>
		    	<div class='a'>
		    			<div><img class='success-icon' src='./resources/images/icons/dollar-flat/64x64.png'/></div>
						<span>" . $row['total'] . "</span>
				</div>
				<a href='./update-booking.php'>
					<button class='btn btn-success'>Edit a booking</button>
				</a>
				<a href='./book.php'>
					<button class='btn btn-success'>New Booking</button>
				</a>";

	echo "<div class='success-page'>" . $receipt1 . "</div>";

} else {
	header("Location: book.php");
}

include_once './footer.php';