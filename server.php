<?php 
header('content-type: text/html; charset=latin1'); 
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
date_default_timezone_set("Europe/Paris");

$servername = "localhost";
$username = "u501368352_rooot";
$passwordDb = "Grandschenes25!";
$dbname = "u501368352_grandschenes";

/// ----------------- POUR MR Mamiah  ligne 128 -----------------------------------------


/*
 
function inscription($conn,$nomPrenom,$adresse,$email,$ip, $telephone ="00"    ) { 
        
        
        $sql = "SELECT idClient, email, tel FROM listeClients ";
     
        $result = $conn->query($sql);
                echo $nomPrenom,$adresse,$email,$ip, $telephone ;

        if ($result->num_rows > 0) {
           // output data of each row
            while($row = $result->fetch_assoc()) {
              // echo "email: " . $row["email"]. " - password: " . $row["password"]. "<br>"; 
              if  ($email==$row["email"] )  {
                $response=['action'=>'Vous êtes dèjà inscrit  ! ! ! '] ;
                echo  json_encode($response);
                exit;
              }
            }
     
           // date_default_timezone_set("Europe/Paris");
            $dateHeureInscription=date(DATE_ATOM);
           
            $insert = "INSERT INTO listeClients(ip,  dateHeureInscription ,    nomPrenom,   adresse,     tel,       email,    ) 
                                    VALUES ('$ip' ,'$dateHeureInscription'  ,'$nomPrenom','$adresse','$telephone','$email')";
               echo"dfgdfh465456";
            $resultt=$conn->query($insert) ;
            if ($resultt === TRUE) {
       
                  $strsql="SELECT MAX(idClient) AS lastid FROM listeClients";
                  $resultt=$conn->query($strsql) ;
                  $row = $resultt->fetch_assoc();
                  
                  $iduser=$row['lastid'];
          
            }
            
            return [$resultt,$iduser];
            // récuperer dans le processus parent par : 
            // [ $resultt, $iduser ] = inscription(......);
        }
}

*/



function setInterval($funktion, $milliseconds){
    $seconds=(int)$milliseconds/1000;
    while(true)
    {
        $funktion();
        sleep($seconds);
    }
}

function checkArrhes(){
    
   
    //checkArrhes();
    
    
    $todayMoinsSept= date('Y-m-d', strtotime("-7 days") );
     
    $datesArrhes=[];
    
       // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
     
    // Check connection
    if ($myConn->connect_error) {
        
      die("Connection failed: " . $myConn->connect_error);
      
    }  else { 
        $sqlStrVoirArrhes = "SELECT * FROM listeResa WHERE confirm=0  ";
           
            $resultVoirArrhes = $myConn->query($sqlStrVoirArrhes);
        
       
             
            if (  $resultVoirArrhes->num_rows > 0) {
                      
                while ( $row = $resultVoirArrhes->fetch_assoc() ) {
                    
                $dateResa=  $row["dateResa"];   
                $idResa  =  $row["idResa"];  
                
                    if ($dateResa< $todayMoinsSept) {
                               
                        $data=" dateResa : " . $dateResa ."   todayMoinsSept :  " . $todayMoinsSept .  " idResa :" .$idResa;
                                
                         array_push($datesArrhes, $data);
                       
                  
                
                     
                    $delStrSql=" DELETE  FROM listeResa WHERE idResa =$idResa ";
                   
                    $resultDelrArrhes = $myConn->query($delStrSql);
                       
                        
                    }
              
                }
                $datesArrhes=implode(" ",$datesArrhes);
             
                 $message = "resas supprimees   \n\n $datesArrhes  ";
               
                 $message.=  utf8_decode($message ); 
                 $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Host = 'smtp.hostinger.fr';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->Username = 'email@campinglesgrandschenes.org';
                        $mail->Password = 'Vince46!';
                        $mail->setFrom('email@campinglesgrandschenes.org' );
                        $mail->addReplyTo('email@campinglesgrandschenes.org');
                        $mail->addAddress('vincent.gouygou@gmx.fr');
                        //  lesgrandschenespinsac@gmail.com   vincent.gouygou@gmx.fr
                        $mail->Subject = utf8_decode("DELETE idresas ");
                        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
                        $mail->Body =  $message;
                        //$mail->addAttachment('test.txt');
                        if (!$mail->send()) {
                           // echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
                       //   echo "Erreur lors de l'envoi de l'email de message.";
                                  // echo "Error inserting: " . $conn->error;
                        }
    
        /*        
            $response=['action'=> 'ok',
                       'response' => $datesArrhes] ;       
                   
            echo  json_encode($response );
        
        } else {      
      
             $response=[ 'action'=> 'error',
                        'error' => $myConn->error
                        ] ;
        echo  json_encode($response );
        
        }
     
    */
    
            }
     
                   
        $myConn->close(); 
        
        
    
    
    }
    
    
    

 

}

