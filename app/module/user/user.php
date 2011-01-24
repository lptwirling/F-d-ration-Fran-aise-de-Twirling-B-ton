<?php

$user_id = ( isset( $URL['where']['user_id'] ) ) ? $URL['where']['user_id'] : $user_id;

$User = new User( $user_id );

$TPL['menu'] = true;

switch ( $URL['action'] ) {
	case 'edit':
	case 'add':
		if ( $URL['action'] == 'add' ) {
			$TPL['title'] = _( 'Cr�er votre compte' );
			$TPL['breadcrump'][] = _( 'Ajouter' );
		}
		else {
			_USER::needLogin();

			$TPL['title'] = _( 'Modifier votre compte' );
			$TPL['breadcrump'][] = _( 'Editer' );
		}

		if ( $_POST['action'] == 'add_user' ) {
			$email = strip_tags( addslashes( $_POST['Email'] ) );
			$login = strip_tags( addslashes( $_POST['Pseudo'] ) );
			$pass = strip_tags( addslashes( $_POST['Password'] ) );

			if ( $_POST['action'] = 'add_user' && isset( $email ) && isset( $login ) ) {
				$new_user = array(
					'login' => $login,
					'pass' =>  _::crypt( $pass ),
					'sessioncode' => _::crypt( "<$login><$pass>" ),
					'email' => $email
				);

				if ( $URL['action'] == 'add' ) {
					$new_user_id = $User->add( $new_user );
				}
				else {
					$new_user_id = $user_id;

					if ( empty( $pass ) || $pass == '' ) {
						unset( $new_user['pass'] );
						unset( $new_user['sessioncode'] );
						unset( $new_user['login'] );
					}

					$User->save( $new_user_id, $new_user );
				}

				if ( $new_user_id > 0 ) {
					_URL::redirect( _LINK::href() );
				}
			}
		}
		break;

	case 'login':
		$TPL['title'] = _( 'Connection obligatoire' );

		if ( isset( $_POST['login'] ) && isset( $_POST['mdp'] ) ) {
			$session_code = _::crypt( '<'.$_POST['login'].'><'.$_POST['mdp'].'>' );

			$where[] = "user.login = '".$_POST['login']."'";
			$where[] = "user.pass = '"._::crypt( $_POST['mdp'] )."'";
			$where[] = "user.sessioncode = '$session_code'";

			$user_verif_exist = $User->verif_exist( $where );

			if ( $user_verif_exist > 0 ) {
				$_SESSION['user']['session'] = $session_code;

				_URL::redirect( _LINK::href() );
			}
		}
		break;

	case 'logout':
		session_destroy();

		_URL::redirect( _LINK::href() );
		break;

	case 'delete':
		_USER::needAdmin();

		$TPL['title'] = _( 'Supprimer une excuse' );
		$TPL['breadcrump'][] = _( 'Supprimer' );

		$User->delete( $user_id );

		if ( $user_id > 0 ) {
			_URL::redirect( _LINK::href( 'user', 'list' ) );
		}
		break;

	case 'list':
		_USER::needAdmin();

		$TPL['title'] = _( '' );
		$TPL['description'] = '';
		$TPL['breadcrump'][] = _( 'Liste' );

		$list = $User->listes();
		break;
}