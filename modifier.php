<?php
session_start();
include_once('includes.php');

if(!isset($_SESSION['pseudo'])){
	header('Location: accueil.php');
	exit;
}

if(!empty($_POST)){
	extract($_POST);
	$valid = true;

	if($modifier == "form"){
		$Pseudo = htmlspecialchars(trim($Pseudo));
	
		if(empty($Pseudo)){
			$valid = false;
			$_SESSION['flash']['danger'] = "Veuillez mettre un pseudo !";
			
		}
		
		$req = $DB->query("Select pseudo from user where idpublic = :id", array('id' => $_SESSION['id']));
		$req = $req->fetch();
		
		if($Pseudo == $_SESSION['pseudo']){
			$valid = false;
			$_SESSION['flash']['info'] = "Votre pseudo est le même";
		
		}
		
		if($valid){
			
			$DB->insert("UPDATE user SET pseudo = :newpseudo where idpublic = :id ", array('id' => $_SESSION['id'], 'newpseudo' => $Pseudo));
			
			$_SESSION['pseudo'] = $Pseudo;
			$_SESSION['flash']['success'] = "Votre pseudo a bien été modifié !";
			header('Location: modifier.php');
			exit;
		}
		
	}elseif($modifier == "mdp"){
		
		$Password = trim($Password);
		$PasswordConfirmation =trim($PasswordConfirmation);
		$NewPassword = trim($NewPassword);
		
		$req = $DB->query("Select * from user where idpublic = :id", array('id' => $_SESSION['id']));
		$req = $req->fetch();
		
		if(empty($Password)){
			$valid = false;
			$_SESSION['flash']['warning'] = "Veuillez mettre votre mot de passe !";
		
		}elseif($Password && empty($PasswordConfirmation)){
			$valid = false;
			$_SESSION['flash']['warning'] = "Veuillez confirmer votre mot de passe";

		}elseif($Password != $PasswordConfirmation){
			$valid = false;
			$_SESSION['flash']['danger'] = "Votre mot de passe ne correspond pas au mot de passe !";

		}else if($req['password'] != (crypt($Password, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t'))){
			$valid = false;
			$_SESSION['flash']['danger'] = "Votre mot de passe n'est pas le bon !";
			
		}else if(empty($NewPassword)){
			$valid = false;
			$_SESSION['flash']['warning'] = "Veuillez mettre un nouveau mot de passe !";
	
		}else if($valid){
			
			$DB->insert("UPDATE user SET password = :newpassword where idpublic = :id", array('id' => $_SESSION['id'], 'newpassword' => (crypt($NewPassword, '$2a$10$1qAz2wSx3eDc4rFv5tGb5t'))));
			
			$_SESSION['flash']['success'] = "Votre nouveau mot de passe a été enregistré !";
			header('Location: modifier.php');
			exit;
			
		}	
	}
}		
?>
<!DOCTYPE html>
<html lang="fr">
	<header>
		
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="bootstrap/js/bootstrap.js" rel="stylesheet" type="text/css"/>
		
		<link href="style.css" rel="stylesheet" type="text/css" media="screen"/>
		
		<title>Modifier profil</title>
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
			       	
			       <h1 class="index-h1">Modifier votre profil</h1>
			       	
			       <br/>
	                
	                <form method="post" action="modifier.php">
	                    
                        <label>Nom</label>
                        
                    	<input class="input" type="text" name="Pseudo" placeholder="Pseudo" value="<?= $_SESSION['pseudo'];  ?>" maxlength="20" required="required">

						<br/>
						<br/>
						
	                    <div class="row">
	                        <div class="col-xs-0 col-sm-10 col-md-2"></div>
	                        <div class="col-xs-12 col-sm-2 col-md-8">
		                        <input type="hidden" value="form" name="modifier"/>
								<button type="submit">Modifier</button>
	                        </div>
	                        <div class="col-xs-0 col-sm-1 col-md-2"></div>                                
	                   </div>
						
	                </form>
	                
	                <br/>
	                <br/>
	                
	                <form method="post" action="modifier.php">

	                    <label>Mot de passe</label>	                 

                        <input class="input" type="password" name="Password" value="<?php if(isset($Password)){ echo $Password; }?>" placeholder="Mot de passe" required="required"/>
					
						<br/>
	
	                    <label>Confirmez votre mot de passe</label>

                        <input class="input" type="password" name="PasswordConfirmation" value="<?php if(isset($PasswordConfirmation)){ echo $PasswordConfirmation; }?>" placeholder="Confirmation du mot de passe" required="required"/>
	                    
	                    <br/>
	                    
	                    <label>Nouveau mot de passe</label>
                        <input class="input" type="password" name="NewPassword" placeholder="Nouveau mot de passe" required="required"/>
						
						<br/><br/>
						
	                    <div class="row">
	                        <div class="col-xs-0 col-sm-10 col-md-2"></div>
	                        <div class="col-xs-12 col-sm-2 col-md-8">
		                        <input type="hidden" value="mdp" name="modifier"/>
								<button type="submit">Modifier</button>
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
</html