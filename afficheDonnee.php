<?php
session_start();
include_once 'includes.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
	 crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
	 crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
	 crossorigin="anonymous"></script>
	 <script src="js/parser.js"></script>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
	<title>affichage donnee patient</title>
</head>

<body>
	<?php
include("barre_de_nav.php");

$errors = array();
$patient;

if (!isset($_POST['pid'])) {
    header('Location: patient.php');
}


if (isset($_POST['rendezvous'])) {
    if (!isset($_POST['agenda'])) {
        array_push($errors, 'Agenda non séléctionnée');
    }
    if (!isset($_POST['acte'])) {
        array_push($errors, 'Acte non séléctionnée');
    }
    if (!isset($_POST['date'])) {
        array_push($errors, 'Date non séléctionnée');

    }
    if (!isset($_POST['heure'])) {
        array_push($errors, 'Heure non séléctionnée');

    }
    if (!isset($_POST['medecin'])) {
        array_push($errors, 'Médecin non séléctionnée');
    }

    if (count($errors) > 0) {
        print_r($errors);
    } else {
        $sql = "insert into rendez_vous (pid, nom_du_patient, prenom_du_patient, nom_du_medecin, dates, heure, agenda, acte) values
		(:pid, :nomdupatient, :prenomdupatient, :nomdumedecin, :dates, :heure, :agenda, :acte)";
        $result = $DB->insert($sql,
            array(
                'pid' => $_POST['pid'],
                'nomdupatient' => $_POST['nompatient'],
                'prenomdupatient' => $_POST['prenompatient'],
                'nomdumedecin' => $_POST['medecin'],
                'dates' => $_POST['date'],
                'heure' => $_POST['heure'],
                'agenda' => $_POST['agenda'],
                'acte' => $_POST['acte'],
            )
        );

    }
}

