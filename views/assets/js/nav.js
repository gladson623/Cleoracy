$(document).ready(function() {
    $('.dropdown-toggle').on('click', function() {
      var dropdownMenu = $(this).siblings('.dropdown-menu');
      $('.dropdown-menu').not(dropdownMenu).hide(); // Fecha outros dropdowns abertos
      dropdownMenu.toggle(); // Abre ou fecha o dropdown atual
    });
  });
  
