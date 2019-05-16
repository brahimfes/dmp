<?php
/*
 * Description of connexionDB
 *  Connexion à la base de donnée avec des fonctions des requêtes;
 * @author Clouder
 */
class connexionDB
{
    // private $host = 'localhost';
    // private $name = 'sih';
    // private $user = "root";
    // private $pass = '';

    private $host = 'u615qyjzybll9lrm.chr7pe7iynqr.eu-west-1.rds.amazonaws.com';
    private $user = "znrv09cif9r6878k";
    private $pass = "besy5nu30n3u1hrh";
    private $name = "ffl0zhvdujs4a0wc";
    private $connexion;

    public function __construct($host = null, $name = null, $user = null, $pass = null)
    {
        if ($host != null) {
            $this->host = $host;
            $this->name = $name;
            $this->user = $user;
            $this->pass = $pass;
        }
        try {
            $this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name,
                $this->user, $this->pass, array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                ));
        } catch (PDOException $e) {
            echo $e;
            echo 'Erreur : Impossible de se connecter  à la BDD !';die();
        }
    }

    public function query($sql, $data = array())
    {
        $req = $this->connexion->prepare($sql);
        $req->execute($data);
        return $req;
    }

    public function insert($sql, $data = array())
    {
        $req = $this->connexion->prepare($sql);
        return $req->execute($data);
    }
}
