<?php

$bdd['host'] = 'localhost';
$bdd['port'] = '3306';
$bdd['user'] = 'twirling';
$bdd['mdp'] = 'twirling';
$bdd['base'] = 'twirling';

/* Connexion à une base ODBC avec l'invocation de pilote */
$dsn = 'mysql:dbname=' . $bdd['base'] . ';host=' . $bdd['host'] . ';port=' . $bdd['port'];

try {
    $SQL = new PDO( $dsn, $bdd['user'], $bdd['mdp'] );
}
catch ( PDOException $e ) {
    echo 'Connexion échouée : ' . $e->getMessage();
	echo '<p>'.$dsn.', '.$bdd['user'].', '.$bdd['mdp'].'</p>';
}