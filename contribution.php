<?php 

	include('user_management.php');

	if (isset($_POST['contribution'])) {
	$contribution = $bdd->prepare('INSERT INTO messages (post_id, post_author, post_date, post_content) VALUES (:id, :post_author, NOW(), :post_content)');
	$contribution->execute(array(
		'id' => '',
		'post_author' => $_SESSION['user_id'], 
		'post_content' => $_POST['contribution']
		));
	header('Location: index.php');
}
 ?>