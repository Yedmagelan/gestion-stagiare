

<?php 
 session_start();
 if(!$_SESSION["login"]){
    header('Location: ../inscriptions.php');

}

 require_once('connexionbd.php');
 
// Parametre de suppression 
if(isset($_GET['idIns']))
{
    $idIns=$_GET['idIns'];
//code de suppression
$sql="DELETE FROM inscription WHERE idIns=:idIns";
$req=$pdo->prepare($sql);
$req->bindParam(":idIns", $idIns, PDO::PARAM_INT);
$res=$req->execute();
if($res){
    header('Location: inscriptions.php');
}
else{
    echo"suppression échouée";
}
}

    $requete=$pdo->prepare("SELECT inscription.*, matiere.libMat, etudiant.nomEtu, etudiant.prenEtu FROM inscription INNER JOIN matiere ON inscription.idMat = matiere.idMat
     INNER JOIN etudiant ON inscription.idEt = etudiant.idEt");
    $requete->execute();
    $inscription=$requete->fetchAll();

 
$selectcompter="SELECT * FROM inscription";

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
    <title>Accueil Etudiants--- Gestion Vebest Group </title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>

<div class="container shadow-lg table1">
    <div class="bg-warning text-center text-white"> <strong> Nombre d'Inscrits: <?php echo $nbreUtilisateur; ?> </strong> 
 &nbsp <a href="NouvelIns.php" class="text-white btn btn-success"><strong><i class="fa fa-plus"></i> nouvelle inscription</strong></a></div>
</div>
<br>
<div class="container">

<table class="table table-striped shadow-lg">
              <thead>
                  <tr class="table-dark">
                      <th> Identifiant de l'inscription </th>
                      <th> Nom & Prenom Etudiant </th>
                      <th> Module de formation </th>
                      <th> Periode de formation </th>  
                      <th> Date d'inscription</th> 
                      <th> Etat d'inscription </th> 

                      <?php if($_SESSION["role"]=="ADMIN"){ ?> 
                      <th colspan="2"> Action</th> 
                      <?php } ?> 
                  </tr>
              </thead>
              <tbody>
                 <?php  foreach($inscription as $inscription): ?>
                 
                      <td> <?php echo $inscription["idIns"]; ?> </td>
                      <td> <?php echo $inscription["nomEtu"]." ".$inscription["prenEtu"]; ?></td>
                      <td> <?php echo $inscription["libMat"]; ?></td>
                      <td> <?php echo $inscription["periode"]; ?></td>
                      <td> <?php echo $inscription["dateIns"]; ?></td>
                      <td> <?php echo $inscription["libInscript"]; ?></td>

                      <?php if($_SESSION["role"]=="ADMIN"){ ?> 
                      <td>
                        <a class="btn btn-outline-primary" href="ModIns.php?idIns=<?php echo $inscription["idIns"]; ?>">
                          <span class="fa fa-edit"></span>
                        </a>
                        </td>

                        <td>
                        <a class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de suprimer cet étudiant')" href="inscriptions.php?idIns=<?php echo $inscription["idIns"]; ?>">
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