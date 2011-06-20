$(function(){
	
	// main menu

	$('#global-menubar > ul > li').mouseenter(function(){
		$(this).children('.submenu').stop(true, true).fadeIn('fast');
		$(this).addClass('on');
	}).mouseleave(function(){
		$(this).children('.submenu').stop(true, true).fadeOut('fast');
		$(this).removeClass('on');
	});
	
	if ( $('#global-menubar > ul > li.selected').length == 0 ) {
		$('#global-menubar > ul > li:first').addClass('selected');
	}
	
	Cufon.replace('h1'); 
	Cufon.replace('h2'); 
	Cufon.replace('#social-media h3'); 
	Cufon.replace('#featured_product'); 
	
});