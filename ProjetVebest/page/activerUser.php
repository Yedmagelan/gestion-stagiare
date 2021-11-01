<?php
 session_start();
 if(!$_SESSION["login"]){
      header('Location: index.php');
      }

  require_once("connexionbd.php");

  if(isset($_GET["iduser"]) && isset($_GET["etat"])){
    $iduser=$_GET["iduser"];
    $etat=$_GET["etat"];
    
    if($etat==1)
    { 
        $newEtat=0;
    }else{
        $newEtat=1;
    }

    $req = $pdo->prepare("UPDATE users SET  etat=:etat WHERE iduser=:iduser");
    $resultats=$req->execute(array(
    "etat"=>$newEtat,
    "iduser"=>$iduser
    ));
   if($resultats){ 
    header('Location: index.php');
     }else{
       header('Location: index.php');
     } 
 }
?>
