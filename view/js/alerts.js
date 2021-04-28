
const FORM_AJAX = document.querySelectorAll(".formAjax");

function captureDataForm (e){
	e.preventDefault();

    var form=$(this);

	let dataForm = new FormData(this);

	let method = this.getAttribute("method");
	let action = this.getAttribute("action");
	let type = this.getAttribute("data-form");
    let responseProcess=form.children('.responseProcessAjax');
    let msgBackendProcess=form.children('.msgBackendProcess');

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

// Operaciones que no necesitan confirmacion
if(textMsjAlert==false){

			return sendDataAjax(action,formFields,method,responseProcess,msgBackendProcess);
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
			
			let modal = form.parents('.modal');
			let buttonCancelAjax = modal.find('.buttonCancelAjax');

			  let inputFile =form.find('input:file');
				contentTypes = false;

				  return sendDataAjax(action,dataForm,method,responseProcess,msgBackendProcess,buttonCancelAjax,contentTypes,inputFile);

					}

			if(type==="report"){
			
			let modal = form.parents('.modal');
			let buttonCancelAjax = modal.find('.buttonCancelAjax');

				return sendDataAjax(action,formFields,method,responseProcess,msgBackendProcess,buttonCancelAjax);

					}


				return sendDataAjax(action,formFields,method,responseProcess,msgBackendProcess);

			}
	});


}



function sendDataAjax(action,ValuesAndFields,method,elementForShowProccesAjax='',elementMsgBackendProcess = '', buttonCancelAjax = false, contentTypes = 'application/x-www-form-urlencoded',inputFile = false){

//console.log(action,ValuesAndFields,method,elementForShowProccesAjax,elementMsgBackendProcess, buttonCancelAjax, contentTypes,inputFile,inputFile );

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


//botones del modal ajax para form con input files solo se activaran cuando el parametro inputFile is true para evitar errores

if (buttonCancelAjax) {

		buttonCancelAjax.removeClass('btn-secondary');
		buttonCancelAjax.addClass('btn-danger');
}

                xhr.upload.addEventListener("progress", function(evt) {
                   if (evt.lengthComputable) {
                     var percentComplete = evt.loaded / evt.total;
                     percentComplete = parseInt(percentComplete * 100);
                       if(percentComplete<100){
                        	elementForShowProccesAjax.html('<p class="text-center">Enviando... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                      	}else{
                      		elementForShowProccesAjax.html('<p class="text-center"></p>');
						    //mensaje cuando el bakend este procesando datos de ajax

						 elementMsgBackendProcess.html("</p>Procesando...<p>");

						 // termine el proceso esconde el button de cancelar
						  $(document).ajaxStop(function() {

						 elementMsgBackendProcess.html("");

						  });
						 }
                      }
                    }, false);
                    return xhr;

        },success: function (response) {

        	console.log(response);
        	

		  let operationResult = JSON.parse(response);

		  console.log(operationResult);


		if (typeof operationResult.cleanInput != 'undefined') {	
			$('.formAjax').trigger("reset");
			}

		  if (typeof operationResult.Alert != 'undefined') {		
			ajaxSweetAlerts(operationResult);

			}

		 if (typeof operationResult.idRemoveClass != 'undefined') {	
		 	$(operationResult.idRemoveClass).removeClass(operationResult.valueRemoveClass);
			}			

		 if (typeof operationResult.idAddClass != 'undefined') {
		 	$(operationResult.idAddClass).addClass(operationResult.valueAddClass);
			}


		 if (typeof operationResult.idSetAtribute != 'undefined') {

		var elementAtribute = document.getElementById(operationResult.idSetAtribute);

		elementAtribute.setAttribute(operationResult.typeSetAtribute,
		 operationResult.valueSetAtribute); 
		}


		 if (typeof operationResult.idSetAtributeDownload != 'undefined') {

  setTimeout(function(){ 
		var elementAtributeDownload = document.getElementById(operationResult.idSetAtributeDownload);

		elementAtributeDownload.setAttribute(operationResult.typeSetAtributeDownload,'download'); 
		}, 100)

		}


if (buttonCancelAjax) {

		buttonCancelAjax.removeClass('btn-danger');

		buttonCancelAjax.addClass('btn-secondary');
}

						 elementMsgBackendProcess.html("");

			//return operationResult;
		},error: function (e) {

			console.log('Error:', e);
						 elementMsgBackendProcess.html("");

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
					if(ajax != null && buttonCancelAjax != false){

    			buttonCancelAjax.click(function(){
			            ajax.abort();

						buttonCancelAjax.removeClass('btn-danger');

						buttonCancelAjax.addClass('btn-secondary');

							elementForShowProccesAjax.html('');

			            	elementMsgBackendProcess.html("");
						
						if(inputFile){

			            	inputFile.val('');

			            	}

			        });
			      }                
}



FORM_AJAX.forEach(form => {
	form.addEventListener("submit", captureDataForm );
 });

async function ajaxSweetAlerts(alert){
	if(alert.Alert==="simple"){

		await Swal.fire({
			title: alert.Title,
			html: alert.Text,
			type: alert.Type,
			confirmButtonText: 'Aceptar'
		});


	}else if(alert.Alert==="reload"){
		await Swal.fire({
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
		await Swal.fire({
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

			await Swal.fire({
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
	
		if (typeof alert.reloadDataTable != 'undefined') {	
			$('#dataTable').DataTable().ajax.reload();

			//$('#dataTableReportEpiFilas').DataTable().ajax.reload();
						 
			}

		if (typeof alert.reloadDataTableSpecify != 'undefined') {	
			$('#'+alert.reloadDataTableSpecify).DataTable().ajax.reload();
						 
			}
			
	}

function msjForAlertForm(typeMsj){

 	var textMsjAlert;

	if(typeMsj==="save"){
		textMsjAlert="Los datos quedaran guardados en el sistema";
	}else if(typeMsj==="register"){
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
		textMsjAlert="¿Desea realizar la operación solicitada?";
	}
	return textMsjAlert;
}