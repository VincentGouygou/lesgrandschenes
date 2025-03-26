

<script charset="utf-8" type="text/javascript">

clearInterval(myIntercheckLoginPass);
let currentDate = new Date().toJSON().slice(0, 10);
  $('#logging').hidden=true;  
   document.getElementById("dDivListResaNonConfirm").style.display = "none";  
 
 
 // mis dans index
 //checkEmplOccupDates();
//voirCumulTaxeSejour();
 
 
function encaiCResa(idd) {
    let myData =  {     "action" : "resaEncaiC",
                        "idResa" : idd
                              // "nomPrenom"    : nomPrenom,
                     };

                    
    $.ajax({
        url: "servmin.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",

                          
        success: function(response) { 
            var resaRow="";
            if (response.action=="ok") { 
                $('#rowResaId').html('Encaissement confirmé');
                voirCumulTaxeSejour();
                $('#fIdResa').val(" ");
            }
        },
                           
        error: function(error) {
             console.log("errrrror : "+error.statusText);
                            
        }
        
    });   

}


function seekResa() {

    var iddResa= $('#fIdResa').val();
    console.log('ideresa : '+ iddResa);
  //  let nom=$('#fNom').val();
   // let prenom=$('#fPrenom').val();
  //  let nomPrenom=nom+" "+prenom;
    
    let myData =  {   "action"   : "seekResa",
                       // "nomPrenom"    : nomPrenom,
                        "idResa" : iddResa
                     };

                    
    $.ajax({
        url: "servmin.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",

                          
        success: function(response) { 
            var resaRow="";
            if (response.action=="ok") {
                console.log('response : '+ response.resaRow);
                    
                    resaRow="Numero de Réservation : "+response.resaRow.idResa+" Début du séjour : "+response.resaRow.dateDeb+" Fin du séjour : "+response.resaRow.dateFin+" Nom et prénom : "+response.resaRow.nomPrenom+" Téléphone : "+response.resaRow.tel+" Prix : "+response.resaRow.prix +" <button class='btnjour border   pointer' onclick='encaiCResa("+response.resaRow.idResa+");'  > Confirmer l'encaissement</button>   <br>";
                    
                    $('#rowResaId').html(resaRow);
            } else {
                $('#rowResaId').html('Introuvable... vérifier le numéro');
            }
         
        },
                           
        error: function(error) {
             console.log("errrrror : "+error.statusText);
                            
        }
        
    });   

}

 
function voirCumulTaxeSejour() {
     var myData =  {   "action"  : "voirCumulTaxeSejour"
                     };

                    
    $.ajax({
        url: "servmin.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",

                          
        success: function(response) { 
            if (response.action=="ok") {
                
                $('#taxeSejour').html( response.taxeLocale);
                
            }
        },
                           
        error: function(error) {
             console.log("errrrror : "+error.statusText);
                            
        }
        
    });               
            
            
            
            
}
 
function confirmResa(idResa){
      var myData =  {   "action"  : "confirmResa",
                        "idResa"  : idResa
                     };

                    
    $.ajax({
        url: "servmin.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",

                          
        success: function(response) { 
            if (response.action=="okConfirm") {
                if (response.num_rows==0) { 
                      document.getElementById("dDivListResaNonConfirm").style.display= "none";
                } else {
                    voirResa();
                }
            } 
            checkEmplOccupDates ();
        },
                           
        error: function(error) {
             console.log("errrrror : "+error.statusText);
                            
        }
        
    });               
}
function voirResa() {
    
     var myData =  {   "action"  : "voirResaNonConfirm"
                        
                        
                     };

                    
    $.ajax({
        url: "servmin.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",

                          
        success: function(response) { 
            if ( response.action=="error" ) {
            
                  document.getElementById("dDivListResaNonConfirm").style.display = "none";
            } else {
               
                var tabresanonconfirm = [];
              
                 for (var i = 0; i < response.response.length ; i++) {
                 /*
                    tabresanonconfirm[i]=response.response[i].idResa+" "+response.response[i].dateDeb+" "+response.response[i].dateFin+" "+response.response[i].nomPrenom+" "+response.response[i].tel+" <br>";
                  */  
                      
                    tabresanonconfirm[i]=response.response[i].idResa+" "+response.response[i].dateDeb+" "+response.response[i].dateFin+" "+response.response[i].nomPrenom+" "+response.response[i].tel +"<button class='btnjour border   pointer' onclick='confirmResa("+response.response[i].idResa+");'  > Confirmer </button>   <br>";
                    
                    
                 }
                tabresanonconfirm=tabresanonconfirm.toString().replace(/,/g,'');
                $('#dDivListResaNonConfirm').html("Réservations non confirmées<br>"+tabresanonconfirm);
                document.getElementById("dDivListResaNonConfirm").style.display = "block";
            }
        }
        
    });
}

function resetCalendar() {
        var dayIndex    =  0;
        var numeroSemaine = 1;
       

    for (var i = 0; i < 112  ; i++) {
        
       
         const jourdelasemaine =[ 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
        var dayIndexNom = jourdelasemaine[ dayIndex ];
    
      //  console.log(dayIndexNom+" "+numeroSemaine);
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
    var debb= $('#startDate').val();
    var finn=$('#endDate').val();
      var myData =  {   "action"  : "CheckEmplOccupDates",
                        
                        "dateDeb"   : debb,
                        "dateFin"   : finn
                     };

                    
    $.ajax({
        url: "servmin.php", // Url appelée
        method: "POST",              // la méthode GET ou POST
        data: myData,
        dataType: "JSON",

                          
        success: function(response) { 
             var numeroSemaine = 1;
             var listoccup= [];
            var occup = response.txOccup;  
             var coloor;
             const jourdelasemaine =[ 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            
           // if (dayZero == '')
            var dayZero = new Date(occup[0][0]);
                dayZero =  dayZero.getDay()+1;
            if (dayZero>=8) { dayZero=1;}
            var dayZeroNom = jourdelasemaine[dayZero];
            var tailleOccup= occup.length ;
            if ( tailleOccup > 111 ) {
                tailleOccup=111;
            }
            for (var i = 0; i < tailleOccup ; i++) {
            
                
                
                
                var dDate = new Date(occup[i][0]);
                var mMois = dDate.getMonth()+1;
                dDate = dDate.getDate();
               
                let dayIndex    =  new Date(occup[i][0]);
                dayIndex        = dayIndex.getDay();
                let dayIndexNom = jourdelasemaine[ dayIndex ];
                  confirmArrhes=   occup[i][2];
               
                
                         if (confirmArrhes==0) { 
                          
                                               arrhesnotconfirm="arrhesnotconfirm";

                         } 
                          if (confirmArrhes==1) { 
                          
                                                   arrhesnotconfirm=" ";
                         } 

                $('#'+dayIndexNom+numeroSemaine).html( "<button class='btnjour "+ arrhesnotconfirm+"  border   pointer' onclick='voirResa();'  >  "+dDate+"/"+mMois+"<br>"+occup[i][1]+" </button>" );
               
               
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
             //   console.log(coloor + " "+ dayIndexNom+numeroSemaine);
                dayIndex++;
                if (dayIndex==7) {
                    dayIndex=1; 
                    numeroSemaine++;
                    if (numeroSemaine==18) {  numeroSemaine=1 ;             }
                }
            } /// fin du for -------------------------------
              
           // $('#resultOccup').html(listoccup);
            
       
            
           
            

      
            
       
        },
                            
                           
        error: function(error) {
             console.log("errrrror : "+error.statusText);
                            
        }
        
    });       
}       




  
</script>