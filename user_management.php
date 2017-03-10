<?php 

//GESTION UTILISATEUR

session_start();

if (!isset($_SESSION['user_id']) OR !isset($_SESSION['user_name'])) {
	$_SESSION['user_id'] = 3;
	$_SESSION['user_name'] = 'Visiteur';
}
else {
	$_SESSION['user_id'] = $_SESSION['user_id'];
}

//CONNEXION BDD

try {
	$bdd = new PDO('mysql:host=localhost;charset=utf8;dbname=espace_membres', 'root', 'root');
}

catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}

//REQUETE

$req_USER = $bdd->query('SELECT user_id, user_name FROM users WHERE user_id = ' . $_SESSION['user_id']);
$user = $req_USER->fetch();
$user['user_id'] = $_SESSION['user_id'];

 ?>