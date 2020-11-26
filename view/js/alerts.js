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


	var textMsjAlert =  msjForAlertForm(type);
	
	var formFields = form.serialize();

     formFields+='&operationType='+type;

     console.log(formFields);

// Operaciones que no necesitan confirmacion
if(textMsjAlert==false){

			return sendFormDataAjax(action,formFields,method,responseProcess);
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

			if(type==="files"){

			// parametos especiales para envio de archivos
			    var file = $('.files')[0].files[0];

			    dataForm.append('file',file);
				contentTypes = false;
				  return sendFormDataAjax(action,dataForm,method,responseProcess,contentTypes,true);

					}else{

						return sendFormDataAjax(action,formFields,method,responseProcess);

					}

			}
	});


}



function sendFormDataAjax(action,ValuesAndFields,method,showResponseProcess='',contentTypes = 'application/x-www-form-urlencoded',ifFile = false){

var msgBackendProcessAjaxData = $("#msgBackendProcessAjaxData");
var ajax = null;

 ajax = $.ajax({
		url : action,
		type: method,
 		data: ValuesAndFields,
        processData: false,
	  	contentType:contentTypes,
 		enctype: 'multipart/form-data',
 		cache: true,
		xhr: function(){
        	var xhr = new window.XMLHttpRequest();


//botones del modal ajax para form con input files solo se activaran cuando el parametro ifFile is true para evitar errores

if (ifFile) {
             
		var buttonCancelAjax = document.getElementsByClassName("buttonCancelAjax")[0];

		buttonCancelAjax.classList.remove('btn-secondary');
		buttonCancelAjax.classList.add('btn-danger');
}

                xhr.upload.addEventListener("progress", function(evt) {
                   if (evt.lengthComputable) {
                     var percentComplete = evt.loaded / evt.total;
                     percentComplete = parseInt(percentComplete * 100);
                       if(percentComplete<100){
                        	showResponseProcess.html('<p class="text-center">Enviando... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                      	}else{
                      		showResponseProcess.html('<p class="text-center"></p>');
						    //mensaje cuando el bakend este procesando datos de ajax

						 msgBackendProcessAjaxData.html("</p>Procesando...<p>");

						 // termine el proceso esconde el button de cancelar
						  $(document).ajaxStop(function() {

						 msgBackendProcessAjaxData.html("");

							$("#btnInsertCancelAjax").html("");

						   // msgBackendProcessAjaxData.hide();
						  });
						                      	}
                      }
                    }, false);
                    return xhr;

        },success: function (response) {

if (ifFile) {

		var buttonCancelAjax = document.getElementsByClassName("buttonCancelAjax")[0];

		buttonCancelAjax.classList.remove('btn-danger');

		buttonCancelAjax.classList.add('btn-secondary');
}
        	console.log(response);
        	
		  let operationResult = JSON.parse(response);
		 
		  if (typeof operationResult.Alert != 'undefined') {		
			ajaxSweetAlerts(operationResult);
			}

		 if (typeof operationResult.reloadDataTable != 'undefined') {					
			$('#dataTable').DataTable().ajax.reload( null, false );
			}


			//return operationResult;
		},error: function (e) {
			// cuando no se hizo un ajax.abort
					if(ajax == null){

  					alert("Error: " + e);

  				}

		//var alert = {"Alert":"simple","Title":"Ocurrió un error inesperado","Text":"Por favor recargue la página","Type":"error"};

		//return ajaxSweetAlerts(alert);

		}
	}); 

	                	// para cancelar el ajax su un modal con formulario
                	// al cerrar tambien lo hara la operacion ajax
					if(ajax != null){

			         	modalAjax=$(".modalAjax");

			          $(modalAjax).on('hide.bs.modal', function(){
			            ajax.abort();

		var buttonCancelAjax = document.getElementsByClassName("buttonCancelAjax")[0];

						buttonCancelAjax.classList.remove('btn-danger');

						buttonCancelAjax.classList.add('btn-secondary');

							showResponseProcess.html('');

			            	msgBackendProcessAjaxData.html("");

							$(':file').val('');


			        });
			      }                
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
	}else if(alert.Alert==="simpleReload"){
			location.reload();	
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
	}else if(alert.Alert==="confirmation"){

			Swal.fire({
				title: '¿Estás seguro?',
				html: alert.Text,
				type: 'question',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Aceptar',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if(result.value){
					$.ajax({
					  url : alert.Url,
					  type: alert.Method,
					  data : alert.Data,
		       		 success:function(response) {
		       		 	console.log(response);
				  let operationResult = JSON.parse(response);
					return ajaxSweetAlerts(operationResult);
					
					}
				})
			}
		});

	}else if(alert.Alert==="redirecting"){
			window.location.href=alert.URL;
		}
	}

function msjForAlertForm(typeMsj){

 	var textMsjAlert;

	if(typeMsj==="save"){
		textMsjAlert="Los datos quedaran guardados en el sistema";
	}else if(typeMsj==="delete"){
		textMsjAlert="Los datos serán eliminados completamente del sistema";
	}else if(typeMsj==="update"){
		textMsjAlert="Los datos del sistema serán actualizados";
	}else if(typeMsj==="search"){
		textMsjAlert="Se eliminará el término de búsqueda y tendrás que escribir uno nuevo";
	}else if(typeMsj==="config"){
		textMsjAlert="Las configuraciones se guardaran en el sistema";		
	}else if(typeMsj==="login"){
		textMsjAlert=false;		
	}else if(typeMsj==="query"){
		textMsjAlert=false;
	}else if(typeMsj==="files"){
	textMsjAlert="Los datos de cargaran en el sistema";	
	}else{
		textMsjAlert="Quieres realizar la operación solicitada";
	}
	return textMsjAlert;
}
