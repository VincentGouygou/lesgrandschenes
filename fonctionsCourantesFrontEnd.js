
// <script charset="utf-8" type="text/javascript">
    
function jQajax(action,datatab,url) {
    
    let myData =  { "action": action,
                    "data"  : datatab};
    $.ajax({          // url: "wp-cron.php",
                            url: url, // Url appelée
                            method: "POST",              // la méthode GET ou POST
                            data: myData,
                            dataType: "JSON",
                             // si l'envoi est réussi 
                            success: function(response) {
                                return { "Ok" : response};
                            },
                                            // s il y a une erreur je l'affiche en console et dans la div #messageID
                            error: function(error) {
                                 return { "Error" : error.statusText};
                            }
                            
        });
        
}

     let nom =       $('#fNom').val();
    let prenom =    $('#fPrenom').val();
   
    let email =     $('#fEmail').val();
    let message =     $('#fMessage').val();
    let ip =     $('#ip').val();
    sendmsg(nom,prenom,message,email);
function sendmsg(nom,prenom,message,email) {
    
        clearInterval(myIntervalCheckmail);
   let nomPrenom=nom+" "+prenom;
        let myData =  { "nomPrenom": nomPrenom,
                    
                    "message": message,
                   
                    "email": email,
                    
                     "ip" : ip};
    let  response=jQajax("sendmsg", myData, "server.php");    
    if (typeof response.Error!== 'undefined') {
                $('#msgmail').html(response.Error+" "+response.error);

            
            }
    if ( typeof response.Ok!== 'undefined'){
                $('#msgmail').html(response.Ok.action);
                document.getElementById('fbuttonsendmsg').hidden=true;
            
            }
}
    /* --------------- exemple coté client : 
    
    let myData =  { "msg": "hello Alice",
                    "sender"  : "Bob",
                    "receiver": "Alice" };
                    
    response=jQajax("msgAction", myData, "serverMsg.php");
    */

// </script>



// --------------- exemple coté server :
<?php 
// encodage latin1 pour les éèô etc...
header('content-type: text/html; charset=latin1'); 

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
date_default_timezone_set("Europe/Paris");

$servername = "localhost";
$username = "u501368352_rooot";
$passwordDb = "Grandschenes25!";
$dbname = "u501368352_grandschenes";
 

switch ($POST['action']) {
    case "sendmsg":
        $msg        =$POST['msg'];
        $sender     =$POST['sender'];
        $receiver   =$POST['receiver'];
        $dateHeureMsg=date(DATE_ATOM);
        // code des actions à effectuer pour le transfert d'un message ... sql query ...
        if (resultsql) { // requetes sql ok
            $idmsg=row['idmsg']; // prendre l'id du message
            // empaqueter l'heure et l'id du message
            $response= ['dateHeureMsg'=> $dateHeureMsg,
                        'idmsg'       => $idmsg] ;
            // et assigner le tableau resultant a 'ok'
            $responseMsg=[ 'Ok'  => $response];
            // encoder en json et renvoyer au client               
            echo json_encode($responseMsg);
        } else {
             $response=['error' => $myConn->error];
        echo  json_encode($response );
        }
        break;
    case "inscription":
        // code des actions à effectuer pour une inscription
        break;
    case "connexion":
        // code des actions à effectuer pour une connexion
        break;
} ?>
<script charset="utf-8" type="text/javascript">
/*  --------------- exemple retour client
let myData =  { "msg": "hello Alice",
                "sender"  : "Bob",
                "receiver": "Alice" };
response=jQajax("msgAction", myData, "serverMsg.php");  */


if (typeof response.Ok !==undefined) {
    switch( response.Ok) {
      case "error "+*:
        // code block
        break;
      case y:
        // code block
        break;
      default:
        // code block
    } 
} else console.log 

</script>














