<?php 
session_start();

$_SESSION['user_name_error'] = 0;
$_SESSION['password_error'] = 0;
$_SESSION['password_confirm_error'] = 0;

//CONNEXION BDD

try {
	$bdd = new PDO('mysql:host=localhost;charset=utf8;dbname=espace_membres', 'root', 'root');
}

catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}


//TEST USER_NAME
//--------------

switch ($_POST['user_name']) {

	case (!isset($_POST['user_name'])):

		$_SESSION['user_name_error'] = 1;
		break;

	case (strlen($_POST['user_name']) > 20 OR  strlen($_POST['user_name']) < 6):

		$_SESSION['user_name_error'] = 2;
		break;

	default:

		$_SESSION['user_name_error'] = 0;
		break;
}

//TEST PASSWORD
//-------------

switch ($_POST['password']) {

	case (!isset($_POST['password'])):

		$_SESSION['password_error'] = 1;
		break;

	case (strlen($_POST['password']) > 20 OR  strlen($_POST['password']) < 6):

		$_SESSION['password_error'] = 2;
		break;

	default:

		$_SESSION['password_error'] = 0;
		break;
}

//TEST PASSWORD_CONFIRM
//---------------------

switch ($_POST['password_confirm']) {

	case (!isset($_POST['password_confirm'])):

		$_SESSION['password_confirm_error'] = 1;
		break;

	case (strlen($_POST['password_confirm']) > 20 OR  strlen($_POST['password_confirm']) < 6):

		$_SESSION['password_confirm_error'] = 2;
		break;

	default:

		$_SESSION['password_confirm_error'] = 0;
		break;
}

//CORRESPONDANCE DES MOTS DE PASSE
//----------------

	if (isset($_POST['password']) AND isset($_POST['password_confirm']) AND $_POST['password'] != $_POST['password_confirm']) {
		$_SESSION['password_error'] = 3;
		$_SESSION['password_confirm_error'] = 3;
	}

//TRAITEMENT EN SORTIE
//--------------------

	if (
	$_SESSION['user_name_error'] == 0 AND
	$_SESSION['password_error'] == 0 AND
	$_SESSION['password_confirm_error'] == 0
		)
	{
	$subs = $bdd->prepare('INSERT INTO `users`(`user_id`, `user_name`, `passwd`, `user_permission`) VALUES (:id, :user_name, :passwd, :user_permission)');
	$subs->execute(array(
		'id' => '',
		'user_name' => $_POST['user_name'],
		'passwd' => $_POST['password'],
		'user_permission' => 2
		 ));
		
	//header('Location: inscription_OK.php');
	echo 'Inscription réussie';
	echo '<br/><a href="index.php"><input type="submit" value="<---Commencer à Chater" class="subscription_button"></a>';
	include('inscription.php');
	$_SESSION['user_name'] = $_POST['user_name'];
}

else {
	echo 'Inscription échouée.';
	include('inscription.php');
}

 ?>