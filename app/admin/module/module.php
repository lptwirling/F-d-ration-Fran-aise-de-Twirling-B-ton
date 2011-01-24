<?php

$module_name = ( $URL['where']['module_name'] ) ? $URL['where']['module_name'] : '' ;

$Module = new Module();

switch ( $URL['action'] ) {
	case 'add':
		$TPL['title'] = _( 'Ajouter un module' );

		if ( _FORM::verify( $_POST ) ) {
			$nbField = count( $_POST['Champ'] );

			if ( !empty( $_POST['Champ'][0] ) ) {
				$sql = 'CREATE TABLE `'.$_POST['Nom'].'` (';
					for ( $i = 0; $i < $nbField; $i++ ) {
						$champ = $_POST['Champ'][$i];
						$type = $_POST['Type'][$i];
						$taille = $_POST['Taille'][$i];
						$primaire = $_POST['Primaire'][$i];

						$auto_inc = '';
						if ( $primaire == 'on' ) {
							$auto_inc = 'auto_increment';
							$primary = 'PRIMARY KEY  (`'.$champ.'`)';
							$primary_key = $champ;
						}

						$type_size = '';
						if ( $taille ) {
							$type_size = '('.$taille.')';
						}

						$sql .= '`'.$champ.'` '.$type.$type_size.' NOT NULL '.$auto_inc.',';
					}

					$sql .= $primary;
				$sql .= ') ENGINE=InnoDB;';

				$Module->create_table( $sql );
			}

			$Module->add( $_POST['Nom'], $_POST['Alias'], $primary_key );
		}
		break;
} // switch