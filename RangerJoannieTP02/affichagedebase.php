
<?php

require 'tp02dbpdo.php';
    $pdoArticle = creerPDO();
                                                        //sinon directement = 1, mais j'ai préféré le garder ainsi.
    $requete_sql_article = "SELECT * FROM Article WHERE Id=:idArticle";
    $pdo_statement_article = $pdoArticle->prepare($requete_sql_article);
    $pdo_statement_article->execute(['idArticle'=>1]);  //et ici je n'aurais pas eu besoin de faire le =>1

     if ($pdo_statement_article->rowCount() === 1) {

        session_start();
        session_regenerate_id();

        $Article01 = $pdo_statement_article->fetch();

        $_SESSION['article_entete']= $Article01['Entete'];
        $_SESSION['article_contenu']= $Article01['Contenu'];
        $_SESSION['article_pied'] = $Article01['Pied'];
        
    }
    
?>
