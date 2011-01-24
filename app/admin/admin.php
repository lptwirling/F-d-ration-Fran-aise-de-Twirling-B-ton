<?php

//$test_id = $URL['where']['test_id'];

//$Test = new Test( $test_id );

switch ( $URL['action'] ) {
	case 'module':
		$TPL['title'] = _( 'Détail d\'un test' );
		break;

	case 'add':
		$TPL['title'] = _( 'Ajouter un test' );
		break;

	case 'edit':
		$TPL['title'] = _( 'Editer un test' );
		break;

	case 'delete':
		$TPL['title'] = _( 'Supprimer un test' );
		break;

	case 'list':
		$TPL['title'] = _( 'Liste des testes' );
		//$list = $Test->listes( $APPLI );
		break;
} // switch