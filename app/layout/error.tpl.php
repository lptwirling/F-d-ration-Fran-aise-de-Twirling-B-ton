<?php

$TPL['title'] = _( 'Page inexistante' );

echo '<div id="error">
	<p>La page demand� n\'existe pas !</p>
	<p><a href="'._LINK::href( 'admin:module', 'add', array( 'module_name' => $URL['module'] ) ).'">Cr�er: '.$INCLUDE_MIDDLE.'</a></p>
</div>';