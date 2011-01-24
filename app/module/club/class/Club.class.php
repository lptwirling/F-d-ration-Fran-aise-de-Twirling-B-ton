<?php

class Club extends _CRUDL
{
	public $id;
	public $nom;
	public $rue;
	public $ruebis;
	public $codepostal;
	public $ville;
	public $telephone;
	public $email;
	public $contact;

	public function __construct ( $id = '' )
	{
		$this -> _table = array(
			'val' => 'club',
			'alias' => 'club',
			'key' => 'id'
		);

		parent::__construct( $id );
	}
}