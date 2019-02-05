<?php
    $paymentID = 'FBC95BCA-685A-4C44-A9DD-B94355249B3B';
    if(isset($_POST['submit'])) {

      include_once './dbConnection.php';

      $fname = mysqli_real_escape_string($conn, strtoupper(trim($_POST["fname"])));
      $lname = mysqli_real_escape_string($conn, strtoupper(trim($_POST["lname"])));
      $noOfGuests = mysqli_real_escape_string($conn, $_POST["noOfGuests"]);
      $selectedDate = mysqli_real_escape_string($conn, $_POST["selectedDate"]);
      $cust_email = mysqli_real_escape_string($conn, trim($_POST["cust_email"]));
      $cust_phone = mysqli_real_escape_string($conn, trim($_POST["cust_phone"]));
      $country = mysqli_real_escape_string($conn, $_POST["country"]);
      $totalPrice = $noOfGuests * 20;
      $splash_id = uniqid('SVCB1DP').$fname[0].$lname[0];

      // ERROR handlers
      // if(!filter_var($cust_email, FILTER_VALIDATE_EMAIL)) {
      //   // header("Location: ../book.php?error=invalidemail");
      //   echo 'invalid email';
      //   exit();
      // }

      $sqlCommand = "INSERT INTO unpaidguests(fname, lname, total, noOfGuests, selectedDate, email, phone, country, splash_id) VALUES ('$fname','$lname','$totalPrice','$noOfGuests','$selectedDate','$cust_email','$cust_phone','$country','$splash_id')";

      mysqli_query($conn, $sqlCommand);
      $conn->close();

      // uncomment the url below and remove brackets when ready to use with jad

      $url = 'https://jad.cash/handlers/webpay.aspx?paymentID=FBC95BCA-685A-4C44-A9DD-B94355249B3B&subTotalAmount=$newTotalPrice&discountAmount=0&tipAmount=0&itemCode=SVCB1DP&itemName=1_Day_Pass&custom=$splash_id';
  
      // comment the url below when ready to use with jad

      // $url = "../success.php?paymentId=" . urlencode($paymentID) . "&custom=". urlencode($splash_id); 
      header("Location: $url");
      exit();

    } elseif(isset($_POST['submitChanges'])) {
        session_start();
        include_once './dbConnection.php';

        $splash_id = $_SESSION['$splash_id'];
        $noOfGuestsBookedPreviously = $_SESSION['$noOfGuests'];

        $sqlSelect = "SELECT * FROM paidguests WHERE splash_id = '$splash_id'";
        $results = mysqli_query($conn, $sqlSelect);
        $resultCheck = mysqli_num_rows($results);
        $row = mysqli_fetch_assoc($results); 
        $user_id = $row['user_id']; 

        $newFName = mysqli_real_escape_string($conn, strtoupper(trim($_POST["fname"])));
        $newLNname = mysqli_real_escape_string($conn, strtoupper(trim($_POST["lname"])));
        $newNoOfGuests = mysqli_real_escape_string($conn, $_POST["noOfGuests"]);
        $newSelectedDate = mysqli_real_escape_string($conn, $_POST["selectedDateToEdit"]);
        $newTotalPrice = $newNoOfGuests * 20;

        $sqlAddToUpdateTable = "INSERT INTO updatetable(user_id, lname, fname, total, noOfGuests, selectedDate, splash_id) VALUES ('$user_id', $newFName','$newLName','$newTotalPrice','$newNoOfGuests','newSelectedDate','$splash_id')";

        mysqli_query($conn, $sqlAddToUpdateTable); 

        $sqlUpdateCommand = "UPDATE paidguests SET fname = '$newFName', lname = '$newLNname', noOfGuests = '$newNoOfGuests', selectedDate = '$newSelectedDate', total = '$newTotalPrice' WHERE splash_id = '$splash_id'";


        if($noOfGuestsBookedPreviously === $newNoOfGuests) {
          mysqli_query($conn, $sqlUpdateCommand); 
          $conn->close();
          $url = "../success.php?&instruction=". urlencode('update'); 
          header("Location: $url");
        } elseif ($noOfGuestsBookedPreviously > $newNoOfGuests) {
            $_SESSION['$difference'] = $_SESSION['$oldTotal'] - $newTotalPrice;
            mysqli_query($conn, $sqlUpdateCommand); 
            $conn->close();
            $url = "../success.php?&instruction=". urlencode('refund'); 
            header("Location: $url");
        } else{          
            $url = 'https://jad.cash/handlers/webpay.aspx?paymentID=FBC95BCA-685A-4C44-A9DD-B94355249B3B&subTotalAmount=$newTotalPrice&discountAmount=0&tipAmount=0&itemCode=SVCB1DP&itemName=1_Day_Pass&custom=$splash_id';
            header("Location: $url");
        }
      } 
    else {
      header("Location: ../book.php");
      exit(); //stops script from running
    }
