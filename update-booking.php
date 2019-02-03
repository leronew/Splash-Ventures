<?php
  session_start();
          
$formToCaptureId = "
          <form role='form' method='POST' class='' id='existingForm' 
              action='./update-booking.php'>
            <label>Enter the Splash ID from your receipt:</label>
            <input type='text' name='splash-id' id='splash-id'/>
            <input name='submitExisting' type='submit' class='btn btn-md' id='submitExisting' value='Edit Booking'/>
          </form>";

    if(!isset($_POST['submitExisting'])) {
      header('Location: ./book.php');
      exit(); //stops script from running
    } else {
      include_once './header.php';
      include_once './php-includes/dbConnection.php';

      $splash_id = mysqli_real_escape_string($conn, trim($_POST["splash-id"]));
      $sqlSelect = "SELECT * FROM paidguests WHERE splash_id = '$splash_id'";
      $results = mysqli_query($conn, $sqlSelect);
      $resultCheck = mysqli_num_rows($results);
      $row = mysqli_fetch_assoc($results);  
      
      if($resultCheck > 0){
        $_SESSION['$fname'] = $fname = $row['fname'];
        $_SESSION['$lname'] = $lname = $row['lname'];
        $_SESSION['$oldTotal'] = $total = $row['total'];
        $_SESSION['$selectedDate'] = $date = $row['selectedDate'];
        $_SESSION['$noOfGuests'] = $noOfGuests = $row['noOfGuests'];
        $_SESSION['$splash_id'] = $splash_id;

        echo "";
        echo " <div class='container-fluid'>
                      <div class='row'>
                      <div class='col-md-6'>
                      <h4>Edit your booking here. You must select your DATE again! To cancel a booking, select 0 guests and click next.</h4>
                      </div>
                      </div>
                      <div class='row'>
                      <div class='col-md-6'>
                      <form role='form' method='POST' id='submitChanges' 
          action='./php-includes/submit-to-jad.php'>
            <div class='container-fluid'>
              <div class='row'>
                    <div class='col-sm-6 form-group'>
                        <label for='fname'> First Name:</label>
                        <input type='text' class='form-control required' id='fname' required name='fname' value='". $fname. "'maxlength='50'>
                    </div>
                    <div class='col-sm-6 form-group'>
                        <label for='lname'> Last Name:</label>
                        <input type='text' class='form-control required' id='lname' required name='lname' value='". $lname. "'maxlength='50'>
                    </div>
                    <div class='col-sm-3 form-group'>
                  <label for='noOfGuests'> No. of Guests:</label>
                  <input type='number' required onchange='priceDiffCalc(".$total.") 'class='form-control required'
                    id='noOfGuests' name='noOfGuests' min='0' max='55' value='". $noOfGuests. "'/>
              </div>
              <div class='col-sm-3 form-group'>
                  <label for='totalPrice'>Total Paid</label>
                  <p class='form-control' id='totalPrice' name='totalPrice'></p>
              </div>
              <div class='col-sm-6 form-group'>
                  <label for='selectedDateToEdit'> Date:</label>

                  <input required type='text' class='form-control required' id='selectedDateToEdit' name='selectedDateToEdit' data-translate-mode='true' data-large-default='true' data-large-mode='true' data-lock='from' data-min-year='<?php echo @date('Y');?>

                  <script>
                  $('#selectedDateToEdit').dateDropper();
                  </script>

              </div>
              </div>
              <div><p id='paymentDetails'></p></div>
            <div class='col-sm-12 form-group'>
                      <input onclick='' name='submitChanges' type='submit' class='btn btn-lg btn-block' id='submitChanges' value='NEXT STEP'>
                  </div>
           
            </div>   
              
          </form></div></div></div>";
      } else {
        echo "<p>Invalid Splash ID</p>";
        echo $formToCaptureId;
      }
      include_once './footer.php';
  }



