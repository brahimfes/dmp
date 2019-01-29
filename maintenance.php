<?php
session_start();
include_once('includes.php');
include("barre_de_nav.php");
?>
<!DOCTYPE html>
<html lang="fr">
<header>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="bootstrap/js/bootstrap.js" rel="stylesheet" type="text/css"/>

	<link href="style.css" rel="stylesheet" type="text/css" media="screen"/>
	<title>Maintenance</title>

</header>
<body>
<div class="container-fluid">
	        <div class="row">
		       	<div class="col-xs-1 col-sm-2 col-md-3"></div>
		       	<div class="col-xs-10 col-sm-8 col-md-6">
			       	<h1 class="index-h1">Maintenance</h1>
<table>
			<tr>
			<th>Valise n°</th>
			<th>Nom</th>
			<th>Date</th>
			<th>Heure</th>
			</tr>
			
	<?php
	include('conn.php');
	$res = $mysqli->query("SELECT id_valise,date_de_maintenance,heure_de_maintenance,nom_du_maintenant FROM maintenance");

	for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
		$res->data_seek($row_no);
		$row = $res->fetch_assoc();
		?>
		<tr>
			<td>
				<?php echo $row['id_valise'];?>
			</td>
			<td>
				<?php echo $row['nom_du_maintenant'];?>
			</td>
			
			<td>
				<?php echo $row['date_de_maintenance'];?>
			</td>
			
			<td>
				<?php echo $row['heure_de_maintenance'];?>
			</td>
			</tr>
		<?php
	}
	?>
		</table>
		       	</div>
	            <div class="col-xs-1 col-sm-2 col-md-3"></div>
	        </div>
        </div>
        

	<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>