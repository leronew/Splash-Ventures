$(document).ready(function() {
 fullHeight();
});

function fullHeight() {
 let height = screen.height - 400;//header is 19rem. footer is 6 rem. total 400px
 $("#wrapper").css("min-height", height);
 $("#main").css("min-height", height);
}
