

<?php
 session_start();
 require_once("pages/connexionbd.php");

 require_once('fonctions/fonctions.php');

 if(isset($_POST["inscription"])){
  $login=$_POST["login"];
  $email=$_POST["email"];
  $pwd=$_POST["pwd1"];
  $pwd1=$_POST["pwd2"];
  $rechercher=rechercher_email($email);

  if($rechercher>=1){
    $_SESSION["validation"]="Desolé!! Cet email existe dejà";
  }elseif($pwd==$pwd1){
    $requeteF="INSERT INTO utilisateur(login, email, etat, role, pwd) VALUES(?,?,?,?,?)";
    $paramas=array($login,$email,0,"VISITEUR",$pwd);
    $resultat=$pdo->prepare($requeteF);
    $resultat->execute($paramas);
    header('location: connexion.php');
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
    <title> Inscription   </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/cese.css" rel="stylesheet">
</head>
<body>
 

 <div class="container">
     
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center"><strong class="text-danger">Creer son compte</strong></h4>
	<p class="text-center">Otenir un nouveau compte </p>

	<p class="row">
        &nbsp<a href="" class="col-4 btn btn-info btn-twitter"> <strong><i class="fa fa-twitter"></i> Page twitter</strong></a>
		&nbsp <a href="" class="col-3 btn btn-primary btn-facebook"> <strong><i class="fa fa-facebook-f"></i>  Page facook</strong> </a>
        &nbsp<a href="" class="col-4 btn btn-danger btn-facebook"> <strong><i class="fa fa-youtube"></i>  chaine youtube</strong> </a>
	</p>
	<p class="text-center">
        <span class="bg-light">OU</span>
    </p>
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
      <span class="bg-danger text-white input-group-text"> <i class="fa fa-user"></i> </span>
     <input name="login" class="form-control" placeholder="Votre login" type="text">
    </div> <!-- form-group// -->
    <div class="input-group mb-3">
		<span class="bg-danger text-white input-group-text"> <i class="fa fa-envelope"></i> </span>
        <input name="email" class="form-control" placeholder="Votre adresse email" type="email">
    </div> <!-- form-group// -->

    <div class="input-group mb-3">
         <span class="bg-danger text-white input-group-text"> <i class="fa fa-phone"></i></span>
    	<input name="tel" class="form-control" placeholder="exemple:+22507000000" type="text">
    </div> <!-- form-group// -->

    <div class="input-group mb-3">
		<span class="bg-danger text-white input-group-text"> <i class="fa fa-building"></i> </span>
		<select class="form-control">
			<option name="sexe" selected=""> Sexe</option>
			<option>Femme</option>
			<option>Homme</option>
		</select>
	</div> <!-- form-group end.// -->

    <div class="input-group mb-3">
        <span class="bg-danger text-white input-group-text"> <i class="fa fa-lock"></i> </span>
        <input name="pwd1" class="form-control" placeholder="Creer son mot de passe" type="password">
    </div> <!-- form-group// -->

    <div class="input-group mb-3">	
		<span class="bg-danger text-white input-group-text"> <i class="fa fa-lock"></i> </span>
        <input name="pwd2" class="form-control" placeholder="Repeter mot de passe" type="password">
    </div> <!-- form-group// -->
                                        
    <div class="input-group mb-3">
        <button class="w-100 btn btn-lg btn btn-danger" name="inscription" type="submit"> <strong><i class="fa fa-share-square"></i> valider</strong></button>
    </div> <!-- form-group// -->      
    <p class="text-center"> Avez-vous déja un compte? <a href="connexion.php">se connecter</a></p>                                                                 
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

<br><br>
<article class="bg-danger mb-3">  
<div class="card-body text-center">
    <h3 class="text-white mt-3"><strong> Les Enfants du Saint Esprit </strong> </h3>
<p class="h5 text-white"> Communauté Chrétienne,<br>en Mission d'<strong>Evangéliser </strong>le monde et <strong>Réevangéliser</strong>
les chrétiens en vue de l'Eveil Spirituel; et susciter au sein de l'Eglise notre Mère, et du monde une 
nouvelle race de Chrétienne.
</p>   <br>
<p><a class="btn btn-warning" target="_blank" href="index.php"><strong class="text-white">Visitons notre Site</strong>  
 <i class="fa fa-window-restore "></i></a></p>
</div>
<br><br>
</article>



<script src="js/bootstrap.bundle.min.js"></script>    
</body>
</html>
