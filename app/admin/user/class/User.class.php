<?php

class User extends _CRUDL
{
	public $CLIENT_ID;
	public $CLIENT_NOM;
	public $CLIENT_PRENOM;
	public $CLIENT_MAIL;
	public $CLIENT_RUE;
	public $CLIENT_RUE2;
	public $CLIENT_CP;
	public $CLIENT_VILLE;
	public $CLIENT_PAYS;
	public $CLIENT_TELEPHONE;
	public $CLIENT_LOGIN;
	public $CLIENT_MDP;
	public $CLIENT_SESSIONCODE;
	public $CLIENT_STATUT;
	public $CLIENT_DATEADDED;
	public $CLIENT_DATEUPDATE;
	public $CLIENT_LASTLOGIN;

	public function __construct( $id = '' )
	{
		$this -> _table = array(
			'val' => 'D_CLIENTS',
			'alias' => 'c',
			'key' => 'CLIENT_ID'
		);

		parent::__construct( $id );
	}

	public function add ( $array = array() )
	{
		$array['CLIENT_DATEADDED'] = _DATE::now();
		$array['CLIENT_DATEUPDATE'] = _DATE::now();

		return parent::add( $array );
	}

	public function save ( $id, $array = array() )
	{
		$array['CLIENT_DATEUPDATE'] = _DATE::now();

		parent::save( $id, $array );
	}
}