<?php

if (isset($_POST['identifiant']) && isset($_POST['motdepasse'])) {
    $unsafe_identifiant =$_POST['identifiant'];
    $unsafe_motdepasse = $_POST['motdepasse'];

    require 'tp02dbpdo.php';
    $pdo = creerPDO();
    $requete_sql = "SELECT * FROM Personne WHERE Identifiant=:monidentifiant";
    $pdo_statement = $pdo->prepare($requete_sql);
    $pdo_statement->execute(['monidentifiant'=>$unsafe_identifiant]);

    //modifs
    session_start();
    session_regenerate_id();
    if ($pdo_statement->rowCount() === 1) {
        

        $ligne = $pdo_statement->fetch();
        $monhash = $ligne['MotDePasse'];

        //                   string            hash
        if (password_verify($unsafe_motdepasse, $monhash )===true) {
            /*session_start();
            session_regenerate_id();*/

            $_SESSION['Identifiant'] = $ligne['Identifiant'];
            $_SESSION['etat'] = "connecter";
           //suprrime l'État d'erreur
            unset($_SESSION['erreur']);

    /*Tous les messages d'erreur sont a effacés */
            //echo 'Identifiant et mot de passe correct.';
        }
        else {
           // echo 'l\'identifiant est correct, mais le mot de passe est incorrect.';
           /*session_start();
           session_regenerate_id();*/
           $_SESSION['erreur'] = "Erreur !";
        }
    }
    else {
       // echo 'identifiant fourni est incorrect. Le mot de passe n\'a pas été vérifié.';
       /*session_start();
       session_regenerate_id();*/
       $_SESSION['erreur'] = "Erreur !";
    }
}
else {
    //echo 'Les données passées par POST sont incorrectes.';
   /* session_start();
    session_regenerate_id();*/
    $_SESSION['erreur'] = "Erreur !";
}

//Redirection auto
header('Location: index.php');
die();

?>
