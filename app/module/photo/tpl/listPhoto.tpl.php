<?php

if ( count( $list ) > 0 ) {
	echo '<div id="'.$URL['action'].'_'.$URL['module'].'">';
		foreach ( $list as $item ) {
			echo '<div class="item '.$URL['module'].'">';
				echo '<div class="titre"><a href="'._LINK::href( 'photo', 'view', array( 'photo_id' => $item['id'] ) ).'">'.$item['titre'].'</a></div>';
			echo '</div>';
		}
	echo '</div>

	<div class="clear"></div>';
}
else {
	echo '<p>Aucun r�sultat <br /><a href="'._LINK::href( 'photo', 'add' ).'">Ajouter une photo</a></p>';
}