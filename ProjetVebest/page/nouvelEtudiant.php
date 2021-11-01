<?php
 session_start();
 require_once("connexionbd.php");

 require_once('../fonctions/fonctions.php');

 if(isset($_POST["inscription"])){
  $nomEtu=$_POST["nomEtu"];
  $prenEtu=$_POST["prenEtu"];
  $email=$_POST["email"];
  $contact=$_POST["contact"];
  $pays=$_POST["pays"];

    $requeteF="INSERT INTO etudiant(nomEtu,prenEtu,email,contact,pays) VALUES(?,?,?,?,?)";
    $paramas=array($nomEtu,$prenEtu,$email,$contact,$pays);
    $resultat=$pdo->prepare($requeteF);
    $resultat->execute($paramas);
    header('location: etudiants.php');
   }

 
// PARAMETTRE DE SELECTION PHP 
$selectFi="SELECT * FROM matiere";
$resultatF=$pdo->query($selectFi);

?>
<?php
if(isset($_GET["$i"])){
  $i=$_GET["$i"];
  $active="active";
  if($i==1){
    echo $active;
  }

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nouvel Etudiant</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>




<div class="container col-md-5 col-md-offset-3 col-md-5 table1">
     <div class="panel panel-primary ">
      <div class="panel-heading text-white titre"> <h3>  <strong>Création d'un Nouvel Etudiant</strong> </h3>  </div>
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
          <input name="nomEtu" class="form-control" placeholder="Votre nom" type="text">
         </div> <!-- form-group// -->
         <div class="input-group mb-3">
             <span class="bg-danger text-white input-group-text"> <i class="fa fa-envelope"></i> </span>
             <input name="prenEtu" class="form-control" placeholder="votre prenom" type="text">
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
		<span class="bg-danger text-white input-group-text"> <i class="fa fa-arrow-left"></i> </span>
        <input name="pays" class="form-control" placeholder="Pays/Ville" type="text">
        </div> 
                                    
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