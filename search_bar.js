$('#search_bar').focus(function(){
	$(this).css('background-color','rgb(233,234,237)');
	$(this).css('color','rgb(70,120,180)');
	$('#sea').css('background-color','rgb(211,229,254)');
	$('#sea').css('border','1px solid white');
	$('#sea').show();
});
$('#search_bar').focusout(function(){
	$(this).css('background-color','rgb(70,120,180)');
	$(this).css('color','white');
	window.setTimeout(function(){
	 $('#sea').hide()
	}, 145)
});