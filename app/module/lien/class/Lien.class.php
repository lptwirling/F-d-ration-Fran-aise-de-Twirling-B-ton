<?php

class Lien extends _CRUDL
{
	public $id;
	public $nom;
	public $url;

	public function __construct ( $id = '' )
	{
		$this -> _table = array(
			'val' => 'lien',
			'alias' => 'lien',
			'key' => 'id'
		);

		parent::__construct( $id );
	}
}