<?php
    session_start();
    session_regenerate_id();
    $_SESSION = array();
    session_destroy();

    //Sert à rien de faire un etat=déconnecté puisqu'on supprime la session directement
   // $_SESSION['etat'] = 'deconnecter';
   header('Location: index.php');
   die();

?>
