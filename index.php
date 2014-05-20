<?

    session_start();
    session_destroy();


    $compteur_file = fopen('compteur.txt', 'r+'); 
    $compteur = fgets($compteur_file);



?>




<!DOCTYPE>
<html>

    <head>
            <title>Petition Rsf</title>
            <meta charset="utf-8">
            <link rel='stylesheet' type='text/css' href='style.css'>
    </head>
    <body>









<section id="formulaire">

    <form action="merci.php" method="post" name="formulaire_signature" novalidate><!-- target="blank" // nouvel onglet -->
    	<h3>Signez la pétition.</h3>

        <h5>Déjà <?php echo $compteur; ?> signature(s).</h5>


        <div class="petition_champs">
        	<input type="email" value="EMAIL" name="EMAIL" id="EMAIL">
        </div>
        <div class="petition_champs">
        	<input type="text" value="FIRST NAME" name="FNAME" id="FNAME">
        </div>
        <div class="petition_champs">
        	<input type="text" value="LAST NAME" name="LNAME" id="LNAME">
        </div>

        <div id="VALID">Validez</div>

        <br/>

        <div id="NEWS">
            <p>Voulez-vous vous abonner à notre newsletter?</p>
                <!-- ON VALIDE -->
            <input class="SIGNE" type="submit" value="OUI" name="OUI" class="button">
            <input class="SIGNE" type="submit" value="NON" name="NON" class="button">
        </div>

        <br/>
        

    </form>

</section>



<?php fclose($compteur_file); ?>



<script type="text/javascript">


// gestion des interactions avec les champs du formulaire

var Email = document.getElementById("EMAIL");
var Fname = document.getElementById("FNAME");
var Lname = document.getElementById("LNAME"); 

Email.addEventListener("click", effacerChamp, false);
Fname.addEventListener("click", effacerChamp, false);
Lname.addEventListener("click", effacerChamp, false);
document.addEventListener("click", reset, false);


function effacerChamp()
{
    this.value = "";
    this.removeEventListener("click", effacerChamp, false);
}





var valider = document.getElementById("VALID");
valider.addEventListener("click", getValider, false);

function getValider()
{

    // expression reguliere pour une adresse mail
    var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

    if(reg.test(Email.value) == false || Email.value == "" || Email.value == "EMAIL"){
        alert("email non valide");
    }

    else if(Fname.value == "" || Fname.value == "FNAME"){
        alert("first name non valide");
    }

    else if(Lname.value == "" || Lname.value == "LNAME"){
        alert("last name non valide");
    } 

    else {
        var News = document.getElementById("NEWS");
        News.style.display =  "block";
    }
    
}


function reset(event) {

    if(event.target.id != "EMAIL")
    {
        if(Email.value == ""){
            Email.value = "EMAIL";
        }
    } 
    if(event.target.id != "LNAME")
    {
        if(Lname.value == ""){
            Lname.value = "LNAME";
        }
    }
    if(event.target.id != "FNAME")
    {
        if(Fname.value == ""){
            Fname.value = "FNAME";
        }
        
    }
}







</script>




    </body>
</html>