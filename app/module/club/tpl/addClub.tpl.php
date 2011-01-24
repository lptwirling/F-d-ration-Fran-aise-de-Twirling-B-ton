<?php

echo '<form method="post" enctype="multipart/form-data">';
	echo '<fieldset>';
		echo _FORM::legend( _( 'Information sur le club' ) );

		echo _FORM::text( 'Nom', $Club->nom );
		echo _FORM::text( 'Rue', $Club->rue );
		echo _FORM::text( 'Ruebis', $Club->ruebis );
		echo _FORM::text( 'Codepostal', $Club->codepostal );
		echo _FORM::text( 'Ville', $Club->ville );
		echo _FORM::text( 'Telephone', $Club->telephone );
		echo _FORM::text( 'Contact', $Club->contact );
		echo _FORM::text( 'Email', $Club->email );
	echo '</fieldset>';

	echo _FORM::hidden( 'action', 'add_club' );

	if ( $URL['action'] == 'add' ) {
		echo _FORM::submit( _( 'Ajouter le club' ) );
	}
	else {
		echo _FORM::submit( _( 'Modifier le club' ) );
	}
echo '</form>';