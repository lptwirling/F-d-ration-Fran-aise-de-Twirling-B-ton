<?php

echo '<form method="post" action="">';
	echo '<fieldset>';
		echo _FORM::legend( _( 'Identifiant' ) );

		echo _FORM::text( 'Email', $User->email );
		echo _FORM::text( 'Pseudo', $User->login );
		echo _FORM::password( 'Password', '' );
	echo '</fieldset>';

	echo _FORM::hidden( 'action', 'add_user' );

	if ( $URL['action'] == 'add' ) {
		echo _FORM::submit( _( 'S\'inscrire' ) );
	}
	else {
		echo _FORM::submit( _( 'Modifier' ) );
	}
echo '</form>

<style type="text/javascript">
	var Email = new LiveValidation( "Email" );
	Email.add( Validate.Presence );
	Email.add( Validate.Email );

	var Pseudo = new LiveValidation( "Pseudo" );
	Pseudo.add( Validate.Presence );

	var Password = new LiveValidation( "Password" );
	Password.add( Validate.Presence );
	Password.add( Validate.Length, { minimum: 6 } );
</style>';