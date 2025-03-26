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
    echo  "<input id='ip' value='$ip' hidden >";
?>
 <div class="flex hobo flexcolumn justcontentcenter ">
    <div  class="flex  flexcolumn  justselfcenter   justcontentcenter fitcontent  border shadow blurdiv     margin">
                    <b class="superBigFont center paddinglittle">Réservation</b> 
                    <a id='emplNumero'   hidden></a>
    </div>
    <div id="bulleTarifEtInput" class="flex  flexdir divwidth justselfcenter  justcontentcenter  fitcontent       marginlittle " > 
            <img class=" mob images600 flex  justselfcenter  justcontentcenter blurdiv  marginlittle  border shadow" src="images/tarif2025mobile2.png">
            <img class=" notmob images600 flex  justselfcenter  justcontentcenter blurdiv  marginlittle  border shadow" src="images/TARIF 2025bolder.png">
        <div class="flex  flexcolumn  justselfcenter   justcontentcenter   border shadow blurdiv   paddinglittle  marginlittle  " >
            <div class="flex  flexrow ">
                <div class="flex flexcolumn paddingVeryLittle  lineheightlittle "> 
                    <label  class="   right"> Nom  </label>  
                    <label class="   right"> Prénom</label>   
                    <label class="   right"  style="height: 3.3em" > Adresse</label> 
                    <label class="   right"> Email</label>    
                    <label class="   right"> Téléphone</label>    
                </div>
                <div class="flex    flexcolumn  paddingVeryLittle   ">
                    <input class="" size="25" type="text" id="fNomResa"  placeholder="1 lettre minimum" value="Gouygou" required  minlength="3" title="Minimum of 3 characters." >
                    <input class=" " size="25" type="text" id="fPrenomResa" placeholder="1 lettre minimum" value="Vincent" required minlength= "3" title="Minimum of 3 characters.">  
                    <textarea class="     " size="40" type="text"  id="fAdresseResa" placeholder="1 lettre minimum" value="185, route de Brande 46200 Saint Sozy" required title="Minimum of 3 characters." rows= "3em"></textarea>  
                    <input class=" " size="25" type="email" id="fEmailResa" placeholder="10 caractères minimum" value="vincent.gouygou@gmx.fr" required>  
                    <input class="     " size="15"      id="fTelResa" value="0607229383" required title="Minimum of 10 characters.">  
                </div>
                <div class="flex flexcolumn lineheightlittle   paddingVeryLittle  ">
                    <img  class="    iconesSize border borderSolid whitebck" id="nomCheckid"     src="images/icones/checkmarkNotChecked.png"> 
                    <img  class="    iconesSize border borderSolid whitebck" id="prenomCheckid"  src="images/icones/checkmarkNotChecked.png">
                    <img  class="    iconesSize border borderSolid whitebck" id="adresseCheckid" src="images/icones/checkmarkNotChecked.png"> 
                    <img  class="    iconesSize border borderSolid whitebck" id="emailCheckid"   src="images/icones/checkmarkNotChecked.png">
                    <img  class="    iconesSize border borderSolid whitebck" id="telCheckid"     src="images/icones/checkmarkNotChecked.png">        
                </div>
            </div>     
            <div class="flex flexcolumn "> 
               <div class="flex left flexrow lineheightlittle  ">
                    <div class="flex flexcolumn paddingVeryLittle  lineheightlittle  ">  
                        <label class="right lineheightlittle" for="startDate">Arrivée </label>
                        <br> Après
                        <label class="right lineheightlittle" for="endDate">Départ </label> 
                        <br> Avant
                        <label class="right lineheightlittle" id="njoursInfo">0  </label> 
                        <label class="right lineheightlittle" >Adulte(s) </label>  
                        <label class="right lineheightlittle" >Enfant(s) </label> 
                        <label class="right lineheightlittle" >Chien(s) </label>
                    </div>
                    <div class="flex flexcolumn paddingVeryLittle  lineheightlittle ">
                        <input size="25" class="lineheightlittle"  value="2025-06-15"   type="date" id="startDate"  required  > le 15-06
                        <input size="25" class="lineheightlittle"  value="2025-06-15"   type="date" id="endDate"    required  > le 15-09  <br>
                        <label class="  lineheightlittle  ">  nuitée(s)  </label>   <br>
                        <input class="lineheightlittle" type="number" name="finforesaNadult"  id="finforesaNadult"  min="1" value="1" style="width: 3em" required disabled="true" onchange="prix();">
                        <input class="lineheightlittle" type="number" name="finforesaNenfant" id="finforesaNenfant" min="0" value="0" style="width: 3em" required disabled="true" onchange="prix();">
                        <input class="lineheightlittle" type="number" name="finforesaNchien"  id="finforesaNchien"  min="0" value="0" style="width: 3em" required disabled="true" onchange="prix();">
                    </div>   
                </div> 
                <div class="flex flexcolumn paddingVeryLittle  lineheightlittle ">    
                    <b class="hobo  " >Total séjour : 
                        <a id="prix"></a> € 
                    </b>
                    <b class="hobo  " >
                        <a id="arrhes" hidden></a> 
                    </b>
                    <b class="hobo  " hidden >  
                        <a id="taxeLocale"hidden="" ></a> 
                    </b>
                    <button class="button hobo" id="btnPrix"           onclick="prix()"           hidden  >Calculer  </button> 
                    <button class="button hobo" id="btnResa"           onclick="resa()"           hidden  >Réserver  </button> 
                    <button class="button hobo" id="btnResaInscript"   onclick="inscriptResa()"   hidden  >S'incrire  </button> 
                    <button class="button hobo" id="btnVoirEmplLibres" onclick="voirEmplLibres()" hidden  >Voir les emplacements libres </button> 
                </div>
            </div>
            <label class="  " id="result"   >   </label> 
            <b class=" littleFont " id="msgmailResa"></b>
            <b class=" littleFont " id="msgmailResaconf"></b>
            <div class="" id="resultEmpl"   ></div>
            <b class=" littleFont " id="msgDatesResa"></b>
            <b class="  littleFont" id="msgpassResa"></b>
            <b class=" littleFont " id="nomprenomlengthResa"></b>
            <b class=" littleFont " id="msgalreadydoneResa"></b>
            <b class=" littleFont " id="msgalconfirmationResa"></b> 
            <b class=" littleFont " id="msgpasslengthResa"></b>
            <b class=" littleFont " id="msgadrtellengthlengthResa"></b>
            <b class=" littleFont " id="msgresaresult"></b>
        </div>
  
    </div>
    <div class="flex     flexcolumn justselfcenter   justcontentcenter   border shadow  paddinglittle  marginlittle " >
        <div class="flex     flexcolumn center   justselfcenter  paddingVeryLittle    border  ">
            <br>
            <label class="  redbck black border paddingVeryLittle"   > Rouge : Complets </label>
            <label class="  greenbck black border paddingVeryLittle"  > Vert  : En partie </label>
            <label class="  bluebck white border paddingVeryLittle"   > Bleu  : libres </label>
             <label class=" whitebck black border paddingVeryLittle" >   Date / Mois  </label>      
        </div>
    </div>                 
    <div class=" flex center  flexcolumn justItemsfcenter    justcontentcenter "> 
        <div class=" flex flexdir justselfcenter">
            <div class=" flex  flexcolumn  justselfcenter  justcontentcenter   border shadow   paddinglittle  marginlittle  ">
                <div class="blurdiv border fitcontent  flex paddinglittle  justselfcenter mediumFont  bold">
                  Juin   
                </div> 
                
                
                <table class="borderTable" >
                    <tr class="borderTable">
                        <th>Lun</th>
                        <th>Mar</th>
                        <th>Mer</th>
                        <th>Jeu</th>
                        <th>Ven</th>
                        <th>Sam</th>
                        <th>Dim</th>
                    </tr>
                    <tr>
                        <td   id="Lundi1">  </td>
                        <td   id="Mardi1">  </td>
                        <td   id="Mercredi1">  </td>
                        <td   id="Jeudi1">  </td>
                        <td   id="Vendredi1">  </td>
                        <td   id="Samedi1">  </td>
                        <td   id="Dimanche1">  </td>
                    </tr>
                    <tr>
                        <td  id="Lundi2">  </td>
                        <td  id="Mardi2">  </td>
                        <td  id="Mercredi2">  </td>
                        <td  id="Jeudi2">  </td>
                        <td  id="Vendredi2"> </td>
                        <td  id="Samedi2">  </td>
                        <td  id="Dimanche2"> </td>
                    </tr>
                    <tr>
                        <td  id="Lundi3">  </td>
                        <td  id="Mardi3">  </td>
                        <td  id="Mercredi3">  </td>
                        <td  id="Jeudi3">  </td>
                        <td  id="Vendredi3">  </td>
                        <td  id="Samedi3">  </td>
                        <td  id="Dimanche3">  </td>
                    </tr>
                    <tr>
                        <td  id="Lundi4">  </td>
                        <td  id="Mardi4">  </td>
                        <td  id="Mercredi4">  </td>
                        <td  id="Jeudi4">  </td>
                        <td  id="Vendredi4"> </td>
                        <td  id="Samedi4">  </td>
                        <td  id="Dimanche4"> </td>
                    </tr>
                    <tr>
                        <td   id="Lundi5">  </td>
                        <td   id="Mardi5">  </td>
                        <td   id="Mercredi5">  </td>
                        <td   id="Jeudi5">  </td>
                        <td   id="Vendredi5">  </td>
                        <td   id="Samedi5">  </td>
                        <td   id="Dimanche5">  </td>
                    </tr>
                  
                    <tr>
                        <td  id="Lundi6">  </td>
                        <td  id="Mardi6">  </td>
                        <td  id="Mercredi6">  </td>
                        <td  id="Jeudi6">  </td>
                        <td  id="Vendredi6"> </td>
                        <td  id="Samedi6">  </td>
                        <td  id="Dimanche6"> </td>
                    </tr>
                </table> 
            </div>
            <div class="flex flexcolumn justselfcenter justcontentcenter border shadow paddinglittle  marginlittle">
                
                <div class="blurdiv border fitcontent  flex paddinglittle  justselfcenter mediumFont bold">
                Juillet    
               </div> 
                <table class="borderTable" >
                  <tr class="borderTable">
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mer</th>
                    <th>Jeu</th>
                    <th>Ven</th>
                    <th>Sam</th>
                    <th>Dim</th>
                  </tr>
                
                   <tr>
                    <td  id="Lundi7">  </td>
                    <td  id="Mardi7">  </td>
                    <td  id="Mercredi7">  </td>
                    <td  id="Jeudi7">  </td>
                    <td  id="Vendredi7">  </td>
                    <td  id="Samedi7">  </td>
                    <td  id="Dimanche7">  </td>
                  </tr>
                  <tr>
                    <td  id="Lundi8">  </td>
                    <td  id="Mardi8">  </td>
                    <td  id="Mercredi8">  </td>
                    <td  id="Jeudi8">  </td>
                    <td  id="Vendredi8"> </td>
                    <td  id="Samedi8">  </td>
                    <td  id="Dimanche8"> </td>
                  </tr>
                    <tr>
                    <td   id="Lundi9">  </td>
                    <td   id="Mardi9">  </td>
                    <td   id="Mercredi9">  </td>
                    <td   id="Jeudi9">  </td>
                    <td   id="Vendredi9">  </td>
                    <td   id="Samedi9">  </td>
                    <td   id="Dimanche9">  </td>
                  </tr>
                  <tr>
                    <td  id="Lundi10">  </td>
                    <td  id="Mardi10">  </td>
                    <td  id="Mercredi10">  </td>
                    <td  id="Jeudi10">  </td>
                    <td  id="Vendredi10"> </td>
                    <td  id="Samedi10">  </td>
                    <td  id="Dimanche10"> </td>
                  </tr>
                   <tr>
                    <td  id="Lundi11">  </td>
                    <td  id="Mardi11">  </td>
                    <td  id="Mercredi11">  </td>
                    <td  id="Jeudi11">  </td>
                    <td  id="Vendredi11">  </td>
                    <td  id="Samedi11">  </td>
                    <td  id="Dimanche11">  </td>
                  </tr>
                  <tr>
                    <td  id="Lundi12">  </td>
                    <td  id="Mardi12">  </td>
                    <td  id="Mercredi12">  </td>
                    <td  id="Jeudi12">  </td>
                    <td  id="Vendredi12"> </td>
                    <td  id="Samedi12">  </td>
                    <td  id="Dimanche12"> </td>
                  </tr>
            </table> 
            
            </div>
        </div> 
   
        <div class="flex flexdir justselfcenter ">
            <div    class="flex  flexcolumn  justselfcenter   justcontentcenter   border shadow    paddinglittle  marginlittle">
                
                <div class="blurdiv border fitcontent  flex paddinglittle  justselfcenter mediumFont bold  " >
                Août    
               </div> 
                <table class="borderTable" >
                  <tr class="borderTable">
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mer</th>
                    <th>Jeu</th>
                    <th>Ven</th>
                    <th>Sam</th>
                    <th>Dim</th>
                  </tr>
            
                
                  
                   <tr>
                <td   id="Lundi13">  </td>
                <td   id="Mardi13">  </td>
                <td   id="Mercredi13">  </td>
                <td   id="Jeudi13">  </td>
                <td   id="Vendredi13">  </td>
                <td   id="Samedi13">  </td>
                <td   id="Dimanche13">  </td>
              </tr>
              <tr>
                <td  id="Lundi14">  </td>
                <td  id="Mardi14">  </td>
                <td  id="Mercredi14">  </td>
                <td  id="Jeudi14">  </td>
                <td  id="Vendredi14"> </td>
                <td  id="Samedi14">  </td>
                <td  id="Dimanche14"> </td>
              </tr>
               <tr>
                <td  id="Lundi15">  </td>
                <td  id="Mardi15">  </td>
                <td  id="Mercredi15">  </td>
                <td  id="Jeudi15">  </td>
                <td  id="Vendredi15">  </td>
                <td  id="Samedi15">  </td>
                <td  id="Dimanche15">  </td>
              </tr>
              <tr>
                <td  id="Lundi16">  </td>
                <td  id="Mardi16">  </td>
                <td  id="Mercredi16">  </td>
                <td  id="Jeudi16">  </td>
                <td  id="Vendredi16"> </td>
                <td  id="Samedi16">  </td>
                <td  id="Dimanche16"> </td>
              </tr>
               <tr>
                <td   id="Lundi17">  </td>
                <td   id="Mardi17">  </td>
                <td   id="Mercredi17">  </td>
                <td   id="Jeudi17">  </td>
                <td   id="Vendredi17">  </td>
                <td   id="Samedi17">  </td>
                <td   id="Dimanche17">  </td>
              </tr>
              <tr>
                <td  id="Lundi18">  </td>
                <td  id="Mardi18">  </td>
                <td  id="Mercredi18">  </td>
                <td  id="Jeudi18">  </td>
                <td  id="Vendredi18"> </td>
                <td  id="Samedi18">  </td>
                <td  id="Dimanche18"> </td>
              </tr>
            </table> 
             </div>
            <div   class="flex  flexcolumn  justselfcenter   justcontentcenter   border shadow    paddinglittle  marginlittle">
                
                <div class="blurdiv border fitcontent  flex paddinglittle  justselfcenter mediumFont bold">
                Septembre    
               </div> 
                <table class="borderTable" >
                  <tr class="borderTable">
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mer</th>
                    <th>Jeu</th>
                    <th>Ven</th>
                    <th>Sam</th>
                    <th>Dim</th>
                  </tr>
           
              
               <tr>
                <td  id="Lundi19">  </td>
                <td  id="Mardi19">  </td>
                <td  id="Mercredi19">  </td>
                <td  id="Jeudi19">  </td>
                <td  id="Vendredi19">  </td>
                <td  id="Samedi19">  </td>
                <td  id="Dimanche19">  </td>
              </tr>
               <tr>
                <td  id="Lundi20">  </td>
                <td  id="Mardi20">  </td>
                <td  id="Mercredi20">  </td>
                <td  id="Jeudi20">  </td>
                <td  id="Vendredi20">  </td>
                <td  id="Samedi20">  </td>
                <td  id="Dimanche20">  </td>
              </tr>
                            <tr>
                <td  id="Lundi21">  </td>
                <td  id="Mardi21">  </td>
                <td  id="Mercredi21">  </td>
                <td  id="Jeudi21">  </td>
                <td  id="Vendredi21"> </td>
                <td  id="Samedi21">  </td>
                <td  id="Dimanche21"> </td>
              </tr>
               <tr>
                <td   id="Lundi22">  </td>
                <td   id="Mardi22">  </td>
                <td   id="Mercredi22">  </td>
                <td   id="Jeudi22">  </td>
                <td   id="Vendredi22">  </td>
                <td   id="Samedi22">  </td>
                <td   id="Dimanche22">  </td>
              </tr>
              <tr>
                <td  id="Lundi23">  </td>
                <td  id="Mardi23">  </td>
                <td  id="Mercredi23">  </td>
                <td  id="Jeudi23">  </td>
                <td  id="Vendredi23"> </td>
                <td  id="Samedi23">  </td>
                <td  id="Dimanche23"> </td>
              </tr>
               <tr>
                <td  id="Lundi24">  </td>
                <td  id="Mardi24">  </td>
                <td  id="Mercredi24">  </td>
                <td  id="Jeudi24">  </td>
                <td  id="Vendredi24">  </td>
                <td  id="Samedi24">  </td>
                <td  id="Dimanche24">  </td>
              </tr>
            </table>         
                </div>
            
        </div> 
    </div>
          
