<?php

class _USER
{
	static public function needLogin () {
		if ( !_USER::is_login() ) {
			_URL::redirect( _LINK::href( 'user', 'login' ) );
		}
	}

	static public function needAdmin () {
		if ( !_USER::is_admin() ) {
			_URL::redirect( _LINK::href( 'user', 'login' ) );
		}
	}

	static public function is_login () {
		global $_SESSION, $User;

		$return = false;
		if ( $_SESSION['user']['session'] == $User->sessioncode ) {
			$return = $User->id;
		}

		return $return;
	}

	static public function is_admin () {
		$User = new User( _USER::sessioncode2userid() );

		$return = false;
		if ( $User->status == 5 ) {
			$return = true;
		}

		return $return;
	}

	static public function sessioncode2userid ( $sessioncode = '' ) {
		if ( $sessioncode == '' ) {
			global $_SESSION;

			$sessioncode = $_SESSION['user']['session'];
		}

		$appli['select'][] = "user.id";
		$appli['where'][] = "user.sessioncode = '$sessioncode'";

		$User = new User();

		return $User->listes( $appli, 'extract', 'id' );
	}

	static private function userurl2usergroup ( $user_url = '' ) {
		if ( $user_url == '' ) {
			$user_url = _USER::is_login();
		}

		$appli['select'][] = "ug.group_url";
		$appli['where'][] = "u.user_url = '$user_url'";

		return _USER::listes( $appli, 'extract', 'group_url' );
	}

	static public function listes ( $appli = array(), $sortie = '', $field = '' ) {
		$appli['form'][] = "usergroup ug";
		$appli['where'][] = "ug.usergroup_id = u.usergroup_id";

		return parent::listes( $appli, $sortie, $field );
	}

	static public function get_cart ( $commande_id = '' ) {
		global $User, $Commande;

		if ( $commande_id == '' ) {
			$user_id = $User->CLIENT_ID;

			$appli['where'][] = "cm.CLIENT_ID = '$user_id'";
			$appli['where'][] = "cm.COMMANDE_STATUT = '0'";

			$Commande = new Commande();
			$return = $Commande->listes( $appli );
			$return = $return[0];
			$commande_id = $return['COMMANDE_ID'];
		}
		else {
			$user_id = $Commande->CLIENT_ID;

			$appli['where'][] = "cm.CLIENT_ID = '$user_id'";
			$appli['where'][] = "cm.COMMANDE_ID = '$commande_id'";
			$appli['where'][] = "cm.COMMANDE_STATUT = '2'";

			$Commande = new Commande();
			$return = $Commande->listes( $appli );
			$return = $return[0];
		}

		$appli = array();
		$appli['where'][] = "vd.COMMANDE_ID = '".$commande_id."'";

		$Vendu = new Vendu();
		$return['items'] = $Vendu->listes( $appli );

		return $return;
	}
}