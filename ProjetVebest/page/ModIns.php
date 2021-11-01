<?php
 session_start();
 require_once("connexionbd.php");

 require_once('../fonctions/fonctions.php');

//   Paramttre de SELECTION ou Recuperration 
 if(isset($_GET["idIns"]) AND !empty($_GET['idIns'])){
    $idIns=$_GET["idIns"];
    $requeteU="SELECT * FROM inscription WHERE idIns=$idIns";
    $resultat=$pdo->query($requeteU);
    $user=$resultat->fetch();
    $libInscript=$user["libInscript"];
    $dateIns=$user["dateIns"];
    $idMat=$user["idMat"];
    $periode=$user["periode"];
    $idEt=$user["idEt"];
  }

 if(isset($_POST["inscription"]) AND isset($_POST["idIns"])){
  $libInscript=$_POST["libInscript"];
  $dateIns=$_POST["dateIns"];
  $idMat=$_POST["idMat"];
  $periode=$_POST["periode"];
  $idEt=$_POST["idEt"];
  

 
    $req = $pdo->prepare("UPDATE inscription SET libInscript=:libInscript, dateIns=:dateIns, idMat=:idMat, periode=:periode,
    idEt=:idEt  WHERE idIns=:idIns");
    $resultats=$req->execute(array(
    "libInscript"=>$libInscript,
    "dateIns"=>$dateIns,
    "idMat"=>$idMat,
    "periode"=>$periode,
    "idEt"=>$idEt,
    "idIns"=>$idIns
    ));
   if($resultats){ 
    header('Location: inscriptions.php');
     }else{
       header('Location: ModIns.php');
     }
 
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
        <label for="Id Etudiants"> <strong>Identifiant de l'Etudiant : <?php echo $idIns; ?></strong></label>
           <input type="hidden" name="idIns" value="<?php echo $idIns; ?>">
         </div> <!-- form-group// -->

         <div class="input-group mb-3">
         
         <input name="libInscript" class="form-control" placeholder="Type d'Inscription" type="text" value="<?php echo $libInscript; ?>">
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
         <input name="dateIns" class="form-control" placeholder="Votre prénom" type="date" value="<?php echo $dateIns; ?>">
        </div> <!-- form-group// -->
             

        <div class="input-group mb-3">
            <span class="bg-danger text-white input-group-text"> Peride </span>
            <input name="periode" class="form-control" placeholder="exple de 11-JUILLET à 13-Mai" type="text" value="<?php echo $periode; ?>">

                   
                                    
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