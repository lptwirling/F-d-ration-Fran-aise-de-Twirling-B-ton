<?php

$lien_id = $URL['where']['lien_id'];

$Lien = new Lien( $lien_id );

$TPL['breadcrump'][] = _( 'Lien' );

switch ( $URL['action'] ) {
	case 'view':
		$TPL['title'] = $Lien->nom;
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Voir' );

		break;

	case 'edit':
	case 'add':
		_USER::needAdmin();

		if ( $URL['action'] == 'add' ) {
			$TPL['title'] = _( 'Ajouter un lien' );
			$TPL['breadcrump'][] = _( 'Ajouter' );
		}
		else {
			$TPL['title'] = _( 'Modifier un lien' );
			$TPL['breadcrump'][] = _( 'Modifier' );
		}

		if ( $_POST['action'] == 'add_lien' ) {
			$Nom = strip_tags( addslashes( $_POST['Nom'] ) );
			$Url = addslashes( $_POST['Url'] );

			$new_lien = array(
				'nom' => $Nom,
				'url' => $Url
			);

			if ( $URL['action'] == 'add' ) {
				$new_lien_id = $Lien->add( $new_lien );
			}
			else {
				$new_lien_id = $lien_id;
				$Lien->save( $new_lien_id, $new_lien );
			}

			_URL::redirect( _LINK::href( 'lien', 'view', array( 'lien_id' => $new_lien_id ) ) );
		}
		break;

	case 'delete':
		_USER::needAdmin();

		$TPL['title'] = _( 'Supprimer un lien' );
		$TPL['breadcrump'][] = _( 'Supprimer' );

		$Lien->delete( $lien_id );

		if ( $lien_id > 0 ) {
			_URL::redirect( _LINK::href( 'lien', 'list' ) );
		}
		break;

	case 'list':
		$TPL['title'] = _( 'Listes des liens' );
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Liste' );

		$list = $Lien->listes( $APPLI );
		break;
}