<?php
session_start();
if(isset($_GET["action"]) AND $_GET["action"]=="sedeconnecter"){
    session_destroy();
    header('Location:../index.php?action=infosdeco');
}
?>