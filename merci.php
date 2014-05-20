

<?php







// COMPTEUR AUGMENTE

//if(file_exists('compteur.txt')){} // pas besoin de verifier l'existence du fichier

session_start();


// OUVRE LE FICHIER COMPTEUR
$compteur_file = fopen('compteur.txt', 'r+'); 
$compteur = fgets($compteur_file);




// EMPECHE LE RENVOI DES DONNEES PAR UN REDIRECTION
if(!empty($_POST) OR !empty($_FILES))
{
    // sauvegarde des infos du formulaires
    $_SESSION['sauvegarde'] = $_POST ;
    $_SESSION['sauvegardeFILES'] = $_FILES ;
    
    $fichierActuel = $_SERVER['PHP_SELF'] ;
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ;
    }

    // on augmente le compteur
    $compteur = $compteur + 1;
    fseek($compteur_file, 0);
    fputs($compteur_file, $compteur);




    // ECRITURE DE LA NOUVELLE ENTREE DANS LE CSV

    // recupere les post du formulaire et on les rends inoffensifs
    $firstname = htmlspecialchars($_POST['FNAME']);
    $lastname = htmlspecialchars($_POST['LNAME']);
    $email = htmlspecialchars($_POST['EMAIL']);

    // newsletter true false
    //if(strcmp($optin, "on") == 0)
    if(isset($_POST['OUI']))
    {
        $optin = "true";
    } else {
        $optin = "false";
    }

    // OUVRIR LE CSV
    $signature_file = fopen('signatures.csv', 'a+');
        
    // ECRIRE DANS LE CSV
    $nouvelleEntree = $firstname.','.$lastname.','.$email.',petition,fr,'.$optin;
    fwrite($signature_file, $nouvelleEntree."\n");

    // FERMER LE CSV
    fclose($signature_file);




    // redirection vers le meme fichier (empeche le renvoi)
    header('Location: ' . $fichierActuel);
    exit;

}

if(isset($_SESSION['sauvegarde']))
{
    $_POST = $_SESSION['sauvegarde'] ;
    $_FILES = $_SESSION['sauvegardeFILES'] ;
    
    unset($_SESSION['sauvegarde'], $_SESSION['sauvegardeFILES']);

}






fclose($compteur_file);



    
  



?>


<!DOCTYPE>
<html>

    <head>
            <title>Merci</title>
            <meta charset="utf-8">
            <link rel='stylesheet' type='text/css' href='style.css' >
    </head>
    <body>


        <section>
            <h1>Merci pour votre signature</h1>
            <p>Deja <?php echo $compteur; ?> signature(s)</p>
        </section>




    </body>
</html>

