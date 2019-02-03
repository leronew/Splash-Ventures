<?php
    
	

    if(isset($_SERVER['HTTP_REFERER']) & (strpos($_SERVER['HTTP_REFERER'], "jad.cash"))) {
    	session_start();
    	include_once './header.php';
	    include_once './php-includes/dbConnection.php';

  		$splash_id = $_GET['custom'];

	  	$sqlSelect = "SELECT * FROM unpaidguests WHERE splash_id = '$splash_id'";
	  	$results = mysqli_query($conn, $sqlSelect);
	  	$resultCheck = mysqli_num_rows($results);
	  	$row = mysqli_fetch_assoc($results);		    
		 
	    $conn->close();
 ?>

 <div class='cancel-page'>
    <div class='container-fluid cancel'>
    	<div class='row'>
		    <div class='col-md-12'>
		    	<img class='success-icon' src='./resources/images/failure.jpg' alt='failure-X' />
		    	<p>Transaction unsuccessful</p>
		    	<p>There was a problem processing your payment. Please select a different payment method or try again later.</p>
		    	<button type='button' class='btn btn-success' onclick="location.href='./book.php'">Try again</button>
		    </div>
		</div>
	</div>
</div>
<?php
} else {
	header("Location:./book.php");
}


	include_once './footer.php';

