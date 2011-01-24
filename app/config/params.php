<?php

// url de l'appication
define( 'URL_SITE', DIRECTORY_SEPARATOR.'twirling'.DIRECTORY_SEPARATOR );

// parametres par defaut de l'application
define( '_MODULE', 'page' );
define( '_ACTION', 'list' );
define( '_LIMIT', 20 );

// javascript
$TPL['js'][] = 'jquery';
$TPL['js'][] = 'jquery.ui';
$TPL['js'][] = 'jquery.corners.min';
$TPL['js'][] = 'jquery.wysiwyg';
$TPL['js'][] = 'jquery.colorbox-min';
$TPL['js'][] = 'bg.pos';
$TPL['js'][] = 'tabs.pack';
$TPL['js'][] = 'livevalidation';
$TPL['js'][] = 'cleanity';
$TPL['js'][] = 'pwbcms';

// css
$TPL['css'][] = 'reset';
$TPL['css'][] = 'jquery-ui';
$TPL['css'][] = 'style';