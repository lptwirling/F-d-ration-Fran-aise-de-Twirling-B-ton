<?php

class User extends _CRUDL
{
	public $id;
	public $login;
	public $pass;
	public $sessioncode;
	public $email;
	public $status;

	public function __construct( $id = '' )
	{
		$this -> _table = array(
			'val' => 'user',
			'alias' => 'user',
			'key' => 'id'
		);

		parent::__construct( $id );
	}
}