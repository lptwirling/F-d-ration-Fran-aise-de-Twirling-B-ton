<?php

$actu_id = $URL['where']['actu_id'];

$Actu = new Actu( $actu_id );

$TPL['breadcrump'][] = _( 'Actu' );

switch ( $URL['action'] ) {
	case 'view':
		$TPL['title'] = $Actu->titre;
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Voir' );

		break;

	case 'edit':
	case 'add':
		_USER::needAdmin();

		if ( $URL['action'] == 'add' ) {
			$TPL['title'] = _( 'Ajouter une actu' );
			$TPL['breadcrump'][] = _( 'Ajouter' );
		}
		else {
			$TPL['title'] = _( 'Modifier une actu' );
			$TPL['breadcrump'][] = _( 'Modifier' );
		}

		if ( $_POST['action'] == 'add_actu' ) {
			$Titre = strip_tags( addslashes( $_POST['Titre'] ) );
			$Contenu = addslashes( $_POST['Contenu'] );

			$new_actu = array(
				'titre' => $Titre,
				'contenu' => $Contenu
			);

			if ( $URL['action'] == 'add' ) {
				$new_actu_id = $Actu->add( $new_actu );
			}
			else {
				$new_actu_id = $actu_id;
				$Actu->save( $new_actu_id, $new_actu );
			}

			_URL::redirect( _LINK::href( 'actu', 'view', array( 'actu_id' => $new_actu_id ) ) );
		}
		break;

	case 'delete':
		_USER::needAdmin();

		$TPL['title'] = _( 'Supprimer une actu' );
		$TPL['breadcrump'][] = _( 'Supprimer' );

		$Actu->delete( $actu_id );

		if ( $actu_id > 0 ) {
			_URL::redirect( _LINK::href( 'actu', 'list' ) );
		}
		break;

	case 'list':
		$TPL['title'] = _( 'Listes des actus' );
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Liste' );

		$list = $Actu->listes( $APPLI );
		break;
}