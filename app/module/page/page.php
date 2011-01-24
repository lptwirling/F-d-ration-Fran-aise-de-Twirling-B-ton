<?php

$page_id = $URL['where']['page_id'];

$Page = new Page( $page_id );

$TPL['breadcrump'][] = _( 'Page' );

switch ( $URL['action'] ) {
	case 'view':
		$TPL['title'] = $Page->titre;
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Voir' );

		break;

	case 'edit':
	case 'add':
		_USER::needAdmin();

		if ( $URL['action'] == 'add' ) {
			$TPL['title'] = _( 'Ajouter une page' );
			$TPL['breadcrump'][] = _( 'Ajouter' );
		}
		else {
			$TPL['title'] = _( 'Modifier une page' );
			$TPL['breadcrump'][] = _( 'Modifier' );
		}

		if ( $_POST['action'] == 'add_page' ) {
			$Titre = strip_tags( addslashes( $_POST['Titre'] ) );
			$Contenu = addslashes( $_POST['Contenu'] );

			$new_page = array(
				'titre' => $Titre,
				'contenu' => $Contenu
			);

			if ( $URL['action'] == 'add' ) {
				$new_page_id = $Page->add( $new_page );
			}
			else {
				$new_page_id = $page_id;
				$Page->save( $new_page_id, $new_page );
			}

			_URL::redirect( _LINK::href( 'page', 'view', array( 'page_id' => $new_page_id ) ) );
		}
		break;

	case 'delete':
		_USER::needAdmin();

		$TPL['title'] = _( 'Supprimer une page' );
		$TPL['breadcrump'][] = _( 'Supprimer' );

		$Page->delete( $page_id );

		if ( $page_id > 0 ) {
			_URL::redirect( _LINK::href( 'page', 'list' ) );
		}
		break;

	case 'list':
		$TPL['title'] = _( 'Listes des pages' );
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Liste' );

		$list = $Page->listes( $APPLI );
		break;
}