<?php

echo '<form method="post" enctype="multipart/form-data">';
	echo '<fieldset>';
		echo _FORM::legend( _( 'Information sur le lien' ) );

		echo _FORM::text( 'Nom', $Lien->nom );
		echo _FORM::text( 'Url', $Lien->url );
	echo '</fieldset>';

	echo _FORM::hidden( 'action', 'add_lien' );

	if ( $URL['action'] == 'add' ) {
		echo _FORM::submit( _( 'Ajouter le lien' ) );
	}
	else {
		echo _FORM::submit( _( 'Modifier le lien' ) );
	}
echo '</form>';