<?php

$TPL['title'] = _( 'Vous n\'�tes pas autoris� � voire cette page !' );

echo '<div id="error">
	<p>Vous n\'�tes pas autoris� � voire cette page !</p>
	<p><a href="'._LINK::href().'"></a></p>
</div>';