// ---------------------------- ici  setInterval ------------------------------------------
// 86 400 000 secondes = 1 jour 
// setInterval(checkArrhes , 30000);

//-------------------------------------- test pour  la fonction checkarrhes ------------------------ 
if ($_POST['action']=='CheckArrhes' ) {
    //checkArrhes();
    
    
    $todayMoinsSept= date('Y-m-d', strtotime("-7 days") );
     
    $datesArrhes=[];
    
       // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
     
    // Check connection
    if ($myConn->connect_error) {
        
      die("Connection failed: " . $myConn->connect_error);
      
    }  else { 
        $sqlStrVoirArrhes = "SELECT * FROM listeResa WHERE confirm=0  ";
           
            $resultVoirArrhes = $myConn->query($sqlStrVoirArrhes);
        
       
             
            if (  $resultVoirArrhes->num_rows > 0) {
                      
                while ( $row = $resultVoirArrhes->fetch_assoc() ) {
                    
                $dateResa=  $row["dateResa"];   
                $idResa  =  $row["idResa"];  
                
                    if ($dateResa< $todayMoinsSept) {
                               
                        $data=" dateResa : " . $dateResa ."   todayMoinsSept :  " . $todayMoinsSept .  " idResa :" .$idResa;
                                
                         array_push($datesArrhes, $data);
                       
                  
                
                     
                  //  $delStrSql=" DELETE  FROM listeResa WHERE idResa =$idResa ";
                   
                  //  $resultDelrArrhes = $myConn->query($delStrSql);
                       
                        
                    }
              
                }
                $datesArrhes=implode(" ",$datesArrhes);
             
                 $message = "resas supprimees   \n\n $datesArrhes  ";
               
                 $message=  utf8_decode($message ); 
                 $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Host = 'smtp.hostinger.fr';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->Username = 'email@campinglesgrandschenes.org';
                        $mail->Password = 'Vince46!';
                        $mail->setFrom('email@campinglesgrandschenes.org' );
                        $mail->addReplyTo('email@campinglesgrandschenes.org');
                        $mail->addAddress('vincent.gouygou@gmx.fr');
                        //  lesgrandschenespinsac@gmail.com   vincent.gouygou@gmx.fr
                        $mail->Subject = utf8_decode("DELETE idresas ");
                        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
                        $mail->Body =  $message;
                        //$mail->addAttachment('test.txt');
                        if (!$mail->send()) {
                           // echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
                       //   echo "Erreur lors de l'envoi de l'email de message.";
                                  // echo "Error inserting: " . $conn->error;
                        }
    
                
            $response=['action'=> 'ok',
                       'response' => $datesArrhes] ;       
                   
            echo  json_encode($response );
        
        } else {      
      
             $response=[ 'action'=> 'error',
                        'error' => $myConn->error
                        ] ;
        echo  json_encode($response );
        
        }
     
    
    
     
                   
        $myConn->close(); 
        
        
    
    
    }
    
    
    

    
}



