<?php

echo '<form method="post" enctype="multipart/form-data">';
	echo '<fieldset>';
		echo _FORM::legend( _( 'Information sur la photo' ) );

		echo _FORM::text( 'Titre', $Photo->titre );
		echo _FORM::textarea( 'Description', $Photo->description );
		echo _FORM::upload( 'Image' );
	echo '</fieldset>';

	echo _FORM::hidden( 'action', 'add_photo' );

	if ( $URL['action'] == 'add' ) {
		echo _FORM::submit( _( 'Ajouter la photo' ) );
	}
	else {
		echo _FORM::submit( _( 'Modifier la photo' ) );
	}
echo '</form>';