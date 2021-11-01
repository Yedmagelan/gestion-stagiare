

<?php 
 session_start();
 if(!$_SESSION["login"]){
    header('Location: ../index.php');
}

 require_once('connexionbd.php');
 
// Parametre de suppression 
if(isset($_GET['iduser']))
{
    $iduser=$_GET['iduser'];
//code de suppression
$sql="DELETE FROM users WHERE iduser=:iduser";
$req=$pdo->prepare($sql);
$req->bindParam(":iduser", $iduser, PDO::PARAM_INT);
$res=$req->execute();
if($res){
    header('Location: index.php');
}
else{
    echo"suppression échouée";
}
}
// PARAMETRE DE SELECTION DE MA PAGE
if(isset($_POST["rechercher"])) {
    $email=$_POST['login'];
}else{
    $email=""; 
}
 
$taille=isset($_GET['taille'])?$_GET['taille']:6;
$page=isset($_GET['page'])?$_GET['page']:1;
$offset=($page-1)*$taille;

 $selectUser="SELECT * FROM users  WHERE login like '%$login%' limit $taille offset $offset";
 $selectcompter="SELECT * FROM users";
 //paramettre d'execution utilisateur 
 $resultatUser=$pdo->query($selectUser);
 
 //paramettre d'execution Pour le Nombre de Stagiaire
 $resultatCount=$pdo->query($selectcompter);
 $nbreUtilisateur=$resultatCount->rowCount();

 $reste=$nbreUtilisateur%$taille;
 if($reste==0){
     $nbrePage=$nbreUtilisateur/$taille;
 }else{
     $nbrePage=floor($nbreUtilisateur/$taille)+1;
 }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil --- Gestion Vebest Group </title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/cese.css" rel="stylesheet">
</head>
<body>
<?php include('menu.php'); ?>

<div class="container table1">
    <div class="bg-warning text-center text-white"> <strong> Nombre Utilisateurs: <?php echo $nbreUtilisateur; ?> </strong> 
 &nbsp <a href="ajoutUser.php" class="text-white btn btn-success"><strong><i class="fa fa-plus"></i> Nouvel User</strong></a></div>
</div>
<br>
<div class="container">

<table class="table table-dark table-borderless">
              <thead>
                  <tr>
                      <th> Id Utilisateurs </th>
                      <th> Login </th> 
                      <th> Role </th>
                      <th> Photo </th>
                      <th colspan="2"> Action</th> 
                      <th> Activer/Desactiver</th>
                  </tr>
              </thead>
              <tbody>
                 <?php while($utilisateur=$resultatUser->fetch()){ ?>
                    <tr class="<?php echo $utilisateur["etat"]==1?'table-success':'table-danger'; ?>">
                      <td> <?php echo $utilisateur["iduser"] ?> </td>
                      <td> <?php echo $utilisateur["login"] ?></td>
                      <td> <?php echo $utilisateur["role"] ?></td>
                      <td>
                       <img src="../img/<?php echo $utilisateur["photo"]; ?>"
                        width="50px" heigth="50px" class="img-circle">
                        </td>
                      <td>
                        <a class="btn btn-outline-primary" href="ModiUser.php?iduser=<?php echo $utilisateur["iduser"]; ?>">
                          <span class="fa fa-edit"></span>
                        </a>
                        </td>

                        <td>
                        <a class="btn btn-outline-danger" onclick="return confirm('Etes-vous sur de suprimer cet utilisateur')" href="index.php?iduser=<?php echo $utilisateur["iduser"]; ?>">
                          <span class="fa fa-trash"></span>
                      </a>
                      </td>

                      <td class="text-center">
  <a class="btn btn-outline-success" href="activerUser.php?iduser=<?php echo $utilisateur["iduser"]; ?>&etat=<?php echo $utilisateur["etat"]; ?>">
                      <?php
                           if($utilisateur["etat"]==1){
                               echo '<span class="fa fa-remove"></span>';
                           }else{
                               echo '<span class="fa fa-check"></span>';
                           }
                      ?>
                      </a>
                      </td>
                    </tr>
                 <?php } ?>
              </tbody>
 </table>

</div>               




<script src="../js/bootstrap.bundle.min.js"></script>    
</body>
</html>