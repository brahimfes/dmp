<?php
//$mysqli = new mysqli("localhost", "root", "", "sih");
$mysqli = new mysqli("u615qyjzybll9lrm.chr7pe7iynqr.eu-west-1.rds.amazonaws.com", "znrv09cif9r6878k", "besy5nu30n3u1hrh", "ffl0zhvdujs4a0wc");
if ($mysqli->connect_errno) {
    echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}


?>