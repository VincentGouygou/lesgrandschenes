
<div id="main" class="flexcolumn flex  navbtn   ">
    <button id="closebtn"   class="mediumBigFont  hobo border  blurdiv   "  onclick="closeNav()" hidden >X Fermer </button>
    <button id="openbtn"  class="  mediumBigFont border hobo     blurdiv    " onclick="openNav()" >☰  Menu </button>   
    <div  class="flex   flexcolumn hobo sidebar border justcontentcenter " id="mySidebar">
        <a class="mediumBigFont pointer paddingH borderTopLR " href="index.php"> ~ Accueil</a>
        <a class="mediumBigFont pointer paddingH " href="photo.php"> ~ Galerie photos</a>
        <a class="mediumBigFont pointer paddingH " href="resa.php">~ Réservation</a>
        <a class="mediumBigFont pointer paddingH borderBottomLR " href="info.php">~ Infos et Contact </a>
    </div>
</div>
    
<script>
var tabparam2=[];
function paramtab2() {
    
    tabparam2=window.location.search
    .substr(1) // enleve le ?
    .split('&') // separe les paires "clés / valeurs"
    .reduce( // sépare les clé des valeurs et les place dans le tableau accumulator
        function(accumulator, currentValue) {
            var pair = currentValue
                .split('=')
                .map(function(value) {
                    return decodeURIComponent(value);
                });
            accumulator[pair[0]] = pair[1];
            return accumulator;
        },
        {}
    );
}
// besoin d'un épluchage du get de l'url avant celui des scripts
paramtab2();
// détecte si le utilisateur a un mobile ou un pc via une propriété du body  déclarer dans le css par @media...
var screen = getComputedStyle(document.body)
                .getPropertyValue('--screen')
                .replace(/\W/g, '');
        
function openNav() {
    if (screen=="pc") {   
        document.getElementById("mySidebar").style.width = "15vw";
        document.getElementById("main").style.marginLeft = "15vw";
    } else {
        document.getElementById("mySidebar").style.width = "38vw";
        document.getElementById("main").style.marginLeft = "38vw";
    }
    document.getElementById("openbtn").hidden =true;
    document.getElementById("closebtn").hidden =false;
}

function closeNav() {
    document.getElementById("mySidebar").style.width =  "0px";
    document.getElementById("main").style.marginLeft=  "4vw";
    document.getElementById("closebtn").hidden =true;
    document.getElementById("openbtn").hidden =false;
}
 
</script>
   

