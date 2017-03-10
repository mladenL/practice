<?php 
//GESTION DE L'IDENTITE DU VISITEUR
	include('user_management.php');

//AFFICHAGE DES POSTS

$req_MSG = $bdd->query('SELECT post_date, user_name, post_content FROM users INNER JOIN messages ON user_id = post_author');

while ($MSG = $req_MSG->fetch()) {
	echo '<p><span style="font-weight: bold; color: grey;">[' . $MSG['post_date'] . '] - ' . strip_tags($MSG['user_name']) . ' a dit : </span>' . strip_tags($MSG['post_content']) . '</p>';
}
?>