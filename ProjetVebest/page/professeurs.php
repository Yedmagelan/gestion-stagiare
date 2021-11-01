

<?php 
 session_start();
 if(!$_SESSION["login"]){
    header('Location: ../index.php');

}

 require_once('connexionbd.php');
 
// Parametre de suppression 
if(isset($_GET['idP']))
{
    $idP=$_GET['idP'];
//code de suppression
$sql="DELETE FROM professeurs WHERE idP=:idP";
$req=$pdo->prepare($sql);
$req->bindParam(":idP", $idP, PDO::PARAM_INT);
$res=$req->execute();
if($res){
    header('Location: professeurs.php');
}
else{
    echo"suppression échouée";
}
}
//    PARAMETTRE DE SELECTION DE TOUS LES CHAMPS DE LA TABLE PROF ET  LES LIBELLEES DE LA TABLE MATIERE OU Identifiant CORRESPOND 

/*     $requete=$pdo->prepare("SELECT professeurs.*, matiere.libMat FROM professeurs INNER JOIN matiere ON professeurs.idMat = matiere.idMat");
    $requete->execute();
    $professeur=$requete->fetchAll(); */

 
$selectcompter="SELECT * FROM professeurs";
$resultatProf=$pdo->query($selectcompter);
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
    <title>Accueil professeurs--- Gestion Vebest Group </title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>

<div class="container table1">

<?php if($_SESSION["role"]=="ADMIN"){ ?> 
    <div class="bg-warning text-center text-white"> <strong>Nombres Professeurs: <?php echo $nbreUtilisateur; ?> </strong> 
 &nbsp <a href="nouveauProf.php" class="text-white btn btn-success"><strong><i class="fa fa-plus"></i> Nouveau Prof</strong></a>
 </div>
 <?php } ?>  
</div>
<br>
<div class="container">

<table class="table table-striped">
              <thead>
                  <tr class="table-dark">
                      <th> Identifiant Prof </th>
                      <th> Nom </th>
                      <th> Prenom </th>
                      <th> email </th>  
                      <th> Contact </th> 
                     <!--  <th> Module à Enseigner </th>  -->
                     <?php if($_SESSION["role"]=="ADMIN"){ ?> 
                      <th colspan="2"> Action</th> 
                     <?php } ?> 
                  </tr>
              </thead>
              <tbody>
              <?php while($professeur=$resultatProf->fetch()): ?>
                 
                      <td> <?php echo $professeur["idP"]; ?> </td>
                      <td> <?php echo $professeur["nomP"]; ?></td>
                      <td> <?php echo $professeur["prenomP"]; ?></td>
                      <td> <?php echo $professeur["email"]; ?></td>
                      <td> <?php echo $professeur["contact"]; ?></td>

                      <?php if($_SESSION["role"]=="ADMIN"){ ?> 

                      <td>
                        <a class="btn btn-outline-primary" href="ModProf.php?idP=<?php echo $professeur["idP"]; ?>">
                          <span class="fa fa-edit"></span>
                        </a>
                        </td>

                        <td>
                        <a class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de suprimer ce Professeur')" href="professeurs.php?idP=<?php echo $professeur["idP"]; ?>">
                          <span class="fa fa-trash"></span>
                      </a>
                      </td>
                      <?php } ?>
                    </tr>
                   <?php endwhile; ?>
              </tbody>
 </table>

</div>               




<script src="../js/bootstrap.bundle.min.js"></script>    
</body>
</html>