if ($_POST['action']=='CheckEmplOccupDates' ) {
    // date deb et dab fin recus de $_POST
    // debscan = dateDeb , finscan = dateFin +20 jours
    
      
    
    $conn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }  
    else {
        
      //echo "database readboooks connected successfully ";
    
     $dateDebSeek     =    $_POST['dateDeb']; //strings
     $dateFinSeek     =    $_POST['dateFin'];
 //    $dateDebSeekDate = date('Y-m-d',$dateDebSeek);
   //  $dateFinSeekDate = date('Y-m-d',$dateFinSeek);
 // $dateDeb = date('Y-m-d',$dateDebSeek);
 // $dateFin = date('Y-m-d',$dateFinSeek);

$start = new DateTime($dateDebSeek);
$end = new DateTime($dateFinSeek);
//Create a DateInterval object with a 1 day interval
$interval = new DateInterval('P1D');

$dates = [];
$itotal=0;

// ------------------------------------------------------- remplir le tableau avec 0 occup  et confirm 1 pour chaque date

for($i = $start; $i <= $end; $i->add($interval)){
 // $dates[] = $i->format('Y-m-d');
     array_push($dates, array( $i->format('Y-m-d') , 0, 1));
  $itotal++;
 
}
    // ------------------------------------------------------- 
     
        
        for ($i=0; $i < 25 ; $i++) { // test par emplacement verif 26
        
            $sqlStrVoir = "SELECT * FROM listeResa WHERE idEmpl=$i  ";
            // AND dateDeb => $dateDebSeek  AND dateFin <= $dateDebSeek 
          //  echo $sqlStrVoir . "ssssssss "  ;
            $resultVoir = $conn->query($sqlStrVoir);
          //  echo $sqlStrVoir  ;
            
            
               
           
           // if ( $resultVoir)  {
            if (  $resultVoir->num_rows > 0) {
                 
                while($row = $resultVoir->fetch_assoc() ) {
                        
                  
                 
                    $start_date = date_create( $row["dateDeb"]);
                    $end_date   = date_create($row["dateFin"]); // If you want to include this date, add 1 day
                    
                    $interval = DateInterval::createFromDateString('1 day');
                    $daterange = new DatePeriod($start_date, $interval ,$end_date);
                     
                    for ($ii = 0; $ii < $itotal; $ii++) {
                        
                            
                           foreach($daterange as $date1){
                            
                              //  echo $dates[$ii][0] . " " ; 
                                 $conff=$row["confirm"];
                                
                                if ( $dates[$ii][0]  == $date1->format('Y-m-d') ){
                                         if ( $conff==0 ) { 
                                    $dates[$ii][2]=0;
                               } 
                                    $dates[$ii][1] ++;///occup 
               //  echo  $date1->format('Y-m-d') . " ".  $dates[$ii][0] ." ". $i . " ". $dates[$ii][1] . "<br> " ;
                                }
                                
                            }    
                            
                        
                         
                        
                    }
                } // fin while pour chaque resa 
                
                 
            }
    
        } // ----------------------------- fin du for -----------------------------------------------
      
 /*          
 for ($i = 0; $i < $itotal; $i++) {
      echo $dates[$i][0] . "<br>";
     echo $dates[$i][1] . "<br>";
 }
    */ 
    
            $responseVoir=[ 'respVoir'=> 'ok',
                            'txOccup'=> $dates ] ;
            echo  json_encode($responseVoir );
            
                 
      

    
      
                
    }  // ---------------------- fin else( db connection is ok )  >>  -------------------------------------------------------------
 
                   
        
    
    
    
                   
        $conn->close();  
        
} 



if ( $_POST['action']=='showOverBookDates') {
    // date deb et dab fin recus de $_POST
    // debscan = dateDeb-10 jours, finscan = dateFin +10 jours
    
}

if ( $_POST['action']=='visitcount') {
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    if ($myConn->connect_error) {
        die("Connection failed: " . $myConn->connect_error);
    }  else     {
        $ipvisit            = $_POST['ip'];
        $datetimevisit= date(DATE_ATOM); 
         $addvisitsqlstr= "INSERT INTO connexionsCount (ipVisit ,dateTimeVisit  ) 
                                   VALUES ('$ipvisit','$datetimevisit')";
 
         $resultaddvisit = $myConn->query($addvisitsqlstr);
         
        if ($resultaddvisit ) {
            
            $lastidsqlstr="SELECT MAX(idVisit ) AS lastidVisit  FROM connexionsCount";
            $resultlastid=$myConn->query($lastidsqlstr) ;
            $rowid = $resultlastid->fetch_assoc();
              
            $visitcount=$rowid['lastidVisit'];
            
            
            $response=[ 'action'=> 'okVisit',
                        'count' =>  $visitcount];
            echo  json_encode($response);
        }
        
        $myConn->close();
    } 
}
  

