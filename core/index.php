<?php

// enregistre lheure de départ
$time_start = microtime( true );

// affiche toutes les erreures
//error_reporting( E_ALL );

// initialisation des sessions
session_start();

// dossier du cms
define( 'DIR_PWB_CMS', str_replace( 'core', '', dirname( __FILE__ ) ) );

// dossier principaux du cms
define( 'DIR_APP', DIR_PWB_CMS.'app'.DIRECTORY_SEPARATOR );
define( 'DIR_APP_LAYOUT', DIR_APP.'layout'.DIRECTORY_SEPARATOR );
define( 'DIR_APP_CONFIG', DIR_APP.'config'.DIRECTORY_SEPARATOR );
define( 'DIR_CORE', DIR_PWB_CMS.'core'.DIRECTORY_SEPARATOR );

// dossier des classes
define( 'DIR_CORE_CLASS', DIR_CORE.'class'.DIRECTORY_SEPARATOR );
define( 'DIR_CORE_FIREWALL', DIR_CORE.'php-firewall'.DIRECTORY_SEPARATOR );
define( 'DIR_APP_CLASS', DIR_APP.'class'.DIRECTORY_SEPARATOR );

// firewall php
require_once( DIR_CORE_FIREWALL.DIRECTORY_SEPARATOR.'firewall.php' );

// connection a la base de donnee
require_once( DIR_APP_CONFIG.'bdd.php' );

// initialisation des paramatre de l'application
require_once( DIR_APP_CONFIG.'params.php' );

// requete de l'url
define( 'URL_REQUEST', PHP_FIREWALL_REQUEST_URI );

// url du site
define( 'URL_APP', str_replace( DIRECTORY_SEPARATOR, '/', URL_SITE.'app/' ) );

define( 'DIR_APP_CSS', DIR_APP.'css'.DIRECTORY_SEPARATOR );
define( 'URL_APP_CSS', URL_APP.'css/' );

define( 'DIR_APP_JS', DIR_APP.'js'.DIRECTORY_SEPARATOR );
define( 'URL_APP_JS', URL_APP.'js/' );

// url beautifuler
$URL = _URL::url2params();
$APPLI = _URL::url2appli( $URL );

// détermine si nous somme sur module du backoffice
$dir_app = 'module'.DIRECTORY_SEPARATOR;
if ( $URL['admin'] ) {
	// chemin pour le backoffice
	$dir_app = 'admin'.DIRECTORY_SEPARATOR;
}

define( 'DIR_MODULE', DIR_APP.$dir_app );
define( 'URL_MODULE', $dir_app );

// function d'autoload ( chargement automatique des classes )
function __autoload ( $class ) {
	if ( $class[0] == '_' ) {
		$class_file = DIR_CORE_CLASS.$class.'.class.php';
	}
	else {
		if ( preg_match( '|_|', $class ) ) {
			$names_class = explode( '_', $class );
			$dir_class = $names_class[0];
		}
		else {
			$dir_class = strtolower( $class );
		}

		$class_file = DIR_MODULE.$dir_class.DIRECTORY_SEPARATOR.'class'.DIRECTORY_SEPARATOR.$class.'.class.php';
	}

	if ( file_exists( $class_file ) ) {
		//echo "<u>\$class_file</u>: <b>".$class_file.'</b><br />';
		require_once( $class_file );
	}
	else {
		//echo( 'class '.$class.' extends _CRUDL { public function __construct(){} }<br />' );
		eval( 'class '.$class.' extends _CRUDL { public function __construct(){} }' );
	}

}

// déclaration des variable de l'application
$_moduleClass = ucfirst( $URL['module'] );

/*
BOF listes universel
--------------------

if ( $URL['action'] == 'list' ) {
	$$_moduleClass = new $_moduleClass;
	$_list = $$_moduleClass->listes( $APPLI );
}

--------------------
EOF listes universel
*/

// active les utilisateurs
$user_id = _USER::sessioncode2userid();
$User = new User( $user_id );

// inclus le ficher qui aiguille sur le bon fichier suivant l'action demandé
if ( file_exists( DIR_MODULE.$URL['module'].DIRECTORY_SEPARATOR.$URL['module'].'.php' ) ) include( DIR_MODULE.$URL['module'].DIRECTORY_SEPARATOR.$URL['module'].'.php' );

// inclus le template
include( DIR_APP_LAYOUT.'layout.tpl.php' );