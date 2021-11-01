<?php
 session_start();
 require_once("connexionbd.php");

 require_once('../fonctions/fonctions.php');

 if(isset($_POST["inscription"])){
  $login=$_POST["login"];
  $mdp=$_POST["pwd1"];
  $mdp1=$_POST["pwd2"];
  $photo=$_FILES["photo"]["name"];

      $rechercher=rechercher_login($login);
      // DEMARCHE DEC RECUPERER DES FICHIERS VIA UN FORMULAIRE POST BINNAIRE
      $imageTemporaire=$_FILES["photo"]["tmp_name"];
      move_uploaded_file($imageTemporaire,"../img/".$photo);

  if($rechercher>=1){
    $_SESSION["validation"]="Desolé!! Cet login existe dejà";
  }elseif($mdp==$mdp1){
    $requeteF="INSERT INTO users(login,mdp,etat,photo) VALUES(?,?,?,?)";
    $paramas=array($login,$mdp,0,$photo);
    $resultat=$pdo->prepare($requeteF);
    $resultat->execute($paramas);
    header('location: index.php');
   }else{
     $_SESSION["validation"]="Desolé!! Vos mots de passe ne sont pas identiques";
   }

 
}

?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nouvel Utilisateur</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>

<div class="container table1">
     
     <div class="card bg-light">
     <article class="card-body mx-auto" style="max-width: 400px;">
         <h4 class="card-title mt-3 text-center"><strong class="text-primary">Créer un compte Utilisateur</strong></h4>
         <p class="text-center">Otenir un nouveau compte </p>

         <form action="" method="post" enctype="multipart/form-data">
         
          <!-- PARTIE INFORMATION ERREUR OU DECONNEXION OU REUSSITE -->
      <?php if(!empty($_SESSION["validation"])){ ?>
     
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
            
     <?php if(isset($_SESSION["validation"])) {echo  $_SESSION["validation"]; }else{
      echo " ";
     } ?>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>
     <?php } ?>
     <!-- PARTIE INFORMATION ERREUR OU DECONNEXION OU REUSSITE -->
     
         <div class="input-group mb-3">
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-user"></i> </span>
          <input name="login" class="form-control" placeholder="Votre login" type="text">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
             <span class="bg-danger text-white input-group-text"> <i class="fa fa-lock"></i> </span>
             <input name="pwd1" class="form-control" placeholder="Creer son mot de passe" type="password">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">	
		     <span class="bg-danger text-white input-group-text"> <i class="fa fa-lock"></i> </span>
          <input name="pwd2" class="form-control" placeholder="Repeter mot de passe" type="password">
        </div> <!-- form-group// -->

        <div class="input-group mb-3">	
		     <span class="bg-danger text-white input-group-text"> <i class="fa fa-photo"></i> </span>
          <input name="photo" class="form-control" type="file">
        </div> <!-- form-group// -->
                                    
         <div class="input-group mb-3">
             <button class="w-100 btn btn-lg btn btn-danger" name="inscription" type="submit"> <strong><i class="fa fa-share-square"></i> valider</strong></button>
         </div> <!-- form-group// -->                                                                      
     </form>
     </article>
     </div> <!-- card.// -->
     
     </div> 
     <!--container end.//-->
     



<script src="../js/bootstrap.bundle.min.js"></script>    
</body>
</html>