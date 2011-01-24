<?php

$menu1 = '';
$menu2 = '';
$menu3 = '';
$menu4 = '';
$menu5 = '';
$menu6 = '';

if ( $URL['module'] == 'page' ) {
	$menu1 = 'selected';
}

if ( $URL['module'] == 'actu' ) {
	$menu2 = 'selected';
}

if ( $URL['module'] == 'club' ) {
	$menu3 = 'selected';
}

if ( $URL['module'] == 'lien' ) {
	$menu4 = 'selected';
}

if ( $URL['module'] == 'photo' ) {
	$menu5 = 'selected';
}

if ( $URL['module'] == 'video' ) {
	$menu6 = 'selected';
}

echo '<ul id="menu">
	<li class="'.$menu1.'">
		<a href="'._LINK::href( 'page' ).'">'._( 'Pages' ).'</a>
	</li>
	<li class="'.$menu2.'">
		<a href="'._LINK::href( 'actu' ).'">'._( 'Actualités' ).'</a>
	</li>
	<li class="'.$menu3.'">
		<a href="'._LINK::href( 'club' ).'">'._( 'Clubs' ).'</a>
	</li>
	<li class="'.$menu4.'">
		<a href="'._LINK::href( 'lien' ).'">'._( 'Liens' ).'</a>
	</li>
	<li class="'.$menu5.'">
		<a href="'._LINK::href( 'photo' ).'">'._( 'Photos' ).'</a>
	</li>
	<li class="'.$menu6.'">
		<a href="'._LINK::href( 'video' ).'">'._( 'Vidéos' ).'</a>
	</li>';
	if ( _USER::is_admin() ) {
		echo '<li>
			<a href="#" class="'.$menu3.' top-level">Admin<span>&nbsp;</span></a>
			<ul>
				<li><a href="'._LINK::href( 'user', 'list' ).'">'._( 'Listes des clients' ).'</a></li>
				<li><a href="'._LINK::href( 'commande', 'list' ).'">'._( 'Listes des commandes' ).'</a></li>
			</ul>
		</li>';
	}
echo '</ul>

<form id="form1" name="form1" method="get" action="">
	<fieldset>
		<legend>Search</legend>
		<label id="searchbox">
			<input type="text" id="s" name="s">
		</label>
	</fieldset>
</form>';