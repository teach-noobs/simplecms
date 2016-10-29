$(document).ready(function() {
	$('.sorting').sortable();
	
	$('.form_sorting input[name=go]').click(function(e){
	
		var pages = [];
		
		$('.sorting li').each(function(){
			pages.push($(this).attr('id_page'));
		});
		
		$('input[name=pages]').val(pages.toString());
		$('.form_sorting').submit();
	});
});
