$(document).ready(function() {
 ajaxFunction();
});
	

	function ajaxFunction(){
	console.log('got to ajax request');
    var splashId = $("#splash-id").val();
    console.log(splashId);
    var queryString = "?splashId=" + splashId ;
    $("#ajaxDiv").load("../php-includes/update-booking.php" + queryString);
}      