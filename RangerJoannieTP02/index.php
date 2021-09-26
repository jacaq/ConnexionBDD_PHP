<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentification</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<article>
<?php include 'affichagedebase.php';?>
<?php
    if (isset($_SESSION['etat']  )):{
        //(AU DEUXIÈME TOUR QUAND "ETAT" est DÉFINIT)
        //affichage pour modification:
        if ($_SESSION['etat'] === "connecter"){
            /*form MODIFICATION*/
            echo '<form class="modify" method="POST" action="modification.php">';
            echo '<header>' . $_SESSION['article_entete'] . '</header>';
            echo '<textarea rows="20" cols="125" name="mesmodifs" >'.  htmlspecialchars($_SESSION['article_contenu']).'</textarea>';
            echo  '<p>'.'<input type="submit" value="Soumettre les modifications"  /> </p></form>';
            if(isset($_SESSION['etat_modif'])) {
                echo $_SESSION['etat_modif'];//'<p class="ajout">' . $_SESSION['etat_modif'] . '</p>';
            }    
            //FOOTER
            echo '<footer>' . $_SESSION['article_pied'] . '</footer>';
        }
           

    
    }   else :{
            //Affichage de base (PREMIERE CHOSE QUI EST FAIT)
            if (isset($_SESSION['article_entete'],$_SESSION['article_contenu'],$_SESSION['article_pied'])) : {
                //Affichage du premier article:    
                echo '<header>' . $_SESSION['article_entete'] . '</header>';
                echo '<p>' . htmlspecialchars($_SESSION['article_contenu']) . '</p>';
                echo '<footer>' . $_SESSION['article_pied'] . '</footer>';

        }
     endif; 
    } 
    endif;
    ?>

</article>
<?php 
    if (isset($_SESSION['etat']  )):{

        if ($_SESSION['etat'] === "connecter"){
            //Form pour la déconnexion
            echo '<form method="get" action="deconnexion.php"> ';
            echo '<p>Bonjour ' . $_SESSION['Identifiant'] . '</p>';
            echo '<input type="submit" value="Déconnexion" /> 
            </form>';
            
        }/* else {
            //Les donnée de session sont supprimé donc pas besion de faire quoique ce soit. 
            //echo 'wow ca marche t\'es déconnecté';
            
        }*/

    }else :{
        //Si le $_session['etat'] n'est pas définit on passe par ici.
        //Puisque la déconexion supprime la session en cours on revient automatiquement à ici.
        if (isset( $_SESSION['erreur'] ) ):{
            $message_erreur = '<p class="erreur" >' . $_SESSION['erreur'] . '</p>' ;
        }else:{
            $message_erreur =""; 
        } 
        endif;
        //Formulaire de connexion
        echo '<form method="post" action="connexion.php">';
            echo $message_erreur;
            echo '
            <p>
                <label for="identifiant">Identifiant : </label>
            </p>
            <p>
                <input type="text" name="identifiant" id="identifiant" />
            </p>
            <p>
                <label for="motdepasse">Mot de passe : </label>
                </p>
                <p>
                <input type="password" name="motdepasse" id="motdepasse" />
                </p>
            <input type="submit" value="Connexion" />
            </form> ';
    }
    
    endif;
?>
</body>
</html>