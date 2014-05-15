<!DOCTYPE>
<html>

    <head>
            <title>Merci</title>
            <meta charset="utf-8">
            <link rel='stylesheet' type='text/css' href='style.css' >
    </head>
    <body>



		<h1>Merci pour votre signature</h1>


<?php



$firstname = htmlspecialchars($_POST['FNAME']);
$lastname = htmlspecialchars($_POST['LNAME']);
$email = htmlspecialchars($_POST['EMAIL']);
$optin = htmlspecialchars($_POST['OPTIN']);



// newsletter true false
if(strcmp($optin, "on") == 0)
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








// COMPTEUR AUGMENTE

//if(file_exists('compteur.txt')){} // pas besoin de verifier l'existence du fichier
    
$compteur_file = fopen('compteur.txt', 'r+'); 
$compteur = fgets($compteur_file);

$compteur = $compteur + 1;
fseek($compteur_file, 0);
fputs($compteur_file, $compteur);

fclose($compteur_file);



?>







    </body>
</html>

