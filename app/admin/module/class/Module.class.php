<?php

class Module
{
	private $fichiers_type;
	private $module;
	private $class;
	private $formulaire;
	private $tpl;

	public function add ( $module, $alias, $primary_key ) {
		$name[0] = strtolower( $module );
		$name[1] = ucfirst( $module );

		// déclaration des répertoires
		$this->fichiers_type = DIR_MODULE.'module/fichiers_type/';
		$this->module = DIR_APP.'module/'.$name[0].'/';
		$this->class = $this->module.'class/';
		$this->formulaire = $this->module.'formulaire/';
		$this->tpl = $this->module.'tpl/';

		$this->create_file( 'controler', $this->module.$name[0].'.php', array( 'name_lo' => $name[0], 'name_up' => $name[1] ) );
		$this->create_file( 'class', $this->class.$name[1].'.class.php', array( 'name_lo' => $name[0], 'name_up' => $name[1], 'alias' => $alias, 'var_public' => $this->get_varPublic( $name[0] ), 'primary_key' => $primary_key ) );

		$this->create_file( 'add_tpl', $this->tpl.'add'.$name[1].'.tpl.php', array( 'name_lo' => $name[0], 'name_up' => $name[1] ) );
		$this->create_file( 'view_tpl', $this->tpl.'view'.$name[1].'.tpl.php', array( 'name_lo' => $name[0], 'name_up' => $name[1] ) );
		$this->create_file( 'edit_tpl', $this->tpl.'edit'.$name[1].'.tpl.php', array( 'name_lo' => $name[0], 'name_up' => $name[1] ) );
		$this->create_file( 'delete_tpl', $this->tpl.'delete'.$name[1].'.tpl.php', array( 'name_lo' => $name[0], 'name_up' => $name[1] ) );
		$this->create_file( 'list_tpl', $this->tpl.'list'.$name[1].'.tpl.php', array( 'name_lo' => $name[0], 'name_up' => $name[1], 'thead' => $this->get_thead( $name[0] ), 'tbody' => $this->get_tbody( $name[0] ) ) );
	}

	private function create_file ( $type, $file, $vars ) {
		$fichiers_type = _FILE::view( $this->fichiers_type.$type.'.txt' );

		if ( count( $vars ) > 0 ) {
			foreach ( $vars as $var_key => $var_val ) {
				$fichiers_type = str_replace( '{'.$var_key.'}', $var_val, $fichiers_type );
			}
		}

		_FILE::add( $file, $fichiers_type );
	}

	private function get_varPublic ( $table ) {
		$list = _SQL::fields( $table );

		if ( count( $list ) > 0 ) {
			$return = '';

			foreach ( $list as $item ) {
				$return .= "\t".'public $'.$item.';'."\n";
			}

			trim( $return, "\n" );
		}

		return $return;
	}

	private function get_thead ( $table ) {
		$list = _SQL::fields( $table );

		if ( count( $list ) > 0 ) {
			$return = '';

			foreach ( $list as $item ) {
				$return .= "\t\t\t\techo '<th>'._( '".$item."' ).'</th>';\n";
			}

			trim( $return, "\n" );
		}

		return $return;
	}

	private function get_tbody ( $table ) {
		$list = _SQL::fields( $table );

		if ( count( $list ) > 0 ) {
			$return = '';

			foreach ( $list as $item ) {
				$return .= "\t\t\t\t\techo '<td>'.\$item['".$item."'].'</td>';\n";
			}
		}

		return $return;
	}

	public function create_table ( $sql ) {
		_SQL::query( $sql );
	}
}