if ( $_POST['action']=='prix') {
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    if ($myConn->connect_error) {
        die("Connection failed: " . $myConn->connect_error);
    }  else     {
         //  echo "database readboooks connected successfully ";
           
        $njoursHorsSaison  = $_POST['njoursHorsSaison'];
        $njoursSaison      = $_POST['njoursSaison'];
        $nadult            = $_POST['nadult'];
        $nenfant           = $_POST['nenfant'];
        $nchien            = $_POST['nchien'];
        // 0.3 = taxelocale par jour et par adulte,
        $constTaxeLocale=0.29;
        $prixAdultBasseSaison=3+$constTaxeLocale;
        $prixEmplBasseSaison=7;
        $prixAdultHauteSaison=4+$constTaxeLocale;
        $prixEmplHauteSaison=10;
       
        $prix=($prixEmplBasseSaison*$njoursHorsSaison)+
        ($prixEmplHauteSaison*$njoursSaison)+
        ($nadult*$prixAdultBasseSaison*$njoursHorsSaison)+
        ($nadult*$prixAdultHauteSaison*$njoursSaison)+
        (2*$nenfant*($njoursHorsSaison+$njoursSaison ))+(0.50*$nchien*($njoursHorsSaison+$njoursSaison ) );
        // pour avoir la décimale = *100 /100 . 30% arrhes 
        $arrhes=100*$prix*0.30 ;
        
        
        $arrhes=($arrhes/100);
 
        // taxeLocale a verser 
         // pour avoir la décimale = *100 /100
        $taxeLocale=(100*$constTaxeLocale)*$nadult*($njoursSaison+$njoursHorsSaison );
        $taxeLocale=$taxeLocale/100;
     
        $response=[ 'action'=> 'okPrix',
                    'prix'=> $prix,
                    'arrhes' => $arrhes,
                    'taxeLocale' => $taxeLocale ] ;
            echo  json_encode($response );
                 
        
     
    $myConn->close();
    } 
}

