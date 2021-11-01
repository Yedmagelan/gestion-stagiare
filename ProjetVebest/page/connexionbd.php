<?php

      $servername="localhost";
      $username="root";
      $password="";
      // DEBUT paremettre de connexion à la base  de donnée
      try{ 
          $pdo= new PDO("mysql:host=$servername;dbname=projetvebest", $username, $password);
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         catch(PDOException $e){
             echo "Erreur : ".$e->getMessage(); 
             exit();
     }
?>