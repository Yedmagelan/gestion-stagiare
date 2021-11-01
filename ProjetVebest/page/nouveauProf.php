<?php
 session_start();
 require_once("connexionbd.php");

 require_once('../fonctions/fonctions.php');

 if(isset($_POST["inscription"])){
  $nomP=$_POST["nomP"];
  $prenomP=$_POST["prenomP"];
  $email=$_POST["email"];
  $contact=$_POST["contact"];
  $idMat=$_POST["idMat"];


    $requeteP="INSERT INTO professeurs(nomP,prenomP,email,contact,idMat) VALUES(?,?,?,?,?)";
    $paramas=array($nomP,$prenomP,$email,$contact,$idMat);
    $resultat=$pdo->prepare($requeteP);
    $resultat->execute($paramas);
    header('location: professeurs.php');
   }


   // PARAMETTRE DE SELECTION DE NOUVELLE MATIERE EN PHP 
$selectFi="SELECT * FROM matiere";
$resultatM=$pdo->query($selectFi);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nouveau Professeur</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>




<div class="container col-md-5 col-md-offset-3 col-md-5 table1">
     <div class="panel panel-primary ">
      <div class="panel-heading text-white titre"> <h3>  <strong>Création d'un Nouveau Professeur</strong> </h3>  </div>
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
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-user"></i> </span>
          <input name="nomP" class="form-control" placeholder="Votre nom" type="text">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-users"></i> </span>
          <input name="prenomP" class="form-control" placeholder="Votre prénom" type="text">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
             <span class="bg-danger text-white input-group-text"> <i class="fa fa-envelope"></i> </span>
             <input name="email" class="form-control" placeholder="votre email" type="email">
         </div> <!-- form-group// -->

          <div class="input-group mb-3">
             <span class="bg-danger text-white input-group-text"> <i class="fa fa-phone"></i> </span>
             <input name="contact" class="form-control" placeholder="votre contact" type="tel">
         </div> <!-- form-group// -->
         
         <div class="input-group mb-3">
            <span class="bg-primary text-white input-group-text"> <strong>Module Formateur</strong> </span>
        <select class="form-control" name="idMat" id="idMatière">
             <option value="0"> CHOISIR....</option>
             <?php  while($matieres=$resultatM->fetch()){ ?>
             
                 <option value="<?php echo $matieres["idMat"]; ?>"
                 <?php if(isset($idMat) AND $idMat==$matieres["idMat"]){ echo "selected";} ?>>

                 <?php echo $matieres["libMat"]; ?> <?php echo $matieres["nbHmat"]; ?> H

                 </option>
             <?php } ?>
		</select>
         </div> <!-- form-group// -->
                                    
         <div class="input-group mb-3">
             <button class="w-100 btn btn-lg btn btn-primary" name="inscription" type="submit"> <strong><i class="fa fa-share-square"></i> valider </strong></button>
         </div>
   

      </form>

      </div>
     </div>
    </div> 



<script src="../js/bootstrap.bundle.min.js"></script>    
</body>
</html>