if ( $_POST['action']=='sendmsg') {
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    if ($myConn->connect_error) {
        die("Connection failed: " . $myConn->connect_error);
    }  else     {
         //  echo "database readboooks connected successfully ";
        $nomPrenom  =        $_POST['nomPrenom'];
        $msg        =        $_POST['message'];
        $msgmail    =        $_POST['email'];
        $ipmsg      =        $_POST['ip'];
        $dateheureMsg=date(DATE_ATOM); 
        $dateHeureInscription=$dateheureMsg;
        if ( isset( $_POST['telephone'] ) ) {
            $telephone = $_POST['telephone'];

        }
          
     //   [ $resultt, $iduser ] = inscription($myConn , $nomPrenom , $adresse , $msgmail , $ipmsg , $telephone    ) ;
        
                //   [ $resultt, $iduser ] =   inscription($Conn , $nomPrenom , $adresse , $email , $ip , $tel    ) ;
 
      
        $sql = "SELECT idClient, email, tel FROM listeClients ";
     
        $result = $myConn->query($sql);
               
 $dejaInscritBool=false; 
        if ($result->num_rows > 0) {
             // output data of each row
            while($row = $result->fetch_assoc()) {
              // echo "email: " . $row["email"]. " - password: " . $row["password"]. "<br>"; 
                if  ($msgmail==$row["email"] )  { $dejaInscritBool=true;           }
            
            
            }
        
      //  return [$resultt,$iduser];
        // récuperer dans le processus parent par : 
        // [ $resultt, $iduser ] = inscription(......);
        }
            
        
       
        if (!$dejaInscritBool) {
            
            $dateHeureInscription=date(DATE_ATOM);
                   
            $insert = "INSERT INTO listeClients (ip,  dateHeureInscription ,    nomPrenom,   adresse,     tel,     email    ) 
                                        VALUES ('$ip' ,'$dateHeureInscription'  ,'$nomPrenom','$adresse','$tel',  '$msgmail')";
        
            $resultt=$myConn->query($insert) ;
      
            if ($resultt === TRUE) {
       
                  $strsql="SELECT MAX(idClient) AS lastid FROM listeClients";
                  $resultt=$myConn->query($strsql) ;
                  $row = $resultt->fetch_assoc();
                  
                  $iduser=$row['lastid'];
          
            }
        }
 
        
        
        $insertMsg= "INSERT INTO listemessages (dateHeureMsg ,msgmail, nomPrenom , msg , ipmsg  ) 
                                   VALUES ('$dateheureMsg','$msgmail','$nomPrenom','$msg','$ipmsg')";
 
         $resultmsg = $myConn->query($insertMsg);
       
        if ($resultmsg) {
            
             $sqlstridmsg="SELECT MAX(idmsg) AS lastidMsg FROM listemessages";
              $resultidmsg=$myConn->query($sqlstridmsg) ;
              $rowid = $resultidmsg->fetch_assoc();
              
              $idMsg=$rowid['lastidMsg'];
            
            $message = "Un message de  $nomPrenom email $msgmail : \n\n ";
               
                 $message.=  utf8_decode($msg); 
                 $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Host = 'smtp.hostinger.fr';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->Username = 'email@campinglesgrandschenes.org';
                        $mail->Password = 'Vince46!';
                        $mail->setFrom('email@campinglesgrandschenes.org' );
                        $mail->addReplyTo('email@campinglesgrandschenes.org');
                        $mail->addAddress('vincent.gouygou@gmx.fr');
                        //  lesgrandschenespinsac@gmail.com   vincent.gouygou@gmx.fr
                        $mail->Subject = utf8_decode("Message sans inscription");
                        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
                        $mail->Body =  $message;
                        //$mail->addAttachment('test.txt');
                        if (!$mail->send()) {
                           // echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
                          echo "Erreur lors de l'envoi de l'email de message.";
                                  // echo "Error inserting: " . $conn->error;
                        } else {
                           // echo 'Le message a été envoyé.';
                                $response=[ 'action'=> 'msgOk' ,
                                            'idMsg'=> $idMsg] ;
                                echo  json_encode($response );
                        }
                        
            
        
        
        } else {
            $response=['action'=>'Error inserting:',
                      'error'=>$myConn->error] ;
            echo  json_encode($response );
              // echo "Error inserting: " . $conn->error;
            }
     
        $myConn->close();
    } 
}
 
