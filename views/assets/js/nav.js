$(document).ready(function() {
    $('.dropdown-toggle').on('click', function() {
      var dropdownMenu = $(this).siblings('.dropdown-menu');
      $('.dropdown-menu').not(dropdownMenu).hide(); 
      dropdownMenu.toggle(); 
    });

    $(this).on('click', function(e) {
      var target = $(e.target);
      if (!target.closest('.dropdown').length) {
        $('.dropdown-menu').hide();
      }
    });
});
  
