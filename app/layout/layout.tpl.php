<?php

if ( $URL['ajax'] ) {
	echo '<div id="title">
		<h1>'.$TPL['title'].'</h1>
		<div class="clear"></div>
	</div>';

	$INCLUDE_MIDDLE = DIR_MODULE.$URL['module'].DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.$URL['action'].$_moduleClass.'.tpl.php';
	include( $INCLUDE_MIDDLE );
}
else {

?>

<html>
	<head>
		<?php include( DIR_APP_LAYOUT.'head.tpl.php' ); ?>
	</head>
	<body id="<?php echo _::clean( $URL['module'].'_'.$URL['action'] ); ?>"<?php $more_module = ( $URL['admin'] ) ? ' class="admin"' : ''; $more_module = ( $URL['ajax'] ) ? ' class="ajax"' : ''; echo $more_module; ?>>
		<div id="container">
			<div id="header">
				<?php include( DIR_APP_LAYOUT.'header.tpl.php' ); ?>
			</div>
			<div id="content">
				<div id="title">
					<h1><?php echo $TPL['title']; ?></h1>
					<?php

					if ( _USER::is_admin() && $URL['module'] != 'commande' ) {
						echo '<div id="admin-bar">
							'._BUTTON::link( '+ Ajouter', _LINK::href( $URL['module'], 'add' ) );

							if ( $URL['where'][$URL['module'].'_id'] ) {
								echo ' '._BUTTON::link( 'Edit', _LINK::href( $URL['module'], 'edit', array( $URL['module'].'_id' => $URL['where'][$URL['module'].'_id'] ) ) );
								echo ' '._BUTTON::link( '- Supprimer', _LINK::href( $URL['module'], 'delete', array( $URL['module'].'_id' => $URL['where'][$URL['module'].'_id'] ) ) );
							}
						echo '</div>';
					}

					?>

					<div class="clear"></div>
				</div>
				<?php

				if ( $TPL['menu'] ) {
					$INCLUDE_MENU = DIR_MODULE.$URL['module'].DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.'menu'.$_moduleClass.'.tpl.php';
					include( $INCLUDE_MENU );
				}

				// left
				if ( count( $TPL['left'] ) > 0 ) {
					echo '<div id="left">';
						foreach ( $TPL['left'] as $left ) {

						}
					echo '</div>';
				}

				// middle
				$INCLUDE_MIDDLE = DIR_MODULE.$URL['module'].DIRECTORY_SEPARATOR.'tpl'.DIRECTORY_SEPARATOR.$URL['action'].''.$_moduleClass.'.tpl.php';
				include( $INCLUDE_MIDDLE );
				/*
				if ( file_exists( $INCLUDE_MIDDLE ) ) {
					include( $INCLUDE_MIDDLE );
				}
				else {
					include( DIR_APP_LAYOUT.'error.tpl.php' );
				}*/

				// right
				if ( count( $TPL['right'] ) > 0 ) {
					echo '<div id="right">';
						foreach ( $TPL['right'] as $right ) {

						}
					echo '</div>';
				}

				?>
			</div>
		</div>
		<div id="footer-wrap">
			<div id="footer">
				<?php include( DIR_APP_LAYOUT.'footer.tpl.php' ); ?>
			</div>
		</div>
	</body>
</html>

<?php

}

?>