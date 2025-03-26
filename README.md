# lesgrandschenes
présentation et gestion d'un camping 

il y a 2 interfaces : 
  - l'interface client qui regroupe :
    . l'accueil 
    . une galerie photos
    . une page de reservation en ligne
    . un page d'information et de messagerie via mail pour contacter le gérant
  - l'interface gérance avec des fonctionnalités :
    . d'encaissement d'arrhes
    . d'encaissement de séjour
    . de cumul des taxe de séjour

et une tache Cron pour supprimer les reservations non confirmées par versement d'arrhes
    
L'interface gérance commence par l'index.php
    . qui permettra un login complexifié ( pour entrer le password et l'id, il faut effacer la derniere lettre de l'id puis la remettre et clicquer "se connecter" en moins d'1.5 secondes, car audela de 11 lettres ce bouton disparait) 
    . et c'est seulement a la connexion vérifiée par le server(servermin.php) que le code sensible sera injecté ( admin.txt : l'html et adminfunction.txt : le javascript


    
