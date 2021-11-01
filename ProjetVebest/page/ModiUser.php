<?php
 session_start();
 require_once("connexionbd.php");

 require_once('../fonctions/fonctions.php');

//   Paramttre de SELECTION ou Recuperration 
 if(isset($_GET["iduser"]) AND !empty($_GET['iduser'])){
    $iduser=$_GET["iduser"];
    $requeteU="SELECT * FROM users WHERE iduser=$iduser";
    $resultat=$pdo->query($requeteU);
    $user=$resultat->fetch();
    $login=$user["login"]; 
    $mdp=$user["mdp"];
    $photo=$user["photo"];
  }

 if(isset($_POST["inscription"]) AND isset($_POST["iduser"])){
  $login=$_POST["login"];
  $mdp=$_POST["pwd"];
  $photo=$_FILES["photo"]["name"];
  $taille=strlen($login);
  
  $rechercher=rechercher_login($login);
  // DEMARCHE DEC RECUPERER DES FICHIERS VIA UN FORMULAIRE POST BINNAIRE
  $imageTemporaire=$_FILES["photo"]["tmp_name"];
  move_uploaded_file($imageTemporaire,"../img/".$photo);


  if($taille<5){
    $_SESSION["validation"]="Desolé!! Ce Login est reservé aux Administrater";
  }else{
 
    $req = $pdo->prepare("UPDATE users SET login=:login, mdp=:mdp WHERE iduser=:iduser");
    $resultats=$req->execute(array(
    "login"=>$login,
    "mdp"=>$mdp,
    "iduser"=>$iduser
    ));
   if($resultats){ 
    header('Location: ../index.php');
     }else{
       header('Location: index.php');
     }
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
         <h4 class="card-title mt-3 text-center"><strong class="text-primary">Editer un compte Utilisateur</strong></h4>
         <p class="text-center">Modifier son compte </p>

         <form action="" method="post">
         
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
           <label for="Id utilisateur"> Id d'Utilisateur : <?php echo $iduser; ?></label>
           <input type="hidden" name="iduser" value="<?php echo $iduser; ?>">
         </div> <!-- form-group// -->
     
         <div class="input-group mb-3">
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-user"></i> </span>
          <input name="login" class="form-control" placeholder="Votre login" type="text"
          value="<?php echo $login; ?>">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
             <span class="bg-danger text-white input-group-text"> <i class="fa fa-lock"></i> </span>
             <input name="pwd" class="form-control" placeholder="Creer son mot de passe" type="password"
             value="<?php echo $mdp; ?>">
             
        <div class="input-group mb-3">	
		     <span class="bg-danger text-white input-group-text"> <i class="fa fa-photo"></i> </span>
          <input name="photo" class="form-control" type="file" value="<?php echo $photo; ?>">
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