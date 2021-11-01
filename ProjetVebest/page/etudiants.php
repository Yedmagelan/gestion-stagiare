

<?php 
 session_start();
 if(!$_SESSION["login"]){
    header('Location: ../etudiants.php');

}

 require_once('connexionbd.php');
 
// Parametre de suppression 
if(isset($_GET['idEt']))
{
    $idEt=$_GET['idEt'];
//code de suppression
$sql="DELETE FROM etudiant WHERE idEt=:idEt";
$req=$pdo->prepare($sql);
$req->bindParam(":idEt", $idEt, PDO::PARAM_INT);
$res=$req->execute();
if($res){
    header('Location: etudiants.php');
}
else{
    echo"suppression échouée";
}
}

    $requete=$pdo->prepare("SELECT * FROM etudiant");
    $requete->execute();
    $etudiants=$requete->fetchAll();

 
$selectcompter="SELECT * FROM etudiant";

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

<div class="container table1">
    <div class="bg-warning text-center text-white"> <strong> Nombre étudiants: <?php echo $nbreUtilisateur; ?> </strong> 
 &nbsp <a href="nouvelEtudiant.php" class="text-white btn btn-success"><strong><i class="fa fa-plus"></i> nouvel Etudiant</strong></a></div>
</div>
<br>
<div class="container">

<table class="table table-striped border-2">
              <thead>
                  <tr class="table-dark">
                      <th> Id Etudiant </th>
                      <th> Nom </th>
                      <th> Prenom </th>
                      <th> email </th>  
                      <th> Contact </th> 
                      <th> Pays </th> 

                      <?php if($_SESSION["role"]=="ADMIN"){ ?>
                      <th colspan="2"> Action</th> 
                      <?php } ?>
                  </tr>
              </thead>
              <tbody>
                 <?php  foreach($etudiants as $etudiants): ?>
                 
                      <td> <?php echo $etudiants["idEt"]; ?> </td>
                      <td> <?php echo $etudiants["nomEtu"]; ?></td>
                      <td> <?php echo $etudiants["prenEtu"]; ?></td>
                      <td> <?php echo $etudiants["email"]; ?></td>
                      <td> <?php echo $etudiants["contact"]; ?></td>
                      <td> <?php echo $etudiants["pays"]; ?></td>

                      <?php if($_SESSION["role"]=="ADMIN"){ ?>

                      <td>
                        <a href="ModEtu.php?idEt=<?php echo $etudiants["idEt"]; ?>" class="btn btn-outline-primary">
                          <span class="fa fa-edit"></span>
                        </a>
                        </td>

                        <td>
                        <a class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de suprimer cet étudiant')" href="etudiants.php?idEt=<?php echo $etudiants["idEt"]; ?>">
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