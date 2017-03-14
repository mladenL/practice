<?php 
session_start();
error_reporting(0);

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

	$req = $bdd->prepare('SELECT * FROM users WHERE user_name = :name');
	$req->execute(array(
		'name' => $_POST['user_name']
		));
	$data = $req->fetch();
	$_SESSION['user_id'] = $data['user_id'];
		
	echo 'Inscription réussie';
	$_SESSION['user_name'] = $_POST['user_name'];
	echo '<br/><a href="index.php"><input type="submit" value="<---Commencer à Chater" class="subscription_button"></a>';
//	$query = $bdd->prepare('SELECT user_id FROM users WHERE user_name = :name');
//	$query->execute(array('name' => $_SESSION['user_name']));
//	$_SESSION['user_id'] = print_r($query);
	header('Location: inscription.php');
}

else {
	echo 'Inscription échouée.';
	include('inscription.php');
}

 ?>