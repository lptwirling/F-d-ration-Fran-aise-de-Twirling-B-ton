<?php

echo '<form method="post" enctype="multipart/form-data">';
	echo '<fieldset>';
		echo _FORM::legend( _( 'Information sur la actu' ) );

		echo _FORM::text( 'Titre', $Actu->titre );
		echo _FORM::textarea( 'Contenu', $Actu->contenu );
	echo '</fieldset>';

	echo _FORM::hidden( 'action', 'add_actu' );

	if ( $URL['action'] == 'add' ) {
		echo _FORM::submit( _( 'Ajouter la actu' ) );
	}
	else {
		echo _FORM::submit( _( 'Modifier la actu' ) );
	}
echo '</form>';