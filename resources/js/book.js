$(document).ready(function() {
    // generateNumbers();
    priceCalc();
    newBooking();
    existingBooking();
});

// function generateNumbers (){
//   for(let index = 0; index<=50; index++) {
//     $("#noOfGuests").append("<option value=" + index + ">" +index+ "</option>");
//   };
// }
/*childPrice = () => {
  priceCalc("#children", 15, "#adults", 20);
}

adultPrice = () => {
  priceCalc("#adults", 20, "#children", 15);
}

determineClick = () => {
  event.target.id = "children" ? priceCalc("#children", 15, "#adults", 20) : false;
  event.target.id = "adult" ? priceCalc("#adults", 20, "#children", 15) : false;
} */

function priceCalc() {
  let noOfGuests = $("#noOfGuests").val();
  let $price = noOfGuests * 20;
  let amtToBePaid =  "&#36;" + $price;
  $( "#totalPrice" ).empty().append(amtToBePaid);
}

function priceDiffCalc(totalPaid) {
  let noOfGuests = $("#noOfGuests").val();
  let $price = noOfGuests * 20;
  let $priceDiff = totalPaid - $price;
  // let amtToBePaid =  "&#36;" + $priceDiff;
  let refundOrExtra;
  let zeroGuestsSelectedNote = 'You are about to delete all guests. ';

  if($priceDiff == 0) {
    refundOrExtra = 'Price unchanged';
  } else {
    refundOrExtra = totalPaid < $price ? 'You will need to pay ' + '&#36;' + Math.abs($priceDiff) + ' extra' : 'You will be refunded ' + '&#36;' + Math.abs($priceDiff);
  }

  if(noOfGuests == 0){
    refundOrExtra += ' and your booking will be canceled.';
    $( "#paymentDetails" ).empty().append(zeroGuestsSelectedNote + refundOrExtra);
  } else {
    $( "#paymentDetails" ).empty().append(refundOrExtra);
  }
}

function validateEmail() {

}

function newBooking(){
    $("#newBooking").on('click', function(){
      $(this).hide();
      $("#editBooking").show();
            $("#newForm").slideDown();
            $("#existingForm").slideUp();
    });
}

function existingBooking(){
    $("#editBooking").on('click', function(){
      $(this).hide();
      $("#newBooking").show();
            $("#existingForm").slideDown();
            $("#newForm").slideUp();
    });
}

function checkChanges() {
  alert('Changes');
}