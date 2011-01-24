<?php

echo '<form method="post">';
	echo _FORM::text( 'login', $User->login );
	echo _FORM::password( 'mdp', $User->pass );
	echo _FORM::none( '<input type="submit" value="Login !" class="form-submit"> '._BUTTON::link( 'S\'inscrire !', _LINK::href( 'user', 'add' ) ) );
echo '</form>';