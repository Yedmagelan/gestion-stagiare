<?php
 session_start();
 require_once("connexionbd.php");

 require_once('../fonctions/fonctions.php');

 if(isset($_POST["inscription"])){
  $libInscript=$_POST["libInscript"];
  $dateIns=$_POST["dateIns"];
  $idMat=$_POST["idMat"];
  $periode=$_POST["periode"];
  $idEt=$_POST["idEt"];

    $requeteF="INSERT INTO inscription(dateIns,idMat,periode,libInscript,idEt) VALUES(?,?,?,?,?)";
    $paramas=array($dateIns,$idMat,$periode,$libInscript,$idEt);
    $resultat=$pdo->prepare($requeteF);
    $resultat->execute($paramas);
    header('location: inscriptions.php');
   }

 
// PARAMETTRE DE SELECTION PHP 
$selectFi="SELECT * FROM matiere";
$resultatF=$pdo->query($selectFi);

$selectEt="SELECT * FROM etudiant";
$resultatET=$pdo->query($selectEt);


?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nouvelle Inscription</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>




<div class="container col-md-5 col-md-offset-3 col-md-5 table1">
     <div class="panel panel-primary ">
      <div class="panel-heading text-white titre"> <h3>  <strong>Faire Une Nouvelle Inscription</strong> </h3>  </div>
      <div class="panel-body"> 
      
      <form action="" method="post" class="form row">
                    
     <!-- PARTIE INFORMATION ERREUR OU DECONNEXION OU REUSSITE -->
     <!--
      <?php if(!empty($_SESSION["validation"])){ ?>
     
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
            
     <?php if(isset($_SESSION["validation"])) {echo  $_SESSION["validation"]; }else{
      echo " ";
     } ?>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
     <?php } ?>
        -->
      <div class="input-group mb-3">
         
          <input name="libInscript" class="form-control" placeholder="Type d'Inscription" type="text">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
            <span class="bg-primary text-white input-group-text"> <strong> Etudiant en question</strong> </span>
        <select class="form-control" name="idEt" id="idetudiant">
             <option value="0"> CHOISIR....</option>
             <?php  while($etudiants=$resultatET->fetch()){ ?>
             
                 <option value="<?php echo $etudiants["idEt"]; ?>"
                 <?php if(isset($idEt) AND $idEt==$etudiants["idEt"]){ echo "selected";} ?>>

                 <?php echo $etudiants["nomEtu"]." ".$etudiants["prenEtu"]; ?> 

                 </option>
             <?php } ?>
		</select>
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
            <span class="bg-primary text-white input-group-text"> <strong>Module</strong> </span>
        <select class="form-control" name="idMat" id="idMatière">
             <option value="0"> CHOISIR....</option>
             <?php  while($matieres=$resultatF->fetch()){ ?>
             
                 <option value="<?php echo $matieres["idMat"]; ?>"
                 <?php if(isset($idMat) AND $idMat==$matieres["idMat"]){ echo "selected";} ?>>

                 <?php echo $matieres["libMat"]; ?> <?php echo $matieres["nbHmat"]; ?> H

                 </option>
             <?php } ?>
		</select>
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
           <span class="bg-danger text-white input-group-text"> Date </span>
          <input name="dateIns" class="form-control" placeholder="Votre prénom" type="date">
         </div> <!-- form-group// -->
              

         <div class="input-group mb-3">
             <span class="bg-danger text-white input-group-text"> Peride </span>
             <input name="periode" class="form-control" placeholder="exple de 11-JUILLET à 13-Mai" type="text">

                                    
         <div class="input-group mb-3">
             <button class="w-100 btn btn-lg btn btn-primary" name="inscription" type="submit"> <strong><i class="fa fa-share-square"></i> valider</strong></button>
         </div>


      </form>

      </div>
     </div>
    </div> 



<script src="../js/bootstrap.bundle.min.js"></script>    
</body>
</html>