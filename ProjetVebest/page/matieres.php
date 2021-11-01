

<?php 
 session_start();
 if(!$_SESSION["login"]){
    header('Location: ../index.php');

}

 require_once('connexionbd.php');
 
// Parametre de suppression 
if(isset($_GET['idMat']))
{
    $idMat=$_GET['idMat'];
//code de suppression
$sql="DELETE FROM matiere WHERE idMat=:idMat";
$req=$pdo->prepare($sql);
$req->bindParam(":idMat", $idMat, PDO::PARAM_INT);
$res=$req->execute();
if($res){
    header('Location: matieres.php');
}
else{
    echo"suppression échouée";
}
}

    $requete=$pdo->prepare("SELECT matiere.*, professeurs.nomP, professeurs.prenomP FROM matiere INNER JOIN professeurs ON matiere.idP = professeurs.idP");
    $requete->execute();
    $matieres=$requete->fetchAll();

 
$selectcompter="SELECT * FROM matiere";
//paramettre d'execution utilisateur 
 $resultatCount=$pdo->query($selectcompter);
 $nbreUtilisateur=$resultatCount->rowCount();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Listes des Matières--- Gestion Vebest Group </title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>

<div class="container table1">

<?php if($_SESSION["role"]=="ADMIN"){ ?>
    <div class="bg-warning text-center text-white"> <strong> Nombres de Matières: <?php echo $nbreUtilisateur; ?> </strong> 
 &nbsp <a href="NouvelMat.php" class="text-white btn btn-success"><strong><i class="fa fa-plus"></i> Ajouter Nouvelle Matière</strong></a>
 </div>
 <?php } ?>
</div>
<br>
<div class="container">

<table class="table table-striped shadow-lg">
              <thead>
                  <tr class="table-dark">
                      <th> Identifiant de la Matière </th>
                      <th> Le Module </th>
                      <th> Nombre d'Heure </th>
                      <th> Formateur </th>
                      <?php if($_SESSION["role"]=="ADMIN"){ ?>
                      <th colspan="2"> Action</th> 
                      <?php } ?>
                  </tr>
              </thead>
              <tbody>
              <?php foreach($matieres as $matieres): ?>
                 
                      <td> <?php echo $matieres["idMat"]; ?> </td>
                      <td> <?php echo $matieres["libMat"]; ?></td>
                      <td> <?php echo $matieres["nbHmat"]; ?></td>
                      <td> <?php echo $matieres["nomP"]."  ".$matieres["prenomP"]; ?></td>

                      <?php if($_SESSION["role"]=="ADMIN"){ ?>
                      <td>
                        <a class="btn btn-outline-primary" href="ModMatiere.php?idMat=<?php echo $matieres["idMat"]; ?>">
                          <span class="fa fa-edit"></span>
                        </a>
                        </td>

                        <td>
                        <a class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de suprimer ce Professeur')" href="matieres.php?idMat=<?php echo $matieres["idMat"]; ?>">
                          <span class="fa fa-trash"></span>
                      </a>
                      </td>
                      <?php } ?>
                    </tr>
                   <?php endforeach; ?>
              </tbody>
 </table>

</div>               




<script src="../js/bootstrap.bundle.min.js"></script>    
</body>
</html>