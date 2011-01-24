<?php

if ( count( $list ) > 0 ) {
	echo '<div id="'.$URL['action'].'_'.$URL['module'].'">';
		foreach ( $list as $item ) {
			echo '<div class="item '.$URL['module'].'">';
				echo '<div class="titre"><a href="'._LINK::href( 'club', 'view', array( 'club_id' => $item['id'] ) ).'">'.$item['nom'].'</a></div>';
			echo '</div>';
		}
	echo '</div>

	<div class="clear"></div>';
}
else {
	echo '<p>Aucun résultat <br /><a href="'._LINK::href( 'club', 'add' ).'">Ajouter un club</a></p>';
}