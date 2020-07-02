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


     //alert($('input:checkbox').val());


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

			$('input:checkbox').val(null);
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
			text: alert.Text,
			type: alert.Type,
			confirmButtonText: 'Aceptar'
		});
	}else if(alert.Alert==="recargar"){
		Swal.fire({
			title: alert.Title,
			text: alert.Text,
			type: alert.Type,
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if(result.value){
				location.reload();
			}
		});
	}else if(alert.Alert==="limpiar"){
		Swal.fire({
			title: alert.Title,
			text: alert.Text,
			type: alert.Type,
			confirmButtonText: 'Aceptar'
		}).then((result) => {
			if(result.value){
				document.querySelector(".formAjax").reset();
			}
		});
	}else if(alert.Alert==="redireccionar"){
		window.location.href=alert.URL;
	}
}