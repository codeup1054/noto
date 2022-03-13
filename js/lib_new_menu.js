/***********************
    Версия 2016.02.23 - 1. скролл по 
    для главного навигационного меню и кнопока заказать столик 
    2. fade текстов при переключении языков для главного сладера   
*/

$( document ).ready( function() { menu-d-wr
 
init_simlple_popup();
 
// добавляем  menu 

console.log("@@  load menu1");

 
$.get("up2/server/php/files/menu.txt", function(data){
 
    
    lines = data.split("\n");
    
    
    var mblock;
    var cnt = 0;
    var line = ""; 
    
    menu_data = block_start = " \
        <div style=\"display:inline-block; padding:0px 20px;\">\
        <table width=100% >\
            <tr class='menu_row'>\
                <td class='menu_bkg_11 fr'><img style=\"width:75px\"/></td>\
                <td class='menu_bkg_12 fr'></td>\
                <td class='menu_bkg_13 fr'><img style=\"width:75px\"/></td>\
            </tr>\
            <tr class='menu_row'>\
                <td class='menu_bkg_21 fr'></td>\
                <td class='menu_bkg_22 fr'>";
    
    block_end = "</td>\
                <td class='menu_bkg_23 fr'></td>\
            </tr>\
            <tr class='menu_row'>\
                <td class='menu_bkg_31 fr'></td>\
                <td class='menu_bkg_32 fr'></td>\
                <td class='menu_bkg_33 fr'></td>\
            </tr>\
            <tr class='menu_row'><td colspan=3 style='text-align:center'><br />\
                 <div>Cubierto por persona 2,50 € / 2,50 € cover charge per person</div>\
                 </td></tr>\
        </table>\
    </div>";
    
    bCnt = 0;
    $(lines).each(function(i,e){
    cols = e.split("\t");
    
    console.log("@@  lines =",cols);

     
    if(cols[1] == 'sec')
    {

        if(bCnt % 7 > 4 || bCnt == 7)
        {
            menu_data += block_end + block_start;
            bCnt = 0;
        }
        else if(bCnt != 0)
        {
            menu_data += "<br />***<br />"; 
        }
       menu_data += "<div class='dish_section_new'> - " + cols[2]+" - </div>"; 
    bCnt++;
    }
    else
    {
    if (bCnt == 7)    
    {
        menu_data += block_end + block_start; 
        bCnt = 0;
        }
      
        
        menu_data += "\
        <div class='dish_item'>\
    		<div class=''>\
    			<div class='dish_name'>\
                    <ru_RU>"+cols[2]+" - "+cols[1]+"€</ru_RU>\
                    <en_GB>"+cols[4]+" - "+cols[1]+"€</en_GB>\
                    <es_ES>"+cols[6]+" - "+cols[1]+"€</es_ES>\
                </div>\
                <div class='dish_description' href='#delivery-head'>\
                    <ru_RU>"+cols[1]+"</ru_RU>\
                    <en_GB>"+cols[3]+"<br /><gr style='color:gray'>"+cols[5]+"</gr></en_GB>\
                    <es_ES>"+cols[3]+"<br /><gr style='color:gray'>"+cols[5]+"</gr></es_ES>\
                 </div>\
    		</div>\
        </div>\
        ";
        bCnt++; 
     }      
       
    });
        
        menu_data += block_end;
        
        $("#menu-slider").html(menu_data);
        
$("#menu-slider").owlCarousel({
     
          animateOut1: 'slideOutDown',
          animateIn1: 'flipInX',
          items : 2,
          singleItem:true,
          dotsEach:true,
          itemsDesktop : [1600,3],
          navigation : true, // Show next and prev buttons
          smartSpeed : 2200,
          autoplaySpeed: 3000,
          paginationSpeed : 4200,
          singleItem:true,
		  mouseDrag: true,
          loop:true,
          autoplay:true,
          autoplayTimeout:6500,
          autoplayHoverPause:true
          // "singleItem:true" is a shortcut for:
          // items : 1, 
          // itemsDesktop : false,
          // itemsDesktopSmall : false,
          // itemsTablet: false,
          // itemsMobile : false
     
      });  
    
  });




// ------------------------------------------------  menu 

// добавляем  slider

 
 $.get("slider.data", function(data){
    lines = data.split("\n");
//    console.log("lines =",lines);
/*
*/    
    var mblock;
    
    $(lines).each(function(i,e){
        
        cols = e.split("\t");
        
         $("div#main-slider").append("<div class='item'>\
		<div id='main-bg22' style='background:url(\"images_desktop/dishes/"+cols[0]+"\"); background-size:cover;'></div>\
		<div class='page'>\
			<div id='main-head3'>\
                <ru_RU>"+cols[2]+"</ru_RU>\
                <en_GB>"+cols[4]+"</en_GB>\
                <es_ES>"+cols[6]+"</es_ES>\
            </div>\
            <div id='main-button3' href='#delivery-head'>\
                <ru_RU>"+cols[1]+"</ru_RU>\
                <en_GB>"+cols[3]+"</en_GB>\
                <es_ES>"+cols[5]+"</es_ES>\
             </div>\
		  </div>\
	    </div>");
        });

      slide_to ();  // назначаем навигацию после загрузки кнопки
      
      carousel ();
    
 });


function carousel ()
{
        $("#main-slider, #feedback-slider, #events-slider").owlCarousel({
     
          animateOut1: 'slideOutDown',
          animateIn1: 'flipInX',
          items : 1,
          singleItem:true,
          dotsEach:true,
          itemsDesktop : [1600,3],
          navigation : true, // Show next and prev buttons
          smartSpeed : 2200,
          autoplaySpeed: 3000,
          paginationSpeed : 4200,
          singleItem:true,
		  mouseDrag: true,
          loop:true,
          autoplay:true,
          autoplayTimeout:6500,
          autoplayHoverPause:true
          // "singleItem:true" is a shortcut for:
          // items : 1, 
          // itemsDesktop : false,
          // itemsDesktopSmall : false,
          // itemsTablet: false,
          // itemsMobile : false
     
      });  
    
}

// ------------------------------------------------  main slider
         
     
          

$("[expand]").click(function(){
    
    $("[expand_text]").attr("expand",false);
    
    el = $(this).parent().children("[expand_text]").attr("expand",true);
    
    console.log("##30 expand %o",el.attr("expand"));

    $("[expand_text]").each( function(){
    if(  $(this).attr("expand") == 'false'  )
         {
         $(this).animate({height:"79px"},500);
         $(this).parent().css("opacity",0.3);
         
         }
    else 
         { 
         $(this).animate({height:'300px'},500);
         $(this).parent().css("opacity",1);
         }
        
    })
});


 $('.ui-accordion').accordion();

$('#accordion').accordion();


    $.each(ml_content,function(k,v){
        
       el = $("#"+k); 
       
       if (typeof $("#"+k) != 'undefined')
       { 
       $("#"+k).html(v.post_content).attr('post_id',v.post_id);
       }

    });
    

    
    
    $("#home").click(function(){
            $( "html,  body" ).animate({scrollTop: 0}, 1000);
            });   
    
 

/*
    $("#langmenu div1").click(function(e)
    {   
        if (e.originalEvent.defaultPrevented) return;
        
        var show_lang = $(this).attr('lang_code'); 
        var lang_code = $(this).text();
        
          
        $(['en_GB', 'ru_RU', 'es_ES']).each(function(k,v){

            $(".fade "+v).css( ((show_lang == v)? {opacity: 1, display: 'block'}: {opacity:  0})); // плавное переключение

            $(v).not(".fade "+v).css({display: ((show_lang == v)? 'block':'none') }); // быстрое переключение

//            console.log("##162 %o %o",k,v);
        })
        
        $("#langmenu div").removeClass('selected');
        $(this).addClass('selected');
        
    });
    
    */


/************* Переключатель языков *****************/


        $(['en_GB', 'ru_RU', 'es_ES']).each(function(k,v){

            $(".fade "+v).css( ((show_lang == v)? {opacity: 1, display: 'block'}: {opacity:  0})); // плавное переключение
            $(v).not(".fade "+v).css({display: ((show_lang == v)? 'block':'none') }); // быстрое переключение
        })
    
    
    
    function slide_to() 
    {
      $("a[href][slide], div[slide]").not('a[fb]').click(function(e)
        {
            event.preventDefault();

            var aTag = $(this).attr('href') || $(this).attr('target');

            console.log ("aTag = ", aTag ); 
            
            $('html,body').animate({scrollTop: $(aTag).offset().top - 170},1200);
        });
    
     } 

    function init_simlple_popup() 
    {
      $("[popup]")
        .css("cursor","pointer" )
        .click(function(e)
        {
            event.preventDefault();
            
            var popText = $(this).attr('popup');
            
            $('body').append("<div class='shade'/>")
                     .append("<div class='simple_popup'>"+popText+"\
                              <div class='btn_close'/> \
                              </div>")
                     .on('click','.simple_popup', function()
                                { 
                                   $(".shade,.simple_popup").remove(); 
                                 });
            
        });
    
     }

/* Для div и post_description сщхраняем результ]*/
    
    $('en_gb, ru_ru, es_es').blur( function()
        {
          el = $(this).parent();  
          
          send_data = {'content':$(this).text(), 
                       'id'     :$(el).attr('post_id'), 
                       'lang'   :$(this).prop('tagName'), 
                       'class'  :$(el).attr('class') }
          
          console.log("## 55",send_data);
          
          $.get( "/dev/ds.php", send_data, function( data ) {
              console.log( ".result %o" ,data);
            });
          
        }
    );
    
    
    $(".edit a1").click(function(e)
        {
        if (e.originalEvent.defaultPrevented) return;
       
        $(this).attr('editmod', function(index, attr){

        attr = (attr == 'true') ? false : true;
        
        console.log ("attr = ",attr);
/*
function(e) { e.css("border","1px dashed gray").
                                        return e;
                                        }
function(){
                    var p = $(this).position();
                        
                    return '<div style ="position:absolute;'+
                    ' top:'+p.top+'px;'+
                    ' height:'+$(this).height()+'px;'+
                    ' width :'+$(this).width()+'px;'+
                    ' border:1px dashed gray;"'+
                    ' class="id_border"></div>';}                                        
                                        
*/        

        if (attr == true)
            {
            $(this).text('View');    
            
/* Назначаем редактирование на post и пункты меню*/            
            
//            $('div[post_id], dish_description').attr("contenteditable", function (){
            $('en_gb, ru_ru, es_es').attr("contenteditable", function (){
                    
                    if ($(this).css("display") == "block")
                    {
                    el = $(this).parent();
                        
                    var p = el.position();
                    
                    console.log ("##101 %o id= %o",p, el.id);

                    var el  = $('body').append("<div pid = '"+el.id+"' class='id_label' style = 'border:1px dashed gray;\
                        top:"+p.top+"; left:"+p.left+";\
                        text-align:right;\
                        width:"+$(el).css('width')+"; height:"+$(el).css('height')+"  '>"
                    +el.id+"</div>");

                    }
                    
                    return true;
                    });
                // todo start stop edit than save
             }
             else
             {  
                $(this).text('Edit');
//                $('div[post_id], en_GB, ru_RU, es_ES').attr("contenteditable",false)
                $('en_GB, ru_RU, es_ES').attr("contenteditable",false)
                .css("border","0px dashed gray");
                $('.id_label').remove();
                
                
             }   
         return attr;
        });    
       }
    );    
    
    set_scroll();  // вызываем функцию для прилипающих меню

});



