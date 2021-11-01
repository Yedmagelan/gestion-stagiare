<?php
 session_start();
 require_once("connexionbd.php");

 require_once('../fonctions/fonctions.php');

//   Paramttre de SELECTION ou Recuperration 
 if(isset($_GET["idP"]) AND !empty($_GET['idP'])){
    $idP=$_GET["idP"];
    $requeteU="SELECT * FROM professeurs WHERE idP=$idP";
    $resultat=$pdo->query($requeteU);
    $user=$resultat->fetch();
    $nomP=$user["nomP"];
    $prenomP=$user["prenomP"];
    $email=$user["email"];
    $contact=$user["contact"];
    $idMat=$user["idMat"];

  }

 if(isset($_POST["inscription"]) AND isset($_POST["idP"])){
    $nomP=$_POST["nomP"];
    $prenomP=$_POST["prenomP"];
    $email=$_POST["email"];
    $contact=$_POST["contact"];  
    $idMat=$_POST["idMat"];
 
    $req = $pdo->prepare("UPDATE professeurs SET nomP=:nomP, prenomP=:prenomP, email=:email, contact=:contact, idMat=:idMat WHERE idP=:idP");
    $resultats=$req->execute(array(
    "nomP"=>$nomP,
    "prenomP"=>$prenomP,
    "email"=>$email,
    "contact"=>$contact,
    "idMat"=>$idMat,
    "idP"=>$idP
    ));
   if($resultats){ 
    header('Location: professeurs.php');
     }else{
       header('Location: ModProf.php');
     }
 
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
    <title> Modification Professeur </title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>




<div class="container col-md-5 col-md-offset-3 col-md-5 table1">
     <div class="panel panel-primary ">
      <div class="panel-heading text-white titre"> <h3> <strong class="text-white">Editer un Professeur</strong>  </h3>  </div>
      <p class="text-center"> Modifier son compte </p>
      <div class="panel-body"> 
      
      <form action="" method="post" class="form row">
                   
     <!-- PARTIE INFORMATION ERREUR OU DECONNEXION OU REUSSITE -->
      <!-- <?php if(!empty($_SESSION["validation"])){ ?> -->
<!--      
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
            
     <?php if(isset($_SESSION["validation"])) {echo  $_SESSION["validation"]; }else{
      echo " ";
     } ?>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>  -->
     <!-- <?php } ?> -->
     
     <div class="input-group mb-3">
        <label for="Id Etudiants"> <strong>Identifiant du Professeur : <?php echo $idP; ?></strong></label>
           <input type="hidden" name="idP" value="<?php echo $idP; ?>">
         </div> <!-- form-group// -->

     <div class="input-group mb-3">
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-user"></i> </span>
          <input name="nomP" class="form-control" placeholder="Votre nom" type="text" value="<?php echo $nomP; ?>">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-users"></i> </span>
          <input name="prenomP" class="form-control" placeholder="Votre prénom" type="text" value="<?php echo $prenomP; ?>">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
             <span class="bg-danger text-white input-group-text"> <i class="fa fa-envelope"></i> </span>
             <input name="email" class="form-control" placeholder="votre email" type="email" value="<?php echo $email; ?>">
         </div> <!-- form-group// -->

          <div class="input-group mb-3">
             <span class="bg-danger text-white input-group-text"> <i class="fa fa-phone"></i> </span>
             <input name="contact" class="form-control" placeholder="votre contact" type="tel" value="<?php echo $contact; ?>">
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
             <button class="w-100 btn btn-lg btn btn-primary" name="inscription" type="submit"> <strong><i class="fa fa-edit"></i> Modifier </strong></button>
         </div>

      </form>

      </div>
     </div>
    </div> 



<script src="../js/bootstrap.bundle.min.js"></script>    
</body>
</html>