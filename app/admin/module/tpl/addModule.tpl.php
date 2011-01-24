<?php
echo '<form method="post" action="">';
	echo '<fieldset>';
		echo _FORM::legend( _( 'Informations sur le nouveau module' ) );

		echo _FORM::text( 'Nom', $module_name );
		echo _FORM::text( 'Alias' );
	echo '</fieldset>

	<fieldset>';
		echo _FORM::legend( _( 'Ajouter les champs' ) );

		echo '<div class="inline">';
			echo _FORM::text( 'Champ[]' );
			echo _FORM::select( 'Type[]', '<option value="varchar">varchar</option><option value="text">text</option><option value="date">date</option><option value="datetime">datetime</option><option value="int">int</option><option value="tinyint">tinyint</option><option value="decimal">decimal</option>' );
			echo _FORM::numeric( 'Taille[]' );
			echo _FORM::checkbox( 'Primaire[]' );
			echo '<span class="add_field">+</span>';
			echo '<div class="clear"></div>';
		echo '</div>';
	echo '</fieldset>';

	echo _FORM::hidden( 'action', 'add_module' );

	echo _FORM::submit( _( 'Ajouter le module' ) );
echo '</form>';