if ($_POST['action']=='voirEmplLibres' ) {

    $conn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }  
    else {
       //  echo "database readboooks connected successfully ";
     
        $emplLibres=[];
        $dateDeb=       $_POST['dateDeb'];
        $dateFin=       $_POST['dateFin'];
        $occup=false;
        $idEmpl= 0;
        $idResa=0;
        $idResaaa=0;
     
        
        for ($i=1; $i < 26 ; $i++) { // test par emplacement
            $occup=false;
         // occupé meme si non confirmé
            $sqlStrVoir = "SELECT * FROM listeResa WHERE idEmpl=$i ";
            $resultVoir = $conn->query($sqlStrVoir);
         
             
            if ( $resultVoir)  {
             /*
                 // je stocke ce  message à la suite (append) du  fichier messages.txt 
                $myfile = fopen("emplacements.txt", "a") or die("Unable to open file!"); 
                // je lui rajoute un retour a la ligne html
                $message="dateDEB : ". $row['dateDeb17h'] .'<br>';
                // j'écris et je ferme le fichier
                fwrite($myfile, $message); 
                fclose($myfile);
                 */
                
                while (  $row = $resultVoir->fetch_assoc()){
                    if  (  $resultVoir->num_rows > 0  ) {  // plusieurs dates de resa ou au moins une pour l'emplacement $i
                        $dateDebList=$row['dateDeb'];
                        $dateFinList=$row['dateFin'];
                  
                        $idResa=$row['idResa'];
                  
                                           // ------------------- si une seule est contingeante alors break while + occup true
                            if ( ($dateDeb <= $dateDebList) && ($dateFin > $dateDebList)  ){ // contingeante gauche 
                                $occup=true;
                                
                                 break;
                            }  
                            if ( ($dateDeb < $dateFinList) && ($dateFin >= $dateFinList)  ){ // contingeante droite 
                                $occup=true;
                                 break;
                            }  
                            if ( ($dateDeb >= $dateDebList) && ($dateFin <= $dateFinList)  ){ // contingeante au milieu
                                $occup=true;
                                 break;
                            }  
                            if ( ($dateDeb <= $dateDebList) && ($dateFin >= $dateFinList)  ){ // contingeante autour
                                $occup=true;
                                 break;
                            }  
                            
                    }
                    if  (  $resultVoir->num_rows === 0  )  
                    { //-------------------------------------------- ($resultVoir->num_rows = 0) 
                           // -------- tri par emplacement, recherche négative : car si l'emplacement  n'est pas dutout réservé il n'apparait pas >>> libre
                            // $idEmpl=$i;
 
                             array_push($emplLibres,  $i);
                              
               
                
          
                      }
                } // ------------------------- fin while --------------------------------------
             if (!$occup)   {array_push($emplLibres,  $i); }
             if ($occup) { continue; }
            } 
            
             
    
        } // ----------------------------- fin du for -----------------------------------------------
       
        if ($emplLibres) { // array $emplLibre n est pas vide
            
            $responseVoir=[ 'respVoir'=> 'ok',
                            'emplLibres'=> $emplLibres ] ;
            echo  json_encode($responseVoir );
            exit();            
        } if (!$emplLibres)    {  // array $emplLibre  est  vide
            $responseVoir=[ 'respVoir' => 'rien',
                            'emplLibres' => $emplLibres ]  ;
            echo  json_encode(  $responseVoir );
            exit();            
        }

    
      
                
    }  // ---------------------- fin else( db connection is ok )  >>  -------------------------------------------------------------
 
                   
    $conn->close();   
}
//----------------------------------------------------------------- resa ------------------------------------------------------------------

