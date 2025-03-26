<?php 
header('content-type: text/html; charset=latin1'); 
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
date_default_timezone_set("Europe/Paris");
 
$servername = "localhost";
$username = "u501368352_rooot";
$passwordDb = "Grandschenes25!";
$dbname = "u501368352_grandschenes";

/*
if ($_POST['action']=='voirResaNonConfirm' ) {
    $listResaNonConfirm=[];
    
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
                    $nomprenom=  $row["nomPrenom"];   
                    
                   array_push($listResaNonConfirm, );
                  
                }
             
             
             
        $response=['action'=> 'ok',
                 //  'link' => 'https://campinglesgrandschenes.org/.admin/admin.php'
                   'dDivNonConf' => $listResaNonConfirm
                   ] ;       
                   
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
*/
 
if ($_POST['action'] == 'arrhesEncaiC' ) {
    
    
    // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($myConn->connect_error) {
        
      die("Connection failed: " . $myConn->connect_error);
      
    }  else { 
    
        $iddArrhesEncaiC    = $_POST['idResa'];
        $sqlStrArrhesEncaiC =  "  UPDATE  listeResa SET confirm =1 WHERE  idResa=$iddArrhesEncaiC";
    
        $resultArrhesEncaiC = $myConn->query($sqlStrArrhesEncaiC);
      
        if (  $resultArrhesEncaiC) {
                       
            $response=['action'   => 'ok' ] ;       
           
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
  
 
if ($_POST['action'] == 'resaEncaiC' ) {
    
    
    // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($myConn->connect_error) {
        
      die("Connection failed: " . $myConn->connect_error);
      
    }  else { 
    
        $iddResaEncaiC    = $_POST['idResa'];
        $sqlStrEncaiC =  "  UPDATE  listeResa SET encaiC =1 WHERE  idResa=$iddResaEncaiC";
    
        $resultEncaiC = $myConn->query($sqlStrEncaiC);
      
        if (  $resultEncaiC) {
                       
            $response=['action'   => 'ok' ] ;       
           
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
        
if ($_POST['action'] == 'seekResa' ) {
    
    
    // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($myConn->connect_error) {
        
      die("Connection failed: " . $myConn->connect_error);
      
    }  else {
        
        $iddResa    = $_POST['idResa'];
        $sqlStrSeekResa = "SELECT * FROM listeResa WHERE idResa=$iddResa ";
 
        $resultSeekResa = $myConn->query($sqlStrSeekResa);
    
         $row = $resultSeekResa->fetch_assoc();
         if (  $resultSeekResa->num_rows >0) { 
    
                $dateDeb    =$row['dateDeb'];
                $dateFin    =$row['dateFin'];
                $nomprenom  =$row['nomPrenom'];
                $tel        =$row['tel'];
                $email      =$row['email'];
                $idResaDb   =$row['idResa'];
                $prix       =$row['prix'];
                $resaRow  =[   "idResa"   => $iddResa,
                            "dateDeb"   => $dateDeb,
                            "dateFin"   => $dateFin,
                            "nomPrenom" => $nomprenom,
                            "tel"       => $tel,
                            "email"     => $email,
                            "idResaDb"  => $idResaDb,
                            'prix'      => $prix
                            ];
              
              
                $response=['action'   => 'ok',
                            'resaRow' => $resaRow ] ;       
               
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

if ($_POST['action'] == 'voirCumulTaxeSejour' ) {
    
    
    // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($myConn->connect_error) {
        
      die("Connection failed: " . $myConn->connect_error);
      
    }  else {
        
      
        $sqlStrCumuTaxSej = "SELECT * FROM listeResa  WHERE confirm='1' AND encaiC='1'";
 //   echo $sqlStrCumuTaxSej;
  //  echo "error". $resultCumuTaxSej->error; 
        $resultCumuTaxSej = $myConn->query($sqlStrCumuTaxSej);
        
        while($row = $resultCumuTaxSej->fetch_assoc() ) {
            $taxSej=$row['taxeLocale']; 
            $taxSej=number_format($taxSej, 2);
            $totalTaxSej=$totalTaxSej+$taxSej;
        }
         
         $response=['action'    => 'ok',
                   'taxeLocale' => $totalTaxSej ] ;       
               
        echo  json_encode($response );

       $myConn->close(); 
    }

}
if ($_POST['action'] == 'confirmResa' ) {
    // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($myConn->connect_error) {
        
       die("Connection failed: " . $myConn->connect_error);
      
    }  else {
         
        $idResa =  $_POST['idResa']; 
      
        $sqlStrConfirm = "SELECT * FROM listeResa WHERE confirm=0 AND idResa=$idResa ";
        $resultConfirm = $myConn->query($sqlStrConfirm);
        if (  $resultConfirm->num_rows >0) { 
            $sqlStrConfirm =  "  UPDATE  listeResa SET confirm =1 WHERE  idResa=$idResa";
        
            $resultConfirm = $myConn->query($sqlStrConfirm);
          
            if (  $resultConfirm) { 
                $response=['action'   => 'okConfirm',
                           'response' => $idResa] ;       
                echo  json_encode($response );
            } else {      
                $response=[ 'action'=> 'error',
                            'error' => $myConn->error
                            ] ;
                echo  json_encode($response );
            }
        } else {
            echo "not found" ;
        }
        $myConn->close();  
    }
}
if ($_POST['action'] == 'voirResaNonConfirm' ) {
    
    
    // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($myConn->connect_error) {
        
       die("Connection failed: " . $myConn->connect_error);
      
    }  else {
      //  $jour                =  $_POST['jour'];
      //  $mois                =  $_POST['mois']; 
      //  $listeResaNonConfirm =  $_POST['listeResaNonConfirm']; 
        
        $tabResa    =[];
        $rowResa    ="";
        $sqlStrVoir = "SELECT * FROM listeResa WHERE confirm=0  ";
    
        $resultVoir = $myConn->query($sqlStrVoir);
      
        if (  $resultVoir->num_rows > 0) {
             
            while($row = $resultVoir->fetch_assoc() ) {
                    
                $idResa     =$row['idResa'];
                $dateDeb    =$row['dateDeb'];
                $dateFin    =$row['dateFin'];
                $nomprenom  =$row['nomPrenom'];
                $tel        =$row['tel'];
                $email      =$row['email'];
                
                $rowResa=[  "idResa"   => $idResa,
                            "dateDeb"   => $dateDeb,
                            "dateFin"   => $dateFin,
                            "nomPrenom" => $nomprenom,
                            "tel"       => $tel,
                            "email"     => $email,
                            "listeResaNonConfirm" => $listeResaNonConfirm
                            ];
                array_push($tabResa,$rowResa);            
            }
            
            $response=['action'   => 'ok',
                       'response' => $tabResa,
                       'num_rows' => $resultVoir->num_rows-1
                       ] ;       
                   
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

if ($_POST['action']=='login' ) {
    // Create connection
    $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
    // Check connection
    if ($myConn->connect_error) {
        
        die("Connection failed: " . $myConn->connect_error);
      
    }  else {
      // echo "database readboooks coonected successfully ";
    
        $dateDeb    =    $_POST['dateDeb'];
        $ip         =    $_POST['ip'];
        $login      =    $_POST['login'];
        $pass       =    $_POST['pass'];
        if ($login=="patteblanche" && $pass=="Vince46!") {
            $datetimevisit= date(DATE_ATOM); 
            $connectedAdminsqlstr= "INSERT INTO listeConnectAdmin  (ip  ,datetimeCo  ) 
                                                         VALUES ( '$ip', '$datetimevisit')";
            $resultconnvisit = $myConn->query($connectedAdminsqlstr);
            if ( $resultconnvisit )  {  
         //   $response=['action'=> 'ok',
         //              'link' => 'https://campinglesgrandschenes.org/.admin/admin.php'] ;
                $fichierNom = "admin.txt";
                $handle = fopen($fichierNom, "r");
                $contents = fread($handle, filesize($fichierNom));
                fclose($handle);
                $fichierNomFunctions = "adminfunction.txt";
                $handlefunction = fopen($fichierNomFunctions, "r");
                $contentsfunction = fread($handlefunction, filesize($fichierNomFunctions));
                fclose($handlefunction);
                $response=['action'=> 'ok',
                           'dDiv' => $contents,
                           'dDivFunctions' => $contentsfunction
                          ] ;       
                echo  json_encode($response );
               
            } else {
                $response=[ 'action'=> 'error',
                            'error' => $myConn->error
                            ] ;
                echo  json_encode($response );
            }
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
    $dateDebSeek     =    $_POST['dateDeb']; //strings 15 juin
    $dateFinSeek     =    $_POST['dateFin'];     //     15 septembre
    
    $start = new DateTime($dateDebSeek);
    $end = new DateTime($dateFinSeek);
    // on crée un objet DateInterval avec un Période de 1 jour (Day)
    $interval = new DateInterval('P1D');
    
    $dates = [];
    $itotal=0;
 // ------------------------------------------------------- remplir le tableau vierge avec 0 occup , confirm 1 et " " idResa nonconfirmées pour chaque date

    for($i = $start; $i <= $end; $i->add($interval) ){ // $i commence avec $start qui est une date qu'on incrémente d' 1 jour jusqu'a $end
     // le tableau vierge  $dates est indexé par $i,  chaque ligne du tableau comprend une  date au format américain,
         array_push($dates, array( $i->format('Y-m-d') ,      0,         1,              " "));
                                      // date  ,    nbre empl occup , etat confirm  ,  idresa 
      $itotal++;   // $itotal compte le nombre de jours 
    }
    // ------------------------------------------------------- 
    for ($i=0; $i < 25 ; $i++) { // test par emplacement  
        $sqlStrVoir = "SELECT * FROM listeResa WHERE idEmpl=$i  ";
        $resultVoir = $conn->query($sqlStrVoir);
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
                        $idResa=$row["idResa"];
                        if ( $dates[$ii][0]  == $date1->format('Y-m-d') ){
                            if ( $conff==0 ) { 
                                $dates[$ii][2]=0;
                                // empilage des idresa non confirmées 
                                $dates[$ii][3].=$idResa." ";
                            } 
                            $dates[$ii][1] ++;///occup 
           //  echo  $date1->format('Y-m-d') . " ".  $dates[$ii][0] ." ". $i . " ". $dates[$ii][1] . "<br> " ;
                        }
                    }    
                }
            } // fin while pour chaque resa 
        }// fin du (  $resultVoir->num_rows > 0)

    } // ----------------------------- fin du for -----------------------------------------------
            $responseVoir=[ 'respVoir'=> 'ok',
                            'txOccup'=> $dates ] ;
            echo  json_encode($responseVoir );
    }  // ---------------------- fin else( db connection is ok )  >>  -------------------------------------------------------------
        $conn->close();  
} 
?>
