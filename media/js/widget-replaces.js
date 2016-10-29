function getReplaceObject(elem, act){
	var type = elem.attr('replace');
	
	switch(type){
		case 'input':
			return new replaceInput(elem, act);
		case 'textarea':
			return new replaceTextarea(elem, act);
		case 'ck':
			return new replaceCK(elem, act);
		case 'modal':
			return new replaceModal(elem, act);
		default: 
			return new replaceInput(elem, act);
	}
}

function replaceInput(elem, act){
	this.elem = elem;
	this.act = act;
	this.replace = '';
	
	this.getVal = function(){
		return this.replace.val();
	}
	
	this.setVal = function(){
		this.replace.val(this.elem.html());
	}
	
	this.object = function(){
		this.replace = $('<input type="text" >');
		this.setVal();
		return this.replace;
	}
	
	this.init = function(){
		// специальные действия для иниализации. В простом инпуте неактуальны

		this.replace.click(function(e){
			e.preventDefault();
		});
	}
	
	this.destroy = function(){
		this.replace.remove();
	}
}

function replaceTextarea(elem, act){
	replaceInput.call(this, elem, act); // наследуемся
	
	this.getVal = function(){
		console.log(this.replace.val().replace('\r\n', '<br>').replace('\n', '<br>'));
		return this.replace.val().replace('\r\n', '<br>').replace('\n', '<br>');
	}
	
	this.setVal = function(){
		var html = this.elem.html();
		html = html.replace('<br>', '\n').replace('<br/>', '\n').replace('<br >', '\n').replace('<br />', '\n');
		this.replace.val(html);
	}
	
	this.object = function(){
		this.replace = $('<textarea></textarea>');
		this.setVal();
		return this.replace;
	}
}

function replaceCK(elem, act){
	replaceInput.call(this, elem, act); // наследуемся
	
	this.getVal = function(){
		return CKEDITOR.instances[this.replace.attr('id')].getData();
	}
	
	this.setVal = function(){
		var ck = this;
		
		$.ajax({
			url: 'frontedit/get' + this.act, 
			type: 'POST', 
			data: {id: elem.record_id}, 
			dataType: 'json',
			async: false,
			success: function(data){
				if(data !== null)
					ck.replace.val(data[elem.attr('change_key')]);
				else
					ck.replace.val('Some errors on server! Do not save it!');
			},
			error: function(){
				ck.replace.val('Some errors on server! Do not save it!');
			}
		});
	}
	
	this.object = function(){
		this.replace = $('<textarea id="replace"></textarea>');
		this.setVal();
		return this.replace;
	}
	
	this.init = function(){
		CKEDITOR.replace(this.replace.attr('id'), {
				filebrowserUploadUrl : '/ajax/ckupload'
			});
			
		CKEDITOR.config.extraPlugins = 'gallery,documents';	
	}
	
	this.destroy = function(){
		this.replace.remove();
		$('#cke_replace').remove();
		location.reload();
	}
}