</div>
        
 
<script charset="utf-8" type="text/javascript">
    
       
    <?php    include "functions.js"; ?>
paramtab();
var currentDate = new Date().toJSON().slice(0, 10);
var todayDate = new Date();
var currentYear =todayDate.getFullYear();
var minDate=currentYear+"-06-15";
var maxDate=currentYear+"-09-15";

let valueInputDate = '15-06-'+ currentYear;
console.log('>>>>> valueInputDate'+ valueInputDate);
 
document.getElementById("startDate").setAttribute('min', minDate ); 
document.getElementById("startDate").setAttribute('max',maxDate ); 
document.getElementById("endDate").setAttribute('min', minDate );
document.getElementById("endDate").setAttribute('max', maxDate );   
console.log(currentDate);
// vaariables globales .... verifier doublons mise en ballise hidden dans html ^^ 
var nomPrenomAdresseTelBool=true;
var mailResabool        =false;
var boolFinAvantDeb= false;
var boolDebAvantToday= false;
   
var  prixbool=false;
var   njours;
var arrhes =0;
var taxeLocale =0;
checkEmplOccupDates(); 
  
const myIntercheckmailResa=setInterval(checkmailResaProcedure,1500);

//function pour verifier l'email
function checkmailResa() {
    const emailResa = document.getElementById("fEmailResa");
    const isValidEmailResa = emailResa.checkValidity();
    return isValidEmailResa;
}
function checkmailResaProcedure() {
 //   let adressetelbool  =false;
    let adressetelboolResa  =false;
    let adressebool         =false;
    let telbool             =false;
    let nomprenomlengthboolResa =false;    
    let nomlengthbool       =false;
    let prenomlengthbool    =false;
    let mailbool            =false;
    let email   =   $('#fEmailResa').val();
    let adresse =   $('#fAdresseResa').val();
    let tel     =   $('#fTelResa').val();
    let nom     =   $('#fNomResa').val();
    let prenom  =   $('#fPrenomResa').val();
    var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;
    var msgresultDiv = document.getElementById('msgDatesResa');
     
    if (new Date(startDate) < new Date(minDate) || new Date(endDate) < new Date(minDate) || new Date(startDate)> new Date(maxDate) || new Date(endDate)> new Date(maxDate)  ){
       boolDebAvantToday=true;
       njours =0;
        msgresultDiv.textContent = 'Les dates fournies sont incompatibles avec les horaires ou la logique';
        $('#startDate').val(todayDate);
    } else { boolDebAvantToday=false; }
    if (new Date(startDate) > new Date(endDate)) {
       boolFinAvantDeb=true;
       njours =0;
        msgresultDiv.textContent = 'La date de début ne peut pas être après la date de fin.';
    } else if (!boolDebAvantToday) {
          boolFinAvantDeb=false;
          
             var start = new Date(startDate);
          //   start.setDate(start.getDate());
              var end = new Date(endDate);
            //  end.setDate(end.getDate());
              $('#dateDeb').val(startDate);
              $('#dateFin').val(endDate);
            msgresultDiv.textContent = ' ';
    
         njours =( end - start) / (1000 * 3600 * 24)  ;
        
          if (njours>0)   {  
            
            $('#njoursInfo').html(njours);
     
        }
        
    if (nom.length<1 ) { 
        nomlengthbool=false;
        $('#nomCheckid').attr("src","images/icones/checkmarkNotChecked.png") ;
    } else { 
        nomlengthbool=true;
        $('#nomCheckid').attr("src","images/icones/checkmarkChecked.png") ;
    }
    
    if ( prenom.length<1) { 
        prenomlengthbool=false;
        $('#prenomCheckid').attr("src","images/icones/checkmarkNotChecked.png") ;
    } else { 
        prenomlengthbool=true;
        $('#prenomCheckid').attr("src","images/icones/checkmarkChecked.png") ;
    }   
    
    if (nomlengthbool || prenomlengthbool) {
       nomprenomlengthboolResa=true;
    } else {
       nomprenomlengthboolResa=false;
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
    } else { 
        telbool=true;
        $('#telCheckid').attr("src","images/icones/checkmarkChecked.png") ;
    }
    
    if ( adressebool || telbool ) {
        adressetelboolResa=true;
    } else  {
        adressetelboolResa=false;
    } 
    
    if  ( checkmailResa()  ) {
        mailResabool=true;
         $('#emailCheckid').attr("src","images/icones/checkmarkChecked.png") ;
         
       
    } else  {
        mailResabool=false;
         $('#emailCheckid').attr("src","images/icones/checkmarkNotChecked.png") ;
        
        
        
    }
         /*
if (njours>0) {
    const myInterCheckEmpl =setInterval(voirEmplLibres ,1000);
     const myInterPrix =setInterval(prix ,1000);
} else {
    clearInterval(myInterCheckEmpl);
    clearInterval(myInterPrix);
}

      
*/
         if (njours>0) {
            voirEmplLibres();
        }  

        if (mailResabool && ( !boolFinAvantDeb && njours>0  ))     {
            document.getElementById('btnVoirEmplLibres').hidden=false;
            
             if (prixbool && nomPrenomAdresseTelBool) {
                document.getElementById('btnResa').hidden=false; 
            }
        }
        else       {
            document.getElementById('btnVoirEmplLibres').hidden=true;
            if (prixbool && nomPrenomAdresseTelBool) {
                document.getElementById('btnResa').hidden=true; 
            }
        }
  
    
    
     
    
    
    
    }
}   
function resetCalendar() {
        var dayIndex    =  0;
        var numeroSemaine = 1;
       

    for (var i = 0; i < 122  ; i++) {
        
       
         const jourdelasemaine =[ 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        var dayIndexNom = jourdelasemaine[ dayIndex ];
    
        
        $('#'+dayIndexNom+numeroSemaine).html( " " );
        document.getElementById(dayIndexNom+numeroSemaine).style.color = "Black";
        document.getElementById(dayIndexNom+numeroSemaine).style.backgroundColor = "transparent ";
                
               
        dayIndex++;
        if (dayIndex==7) {
            dayIndex=0; 
            numeroSemaine++;
            if (numeroSemaine==17) {  
                numeroSemaine=1 ;             
                
            }
        }
    }
}


function    checkEmplOccupDates (){
    resetCalendar();
   // var debb= $('#startDate').val();
   // var finn=$('#endDate').val();
    var debb= new Date("2025-06-01").toJSON().slice(0, 10);
    var finn= new Date("2025-09-30").toJSON().slice(0, 10);
    var myData =  {   "action"  : "CheckEmplOccupDates",
                        
                        "dateDeb"   : debb,
                        "dateFin"   : finn
                     };

                    
    $.ajax({
        url: "server.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",

                          
        success: function(response) { 
             var numeroSemaine = 1;
             var listoccup= [];
            var occup = response.txOccup;  
            var coloor; //              0          1       2         3           4          5         6         
             const jourdelasemaine =[ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ];
             
       
            var dayZero = new Date(occup[0][0]);
                dayZero =  dayZero.getDay();
            var dayZeroNom = jourdelasemaine[dayZero];
            var tailleOccup= occup.length ;
            if ( tailleOccup > 122 ) {
                tailleOccup=122;
            }
            var dDate = new Date(occup[0][0]);
                
                var mMois = dDate.getMonth()+1;
            var mMoisAntecedant = mMois;             
            
            for (var i = 0; i < tailleOccup ; i++) {
            
                
                
                
                dDate = new Date(occup[i][0]);
                mMois = dDate.getMonth()+1;
                if ( mMoisAntecedant != mMois ) {
                    switch(mMois) {
                        case 7: numeroSemaine=6;
                            
                        break;
                        case 8: numeroSemaine=12;

                        break;
                        case 9: numeroSemaine=18;

                        break;
 
                        default:
                            
                    } 
                     numeroSemaine++;
                     if (numeroSemaine==25) {  numeroSemaine=1 ;             }
                }
                
                dDate = dDate.getDate();
               
                let dayIndex    =  new Date(occup[i][0]);
                dayIndex        = dayIndex.getDay();
                let dayIndexNom = jourdelasemaine[ dayIndex ];
                  confirmArrhes=   occup[i][2];
               
                
                         if (confirmArrhes==0) { 
                          
                                               arrhesnotconfirm=" ";

                         } 
                          if (confirmArrhes==1) { 
                          
                                                   arrhesnotconfirm=" ";
                         } 

                $('#'+dayIndexNom+numeroSemaine).html( "<button class='btnjour "+ arrhesnotconfirm+"  border   '    >  "+dDate+" </button>" );
               
               
                switch (  Math.ceil(occup[i][1] /10) ) {
                     case 0 :   coloor= "Black   ";
                               bgcolor = "Screamin Green " ;
                       break;       
                     case 1 : coloor= "Black"   ;
                               bgcolor = "Chartreuse  " ;
                      
                       break;
                     case 2 :  coloor= "White  ";
                               bgcolor = "LightSalmon " ;
                       break;
                     default:   coloor="White";
                                bgcolor = "red" ;
                }
 
                if (occup[i][1] ===25 ) { 
                    coloor="White";
                    bgcolor = "red" ;
                }
                 if (occup[i][1] ===0 ) { 
                    coloor= "white"   ;
                    bgcolor = "blue " ;
                }
                document.getElementById(dayIndexNom+numeroSemaine).style.color = coloor;
                document.getElementById(dayIndexNom+numeroSemaine).style.backgroundColor = bgcolor;
         
                
                $('#'+dayIndexNom+numeroSemaine).color = coloor; 
                
                dayIndex++;
                if (dayIndex==1) {
                     numeroSemaine++;
                    if (numeroSemaine==25) {  numeroSemaine=1 ;             }
                }
                mMoisAntecedant = mMois; 
            } /// fin du for -------------------------------
              
           // $('#resultOccup').html(listoccup);
            
       
            
           
            

      
            
       
        },
                            
                           
        error: function(error) {
             console.log("errrrror : "+error.statusText);
                            
        }
        
    });       
}       
     
function resa() {
       console.log(arrhes+" arrhes");
document.getElementById('btnResa').hidden=true; 
clearInterval(myIntercheckmailResa); 
let currentDate = new Date().toJSON().slice(0, 10);
    
     let ip =        $('#ip').val();
    let nom =       $('#fNomResa').val();
    let prenom =    $('#fPrenomResa').val();
    let nomPrenom=nom+" "+prenom;
   
    let    dateResa=currentDate;
    let    confirm="false" ;
    var    dateDeb= $('#startDate').val();
    var    dateFin= $('#endDate').val();
    let    email=$('#fEmailResa').val();
    let    adresse=$('#fAdresseResa').val();
    let    tel=$('#fTelResa').val();
    let    prix=   $('#prix').html();
    let    encaiC= "false";
                                             // à coder : type logement 
    let    typLogemt=1 ;
    let nadult= Number($('#finforesaNadult').val()); 
    let nenfant=Number($('#finforesaNenfant').val()); 
    let nchien=Number($('#finforesaNchien').val()); 
    let idEmpl= $('#emplNumero').val();
                        console.log("ok "+dateResa);
        
    var myData =  { "action": "resa",
                    "ip": ip,
                    "arrhes"  : arrhes,
                    "taxeLocale" : taxeLocale,
                    "idEmpl": idEmpl,
                    "nomPrenom": nomPrenom,
                    "dateResa": dateResa,
                    "confirm": confirm,
                    "dateDeb": dateDeb,
                    "dateFin": dateFin,
                    "email": email,
                    "adresse": adresse,
                    "tel": tel,
                    "prix": prix,
                    "encaiC": encaiC,
                    "nAdult": nadult,
                    "nEnfant": nenfant,
                    "nChien": nchien,
                    "typLogemt": typLogemt};

                    
    $.ajax({
        url: "server.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",

                             // si l'envoi est réussi 
        success: function(response) { 
            console.log("ok ");
            $('#msgresaresult').html("Confirmation de réservation à réception des arrhes. Un email vous a été envoyé.      ");
// partir ailleurs sinon btn resa reste apparant , un email vous a été envoyé
        },
                            
                           
        error: function(error) {
             console.log("errrrror : "+error.statusText);
                            
        }
        
    });
}


function prix() {
    
     
     
    var njoursHorsSaison=0;
    var njoursSaison = 0;
      prixbool=true;
    let nadult= $('#finforesaNadult').val(); 
    let nenfant=$('#finforesaNenfant').val(); 
    let nchien=$('#finforesaNchien').val(); 
    
    var dateDeb= new Date($('#startDate').val());
    var dateFin= new Date($('#endDate').val());
    var dateyear= new Date();
    var year = dateyear.getFullYear();
    var debSaison= new Date(year+'/07/01');
    var finSaison= new Date(year+'/08/31');
    
    if ( dateDeb <  debSaison &&  dateFin <  finSaison && dateFin > debSaison) { // a cheval 01/07  / (1000 * 3600 * 24)
       //--------------------------------------------------------------------------------------------- var enlevé- !!!!!!--------------------------------------------
       
          njoursSaison =  Math.round( (dateFin - debSaison) / (1000 * 3600 * 24) )  ;
          njoursHorsSaison = Math.round( (debSaison  - dateDeb) / (1000 * 3600 * 24) ) ;
        $('#njoursInfo').html(Number(njoursSaison+njoursHorsSaison) + " nuits");
        console.log( debSaison+" " +dateDeb+' njoursSaison : '+njoursSaison+" njoursHorsSaison : "+njoursHorsSaison);
        
    }
     if ( dateDeb > debSaison && dateDeb < finSaison && dateFin > finSaison ) { // a cheval 31/08
    
          njoursSaison = Math.round( (finSaison -  dateDeb) / (1000 * 3600 * 24) )  ;
          njoursHorsSaison =  Math.round(   (dateFin  - finSaison ) / (1000 * 3600 * 24) )  ;
        $('#njoursInfo').html(Number(njoursSaison+njoursHorsSaison) + " nuits");
        console.log('njoursSaison : '+njoursSaison+" njoursHorsSaison : "+njoursHorsSaison);
        
    }
     if ( dateDeb > finSaison || dateFin < debSaison ) { // hors saison 
           njoursHorsSaison = Math.round( (dateFin  - dateDeb) / (1000 * 3600 * 24) ) ;
            njoursSaison = 0;
            console.log('njoursSaison : '+njoursSaison+" njoursHorsSaison : "+njoursHorsSaison);
     }
      if ( dateDeb > debSaison  && dateFin < finSaison ) { // en saison 
            njoursSaison =  Math.round( (dateFin - dateDeb) / (1000 * 3600 * 24) )  ;
            njoursHorsSaison =0;  
            console.log('njoursSaison : '+njoursSaison+" njoursHorsSaison : "+njoursHorsSaison);
     }
    
    let myData =  {"action"             : "prix",
                    "njoursHorsSaison"  : njoursHorsSaison,
                    "njoursSaison"      : njoursSaison,
                    "nadult"            : nadult,
                    "nenfant"           : nenfant,
                    "nchien"            : nchien  
                     };
                    
        $.ajax({
                            url: "server.php", // Url appelée
                            method: "POST",              // la méthode GET ou POST
                            data:myData,
                            dataType: "JSON",

                             // si l'envoi est réussi 
                            success: function(response) {
                                 console.log(response.prix+" prix avant round, njs"+njoursHorsSaison+" njhs"+njoursSaison);
                                                        // delete =>>>> arrondissement effectué sur le serveur à verif 
                            let prix=Math.round(response.prix * 100) / 100;
                            response.arrhes=Math.round(response.arrhes * 100) / 100;
                            arrhes=response.arrhes;
                            $('#prix').html(prix); 
                            $('#arrhes').html( "( arrhes inclus : "+ arrhes+"euros)");
                                
                            taxeLocale=response.taxeLocale;
                            
                            taxeLocale=Number(taxeLocale).toFixed(2);
                             $('#taxeLocale').html(taxeLocale);
                                
                                
                            
                             console.log(response.prix+" "+response.taxeLocale);
                            document.getElementById('btnPrix').hidden=true; 
                             if  (mailResabool && nomPrenomAdresseTelBool) {
                                 document.getElementById('btnResa').hidden=false; 
                                 
                             }
                            
                            },
                            
                            // s il y a une erreur je l'affiche en console et dans la div #messageID
                            error: function(error) {
                                console.log("errrrroreuuuu"+error.statusText);
                            
                            }
        });
}

function voirEmplLibres() {
    
         document.getElementById('fNomResa').disabled=true;
        document.getElementById('fPrenomResa').disabled=true;
        document.getElementById('fAdresseResa').disabled=true;
        document.getElementById('fTelResa').disabled=true;
        document.getElementById('fEmailResa').disabled=true;
     
        
         var dateDeb= $('#startDate').val();
         var dateFin= $('#endDate').val();
      
          $('#dateDebInfo').html("Du "+new Date($('#startDate').val()).toLocaleString().substr(0,10));
          $('#dateFinInfo').html("Au "+new Date($('#endDate').val()).toLocaleString().substr(0,10));
     var myData= {   "action": "voirEmplLibres", 
                  "dateDeb": dateDeb,
                     "dateFin": dateFin,
                };
    console.log( myData);
    
 
                    
    $.ajax({
        url: "server.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",

                             // si l'envoi est réussi 
        success: function(response) { 
            console.log(response);
          
           
            if (  response.emplLibres.length>0) {
                
                 document.getElementById('startDate').disabled=true;
                document.getElementById('endDate').disabled=true;
    
                document.getElementById('result').hidden=false; 
                 document.getElementById('btnPrix').hidden=false;
                document.getElementById('btnVoirEmplLibres').hidden=true;
            //    document.getElementById('btnResaInscript').hidden=false;
                 
               // const myInterPrix=setInterval(prix,1000);
                
                document.getElementById('finforesaNadult').disabled=false;
                document.getElementById('finforesaNenfant').disabled=false;
                document.getElementById('finforesaNchien').disabled=false;
                $('#resultEmpl').html(" " );
                prix();
                
                
               var    idEmpl=response.emplLibres[0];
                $('#emplNumero').val(idEmpl);
                clearInterval(myIntercheckmailResa)  ;
                
       
                    

               
            } else {
                 $('#resultEmpl').html("Pas d'emplacement libre <br> Plan d'occupation plus bas " );
                 document.getElementById('result').hidden=false;
                document.getElementById('btnPrix').hidden=true;
                  document.getElementById('btnVoirEmplLibres').hidden=false;
            }

        },
                            
                           
        error: function(error) {
             console.log("errr6rror : "+error.statusText);
                            
        }
        
    }); 
}

/*
function checkDates() {
    var startDate = document.getElementById('startDate').value;
    var endDate = document.getElementById('endDate').value;
    var msgresultDiv = document.getElementById('msgDatesResa');
    
    
    if (new Date(startDate) > new Date(endDate)) {
       boolFinAvantDeb=true;
       njours =0;
        msgresultDiv.textContent = 'La date de début ne peut pas être après la date de fin.';
    } else {
          boolFinAvantDeb=false;
          
             var start = new Date(startDate);
          //   start.setDate(start.getDate());
              var end = new Date(endDate);
            //  end.setDate(end.getDate());
              $('#dateDeb').val(startDate);
              $('#dateFin').val(endDate);
            msgresultDiv.textContent = ' ';
    
         njours =( end - start) / (1000 * 3600 * 24)  ;
         
         $('#njoursInfo').html(njours  + " nuits");
           console.log(boolFinAvantDeb) ;
             console.log(njours) ;
    }
      if ( !boolFinAvantDeb && njours>0  ) { 
       
        document.getElementById('btnVoirEmplLibres').hidden=false;
    } else { 
       
        document.getElementById('btnVoirEmplLibres').hidden=true;
    } 
}     
*/ 
       
       

</script>

<?php     include "footerG.php"; ?>
        
        
        
        