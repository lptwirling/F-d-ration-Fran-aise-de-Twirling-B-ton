<?php

class _LINK {
	static public function href ( $module = _MODULE, $action = _ACTION, $params = array() ) {
		if ( count( $params ) > 0 ) {
			$out_params = '';
			foreach ( $params as $param_key => $param_val ) {
				$out_params .= "$param_key:$param_val/";
			}
		}

		return str_replace( DIRECTORY_SEPARATOR, '/', URL_SITE.$module.'/'.$action.'/'.$out_params );
	}
}