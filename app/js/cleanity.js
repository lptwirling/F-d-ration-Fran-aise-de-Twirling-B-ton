$(function(){
	var navSelector = "ul#menu li";/** define the main navigation selector **/

	/** set up rounded corners for the selected elements **/
	$('.box-container').corners("5px bottom");
	$('.box h4').corners("5px top");
	$('ul.tab-menu li a').corners("5px top");
	$('textarea#wysiwyg').wysiwyg();
	$("div#sys-messages-container a, div#to-do-list ul li a").colorbox({fixedWidth:"50%", transitionSpeed:"100", inline:true, href:"#sample-modal"}); /** jquery colorbox modal boxes for system
	messages and to-do list - see colorbox help docs for help: http://colorpowered.com/colorbox/ **/

	$('#to-do').tabs();
	$("#calendar").datepicker();/** jquery ui calendar/date picker - see jquery ui docs for help: http://jqueryui.com/demos/ **/
	$("ul.list-links").accordion();/** side menu accordion - see jquery ui docs for help:  http://jqueryui.com/demos/  **/


	$(navSelector).find('a').css( {backgroundPosition: "0 0"} );

	$(navSelector).hover(
		function(){
			$(this).find('ul:first:hidden').css({visibility: "visible",display: "none"}).show("fast");
			$(this).find('a').stop().animate({backgroundPosition:"(0 -40px)"},{duration:150});
			$(this).find('a.top-level').addClass("blue");
		},
		function(){
			$(this).find('ul:first').css({visibility: "hidden", display:"none"});
			$(this).find('a').stop().animate({backgroundPosition:"(0 0)"}, {duration:75});
			$(this).find('a.top-level').removeClass("blue");
		}
	);

	$('select#Realisateur').css('float','left').after( '<div class="add_field">+</div>' ).parents('p.form').css('clear','both');
	$('select#Genre').css('float','left').after( '<div class="add_field">+</div>' ).parents('p.form').css('clear','both');
	$('select#Langue').css('float','left').after( '<div class="add_field">+</div>' ).parents('p.form').css('clear','both');
	$('select#Acteur').css('float','left').after( '<div class="add_field">+</div>' ).parents('p.form').css('clear','both');

	$('div.item.video').live('mouseover mouseout', function(event) {
		if (event.type == 'mouseover') {
			$(this).find('.price').stop().animate({ opacity: 1, top:-25, right:-25 }, 'fast', 'easeOutBounce');
		}
		else {
			$(this).find('.price').stop().animate({ opacity: 0, top:0, right:0 }, 'fast', 'easeOutBounce');
		}
	});

	$('.add_cart .button').live('mouseover mouseout', function(event) {
		if (event.type == 'mouseover') {
			$(this).prev().stop().animate({ marginRight:20 }, 'fast', 'easeOutBounce');
		}
		else {
			$(this).prev().stop().animate({ marginRight:0 }, 'fast', 'easeOutBounce');
		}
	});

	$('div.item.video .price a').live('mouseover mouseout', function(event) {
		if (event.type == 'mouseover') {
			$(this).parents('.item.video').stop().animate({ boxShadows:'1px 1px 1px #000' }, 'fast', 'easeOutBounce');
			$(this).data( 'price', $(this).text() );
			$(this).text( 'J\achete !' );
		}
		else {
			$(this).text( $(this).data( 'price' ) );
			$(this).parents('.item.video').stop().animate({ boxShadows:'1px 1px 1px #fff' }, 'fast', 'easeOutBounce');
		}
	});

	$('a.button span').live('mouseover mouseout', function(event) {
		if (event.type == 'mouseover') {
			$(this).stop().animate({ paddingRight:30 }, 'fast', 'easeOutBounce');
		}
		else {
			$(this).stop().animate({ paddingRight:15 }, 'fast', 'easeOutBounce');
		}
	});
});