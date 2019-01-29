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
	<title>Patient</title>
	
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
				
				<h1 class="index-h1">Patient</h1>
				
				<br/>
				
				<form method="post" action="afficheDonnee.php">
					
					<label>pid patient</label>
					
					<input class="input" type="text" name="pid" maxlength="20" required="required">

					<br/>
					<br/>
					
					<div class="row">
						<div class="col-xs-0 col-sm-10 col-md-2"></div>
						<div class="col-xs-12 col-sm-2 col-md-8">
							<input type="hidden" value="form" name="modifier"/>
							<button type="submit">Chercher</button>
						</div>
						<div class="col-xs-0 col-sm-1 col-md-2"></div>                                
					</div>
				</form>
			</div>
			<div class="col-xs-1 col-sm-2 col-md-3"></div>
		</div>
	</div>
	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>