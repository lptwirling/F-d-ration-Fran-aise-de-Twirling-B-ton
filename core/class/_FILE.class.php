<?php

class _FILE {
	static public function add ( $file, $content = '', $params = array() ) {
		_FILE::mkdir( $file );

		file_put_contents( $file, $content );
	}

	static public function view ( $file, $params = array() ) {
		return file_get_contents( $file );
	}

	static public function mkdir ( $file, $params = array() ) {
		$dir = dirname( $file );
		$name = basename( $file );

		// création des répertoires
		$dirs = explode( '/', trim( $dir, '/' ) );

		if ( count( $dirs ) > 0 ) {
			$before_dir = '/';

			foreach ( $dirs as $_dir ) {
				$new_dir = $before_dir.$_dir.'/';

				if ( !is_dir( $new_dir ) ) {
					mkdir( $new_dir, 711 );
				}

				$before_dir = $new_dir;
			}
		}
	}
}