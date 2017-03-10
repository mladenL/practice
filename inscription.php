<?php 

error_reporting(0);
	
	if (!isset($_SESSION['user_name_error'])) {
		$_SESSION['user_name_error'] = 0;
	}

	if (!isset($_SESSION['password_error'])) {
		$_SESSION['password_error'] = 0;
	}

	if (!isset($_SESSION['password_error_confirm'])) {
		$_SESSION['password_error_confirm'] = 0;
	}


//DEMARRAGE SESSION, CONNEXION BDD, GESTION UTILISATEUR
	include('user_management.php');
	include('errors.php');

 ?>

 <!DOCTYPE html>
 <html lang="fr">
 <head>
 	<title>Inscription au Chat</title>
 	<meta charset="utf-8">
 </head>
 <body>
 	<form method="post" action="inscription_POST.php">
 		<p>Pseudo : <br/><input type="text" name="user_name"><?php print_r($errors[$_SESSION['user_name_error']]); ?></p>
 		<p>MDP : <br/><input type="password" name="password"><?php print_r($errors[$_SESSION['password_error']]); ?></p>
 		<p>Confirmer MDP : <br/><input type="password" name="password_confirm"><?php print_r($errors[$_SESSION['password_confirm_error']]); ?></p>
 		<p><input type="submit" value="S'inscrire"></p>
 	</form>
 </body>
 </html>