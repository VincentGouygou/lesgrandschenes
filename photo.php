<?php 
    include "headerG.php";
     include "barnav.php";
     
     
 
  // enregistrer l'ip du client
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
       
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
  
    echo  "<input id='ip' value='$ip' size='40' hidden>";
 ?>   

    
<div class="flex  justcontentcenter  flexdir">
    <div  class="  center border shadow blurdiv justselfcenter center  padding margin " >
        <div  class="superBigFont hobo ">
            Galerie de Photos
        </div>
    </div> 
</div>            
        

 <div class=" hobo  " >
     <div class="flex  flexcolumn   ">
        <div  id="gallery" class="       justselfcenter divwidth center  blurdiv     paddingVeryLittle               border shadow">
           
             
             
             
            
        </div>
        <button class="justselfcenter  center  paddingVeryLittle  border shadow" onclick="plusDePhotos()" id="btnLoadMore">Plus de photos</button>
        <div  id="visioneuse"  class="flex flexrow  justselfcenter   justcontentcenter  divwidth  center        marginleftright8em    ">
            <a class="prev mediumFont border" onclick="plusSlides(-1)">&#10094;</a>
            <div id="visio">
                
            </div>
            <a class="next mediumFont border" onclick="plusSlides(1)">&#10095;</a>

        </div>   
          
         
     </div>   
 </div>
 
      <?php 
           /*     
                 $screenwidth='<script type="text/javascript"> document.write(screen.width);</script>';
                 echo $screenwidth;
                 if ((int)$screenwidth>800) {
                     $dir ="/images/littlePc";
                 } else {
                     $dir ="/images/littleMob";
                 } 
                for ($i = 1; $i < 222; $i++) {
                   $path="$dir/C ($i).jpg";
                    echo "<img class='imggallery   border shadow ' onclick='expand($i);' name=$i id='img$i' src='$path'> \n";
                }
                */ 
                
            ?>  
<script  charset="utf-8" type="text/javascript">
        
        
    var screen = getComputedStyle(document.body)
        .getPropertyValue('--screen')
        .replace(/\W/g, '');
   
    document.getElementById("visioneuse").style.display = "none";
    
    
    if (screen=="pc") {
        var dir ="/images/littlePc";
    } else {
        var dir ="/images/littleMob";
    } 
    
    var tabphoto=[];
    var nextPhotoIndex=30;
    for (let i = 1; i <= 30 ; i++) { 
        let path=dir+"/C ("+i+").jpg";
        tabphoto.push("<img class='imggallery   border shadow ' onclick='expand("+i+");' name="+i+" id='img"+i+"' src='"+path+"'> \n");  
        
        
        }
    $('#gallery').html(tabphoto);  
    
    
    
function plusDePhotos() {
    
    if (screen=="pc") {
        var dir ="/images/littlePc";
    } else {
        var dir ="/images/littleMob";
    } 
    
   
    
    for (let i = nextPhotoIndex+1; i <= nextPhotoIndex+30 ; i++) { 
        if (i>221) {
             document.getElementById('btnLoadMore').style.display = "none";  
            break;
        }
        
        let path=dir+"/C ("+i+").jpg";
        tabphoto.push("<img class='imggallery   border shadow ' onclick='expand("+i+");' name="+i+" id='img"+i+"' src='"+path+"'> \n");  
        
        
        }
    nextPhotoIndex=30+nextPhotoIndex;
    
    $('#gallery').html(tabphoto);
    
}    
        
function plusSlides(n) {
    
    const gallery = document.getElementById("gallery");
    const elemDiapo = document.getElementById("visio");
    let idindex= Number(elemDiapo.firstElementChild.name);
  
   
    idindex+=n;
    console.log(idindex);

    if (idindex>=nextPhotoIndex) {idindex=1;}
    if (idindex<=0) {idindex=nextPhotoIndex-1;}
   
    const elemgallery = document.getElementById("img"+idindex);
 
    console.log(idindex); 
    console.log(nextPhotoIndex+" <<<<<");
  
      
    gallery.append(elemDiapo.firstElementChild);
       
      
       
        console.log("dfgdfg "+screen)  ;
       if (screen=="pc")      {         
      elemgallery.style.width = "1000px";   
       gallery.lastElementChild.style.width = "300px";
       } 
       else
     {             elemgallery.style.width = "300px";  
                   gallery.lastElementChild.style.width = "96px";

     }
        
        elemDiapo.append(elemgallery);
        
}
    
function expand(indexx){
         
    const elemgallery = document.getElementById("img"+indexx);
    const elemDiapo = document.getElementById("visio");
    elemDiapo.append(elemgallery);
    document.getElementById("gallery").style.display = "none";
    document.getElementById("visioneuse").style.display = "flex";
    console.log("dfgdfg "+screen)  ;
    document.getElementById('btnLoadMore').style.display= "none";
    if (screen=="pc")  {
        document.getElementById("img"+indexx).style.width = "1000px";
    }
     else  {           
        document.getElementById("img"+indexx).style.width = "300px";      
    }
      
     document.getElementById("img"+indexx).onclick  =  function(){
                      normalize(indexx);
                 } 
     }
     
function normalize(indexx) {
    document.getElementById("gallery").style.display = "block";
    document.getElementById("visioneuse").style.display = "none";
    const gallery = document.getElementById("gallery");
    const elemDiapo = document.getElementById("img"+indexx);
    gallery.append(elemDiapo);
    document.getElementById('btnLoadMore').style.display= "block";    
    if (screen=="pc")  {
        document.getElementById("img"+indexx).style.width = "300px";
    } else  {
        document.getElementById("img"+indexx).style.width = "96px";
    }
    document.getElementById("img"+indexx).onclick  = function(){
        expand(indexx);
    }
}

 

       
<?php 
    include "functions.js";
?>
 



</script>

<?php 
  
    include "footerG.php";
?>