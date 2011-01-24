<?php

echo '<div id="header-top">
	<div>
		<div id="logo">
			<a href="'._LINK::href().'">Fédération Française de Twirling Bâton</a>
		</div>';

		if ( _USER::is_login() ) {
			$nbVendu = 0;
			if ( count( $_cart['items'] ) > 0 ) {
				foreach ( $_cart['items'] as $items ) {
					$nbVendu += $items['VENDU_QTY'];
				}
			}

			// on affiche les infos minimal du user
			echo '<div id="userbox">'.$User->CLIENT_LOGIN.' | <a href="'._LINK::href( 'commande', 'view', array( 'commande_id' => $_cart['COMMANDE_ID'] ) ).'" title="Voire mon panier">Mon panier ( '.$nbVendu.' )</a> &nbsp;| &nbsp;<a title="Voire mon compte" href="'._LINK::href( 'user', 'edit' ).'">Mon compte</a> &nbsp;| &nbsp;<a title="Déconnection" href="'._LINK::href( 'user', 'logout' ).'">x</a></div>';
		}
		else {
			// formulaire de connection
			echo '<form method="post" action="'._LINK::href( 'user', 'login' ).'">
				<div id="userbox_off">
					<span>'._BUTTON::link( 'S\'inscrire', _LINK::href( 'user', 'add' ) ).'</span>
					<input type="submit" value="Login" /><input type="password" name="mdp" /><input class="pseudo" type="text" name="login" />
					<span class="icon user"></span>
				</div>
			</form>';
		}


		echo '<div class="clear"></div>
	</div>
</div>';

include( DIR_APP_LAYOUT.'menu.tpl.php' );

echo '<div class="clear"></div>';