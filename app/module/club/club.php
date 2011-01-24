<?php

$club_id = $URL['where']['club_id'];

$Club = new Club( $club_id );

$TPL['breadcrump'][] = _( 'Club' );

switch ( $URL['action'] ) {
	case 'view':
		$TPL['title'] = $Club->nom;
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Voir' );

		break;

	case 'edit':
	case 'add':
		_USER::needAdmin();

		if ( $URL['action'] == 'add' ) {
			$TPL['title'] = _( 'Ajouter un club' );
			$TPL['breadcrump'][] = _( 'Ajouter' );
		}
		else {
			$TPL['title'] = _( 'Modifier un club' );
			$TPL['breadcrump'][] = _( 'Modifier' );
		}

		if ( $_POST['action'] == 'add_club' ) {		
			$Nom = strip_tags( addslashes( $_POST['Nom'] ) );
			$Rue = strip_tags( addslashes( $_POST['Rue'] ) );
			$Ruebis = strip_tags( addslashes( $_POST['Ruebis'] ) );
			$Codepostal = strip_tags( addslashes( $_POST['Codepostal'] ) );
			$Ville = strip_tags( addslashes( $_POST['Ville'] ) );
			$Telephone = strip_tags( addslashes( $_POST['Telephone'] ) );
			$Contact = strip_tags( addslashes( $_POST['Contact'] ) );
			$Email = strip_tags( addslashes( $_POST['Email'] ) );

			$new_club = array(
				'nom' => $Nom,
				'rue' => $Rue,
				'ruebis' => $Ruebis,
				'codepostal' => $Codepostal,
				'ville' => $Ville,
				'telephone' => $Telephone,
				'contact' => $Contact,
				'email' => $Email
			);

			if ( $URL['action'] == 'add' ) {
				$new_club_id = $Club->add( $new_club );
			}
			else {
				$new_club_id = $club_id;
				$Club->save( $new_club_id, $new_club );
			}

			_URL::redirect( _LINK::href( 'club', 'view', array( 'club_id' => $new_club_id ) ) );
		}
		break;

	case 'delete':
		_USER::needAdmin();

		$TPL['title'] = _( 'Supprimer un club' );
		$TPL['breadcrump'][] = _( 'Supprimer' );

		$Club->delete( $club_id );

		if ( $club_id > 0 ) {
			_URL::redirect( _LINK::href( 'club', 'list' ) );
		}
		break;

	case 'list':
		$TPL['title'] = _( 'Listes des clubs' );
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Liste' );

		$list = $Club->listes( $APPLI );
		break;
}