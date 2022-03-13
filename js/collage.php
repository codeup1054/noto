<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

<style>
#wr{
    display: flex;
    width:80%;
    flex-direction: row;
    flex-wrap: wrap;
    align-items: flex-start;
    justify-content: center;
}

.item{
    border:0px solid white;
    display:block;
    flex-grow:1;
}

.r1, .r5, .r9
{
    opacity:0.5;
}

</style>

<div id='wr'>
<?php 
for ($i = 0 ; $i < 10; $i++){   
    $s = 250;
    $w = rand($s, $s+100).'px'; 
    $h = $s.'px';
    print "<div class='item r".$i."'  style = \"height:$h; 
                        width:$w; 
                        background:url('images_desktop/dishes/m(".rand(1,14).").jpg');
                        background-size: cover;
                        \"
                        ></div>";
    
}?>
</div>

<div id='wr'>
<?php 
for ($i = 0 ; $i < 10; $i++){   
    $s = 400;
    $w = rand($s, $s+100).'px'; 
    $h = $s.'px';
    print "<div class='item r".$i."'  style = \"height:$h; 
                        width:$w; 
                        background:url('images_desktop/dishes/m(".rand(1,14).").jpg');
                        background-size: cover;
                        \"
                        ></div>";
    
}?>
</div>

<div id='wr'>
<?php 
for ($i = 0 ; $i < 10; $i++){   
    $s = 200;
    $w = rand($s, $s+100).'px'; 
    $h = $s.'px';
    print "<div class='item r".$i."'  style = \"height:$h; 
                        width:$w; 
                        background:url('images_desktop/dishes/m(".rand(1,14).").jpg');
                        background-size: cover;
                        \"
                        ></div>";
    
}?>
</div>

<script>

$(document).ready(function(){

$(".r1, .r5, .r9").animate({
    opacity: .9,
    left: "+=50",
    width: "+=20"
  }, 2000, function() {
    // Animation complete.
  });
//$(".r5").fadeIn( 1500 );


});

</script>