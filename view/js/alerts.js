
const FORM_AJAX = document.querySelectorAll(".formAjax");

function captureDataForm (e){
	e.preventDefault();

    var form=$(this);
	let dataForm = new FormData(this);

	let method = this.getAttribute("method");
	let action = this.getAttribute("action");
	let type = this.getAttribute("data-form");
    let responseProcess=form.children('.responseProcessAjax');

	let encabezados = new Headers();

	let config = {
		method: method,
		headers: encabezados,
		mode: 'cors',
		cache: 'no-cache',
		body: dataForm
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
		textMsjAlert=false;		
	}else{
		textMsjAlert="Quieres realizar la operación solicitada";
	}



	var contentFormFields = form.serialize();

     contentFormFields+='&operationType='+type;


// Operaciones que no necesitan confirmacion
if(textMsjAlert==false){
			return sendFormDataAjax(action,contentFormFields,method,responseProcess);
}

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
			return sendFormDataAjax(action,contentFormFields,method,responseProcess);
			}
	});


}



function sendFormDataAjax(action,ValuesAndFields,method,showResponseProcess){
	$.ajax({
		type: method,
		url: action,
		data: ValuesAndFields,
		cache: false,
        processData: false,
        xhr: function(){
        	var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                   if (evt.lengthComputable) {
                     var percentComplete = evt.loaded / evt.total;
                     percentComplete = parseInt(percentComplete * 100);
                       if(percentComplete<100){
                        	showResponseProcess.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                      	}else{
                      		showResponseProcess.html('<p class="text-center"></p>');
                      	}
                      }
                    }, false);
                    return xhr;
                },
		success: function (response) {
		console.log(response);
		  let operationResult = JSON.parse(response);
		  if (typeof operationResult.Alert != 'undefined') {		
			return ajaxSweetAlerts(operationResult);
				}
		},error: function() {

		var alert = {"Alert":"simple","Title":"Ocurrió un error inesperado","Text":"Por favor recargue la página","Type":"error"};

		ajaxSweetAlerts(alert);

		}
	});
}


FORM_AJAX.forEach(form => {
	form.addEventListener("submit", captureDataForm );
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
	}else if(alert.Alert==="redirecting"){
		window.location.href=alert.URL;
	}
}

// Control de funcionalidades de formularios

// si el checkbox de la persona ya existe se active, inabilita los campos innecesarios

$('#siExistPerson').change(function() {

	$(".form-control-person").prop('disabled', this.checked);

});

