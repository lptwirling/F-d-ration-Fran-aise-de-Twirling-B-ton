<?php

$TPL['title'] = _( 'Vous n\'êtes pas autorisé à voire cette page !' );

echo '<div id="error">
	<p>Vous n\'êtes pas autorisé à voire cette page !</p>
	<p><a href="'._LINK::href().'"></a></p>
</div>';