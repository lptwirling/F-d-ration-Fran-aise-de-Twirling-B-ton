<?php

$photo_id = $URL['where']['photo_id'];

$Photo = new Photo( $photo_id );

$TPL['breadcrump'][] = _( 'Photo' );

switch ( $URL['action'] ) {
	case 'view':
		$TPL['title'] = $Photo->titre;
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Voir' );

		break;

	case 'edit':
	case 'add':
		_USER::needAdmin();

		if ( $URL['action'] == 'add' ) {
			$TPL['title'] = _( 'Ajouter une photo' );
			$TPL['breadcrump'][] = _( 'Ajouter' );
		}
		else {
			$TPL['title'] = _( 'Modifier une photo' );
			$TPL['breadcrump'][] = _( 'Modifier' );
		}

		if ( $_POST['action'] == 'add_photo' ) {
			$Titre = strip_tags( addslashes( $_POST['Titre'] ) );
			$Description = addslashes( $_POST['Description'] );
			
			if ( isset( $_FILES['Image'] ) ) {
				// upload de l'image
				$titre_photo = ( !empty( $Titre ) ) ? $Titre.'.jpg' : $_FILES['Image']['name'];
				$Image = _::clean( $titre_photo );
				
				move_uploaded_file( $_FILES['Image']['tmp_name'], DIR_MODULE.$URL['module'].'/upload/'.$Image );
			}

			$new_photo = array(
				'titre' => str_replace( array( '.jpg', '.png', '.gif' ), '', $titre_photo ),
				'description' => $Description,
				'image' => $Image
			);

			if ( $URL['action'] == 'add' ) {
				$new_photo_id = $Photo->add( $new_photo );
			}
			else {
				if ( isset( $_FILES['Image'] ) ) {
					unset( $new_video['image'] );
				}

				$new_photo_id = $photo_id;
				$Photo->save( $new_photo_id, $new_photo );
			}

			_URL::redirect( _LINK::href( 'photo', 'view', array( 'photo_id' => $new_photo_id ) ) );
		}
		break;

	case 'delete':
		_USER::needAdmin();

		$TPL['title'] = _( 'Supprimer une photo' );
		$TPL['breadcrump'][] = _( 'Supprimer' );

		$Photo->delete( $photo_id );

		if ( $photo_id > 0 ) {
			_URL::redirect( _LINK::href( 'photo', 'list' ) );
		}
		break;

	case 'list':
		$TPL['title'] = _( 'Listes des photos' );
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Liste' );

		$list = $Photo->listes( $APPLI );
		break;
}