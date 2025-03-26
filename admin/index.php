<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aire naturelle "Les Grands Chênes"</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">
    </script>
</head>
<body>
<?php 
  // enregistrer l'ip du client
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    echo  "<input id='ip' value='$ip' size='40' hidden>";
?>    
<div class=" hobo  " >
    <div id="logging" class="flex justcontentcenter ">
        <div  class="flex flexcolumn justselfcenter fitcontent justcontentcenter border shadow margin " >
            <div  class="center mediumBigFont justselfcenter blurdiv shadowInv marginlittle">
                Accueil Gérance <br>
                <div   class="flex  flexrow   ">
                    <div class="flex flexcolumn paddingVeryLittle  lineheightlittle "> 
                        <label  class=" right"> Identifiant  </label>  
                        <label class=" right"> Mot de passe</label>   
                    </div>
                    <div class="flex flexcolumn  paddingVeryLittle   ">
                        <input class=" " size="25" type="text"     id="login" value="patteblanche" title="Minimum of 3 characters." width="1em" minlength="3" required>
                        <input class=" " size="25" type="password" id="pass"  value="Vince46!"     title="Minimum of 7 characters. Should have at least one special character and one number." minlength="7" pattern="(?=.*\d)(?=.*[\W_]).{7,}" required> 
                    </div>
                   <button class="button hobo" id="btnlogin"   onclick="connex()" hidden  >S'incrire  </button> 
                   <b  class=" littleFont " id="msgLoginsize"></b>
                </div>     
            </div>
        </div>
        
    </div>
    <!-- chargement du fichier admin.txt --> 
    
    <div id="dDiv">
    </div>
    
</div>
<!-- chargement du fichier adminfunction.txt --> 
<div id="dDivFunctions">
    
</div>

<script charset="utf-8" type="text/javascript">
    //------------------------------------ Comme il s'agit de l'index de la partie admin, le code sensible est chargé seulement apres s'être logger ------------------------------------
    
    // code pour pouvoir taper enter a la place du click bouton 
var loginInput = document.getElementById("login");
loginInput.addEventListener("keypress", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        document.getElementById("btnlogin").click();
    }
});
const myIntercheckLoginPass=setInterval(checkLoginPass,1500);
// le bouton disparait 1 seconde apres patteblanche car > 11 lettres donc clic avant ;) pour anti hack donc patteblanch puis "e" et click ou enter
function checkLoginPass() {
    let login      = $('#login').val();
    if (login.length>11 || login.length<=0) { 
        document.getElementById('btnlogin').hidden=true; 
        $('#msgLoginsize').html("Login d'au plus 11 caractères");
    } else { 
        document.getElementById('btnlogin').hidden=false; 
        $('#msgLoginsize').html("");
    }
}
// function connexion 
function connex () {
    clearInterval(myIntercheckLoginPass);
     
    var login      = $('#login').val();
    var pass       = $('#pass').val();
    var ip         = $('#ip').val();
    let currentDate = new Date().toJSON().slice(0, 10);
    var myData =  { "action"  : "login",
                    "login"     : login,
                    "pass"      : pass,
                    "ip"        : ip,
                    "dateDeb"   : currentDate
                     };  
    $.ajax({
        url: "servmin.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",         
        success: function(response) {
            if (response.action=="ok") {
                var    dDiv= response.dDiv;
                var dDivFunctions = response.dDivFunctions;
                document.getElementById('logging').style.display='none';
                $('#dDiv').html(dDiv);
                $('#dDivFunctions').html(dDivFunctions);
            }
        },              
        error: function(error) {
             console.log("errror : "+error.statusText);
        }
    });       
}    
</script>
<?php     include "footerG.php"; ?>
        
        
        
            
            
            