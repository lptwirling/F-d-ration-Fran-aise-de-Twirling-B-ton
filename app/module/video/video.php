<?php

$video_id = $URL['where']['video_id'];

$Video = new Video( $video_id );

$TPL['breadcrump'][] = _( 'Video' );

switch ( $URL['action'] ) {
	case 'view':
		$TPL['title'] = $Video->titre;
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Voir' );

		break;

	case 'edit':
	case 'add':
		_USER::needAdmin();
		
		// Youtube
		$Youtube = new Youtube();

		if ( $URL['action'] == 'add' ) {
			$TPL['title'] = _( 'Ajouter une video' );
			$TPL['breadcrump'][] = _( 'Ajouter' );
		}
		else {
			$TPL['title'] = _( 'Modifier une video' );
			$TPL['breadcrump'][] = _( 'Modifier' );
		}

		if ( $_POST['action'] == 'add_video' ) {
			$Titre = strip_tags( addslashes( $_POST['Titre'] ) );
			$Description = addslashes( $_POST['Description'] );

			$new_video = array(
				'titre' => $Titre,
				'description' => $Description
			);

			if ( $URL['action'] == 'add' ) {
				$new_video_id = $Video->add( $new_video );
			}
			else {
				$new_video_id = $video_id;
				$Video->save( $new_video_id, $new_video );
			}

			_URL::redirect( _LINK::href( 'video', 'view', array( 'video_id' => $new_video_id ) ) );
		}
		break;

	case 'delete':
		_USER::needAdmin();

		$TPL['title'] = _( 'Supprimer une video' );
		$TPL['breadcrump'][] = _( 'Supprimer' );

		$Video->delete( $video_id );

		if ( $video_id > 0 ) {
			_URL::redirect( _LINK::href( 'video', 'list' ) );
		}
		break;

	case 'list':
		$TPL['title'] = _( 'Listes des videos' );
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Liste' );

		$list = $Video->listes( $APPLI );
		break;
}