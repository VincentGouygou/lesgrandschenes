<?php
header('content-type: text/html; charset=latin1'); 
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
date_default_timezone_set("Europe/Paris");



// ------------------------ chatgpt 2----------------------------------


abstract class Database {
    protected $connection;
    
    public function __construct($servername, $username, $password, $dbname) {
        $this->connection = new mysqli($servername, $username, $password, $dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
    
    abstract public function executeQuery($query);
    
    public function closeConnection() {
        $this->connection->close();
    }
}

abstract class ActionHandler extends Database {
    abstract public function handleAction($action, $data);
}

class PostServerManage extends ActionHandler {
    public function executeQuery($query) {
        return $this->connection->query($query);
    }
    
    public function addVisit($ip) {
        $datetimevisit = date(DATE_ATOM);
        $addvisitsqlstr = "INSERT INTO connexionsCount (ipVisit, dateTimeVisit) VALUES ('$ip', '$datetimevisit')";
        
        if ($this->executeQuery($addvisitsqlstr)) {
            $lastidsqlstr = "SELECT MAX(idVisit) AS lastidVisit FROM connexionsCount";
            $resultlastid = $this->executeQuery($lastidsqlstr);
            $rowid = $resultlastid->fetch_assoc();
            
            return $rowid['lastidVisit'];
        }
        return null;
    }
    public function voirEmplLibres() {
          
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
       
         $sqlStrVoir = "SELECT * FROM listeResa WHERE idEmpl=$i ";
           $voirEmplLibres = $this->executeQuery($sqlStrVoir);
           
    }
    public function prix($data) {
              
        $njoursHorsSaison  = $data['njoursHorsSaison'];
        $njoursSaison      = $_POST['njoursSaison'];
        $nadult            = $_POST['nadult'];
        $nenfant           = $_POST['nenfant'];
        $nchien            = $_POST['nchien']; 
         
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
                 
        
         
    }
    
    public function handleAction($action, $data) {
        switch ($action) {
            case 'visitcount':
                $visitCount = $this->addVisit($data['ip']);
                return $visitCount !== null ? ['action' => 'okVisit', 'count' => $visitCount] : ['error' => 'Failed to add visit'];
            case 'prix':
                prix($data);
            default:
                return ['error' => 'Action non reconnue'];
        }
    }
}
 
    $servername = "localhost";
    $username   = "u501368352_rooot";
    $passwordDb = "Grandschenes25!";
    $dbname     = "u501368352_grandschenes";
    
    $postServerManaging = new PostServerManage($servername, $username, $passwordDb, $dbname);
    $response = $postServerManaging->handleAction($_POST['action'], $_POST);
    
    echo json_encode($response);
    $postServerManaging->closeConnection();
 

 

// ------------------------ chatgpt 1----------------------------------

abstract class Database {
    protected $connection;
    
    public function __construct($servername, $username, $password, $dbname) {
        $this->connection = new mysqli($servername, $username, $password, $dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        } 
    }
    
    abstract public function executeQuery($query);
    
    public function closeConnection() {
        $this->connection->close();
    }
}

class VisitCounter extends Database {
    public function executeQuery($query) {
        return $this->connection->query($query);
    }
    
    public function addVisit($ip) {
        $datetimevisit = date(DATE_ATOM);
        $addvisitsqlstr = "INSERT INTO connexionsCount (ipVisit, dateTimeVisit) VALUES ('$ip', '$datetimevisit')";
        
        if ($this->executeQuery($addvisitsqlstr)) {
            $lastidsqlstr = "SELECT MAX(idVisit) AS lastidVisit FROM connexionsCount";
            $resultlastid = $this->executeQuery($lastidsqlstr);
            $rowid = $resultlastid->fetch_assoc();
            
            return $rowid['lastidVisit'];
        } else  return null;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'visitcount') {
    $servername = "localhost";
    $username = "u501368352_rooot";
    $passwordDb = "Grandschenes25!";
    $dbname = "u501368352_grandschenes";
    
    $visitCounter = new VisitCounter($servername, $username, $passwordDb, $dbname);
    $ipvisit = $_POST['ip'];
    $visitCount = $visitCounter->addVisit($ipvisit);
    
    if ($visitCount !== null) {
        echo json_encode(['action' => 'okVisit', 'count' => $visitCount]);
    }
    
    $visitCounter->closeConnection();
}



// --------------------------------------------------------------------



/*



if (!ConstDb("localhost","u501368352_rooot","Grandschenes25!","u501368352_grandschenes") ) {
    // gestion erreur db   
} else {
    
}
class ConstDbClass{
	public function ConstDb($nameserver,$nameuser,$dbPassword,$nameDb){
	    $servername = $servername;
        $username =  $nameuser;
        $passwordDb = $dbPassword;
        $dbname = $nameDb;
        $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
        if ($myConn->connect_error) {
                die("Connection failed: " . $myConn->connect_error);
            } else return $myConn;
	}
}


abstract class PostActionSqlRowServer extends ConstDbClass {
    
}
    


class postTab {
    public function postab($liste){
        
    }  
}

interface PostActionInterface {
    public function postaction();
    
 }
class PostFunction implements  PostActionInterface {
    public function postaction($action,$postTab,$strSql,$rowTab) {
        
        foreach ($postTab as $postTabb) {
            case $postTabb[]
            $msg        =$POST['msg'];
            $sender     =$POST['sender'];
            $receiver   =$POST['receiver'];
        }
    }

}    
    
    

 // une variable string d'action + un  tableau de clé valeur $post entré pour etre rempli par les $POST + un string de requete sql 
    // + tableau clé valeur pour les rows du resultat de la requete avec le 
 
class SwitchCaseAction {
    public function switchCaseAction($action,$postTab,$strSql,$rowTab) {
        
        switch ($POST["action"]) {
            case "msgAction":
            $msg        =$POST['msg'];
            $sender     =$POST['sender'];
            $receiver   =$POST['receiver'];
        }
    }
}
    




class 
    $servername = "localhost";
    $username = "u501368352_rooot";
    $passwordDb = "Grandschenes25!";
    $dbname = "u501368352_grandschenes";

   
      $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
     
    // Check connection
    if ($myConn->connect_error) {
        
      die("Connection failed: " . $myConn->connect_error);
      
    } 
   

    class DbConnect {
        public function connectDb($servername, $username, $passwordDb, $dbname) {
            $myConn = new mysqli($servername, $username, $passwordDb, $dbname);
            if ($myConn->connect_error) {
                die("Connection failed: " . $myConn->connect_error);
            } else return true;
        }
        
    }
    // une variable string d'action + un  tableau de clé valeur $post entré pour etre rempli par les $POST + un string de requete sql 
    // + tableau clé valeur pour les rows du resultat de la requete avec le 
    class SwitchCaseAction {
        public function switchCaseAction($action,$PostTab) {
            
            switch ($POST["action"]) {
                case "msgAction":
                $msg        =$POST['msg'];
                $sender     =$POST['sender'];
                $receiver   =$POST['receiver'];
            }
        }
    }
    
    
        

        public function __construct( )
        {
            // code...
        }
    }
    function PostAction ($action,$data) {
        
        
    }
                 */
                 
         
?>