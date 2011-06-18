$(function(){
	
	// main menu
	$('#topmenu-firstlevel li:hover .submenu').css({display: 'none'})
	$('#topmenu-firstlevel li').mouseenter(function(){
		$(this).children('.submenu').stop(true, true).fadeIn('fast');
		$(this).addClass('on');
	}).mouseleave(function(){
		$(this).children('.submenu').stop(true, true).fadeOut('fast');
		$(this).removeClass('on');
	});
	$('#topmenu-firstlevel .submenu').css({
		opacity: '0.9'
	});
	
	Cufon.replace('h1'); 
	Cufon.replace('h2'); 
	Cufon.replace('#social-media h3'); 
	Cufon.replace('#featured_product'); 
	
});