$(document).ready(function() {
  letterFx();
});

function letterFx() {
  $(".tagline").letterfx({"fx":"fly-top","backwards":false,"timing":100,"fx_duration":"1000ms","letter_end":"restore","element_end":"restore"});
};
