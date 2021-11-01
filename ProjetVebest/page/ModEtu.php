<?php
 session_start();
 require_once("connexionbd.php");

 require_once('../fonctions/fonctions.php');

//   Paramttre de SELECTION ou Recuperration 
 if(isset($_GET["idEt"]) AND !empty($_GET['idEt'])){
    $idEt=$_GET["idEt"];
    $requeteU="SELECT * FROM etudiant WHERE idEt=$idEt";
    $resultat=$pdo->query($requeteU);
    $user=$resultat->fetch();
    $nomEtu=$user["nomEtu"];
    $prenEtu=$user["prenEtu"];
    $email=$user["email"];
    $contact=$user["contact"];
    $pays=$user["pays"];
  }

 if(isset($_POST["inscription"]) AND isset($_POST["idEt"])){
  $nomEtu=$_POST["nomEtu"];
  $prenEtu=$_POST["prenEtu"];
  $email=$_POST["email"];
  $contact=$_POST["contact"];
  $pays=$_POST["pays"];

 
    $req = $pdo->prepare("UPDATE etudiant SET nomEtu=:nomEtu, prenEtu=:prenEtu, email=:email,contact=:contact,pays=:pays WHERE idEt=:idEt");
    $resultats=$req->execute(array(
    "nomEtu"=>$nomEtu,
    "prenEtu"=>$prenEtu,
    "email"=>$email,
    "contact"=>$contact,
    "pays"=>$pays,
    "idEt"=>$idEt
    ));
   if($resultats){ 
    header('Location: etudiants.php');
     }else{
       header('Location: ModEu.php');
     }
 
}

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
    <title> Modification étudiant </title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>




<div class="container col-md-5 col-md-offset-3 col-md-5 table1">
     <div class="panel panel-primary ">
      <div class="panel-heading text-white titre"> <h3> <strong class="text-white">Editer un Etudiant</strong>  </h3>  </div>
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
        <label for="Id Etudiants"> <strong>Identifiant de l'Etudiant : <?php echo $idEt; ?></strong></label>
           <input type="hidden" name="idEt" value="<?php echo $idEt; ?>">
         </div> <!-- form-group// -->


      <div class="input-group mb-3">
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-user"></i> </span>
          <input name="nomEtu" class="form-control" placeholder="Votre nom" type="text" value="<?php echo $nomEtu; ?>">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-users"></i> </span>
          <input name="prenEtu" class="form-control" placeholder="Votre prénom" type="text" value="<?php echo $prenEtu; ?>">
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
		<span class="bg-danger text-white input-group-text"> <i class="fa fa-arrow-left"></i> </span>
        <input name="pays" class="form-control" placeholder="Pays/Ville" type="text" value="<?php echo $pays; ?>">
        </div> 
                                    
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