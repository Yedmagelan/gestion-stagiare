

<?php
 session_start();
 require_once("page/connexionbd.php");

   //PARAMETTRE DE DECONNEXION REUSSITE

   if(isset($_GET["action"]) AND $_GET["action"]=="infosdeco"){
    $_SESSION["erreurEmail"]="<strong> Infos !!:<strong> Merci! Vous venez de vous deconnecter et à très bientot";
    header('Location: index.php');
   }


  if(isset($_POST["enregistrer"])){

    $login=$_POST["login"];
    $mdp=$_POST["mdp"];
  
   // PARAMETTRE DE SELECTION PHP
   
   $selectuser="SELECT * FROM users WHERE login='".$login."' AND mdp='".$mdp."'";
   $resultat=$pdo->query($selectuser);
   
     if($user=$resultat->fetch()){ 
       $etat=$user["etat"];
       if($etat==1){
       $_SESSION["photo"]=$user["photo"];
       $_SESSION["iduser"]=$user["iduser"];
       $_SESSION["etat"]=$user["etat"];
       $_SESSION["role"]=$user["role"];
       $_SESSION["login"]=$user["login"];
       $_SESSION["mdp"]=$user["mdp"];
       header('Location: page/etudiants.php');

      }else{
        $_SESSION["erreurEmail"]="<strong>Erreur!!:<strong> Votre Compte est desactivé, Veillez conctacter l'administrateur";
        header('Location: index.php');
       }
      }else{
        $_SESSION["erreurEmail"]="<strong>Erreur!!:<strong>Votre login ou mot de passe est incorrect";
       header('Location: index.php');
       }          

  }
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Se connecter  </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/connexion.css" rel="stylesheet">
</head>
<body class="text-center">

<form action="" method="post" class="form-signin">

  <div class="authen bg-primary"><h1 class="h2"><strong>ATHENTIFICATION</strong></h1></div>

<!-- PARTIE INFORMATION ERREUR OU DECONNEXION OU REUSSITE -->
  <?php if(!empty($_SESSION["erreurEmail"]) AND isset($_SESSION["erreurEmail"])){ ?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
       
<?php if(isset($_SESSION["erreurEmail"])) {echo  $_SESSION["erreurEmail"]; }else{
 echo " ";
} ?>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php } ?>
<!-- PARTIE INFORMATION ERREUR OU DECONNEXION OU REUSSITE -->

<div class="input-group mb-3">
	<span class="bg-danger text-white input-group-text"><i class="fa fa-user"></i></span>
  <input type="text" id="inputlogin" name="login" class="form-control input_login" placeholder="Inserez votre login" required autofocus>
</div>

<div class="input-group mb-3">
  <span class="bg-danger text-white input-group-text"><i class="fa fa-lock"></i></span>
  <input type="password" name="mdp" class="form-control input_pass" placeholder="Inserez votre mot de passe" required>
</div>
<hr>

<div class="input-group mb-3">
    <button name="enregistrer" class="w-100 btn btn-lg bouton" type="submit"> <strong><i class="fa fa-share-square"></i> Se connecter </strong></button>
</div> 
  <p class="mt-5 mb-3 text-muted">&copy; Gestion vebest</p>
</form>

<script src="js/bootstrap.bundle.min.js"></script>    
</body>
</html>