/*   **********  Функции  ************/
/*************   super sticky scroll  *****************/


function set_scroll()
{
    
        
var sticks = {'.header-d-wr1':{dim:'0-650,2000-100000',
                           css_in:{ backgroundColor : "#fff",
                                  top: "0px",
                                  opacity: 1 },
                           css_out:{ backgroundColor : "#fff",
                                  top: "-100px",
                                  opacity: 0}
                                },
               '#menu_section_nav1':{dim:'600-2350',
                           css_in:{ border : "1px solid green",
                                  top: "0px",
                                  opacity: 1 },
                           css_out:{ backgroundColor : "#fff",
                                  top: "-200px",
                                  opacity: 0}
                                },
               '.features-d-wr1':{dim:'500-900',
                           css_in:{ backgroundColor : "#green",
                                  opacity: 1 },
                           css_out:{ backgroundColor : "#fff",
                                  opacity: 0.15}
                                },
                                                 
             };


function isScrolledIntoView(elem)  // проеряет объект на экаране или нет
{
    var $elem = $(elem);
    var $window = $(window);

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}

    
 $(window1).scroll(function(){ 
         var windowTop = $(window).scrollTop(); // return scroll position

//        console.log ("$('div.login-control')", $('div.login-control'));
        
        $('div.login-control, div.profile-photo img').css ( 'display','none' );


         $.each($("#header-menu a[href]"), function () {
         
         
         var anchor = $(this).attr("href"); 

//         console.log("$(anchor) ==== ", anchor,( $(anchor).length ));
         
         if ($(anchor).length > 0 )    
         if (isScrolledIntoView( anchor ))
         {  
            $("[href='"+anchor+"']").addClass("oncreen");
         }
         else 
         {
            $("[href='"+anchor+"']").removeClass("oncreen");
         }
         
         });


         $.each (sticks,function (k,v)          // ищем что показать
         {
            var ints  = v.dim.split(','); 
            var in_screen = false;
             
            $.each (ints, function (i,e){
                var d  = e.split('-');
                
                if (d[0] <= windowTop && windowTop < d[1]) 
                    in_screen = true;
            }) 
            
            
            
            
            // определяем границы для диапазона
                        
            if( $(k).attr("in_action") != true ) 
            {    
                $(k).attr("in_action",true);
                
                if (in_screen)
                {   
                $(k).stop().animate(v.css_in,200, function() { $(this).removeProp("in_action"); } );        // если блок попадает в диапазон, отображаем
                }
                else
                {
                $(k).stop().animate(v.css_out,100, function() { $(this).removeProp("in_action"); } );       // все sticky блоки делаем невидимыми
                }
            }     
          });
        });

}      


/*************  super  sticky scroll  *****************/ 




