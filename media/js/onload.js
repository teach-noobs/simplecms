$(document).ready(function() {		var uploader = new FileUploader( {		message_error: 'Ошибка загрузки файла', 		form: 'fileloaded',		formfiles: 'files',		uploadid: '',		uploadscript: '/ajax/uploadDoc',		portion: 1024*1024*2,	});		uploader.onSuccess = function(){		$('#fileloaded').unbind('submit');		$('#fileloaded').submit();	}		$('#myModal').modal({		keyboard: false,		backdrop: 'static',		show: false    })		 $('#btnSubmit').click(function(e){		$('#btnSubmit').hide();		e.preventDefault();		if($('#fileloaded input[name=title]').val() == ''){			alert('Введите название документа');			$('#btnSubmit').show();			return false;		}				$.post('/docs/upload', {name: $('#files').val()}, function(data){			if(data != 1){				alert('Данный файл не может быть загружен на сервер');				$('#btnSubmit').show();			}			else{				$('#myModal').modal('show');				uploader.Upload();			}		});	}); });