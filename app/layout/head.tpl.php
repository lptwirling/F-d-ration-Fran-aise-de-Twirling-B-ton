<?php

//echo '<base href="'.URL_SITE.'" />'."\n";

echo '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
'."\n";
echo '<title>'.$TPL['title'].'</title>'."\n";

if ( count( $TPL['css'] ) > 0 ) {
	foreach ( $TPL['css'] as $css ) {
		echo '<link type="text/css" rel="stylesheet" href="'.URL_APP_CSS.$css.'.css" />'."\n";
	}
}

if ( count( $TPL['js'] ) > 0 ) {
	foreach ( $TPL['js'] as $js ) {
		echo '<script type="text/javascript" src="'.URL_APP_JS.$js.'.js"></script> '."\n";
	}
}