

<?php 
 session_start();
 if(!$_SESSION["login"]){
    header('Location: ../etudiants.php');
}

 require_once('connexionbd.php');

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essaie--- Gestion Vebest Group </title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>

<?php


$select_joint="
SELECT etudiant.email, matiere.libMat
FROM etudiant
INNER JOIN matiere
ON matiere.idMat = etudiant.idEt";

$requete=$pdo->prepare($select_joint);
$requete->execute();
$resultats=$requete->fetchAll();
echo '<pre>';
print_r($resultats);
echo '<pre>';

 ?>


<script src="../js/bootstrap.bundle.min.js"></script>    
</body>
</html>