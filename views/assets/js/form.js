


$(function () {
    $("form").submit(function (e) {
      e.preventDefault();
  
      var form = $(this);
      var action = form.attr("action");
      var data = form.serialize();
  
      $.ajax({
        url: action,
        data: data,
        type: "post",
        dataType: "json",
        beforeSend: function () {
          swal.showLoading();
          
        },
        success: function (su) {
          Swal.close();
  
          if (su.message) {
            Swal.fire({
              icon: su.message.type === 'error' ? 'error' : 'success',
              title: su.message.type === 'error' ? 'Erro' : 'Sucesso',
              text: su.message.message,
            });
            return;
          }
  
          if (su.redirect) {
            location.href = su.redirect.url;
          }
        }
      });
    });
  });

  