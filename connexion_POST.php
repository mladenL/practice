<?php 
	include('user_management.php');

	 $req = $bdd->prepare('SELECT * FROM users WHERE user_name = :name AND passwd = :passwd');
	 $req->execute(array(
	 	'name' => $_POST['user_name'],
	 	'passwd' => $_POST['passwd']
	  ));
	 $data = $req->fetch();
	 if (!$data) {
	 	$_SESSION['user_id'] = 3;
	 	$_SESSION['user_name'] = 'Visiteur';
	 	echo 'echec connexion';
	 	include('index.php');
	 }

else {

	$_SESSION['user_name'] = $_POST['user_name'];
	$_SESSION['user_id'] = $data['user_id'];
	 	header('Location: index.php');
}
 ?>