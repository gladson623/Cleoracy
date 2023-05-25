


var currentModal = null;

$('.modal').on('shown.bs.modal', function (e) {

    currentModal = $(this);
});

$(document).on('keyup',function(e) {
    if (currentModal && currentModal.find('.carousel').length) {

        if(e.keyCode == 32) {

            currentModal.carousel('next');

        } else if (e.keyCode == 8) {

            currentModal.carousel('prev');
            return;

        } 
            
    }
});

$(document).on('keyup', function(e) {


    if(e.keyCode === 65 || e.keyCode === 67 ||e.keyCode === 72 ) {

        if(currentModal != null) currentModal.modal('hide');

        if (e.keyCode === 65) { 
      
            $('#AntesModal').modal('show');
            return;
        }
        if (e.keyCode === 67) { 

            $('#CausasModal').modal('show'); 
            return;
        }

        $('#HojeModal').modal('show'); 

    }

});
  
