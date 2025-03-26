<?php 
header('content-type: text/html; charset=latin1'); 
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
date_default_timezone_set("Europe/Paris");

$servername = "localhost";
$username = "u501368352_rooot";
$passwordDb = "Grandschenes25!";
$dbname = "u501368352_grandschenes";
   
    $todayPlusSept= date('Y-m-d', strtotime("+7 days") );
  
    
    $datesArrhes=[];
    
       // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
     
    // Check connection
    if ($myConn->connect_error) {
        
      die("Connection failed: " . $myConn->connect_error);
      
    }  else { 
        $sqlStrVoirResaNonConf = "SELECT * FROM listeResa WHERE confirm=0  ";
           
            $resultVoirResaNonConf = $myConn->query($sqlStrVoirResaNonConf);
        
      
             
            if (  $resultVoirResaNonConf->num_rows > 0) {
                      
                while ( $rowResaNonConf = $resultVoirResaNonConf->fetch_assoc() ) {
                
                    $idResa     =$rowResaNonConf['idResa'];    
                    
                    $arrhes     =  $rowResaNonConf['arrhes'];  
                    $nomprenom  =$rowResaNonConf['nomPrenom']; 
                    $adresse    =  $rowResaNonConf['adresse'];
                    $tel        =$rowResaNonConf['tel'];
                    $email      =$rowResaNonConf['email'];
                    $dateDeb    =$rowResaNonConf['dateDeb'];
                    $dateFin    =$rowResaNonConf['dateFin'];
                    $prix       =$rowResaNonConf['prix'];
 
                       // si le début du séjour commence moins d'une semaine avant aujourd'hui 
                        if ($dateDeb< $todayPlusSept) {
                                   
                            
                 // -------------------- récupération de l'idClient dans la listeClients
                            $sqlStrRecupIdClient = "SELECT * FROM listeClients WHERE nomPrenom=  '$nomprenom' ";
               
                            $resultRecupIdClient = $myConn->query($sqlStrRecupIdClient);
                            $row = $resultRecupIdClient->fetch_assoc();
                            $idClient    =$row['idClient'];    
                            
                
                // --------------------------- enregistrement des arrhes à encaisser
                        $insertArrhesEncaiCstrsql="INSERT INTO listeArrhesEncaiC (idresa,  arrhesEncaiC ,    nomPrenom,   adresse,     tel,     email,  dateDeb , dateFin , prix, idClient) 
                                                                       VALUES ('$idResa' ,'$arrhes'  ,'$nomprenom', '$adresse',   '$tel',  '$email', '$dateDeb', '$dateFin', $prix, $idClient)";
                            $resultInsertArrhesEncaiC = $myConn->query($insertArrhesEncaiCstrsql);
                             
                 // ------------------------ suppression de la resa 
                            $delStrSql=" DELETE  FROM listeResa WHERE idResa =$idResa ";
                           
                            $resultDelrArrhes = $myConn->query($delStrSql);
                         
                  // ---------------- empilement des infos resa supprimées pour le mail 
                             
                                   $today=date('d-m-Y');
                               
                            
                          
                           
                            $dateDeb = new DateTime($dateDeb);
                            $dateDeb = $dateDeb->format('d-m-Y');
                           
                             $dateFin = new DateTime($dateFin);
                            $dateFin = $dateFin->format('d-m-Y');


                             
                             
                            
                              
                               
                            $data=" Réservation n° : $idResa de Mr/Mme $nomprenom,  \n\n  adresse : $adresse, téléphone : $tel, email : $email, idClient : $idClient   \n\n Arrhes à encaisser : $arrhes euros, Séjour du : $dateDeb au $dateFin, supprimée aujourdhui : $today ";
                             
                            array_push($datesArrhes, $data);          
                            
                    } // if dateDeb ...  si le début du séjour commence moins d'une semaine avant aujourd'hui 
                } // while
              
            } // if (  $sqlStrVoirResaNonConf->num_rows > 0)
                
             
    
            
            if ( sizeof($datesArrhes)>0 ) {
                $datesArrhes=implode(" ",$datesArrhes);
             
                $message = "resas supprimees   \n\n  $datesArrhes  \n\n ";
                
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
    
       
            } //sizeof $datesArrhes

                   
        $myConn->close(); 
        
        
    
    
    } //else db ok
    
    
    

    


    


?>