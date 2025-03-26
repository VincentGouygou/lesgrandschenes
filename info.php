<?php 
    include "headerG.php";
     include "barnav.php";
     
?>
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

<div class=" hobo   " >
    
    <div class="flex justcontentcenter ">
        
        <div  class=" flexdir center border shadow blurdiv  margin " >
            <div class=" marginlittle BigFont">
                      Informations Pratiques <br>et Contacts
            </div>
           
            
        </div>

         
    </div>
    
    
   
    
    <div class=" flex  flexcolumn     ">
        <div  class="grid divwidth justselfcenter justcontentcenter center border shadow   margin " >
            
         
            <div class=" flex  flexdir " > 
                <div  class=" grid center justcontentcenter justselfcenter " >
                            <div  class="Font flex fitcontent  center border shadow  flexcolumn padding margin  blurdiv "> 
                                Ouvert du 15 juin au 30 septembre <br> 
                                Avec ou sans réservation <br>  
                                Tél. : 06.61.05.67.58 <br>  
                                Aire naturelle de camping "Les Grands Chênes" <br>  
                                230 chemin de Piboulades, 46200 Pinsac <br>  
                           
                            
                                lesgrandschenespinsac@gmail.com 
                            </div>
                            
                </div>
                <div  class="flex flexcolumn fitcontent justselfcenter  center border shadow   padding blurdiv  " >
                    
                        <div class="mediumBigFont   "> 
                            Retrouvez nous sur :
                        </div>
                        <div class=" flexrow   ">
                            <!-- target blank pour ouvrir un nouvel onglet --> 
                             <a  target="_blank" href="https://park4night.com/fr/place/88206">
                                <img   class='icones   shadow' src='images/icones/park4night.jpg' >  
                            </a>
                             <a  target="_blank" href="https://www.facebook.com/airenaturellelesgrandschenes">
                                <img class='icones   shadow' src='images/icones/Logo-Facebook.png' > 
                            </a>
                            <a  target="_blank" href="https://maps.app.goo.gl/KxztyxWctaFSZRRT9">
                                <img class='icones   shadow' src='images/icones/google_maps-card.png' > 
                            </a>
                        </div> 
                        
                    
                </div>
            </div>      
        <div class=" flex  flexdir " >      
             <div class="flex  flexcolumn   ">
               
                <div class="flex  flexcolumn  justselfcenter fitcontent    border shadow  paddinglittle  blurdiv   marginlittle  " >
                            
                             <b class="mediumBigFont center paddingVeryLittle"> Envoyer un message </b>   
                            <div class="flex  flexrow ">
                                 
                                <div class="flex flexcolumn lineheightlittle   paddingVeryLittle  "> 
                                
                                
                                 
                                    <label  class="   right"> Nom  </label>  
                                    <label class="   right"> Prénom</label>   
                                    <label class="   right"> Adresse</label> 
                                    <label class=" right "> Téléphone  </label>   
                                    <label class="   right"> Email</label> 
                                    <label class="  right"> Message </label> 
                                    
                                </div>
                                <div class="flex   flexcolumn paddingVeryLittle  lineheightlittle ">
                                    <input class="" type="text"     name="fNom"     placeholder="Votre nom "  id="fNom" value="" required width="1em" minlength="2" title="1 caractère minimum" > 
                                    <input class="" type="text"     name="fPrenom"  placeholder="Votre prénom "  id="fPrenom" value="" required minlength= "3" title="">  
                                    <input class="" size="25" height="2em" type="text"     name="fAdresse"  placeholder="Votre Adresse"   id="fAdresse" value="" required  minlength="5" title=" 3 caractères minimum ">
                                    <input class=""  size="25" type="tel"     name="fTel"   placeholder="Votre Téléphone " id="fTel" value="" required minlength="10" title="Téléphone au moins 10 chiffres"> 
                                    <input class="" type="email"    name="fEmail"   placeholder="Votre Email" id="fEmail" value="" required>  
                                      <!-- idMessagesTextarea por viser l'attribut title en vue de décompter le nombre de caractères restants -->
                                    <textarea id="idMessagesTextarea" rows="4" cols="20" maxlength="1000" class="    " type="text"     name="fMessage"    placeholder="Ecrivez ici votre message (1000 caractères max) "  id="fMessage" value="" title="de min 1 à 1000 caractères max" required></textarea>  
                                    <button onclick="sendmsg()"  class="fitcontent" id="fbuttonsendmsg"   hidden   >Envoyer</button>
                                    <b class=" littleFont " id="msgmail"></b>
                                    <b class=" littleFont " id="nomprenomlength"></b>
                                    <b class=" littleFont " id="msgadrtellengthlength"></b>
                                </div>
                                <div class="flex flexcolumn lineheightlittle      ">
                                      
                                      <!-- div des checkmarks ( &#9745 coche verte   &#9746  x rouge 
                                      
                                          
                                      
                                      -->
                                  
                                    <img  class="    iconesSize border borderSolid whitebck" id="nomCheckid"  src="images/icones/checkmarkNotChecked.png"> 
                                    <img  class="    iconesSize border borderSolid whitebck" id="prenomCheckid"  src="images/icones/checkmarkNotChecked.png">
                                    <img  class="    iconesSize border borderSolid whitebck" id="adresseCheckid" src="images/icones/checkmarkNotChecked.png"> 
                                    <img  class="    iconesSize border borderSolid whitebck" id="telCheckid" src="images/icones/checkmarkNotChecked.png">
                                    <img  class="    iconesSize border borderSolid whitebck" id="emailCheckid" src="images/icones/checkmarkNotChecked.png">
                                    <div  class="      border borderSolid whitebck "  > <label id="messageCheckid"> </label> </div>
                             
                                             
                                </div>
                            </div>       
                </div>          
            </div>
           

                <div  class="flex flexcolumn mediumBigFont   fitcontent center justselfcenter  border shadow   margin  padding  blurdiv " >
                    
                            Accès et Services : <br>
                            <img   class='images300   shadow' src='images/pictogrammes/pictoservices.png' >  <br> 
                            Activités : <br>
                            <img   class='images300   shadow' src='images/pictogrammes/pictoactivites.png' > 
                    
                    
                </div>
        </div>    
             <a  target="_blank" href="https://maps.app.goo.gl/KxztyxWctaFSZRRT9">
                     <img class='images600 border shadow' src='images/plan.png'   > 
                </a>
        </div>
        
         
    </div>          
    
    
    
</div>
     
     
<script charset="utf-8" type="text/javascript">
    
    
     const myIntervalCheckmail = setInterval(checkmailprocedure,1000);
 //function pour verifier l'email
function checkmail() {
    const email = document.getElementById("fEmail");
    const isValidEmail = email.checkValidity();
    return isValidEmail;
}
//function pour verifier l'email

function checkmailprocedure() {
   
    let adressetelbool  =false;
    let adressebool     =false;
    let telbool         =false;
      
    let nomprenomlengthbool =false;
    let nomlengthbool       =false;
    let prenomlengthbool    =false;
    let mailbool            =false;
    
    let adresse =   $('#fAdresse').val();
    let tel =       $('#fTel').val();
    let nom =       $('#fNom').val();
    let prenom =    $('#fPrenom').val();
    let emailMsg =       $('#fEmail').val();
    let msgTextarea = $('#idMessagesTextarea').val();
    let msgNbLeft =$('#messageCheckid').html( msgTextarea.length-1000);
    
 
 
 
 
    if (nom.length<3 ) { 
        nomlengthbool=false;
        $('#nomCheckid').attr("src","images/icones/checkmarkNotChecked.png") ;
    } else { 
        nomlengthbool=true;
        $('#nomCheckid').attr("src","images/icones/checkmarkChecked.png") ;
    }
    
    if ( prenom.length<3) { 
        prenomlengthbool=false;
        $('#prenomCheckid').attr("src","images/icones/checkmarkNotChecked.png") ;
    } else { 
        prenomlengthbool=true;
        $('#prenomCheckid').attr("src","images/icones/checkmarkChecked.png") ;
    }   
     if (nomlengthbool || prenomlengthbool) {
       nomprenomlengthbool=true;
   } else {
       nomprenomlengthbool=false;
   }
    
     if (adresse.length<3 ) { 
        adressebool=false;
        $('#adresseCheckid').attr("src","images/icones/checkmarkNotChecked.png") ;
    } else { 
        adressebool=true;
        $('#adresseCheckid').attr("src","images/icones/checkmarkChecked.png") ;
    }
    
     if (tel.length<10 || isNaN(tel) ) { 
        telbool=false;
       
        $('#telCheckid').attr("src","images/icones/checkmarkNotChecked.png") ;
       // $('#');
    } else { 
        telbool=true;
        $('#telCheckid').attr("src","images/icones/checkmarkChecked.png") ;
       // $('#');

        
    
    }
    
    if ( adressebool || telbool ) {
        adressetelbool=true;
    } else  {
        adressetelbool=false;
    }
    
    
    
  
 
  
    
    if  (checkmail()) {
        mailbool=true;
        $('#emailCheckid').attr("src","images/icones/checkmarkChecked.png") ;
        
    }
    if (!checkmail()) {
        mailbool=false;
         $('#emailCheckid').attr("src","images/icones/checkmarkNotChecked.png") ;
        
    }
    if (  mailbool && nomprenomlengthbool && adressetelbool) { 
        document.getElementById('fbuttonsendmsg').hidden=false;
    } else {
        document.getElementById('fbuttonsendmsg').hidden=true;
    }
      
}

    
    

function sendmsg(){
    clearInterval(myIntervalCheckmail);
  
     let nom =       $('#fNom').val();
    let prenom =    $('#fPrenom').val();
    let nomPrenom=nom+" "+prenom;
    let email =     $('#fEmail').val();
    let message =     $('#fMessage').val();
    let ip =     $('#ip').val();
        let myData =  { "nomPrenom": nomPrenom,
                    
                    "message": message,
                   
                    "email": email,
                    
                     "ip" : ip,
                    "action": "sendmsg"};
        // fonction Ajax de jQuery
        // j'appelle ajax sur le fichier ajaxmessage.php avec la méthode GET pour lui envoyer en json myData
    $.ajax({
        url: "server.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",
        // si l'envoi est réussi
        success: function(response) {
             if (response.action=="Error inserting:"){
                $('#msgmail').html(response.action+" "+response.error);

            
            }
             if (response.action=="msgOk"){
                $('#msgmail').html(response.action);
                document.getElementById('fbuttonsendmsg').hidden=true;
            
            }
        },
        // s il y a une erreur je l'affiche en console et dans la div #messageID
        error: function(error) {
            console.log("errrrror"+error.statusText);
            
        }
    });
}
    
  


       
<?php 
    include "functions.js";
?>




 
</script>

<?php 
  
    include "footerG.php";
?>