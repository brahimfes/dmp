<?php
session_start();
include_once('includes.php');

	include('barre_de_nav.php');	
?>

<!DOCTYPE html>
<html lang="fr">
	<header>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
		<link href="bootstrap/js/bootstrap.js" rel="stylesheet" type="text/css"/>
		
		<link href="style.css" rel="stylesheet" type="text/css" media="screen"/>
		<title>Donnée collectée</title>
		
	</header>
	<body>
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
	
		
			       	
			       	<h1 class="index-h1">Donnée collectée</h1>
			       	<table>
			<tr>
			<th>pid</th>
			<th>Nom</th>
			<th>Prénom</th>
			<th>Date de naissance</th>
			<th>Sexe</th>
			<th>Température</th>
			<th>Fréquence cardiaque</th>
			<th>SpO2</th>
			<th>Tension artérielle diastolique</th>
			<th>tension artérielle systolique</th>
			</tr>
			
	<?php
	include('conn.php');
	$res = $mysqli->query("SELECT patient.pid,patient.nom,patient.prenom,patient.date_naissance,patient.sexe,resultats_capteurs.Temperature,resultats_capteurs.Frequence_cardiaque,resultats_capteurs.SpO2,resultats_capteurs.Tension_arterielle_diastolique,resultats_capteurs.Tension_arterielle_systolique
		From `patient`,`resultats_capteurs`
		WHERE patient.pid=resultats_capteurs.pid");

	for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
		$res->data_seek($row_no);
		$row = $res->fetch_assoc();
		?>
		<tr>
		<td>
				<?php echo $row['pid'];?>
			</td>
			
			<td>
				<?php echo $row['nom'];?>
			</td>
			
			<td>
				<?php echo $row['prenom'];?>
			</td>
			<td>
				<?php echo $row['date_naissance'];?>
			</td>
			<td>
				<?php echo $row['sexe'];?>
			</td>
			<td>
				<?php echo $row['Temperature'];?>
			</td>
			<td>
				<?php echo $row['Frequence_cardiaque'];?>
			</td>
			<td>
				<?php echo $row['SpO2'];?>
			</td>
			<td>
				<?php echo $row['Tension_arterielle_diastolique'];?>
			</td>
			<td>
				<?php echo $row['Tension_arterielle_systolique'];?>
			</td>
			</tr>
		<?php
	}
	?>
		</table>
		       	
		<script src="bootstrap/js/bootstrap.min.js"></script>
	</body>
</html>