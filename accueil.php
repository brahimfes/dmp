<?php
session_start();
include_once('includes.php');
?>
<!DOCTYPE html>
<html lang="fr">
	<header>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="bootstrap/js/bootstrap.js" rel="stylesheet" type="text/css"/>
		
		<link href="style.css" rel="stylesheet" type="text/css" media="screen"/>
		<title>Accueil</title>
		
	</header>
	<body>
	
		<?php 
		include("barre_de_nav.php");
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
			       	<h1 class="index-h1">Accueil</h1>
			       	
			       	<p>Docteur <?php 
				       
				    	if(!isset($_SESSION['id'])){
					       echo "vous n'êtes pas connecté !";
				    	}else{
					    	echo $_SESSION['pseudo'];
				       	
				       	}
				       	?>
				    </p>
			       	
			       	<a href="modifier.php">Modifier votre profil</a>
			       	<br/>
			       	<a href="deconnexion.php">Deconnexion</a>
		       	</div>
	            <div class="col-xs-1 col-sm-2 col-md-3"></div>
	        </div>
        </div>
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>