<?php

class Video extends _CRUDL
{
	public $id;
	public $titre;
	public $description;
	public $date;

	public function __construct ( $id = '' )
	{
		$this -> _table = array(
			'val' => 'video',
			'alias' => 'video',
			'key' => 'id'
		);

		parent::__construct( $id );
	}

	public function add ( $array = array() )
	{
		$array['date'] = _DATE::now();

		return parent::add( $array );
	}

	public function save ( $id, $array = array() )
	{
		$array['date'] = _DATE::now();

		parent::save( $id, $array );
	}
}