$(document).ready( function() {
	$('.add_field').live( 'click', function(){
		var $this = $(this);
		var $parent = $this.parents('div.inline');

		if ( $parent.length == 0 ) {
			$parent = $this.parents('p.form');
		}

		var $new_field = $parent.clone().hide();

		$this.fadeOut('slow').remove();
		$new_field.find('.form:eq(3)').remove();

		$parent.after( $new_field );
		$new_field.slideDown('slow');
	});

	$('div.load').each(function(){
		if ( $(this).is(':empty') ) {
			var $thisSrc = $(this).attr('src');
			$(this).load( $thisSrc );
		}
	});

	$('.datepicker').datepicker( { dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true } );
});