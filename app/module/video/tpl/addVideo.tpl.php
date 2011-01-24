<?php

echo '<form method="post" enctype="multipart/form-data">';
	echo '<fieldset>';
		echo _FORM::legend( _( 'Information sur la video' ) );

		echo _FORM::text( 'Titre', $Video->titre );
		echo _FORM::textarea( 'Description', $Video->Description );
	echo '</fieldset>';
	echo '<fieldset>';
		if ( count( $Youtube->videos ) ) {
			foreach ( $Youtube->videos as $i => $video ) {
				echo '<img src="'.$video['image'].'" /> ';
	
			}
		}
	echo '</fieldset>';

	echo _FORM::hidden( 'action', 'add_video' );

	if ( $URL['action'] == 'add' ) {
		echo _FORM::submit( _( 'Ajouter la video' ) );
	}
	else {
		echo _FORM::submit( _( 'Modifier la video' ) );
	}
echo '</form>';