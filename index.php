<?php 

error_reporting(0);

//GESTION DE L'IDENTITE DU VISITEUR
	include('user_management.php');
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Mon Chat privé avec Espace membres</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<!--En-tête du site avec titre et encart de connexion membres-->
<div id="container_1">
	<div class="title">
		<span style="color: blue;">TITRE DU SITE</span>
	</div>
	<div class="members">
		<span style="color: red;">CONNEXION MEMBRES</span><br/>
<!--FORMULAIRE DE CONNEXION-->
<p><?php echo 'Bonjour, '. $_SESSION['user_name']; ?></p>
	<form method="post" action="connexion_POST.php">
		<p><label>Pseudo : <br/><input type="text" name="user_name"></label></p>
		<p><label>MDP : <br/><input type="password" name="passwd"></label></p>
		<p><label><input type="submit" value="Se connecter" class="connexion_button"></label></p>
	</form> Ou bien : 
	<a href="inscription.php"><input type="submit" value="S'inscrire" class="subscription_button"></a>
<!--BOUTON DECONNEXION (SI CONNECTÉ)-->
	<?php if ($_SESSION['user_name'] != 'Visiteur') {
		echo '<br/><a href="deconnexion.php"><input type="submit" value="Se déconnecter" class="subscription_button"></a>';
	}
		?>
	</div>
</div>
<!--Menu de gauche et corps du site-->
<div id="container_2">
	<div class="side_menu">
		<span style="color: purple;">MENU GAUCHE</span>
	</div>
	<div class="main_content">
		<span style="color: grey;">CHAT PRIVÉ</span><br/><br/>
<!--Messages Chat-->

<?php 
	if ($_SESSION['user_name'] != 'Visiteur') { ?>
	<p>Vous pouvez poster un message : </p>
	<form method="post" action="contribution.php">
		<input type="text" name="contribution">
		<input type="submit" value="Envoyer">
	</form>
	
<?php	}
	include('chat.php'); ?>
	</div>

</div>

</body>
</html>