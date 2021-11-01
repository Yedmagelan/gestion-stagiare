

<?php 
 session_start();
 if(!$_SESSION["login"]){
    header('Location: ../index.php');
}

 require_once('connexionbd.php');
 

?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil --- Gestion Vebest Group </title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>
<div class="container table1 col-lg-7 col-lg-offset-4 col-md-6 col-md-offset-3">
<div class="row bg-secondary">
<div class="col-md-12 bg-dark text-white text-center"> <h3><strong class="bg-primary">MON PROFIL</strong></h3> </div>
<br>
<div class="col-md-12"><h4> Nom: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <i class="text-white"><?php echo $_SESSION["login"];?> </i> </h4></div>
<hr>
<div class="col-md-12"><h4> Mon Role: &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <i class="text-white"><?php echo $_SESSION["role"]; ?></i> </h4></div>
<hr>
<div class="col-md-12"><h4> Mot de Passe: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <i><?php echo $_SESSION["mdp"]; ?></i> </h4></div>
<hr>
<div class="col-md-12 bg-info"><h4> <u>Photo de profil:</u> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<img src="../img/<?php echo $_SESSION["photo"]; ?>" alt="logo communautaire" width="100" height="100">  </h4></div>
<hr>
<div class="col-md-12 text-end"> <a href="ModiUser.php?iduser=<?php echo $_SESSION["iduser"]; ?>" class="btn btn-outline-primary"> <strong> Modifier Mon Profil </strong> </a> </div>
<div class="col-md-12  text-center"> <u class="text-white">Gestion Vebest</u></div>
</div>
</div>



<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>