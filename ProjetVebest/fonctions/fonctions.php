<?php 
 function rechercher_login($login){
    global $pdo;
    $requete=$pdo->prepare("SELECT * FROM users WHERE login=?");
    $requete->execute(array($login));
    $nbr=$requete->rowCount();
    return $nbr;
 }

 function rechercher_email($email){
    global $pdo;
    $requete=$pdo->prepare("SELECT * FROM users WHERE email=?");
    $requete->execute(array($email));
    $nbr=$requete->rowCount();
    return $nbr;
 }

 function rechercher_id($login){
   global $pdo;
   $requete=$pdo->prepare("SELECT * FROM users WHERE login=?");
   $requete->execute(array($email));
   $id=$requete->fetch();
   $iduser=$id["iduser"];
   return $iduser;
}

 function etudiants(){
   global $pdo;
   $requete=$pdo->prepare("SELECT etudiant.*, matiere.libMat FROM etudiant INNER JOIN matiere ON etudiant.idEt = matiere.idMat");
   $requete->execute();
   $requete=$requete->fetchAll();
   return $requete;
}






?>