if ($_POST['action']=='resa' ) {

    $conn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
    }  else {
        //echo "database readboooks connected successfully ";
        
      
     
       
         $ip=        $_POST['ip'];
       // $idClient=        $_POST['idClient'];
        $arrhes=        $_POST['arrhes'];
        $taxeLocale=    $_POST['taxeLocale'];
        $idEmpl=        $_POST['idEmpl'];
        $nomPrenom=     $_POST['nomPrenom'];
        $dateResa=      $_POST['dateResa'];
        $confirm=       $_POST['confirm'];
        $dateDeb=       $_POST['dateDeb'];
        $dateFin=       $_POST['dateFin'];
        $email=         $_POST['email'];
        $adresse=       $_POST['adresse'];
        $tel=           $_POST['tel'];
        $encaiC=      0;
        $nAdult=        $_POST['nAdult'];
        $nEnfant=       $_POST['nEnfant'];
        $nChien=        $_POST['nChien'];
        $typLogemt=     $_POST['typLogemt'];
        $prix=          $_POST['prix'];
        $dateheureResa=date(DATE_ATOM);
        
    
       
        $todayMoinsSept= date('Y-m-d', strtotime("-7 days") );
        //   [ $resultt, $iduser ] =   inscription($Conn , $nomPrenom , $adresse , $email , $ip , $tel    ) ;
 
      
        $sql = "SELECT idClient, email, tel FROM listeClients ";
     
        $result = $conn->query($sql);
               
        $dejaInscritBool=false; 
        if ($result->num_rows > 0) {
             // output data of each row
            while($row = $result->fetch_assoc()) {
              // echo "email: " . $row["email"]. " - password: " . $row["password"]. "<br>"; 
                if  ($email==$row["email"] )  { $dejaInscritBool=true;           }
                    $iduser=$row['idClient'];
            
            }
        
      //  return [$resultt,$iduser];
        // récuperer dans le processus parent par : 
        // [ $resultt, $iduser ] = inscription(......);
        }
            
        
       
        if (!$dejaInscritBool) {
            
            $dateHeureInscription=date(DATE_ATOM);
                   
            $insert = "INSERT INTO listeClients (ip,  dateHeureInscription ,    nomPrenom,   adresse,     tel,     email    ) 
                                        VALUES ('$ip' ,'$dateHeureInscription'  ,'$nomPrenom','$adresse','$tel',  '$email')";
        
            $resultt=$conn->query($insert) ;
      
            if ($resultt === TRUE) {
       
                  $strsql="SELECT MAX(idClient) AS lastid FROM listeClients";
                  $resultt=$conn->query($strsql) ;
                  $row = $resultt->fetch_assoc();
                  
                  $iduser=$row['lastid'];
          
            }
        }
 
        $insertResa = "INSERT INTO listeResa ( idClient ,taxeLocale  ,arrhes,dateheureResa ,ip, idEmpl, nomPrenom , dateResa, confirm ,dateDeb  ,dateFin, email ,  adresse,  tel, encaiC , nAdult, nEnfant, nChien                  ,typLogemt,prix) 
        VALUES (          $iduser   , $taxeLocale,       $arrhes ,'$dateheureResa' ,'$ip' , $idEmpl,'$nomPrenom','$dateResa',$confirm,'$dateDeb','$dateFin','$email','$adresse','$tel','$encaiC' ,'$nAdult','$nEnfant','$nChien','$typLogemt','$prix')";
              
        
        $resultResa = $conn->query($insertResa);
          
        if ($resultResa) { 
            
            $sqlstridresa="SELECT MAX(idResa) AS lastidResa FROM listeResa";
            $resultResa=$conn->query($sqlstridresa) ;
            $row = $resultResa->fetch_assoc();
          
            $idResa=$row['lastidResa']; 
            $dateDebMoinsSept=date_create($dateDeb);
            date_sub($dateDebMoinsSept,date_interval_create_from_date_string("7 days"));
            
       
            $dateDeb=date_create($dateDeb);
            $dateFin=date_create($dateFin);
                 
            $dateDeb=$dateDeb->format("d/m/Y");
            $dateFin=$dateFin->format("d/m/Y");
   
            $dateDebMoinsSept=$dateDebMoinsSept->format("d/m/Y"); 
           
        $message = "Bonjour $nomPrenom ,\n\nMerci pour votre reservation.\n\n";
        $message .= "La réservation Numero $idResa du $dateDeb au $dateFin pour $prix euros $nAdult adultes, $nEnfant enfant(s),$nChien chien(s),\n\n";
        $message .= "sera confirmée à réception d'un chèque de $arrhes euros d'arrhes avant le $dateDebMoinsSept sinon elle sera supprimée.\n\n";
         $message .=  "Aire naturelle de camping 'Les Grands Chênes \n\n 230 chemin de Piboulades \n\n 46200 Pinsac \n\n ";
       
        $message .= "Veuillez indiquer le numéro $idResa au dos du chèque \n\n NE PAS REPONDRE : contactez nous par message dans l'onglet \" Infos et Contact \" du site\n\n https://campinglesgrandschenes.org/info.php";
             $message=  utf8_decode($message); 
             $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->Host = 'smtp.hostinger.fr';
                    $mail->Port = 587;
                    $mail->SMTPAuth = true;
                    $mail->Username = 'email@campinglesgrandschenes.org';
                    $mail->Password = 'Vince46!';
                    $mail->setFrom('email@campinglesgrandschenes.org' );
                  //  $mail->addReplyTo('email@campinglesgrandschenes.org');
                    $mail->addAddress($email);
                    $mail->Subject = utf8_decode("Confirmation de Reservation");
                    //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
                    $mail->Body =  $message;
                    //$mail->addAttachment('test.txt');
                    if (!$mail->send()) {
                       // echo 'Erreur de Mailer : ' . $mail->ErrorInfo;
                      echo "Erreur lors de l'envoi de l'email de confirmation.";
                              // echo "Error inserting: " . $conn->error;
                    } else {
                       // echo 'Le message a été envoyé.';
                            $response=[ 'action'=> 'resaOk' ,
                                        'idResa'=> $idResa] ;
                            echo  json_encode($response );
                    }
            
            
        } else {
        $response=['action'=>'Error inserting:',
                    'error'=>$conn->error] ;
        echo  json_encode($response );
          // echo "Error inserting: " . $conn->error;
        }
     
    
    
    
                   
    $conn->close();   
    }
}
?>