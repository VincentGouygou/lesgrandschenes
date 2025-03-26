<?php 
    include "headerG.php";
    include "barnav.php";
    include "titre.php";
?>
<?php 
  // enregistrer l'ip du client
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } 
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    echo  "<input id='ip' value='$ip' size='40' hidden>";
?>

<div class=" hobo  " >
    <div class="flex   justcontentcenter ">     
        <div class="flex divwidth flexcolumn    justselfcenter   justcontentcenter   border shadow    padding  marginlittle  " > 
        
            <div class="center mediumBigFont justselfcenter paddinglittle marginlittle border shadow  ">
                Accueil 
            </div>
            <div class=" textindentem  mediumFont justselfcenter paddinglittle marginlittle border shadow blurdiv ">
                <div  class="   " >
                     Harmonie avec la nature et douceur de vivre, c’est ce que vous propose ce petit camping tout simple au bord de la rivière Dordogne.
                </div>     
                <div  class="   " >
                     Dans une clairière, entourée de hauts chênes verts, habitée par des chevreuils, des écureuils et une multitude d’oiseaux…   
                </div>
                <div  class="   " >
                     Yannick avec sa gentillesse coutumière vous fera découvrir au printemps les nombreuses espèces d’Orchidées dans le parc. 
                </div>   
                <div  class="   " >    
                Baignade, pêche seront vos loisirs détente. Des vacances vraies, en camping-car ou en tente pour une nuit ou plus si affinités…
                </div>
            </div>
        </div>       
    </div> 
    <div class="flex    justcontentcenter ">
        <div  class=" flex    flexdir    justcontentcenter        margin      border shadow">
            <div class="carousel divwidth">
                <div class="wrap  justcontentcenter" onclick="location.replace('https://campinglesgrandschenes.org/photo.php');">
                    <img src="images/littleMob/C (1).jpg" alt="">
                    <img src="images/littleMob/C (2).jpg" alt="">
                    <img src="images/littleMob/C (3).jpg" alt="">
                    <img src="images/littleMob/C (4).jpg" alt="">
                    <img src="images/littleMob/C (5).jpg" alt="">
                    <img src="images/littleMob/C (6).jpg" alt="">
                    <img src="images/littleMob/C (7).jpg" alt="">
                    <img src="images/littleMob/C (8).jpg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class=" border shadow  blurdiv   fitcontent margin padding bold hobo" > Vous êtes le
        <a id="visitcount"> </a> ème visiteur
    </div> 
</div>

<script charset="utf-8" type="text/javascript">

    
<?php 
    include "functions.js";
?>
$(document).ready(function() {   
    let ip     = $('#ip').val();
    let myData = {"action": "visitcount",
                  "ip"    : ip  };
                    
    $.ajax({
        url: "server.php",  
        method: "POST",              
        data:myData,
        dataType: "JSON", 
        success: function(response) {
            $('#visitcount').html(response.count);
        }, 
        error: function(error) {
            console.log("erRror"+error.statusText);
        }
    }); 
});
 
</script>

<?php 
  
    include "footerG.php";
?>