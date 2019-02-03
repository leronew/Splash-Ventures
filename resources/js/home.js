$(document).ready(function() {
    changeToX();
});

function changeToX() {
  $('#splash-toggle-nav')
    .on('shown.bs.collapse', function() {
      $('#hamburger-button').addClass('hidden');
      $('#navbar-close').removeClass('hidden');
    });
  $('#splash-toggle-nav')
    .on('hidden.bs.collapse', function() {
      $('#hamburger-button').removeClass('hidden');
      $('#navbar-close').addClass('hidden');
    });

};
