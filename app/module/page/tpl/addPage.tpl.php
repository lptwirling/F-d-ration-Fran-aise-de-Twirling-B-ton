<?php

echo '<form method="post" enctype="multipart/form-data">';
	echo '<fieldset>';
		echo _FORM::legend( _( 'Information sur la page' ) );

		echo _FORM::text( 'Titre', $Page->titre );
		echo _FORM::textarea( 'Contenu', $Page->contenu );
	echo '</fieldset>';

	echo _FORM::hidden( 'action', 'add_page' );

	if ( $URL['action'] == 'add' ) {
		echo _FORM::submit( _( 'Ajouter la page' ) );
	}
	else {
		echo _FORM::submit( _( 'Modifier la page' ) );
	}
echo '</form>';