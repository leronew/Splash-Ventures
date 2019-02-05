<?php
	
if(isset($_SERVER["HTTP_REFERER"]) & ($_GET['paymentID'] === '1c55c245-47f7-40b3-b140-9442cd169faf')) {  //uncomment when using with jad.

    // if(isset($_SERVER["HTTP_REFERER"]) & (strpos($_SERVER["HTTP_REFERER"], "book.php"))) { //comment when using with jad
       	session_start();
    	include_once './header.php';
	    include_once './php-includes/dbConnection.php';

		$trans_id = $_GET['txnID']; //uncomment when using with jad
	    $splash_id = $_GET['custom'];//get custom string returned in the url from JAD. Custom string is the $splash_id created in sumit-to-jad.php. If it returns here, it means the pay was succesful on Jad's end

	    $row;
	    $sqlSelect = "SELECT * FROM unpaidguests WHERE splash_id = '$splash_id'";
	 	$results = mysqli_query($conn, $sqlSelect);
	 	$resultCheck = mysqli_num_rows($results);
	   
  			
		  	if($resultCheck !== 0) {//checks if this is a new booking. if yes, do the following
		  		
		  		$row = mysqli_fetch_assoc($results);

			  	$sqlCopy = "INSERT INTO paidguests " . $sqlSelect;
		  		$sqlAddTransactionID = "UPDATE paidguests SET trans_id = '$trans_id' WHERE splash_id = '$splash_id'"; //uncomment when using with jad
				$sqlDelete = "DELETE FROM unpaidguests WHERE splash_id = '$splash_id'";


			    mysqli_query($conn, $sqlCopy);
			    mysqli_query($conn, $sqlAddTransactionID); // uncomment when using with jad
			    mysqli_query($conn, $sqlDelete);
			    $conn->close();
		  	} else { //if this is and existing booking and extra was paid, do the following
		  		$sqlSelectFromUpdateTable = "SELECT * FROM updatetable WHERE splash_id = '$splash_id'";
		  		$resultsFromUpdateTable = mysqli_query($conn, $sqlSelectFromUpdateTable);
		  		$row = mysqli_fetch_assoc($resultsFromUpdateTable);
		  		$newFName = $row['fname'];
		  		$newLName = $row['lname'];
		  		$newNoOfGuests = $row['noOfGuests'];
		  		$newSelectedDate = $row['selectedDate'];
		  		$newTotalPrice = $row['total'];
 
		  		$sqlUpdateCommand = "UPDATE paidguests SET fname = '$newFName', lname = '$newLName', noOfGuests = '$newNoOfGuests', selectedDate = '$newSelectedDate', total = '$newTotalPrice' WHERE splash_id = '$splash_id'";
		  	}
		  	

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
					<button class='btn btn-success'>Edit or Create a booking</button>
				</a>";

echo "<div class='success-page'>" . $receipt . "</div>";

} elseif(isset($_SERVER["HTTP_REFERER"]) & ($_GET['instruction'] === 'update' OR 'refund')) { 
	session_start();
    include_once './header.php';
	include_once './php-includes/dbConnection.php';
	$splash_id = $_SESSION['$splash_id'];

	$sqlSelect = "SELECT * FROM paidguests WHERE splash_id = '$splash_id'";
	$results = mysqli_query($conn, $sqlSelect);
	$resultCheck = mysqli_num_rows($results);
	$row = mysqli_fetch_assoc($results);
	$updatedOrRefund;
	$receipt;

	if($_GET['instruction'] == 'update'){
		$updatedOrRefund  = '';
	} 

	if($_GET['instruction'] == 'refund') {
		$updatedOrRefund = 'You will be refunded $' . $_SESSION['$difference'];
		if($row['noOfGuests'] == 0) {
			$receipt = "<p class='thanks'>You have canceled your booking.</p>
		    	<img class='success-icon' src='./resources/images/icons/payment-success.png'/>
		    	<p class='thanks'>" . $updatedOrRefund . "</p>
		    	<a href='./book.php'>
					<button class='btn btn-success'>New Booking</button>
				</a>"; 

			$sqlSelect = "SELECT * FROM paidguests WHERE splash_id = '$splash_id'";
			$sqlCopy = "INSERT INTO unpaidguests " . $sqlSelect;
			$sqlDelete = "DELETE FROM paidguests WHERE splash_id = '$splash_id'";
			mysqli_query($conn, $sqlCopy);
			mysqli_query($conn, $sqlDelete);
		} else {
			$receipt = "<p class='thanks'>You have updated your booking.</p>
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
				<a href='./book.php'>
					<button class='btn btn-success'>Edit or Create a booking</button>
				</a>";
		}		

	}

	
	echo "<div class='success-page'>" . $receipt . "</div>";

} else {
	header("Location: book.php");
}

include_once './footer.php';