?>

	<div class="container-fluid">

		<div class="row">

			<div class="col-xs-10 col-sm-8 col-md-10">

				<h1 class="index-h1">Identifiant du patient(PID) :
					<?php $pid = $_POST['pid'];
					echo $pid?>
				</h1>
				<h1>Donnees du Patient</h1>
				<table>
					<tr>
						<th>Nom</th>
						<th>Prenom</th>
						<th>Date de naissance</th>
						<th>Age</th>
						<th>Sexe</th>
						<th>Adresse</th>
						<th>Ville</th>
						<th>Code postal</th>
					</tr>
					<?php
					include 'conn.php';
					$res = $mysqli->query("SELECT nom,prenom,date_naissance,age,sexe,adresse,ville,Code_Postal FROM patient where pid=" . $_POST['pid']);

					for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
						$res->data_seek($row_no);
						$patient = $res->fetch_assoc();
						?>
					<tr>

						<td>
							<?php echo $patient['nom']; ?>
						</td>

						<td>
							<?php echo $patient['prenom']; ?>
						</td>
						<td>
							<?php echo $patient['date_naissance']; ?>
						</td>
						<td>
							<?php echo $patient['age']; ?>
						</td>
						<td>
							<?php echo $patient['sexe']; ?>
						</td>
						<td>
							<?php echo $patient['adresse']; ?>
						</td>
						<td>
							<?php echo $patient['ville']; ?>
						</td>
						<td>
							<?php echo $patient['Code_Postal']; ?>
						</td>
					</tr>
					<?php
}
?>
				</table>
				<h1>Rendez-vous</h1>
				<!-- <button type="button" class="btn btn-success">Nouveau rendez-vous</button> <br /> -->
				<p>
					<button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
					 aria-controls="collapseExample">
						Nouveau rendez-vous
					</button>
				</p>
				<div class="collapse" id="collapseExample">
					<div class="card card-body">
						pid:
						<?php echo $_POST['pid']; ?>
						<form method="post" action="afficheDonnee.php">
							<input type="hidden" name="pid" value="<?php echo $_POST['pid']; ?>" />
							<input type="hidden" name="nompatient" value="<?php echo $patient['nom']; ?>" />
							<input type="hidden" name="prenompatient" value="<?php echo $patient['prenom']; ?>" />
							<input type="hidden" name="rendezvous" value="true" />
							<div class="form-group">
								<label for="date">Agenda</label>
								<select class="custom-select" name="agenda">
									<option value="Prise constante">Prise constante</option>
									<option value="consultation">Consultation</option>
								</select>
							</div>
							<div class="form-group">
								<label for="date">Acte</label>
								<select class="custom-select" name="acte">
									<option value="ecg">ECG</option>
									<option value="ocymetre">Oxymetre</option>
									<option value="tensionmetre">Tensiometre</option>
									<option value="temperature">Temperature</option>
								</select>
							</div>
							<div class="form-group">
								<label for="date">Date</label>
								<input type="date" class="form-control" name="date" id="date" aria-describedby="date" placeholder="Entrer la date">
							</div>
							<div class="form-group">
								<select class="custom-select" name="heure">
									<option selected>Heure</option>
									<?php
										for ($i = 8; $i <= 16; $i++) {
											echo "<option value=" . $i . ">" . $i . ":00 - " . ($i + 1) . ":00</option>";
										}

										?>
								</select>
							</div>
							<div class="form-group">
								<label for="doctor">Medecin</label>
								<input type="text" value="Dominique" class="form-control" name="medecin" id="doctor" placeholder="Médecin">
							</div>

							<button type="submit" class="btn btn-primary">Enregistrer</button>
						</form>

					</div>
					<br />
				</div>


				<table>
					<tr>
						<th>Nom du medecin</th>
						<th>Date RDV</th>
						<th>Heure RDV</th>
						<th>Agenda</th>
						<th>Acte</th>
						<th>Etat</th>
					</tr>
					<?php
						include 'conn.php';
						$res = $mysqli->query("SELECT id, pid, nom_du_patient, prenom_du_patient, nom_du_medecin, dates, heure, acte, agenda, etat FROM rendez_vous where pid=" . $_POST['pid']);

						for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
							$res->data_seek($row_no);
							$row = $res->fetch_assoc();
							
							?>
					<tr>

						<td>
							<?php echo "Dr " . $row['nom_du_medecin']; ?>
						</td>

						<td>
							<?php echo $row['dates']; ?>
						</td>
						<td>
							<?php echo $row['heure']; ?>
						</td>
						<td>
							<?php echo $row['agenda']; ?>
						</td>
						<td>
							<?php echo $row['acte']; ?>
						</td>
						<td>
						<p>
							<button 
								class="btn btn-success" 
								<?php if($row['etat'] == 'finalise') { ?>disabled <?php } ?>
								id="<?php echo $row['id']; ?>" type="button"
								onclick='getHL7(<?php echo htmlspecialchars(json_encode($row)); ?>)'>
								<?php 
									if($row['etat'] == 'finalise') {
										echo 'Finalise';
									} else {
										echo 'Debut d\'examen';
									}
								

								?>
								</button>
							</p>
						</td>
					</tr>
					<?php
						}
					?>
				</table>
				<h1>Resultats des capteurs</h1>
				<table>
					<tr>
						<th>ID</th>
						<th>Resultat</th>
						<th>Unite</th>
						<th>Date rendez_vous</th>
						<th>References</th>
					</tr>
					<?php
						include 'conn.php';
						$res = $mysqli->query("select * from obx where pid=" . $_POST['pid']);

						for ($row_no = $res->num_rows - 1; $row_no >= 0; $row_no--) {
							$res->data_seek($row_no);
							$row = $res->fetch_assoc();
							?>
					<tr>

						<td>
							<?php echo $row['set_id']; ?>
						</td>

						<td>
							<?php echo $row['value']; ?>
						</td>
						<td>
							<?php echo $row['units']; ?>
						</td>
						<td>
							<?php echo $row['references_range']; ?>
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

</body>

</html>