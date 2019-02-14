<?php
session_start();
include_once('includes.php');
echo $_SESSION['id'];	
?>

<!DOCTYPE html>
<html lang="fr">
<header>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="bootstrap/js/bootstrap.js" rel="stylesheet" type="text/css"/>
	
	<link href="style.css" rel="stylesheet" type="text/css" media="screen"/>
	<title>Donnee</title>
</header>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">MES</a>
			</div>
			
			
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="accueil.php">Accueil</a></li>
					<li><a href="analyse.php">Analyse</a></li>
					<li><a href="patient.php">Patient</a></li>
					<li><a href="modifier.php">Compte</a></li>
					<li><a href="deconnexion.php">Deconnexion</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<?php 
	if(isset($_SESSION['flash'])){ 
		foreach($_SESSION['flash'] as $type => $message): ?>
		<div id="alert" class="alert alert-<?= $type; ?> infoMessage"><a class="close">X</span></a>
			<?= $message; ?>
		</div>	
		
		<?php
		endforeach;
		unset($_SESSION['flash']);
	}
	?> 
	
	<div class="container-fluid">
		
		<div class="row">
			
			<div class="col-xs-1 col-sm-2 col-md-3"></div>
			<div class="col-xs-10 col-sm-8 col-md-6">
				
				<h1 class="index-h1">Donnee</h1>
				<p>ryhtme cardiaque</p><br>
				<img src="rythmeTest.jpg" class="images_petit">
				<p>temperature</p><br>
				<p>video de la consultation</p>
			</div>
			<div class="col-xs-1 col-sm-2 col-md-3"></div>
		</div>
	</div>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>