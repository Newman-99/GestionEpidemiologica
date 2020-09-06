$(document).ready(function() {
  $(".btn-exit-system").on('click',function(e){

    e.preventDefault();
    var URL_tokenCurrentUSer = $(this).attr('href');

    Swal.fire({
      title: 'Quiere salir del sistema?',
      text: "La sesión actual se cerrara y saldra del sistema",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#03A9F4',
      cancelButtonColor: '#F44336',
      confirmButtonText: ' <i  class="zmdi zmdi-run"></i> Si, Salir!',
      cancelButtonText: ' <i class="zmdi zmdi-close-circle"></i> No, Cancelar'
    }).then((result) => {
      if (result.value) {
        
        $.ajax({
    url: URL_tokenCurrentUSer,
    processData: false,
    cache: false,
        success:function(data) {
    console.log(data);
    let alert = JSON.parse(data);
    ajaxSweetAlerts(alert);

/*
    var alert = {"Alert":"simple","Title":"Ocurrió un error inesperado","Text":"No se pudo salir de la Sesion","Type":"error"};

    ajaxSweetAlerts(alert);
*/
        }

        });
      }
    });

  });
});
  