<?php

if (isset($_POST['mesmodifs']) ) {
    $unsafe_modification = $_POST['mesmodifs'];
    
    session_start();
    session_regenerate_id();

    require 'tp02dbpdo.php';
    $pdo = creerPDO();
    $requete_sqlmodif = 'UPDATE Article SET Contenu=:new_contenu WHERE Id=:id_defaut';
    $pdo_statement03 = $pdo->prepare($requete_sqlmodif );
    $resultat_modif = $pdo_statement03->execute(['new_contenu' => $unsafe_modification, 'id_defaut' => 1]);

    $message="";

    if ($pdo_statement03->rowCount()==1){
        
       
        $message= '<p class="ajout">' . 'La modification a été appliqué à la BDD avec succèes.' . '</p>';
        
    }else{ 
       
       $message= '<p class="pas_ajout">' . 'Aucune modification a été appliquée!' . '</p>';
    }

    $_SESSION['etat_modif'] = $message;

    

}

header('Location: index.php');
die();

