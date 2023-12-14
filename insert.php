<?php
echo 'serveur 1';
$host = getenv('host');
$dbname = 'test';
$username = getenv('user');
$password = getenv('password');

if(isset($_GET['firstname']) && isset($_GET['lastname'])){
  try {
  // se connecter à mysql
  $pdo = new PDO("mysql:host=$host;dbname=$dbname","$username","$password");
  } catch (PDOException $exc) {
    echo $exc->getMessage();
    exit();
  }

  // récupérer les valeurs 
  $firstname = $_GET['firstname'];
  $lastname = $_GET['lastname'];

  // Requête mysql pour insérer des données
  $sql = "INSERT INTO `user`(`firstname`, `lastname`) VALUES (:firstname,:lastname)";
  $res = $pdo->prepare($sql);
  $exec = $res->execute(array(":firstname"=>$firstname,":lastname"=>$lastname));

  // vérifier si la requête d'insertion a réussi
  if($exec){
    echo 'Données insérées';
  }else{
    echo "Échec de l'opération d'insertion";
  }
} else {
    echo 'Pas de données inséré';
}
?>