<?php
 session_start();
 require_once("connexionbd.php");

 require_once('../fonctions/fonctions.php');


 if(isset($_POST["inscription"])){
  $libMat=$_POST["libMat"];
  $nbHmat=$_POST["nbHmat"];
  $idP=$_POST["idP"];

  $requeteF="INSERT INTO matiere(libMat,nbHmat,idP) VALUES(?,?,?)";
  $paramas=array($libMat,$nbHmat,$idP);
  $resultat=$pdo->prepare($requeteF);
  $resultat->execute($paramas);
  header('location: matieres.php');
 
}

// PARAMETTRE DE SELECTION PHP 
$selectFi="SELECT * FROM professeurs";
$resultatP=$pdo->query($selectFi);

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
      <div class="panel-heading text-white titre"> <h3> <strong class="text-white">Editer Une Matière </strong>  </h3>  </div>
      <p class="text-center"> Modifier Sa Matière </p>
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
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-user"></i> </span>
          <input name="libMat" class="form-control" placeholder="Module de l'enseignemnt" type="text" ?>
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
           <span class="bg-danger text-white input-group-text"> <i class="fa fa-users"></i> </span>
          <input name="nbHmat" class="form-control" placeholder="Nombre d'Heure" type="text" ?>
         </div> <!-- form-group// -->
             
         <div class="input-group mb-3">
            <span class="bg-primary text-white input-group-text"> <strong>Formateur</strong> </span>
            <select class="form-control" name="idP" id="idProfesseur">
             <option value="0"> CHOISIR....</option>
              <?php  while($professeurs=$resultatP->fetch()){ ?>
             
                 <option value="<?php echo $professeurs["idP"]; ?>"
                 <?php if(isset($idP) AND $idP==$professeurs["idP"]){ echo "selected";} ?>>

                 <?php echo $professeurs["nomP"]; ?> <?php echo $professeurs["prenomP"]; ?>

                 </option>
              <?php } ?>
		       </select>
         </div> <!-- form-group// -->
                                    
         <div class="input-group mb-3">
             <button class="w-100 btn btn-lg btn btn-primary" name="inscription" type="submit"> <strong><i class="fa fa-edit"></i> Valider </strong></button>
         </div>
      </form>

      </div>
     </div>
    </div> 



<script src="../js/bootstrap.bundle.min.js"></script>    
</body>
</html>