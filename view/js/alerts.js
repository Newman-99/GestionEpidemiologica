const FORM_AJAX = document.querySelectorAll(".formAjax");

function sendFormAjax (e){
	e.preventDefault();

	let data = new FormData(this);
	let method = this.getAttribute("method");
	let action = this.getAttribute("action");
	let type = this.getAttribute("data-form");

	let encabezados = new Headers();

	let config = {
		method: method,
		headers: encabezados,
		mode: 'cors',
		cache: 'no-cache',
		body: data
	}

	let textMsjAlert;

	if(type==="save"){
		textMsjAlert="Los datos quedaran guardados en el sistema";
	}else if(type==="delete"){
		textMsjAlert="Los datos serán eliminados completamente del sistema";
	}else if(type==="update"){
		textMsjAlert="Los datos del sistema serán actualizados";
	}else if(type==="search"){
		textMsjAlert="Se eliminará el término de búsqueda y tendrás que escribir uno nuevo";
	}else if(type==="loans"){
		textMsjAlert="Desea remover los datos seleccionados para préstamos o reservaciones";
	}else if(type==="login"){
		textMsjAlert="Desea iniciar sesion?";		
	}else{
		textMsjAlert="Quieres realizar la operación solicitada";
	}


var formData = {};
    $('.form-control').not('input:checkbox').each(function () {
     formData[this.name] = this.value;
    });
     

    $('input:checkbox').each(function () {

        var valueCheckbox = this.checked;

        if (valueCheckbox) {
       
        formData[this.name] = this.value;
        
       }
    });

   // alert(Object.entries(formData));
     
      formData['operationType'] = type;

	Swal.fire({
		title: '¿Estás seguro?',
		text: textMsjAlert,
		type: 'question',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Aceptar',
		cancelButtonText: 'Cancelar'
	}).then((result) => {
		if(result.value){
			$.ajax({
			        url: action,
			       	data: formData,
			        type:method,
			        success: function (response) {

			          if(!response.error) {
			          let operationResult = JSON.parse(response);

			          if (typeof operationResult.Alert != 'undefined') {
			
			 ajaxSweetAlerts(operationResult);

						}

			          }
			        } 
			      });

		}
	});

}




FORM_AJAX.forEach(form => {
	form.addEventListener("submit", sendFormAjax );
 });

function ajaxSweetAlerts(alert){
	if(alert.Alert==="simple"){

		Swal.fire({
			title: alert.Title,
			html: alert.Text,
			type: alert.Type,
			confirmButtonText: 'Aceptar'
		});
	}else if(alert.Alert==="reload"){
		Swal.fire({
			title: alert.Title,
			html: alert.Text,
			type: alert.Type,
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if(result.value){
				location.reload();
			}
		});
	}else if(alert.Alert==="clean"){
		Swal.fire({
			title: alert.Title,
			html: alert.Text,
			type: alert.Type,
			confirmButtonText: 'Aceptar'
		}).then((result) => {


			if(result.value){
			$('.formAjax').trigger("reset");

			$(".form-control").prop('disabled', false);

				//document.querySelector(".formAjax").reset();
			}
		});
	}else if(alert.Alert==="redireccionar"){
		window.location.href=alert.URL;
	}
}

// Control de funcionalidades de formularios

// si el checkbox de la persona ya existe se active, inabilita los campos innecesarios

$('#siExistPerson').change(function() {
    
var fieldStatusValuePerson;

    if (this.checked) {	
    	 fieldStatusValuePerson = true;

    } else {
    	 fieldStatusValuePerson = false;
    }

	$(".form-control-person").prop('disabled', fieldStatusValuePerson);

});

