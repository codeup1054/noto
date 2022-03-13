/***********************
    Версия 2016.02.23 - 1. скролл по 
    для главного навигационного меню и кнопока заказать столик 
    2. fade текстов при переключении языков для главного сладера   
*/

$( document ).ready( function() { 
    
 //cristmas_popup();
 
 init_simlple_popup();
 
// добавляем  menu 
 //$.get("up2/server/php/files/menu.txt", function(data){
 $.get("up/notofiles/menu.txt", function(data){
    lines = data.split("\n");
//    console.log("lines =",lines);
    
    var mblock;
    var cnt = 0;
    var line = ""; 
    
    $(lines).each(function(i,e){
        
        cols = e.split("\t");
        
        if(cols[1] == "sec")
        {   
            mblock = cols[2];
            
            $("#menu_section_nav").append("<div class='menu_section_button' id='"+mblock+"'>\
            <ru_RU>"+cols[6]+"</ru_RU>\
            <en_GB>"+cols[4]+"</en_GB>\
            <es_ES>"+cols[2]+"</es_ES>\
            </div>");
            
            $("div#dish_panel")
            .append("<div class=dish_section id = '"+mblock+"'>");

        }
        else if(cols[1] == "footnote")
        {   
            $("#menu_footnote").append("<div class='menu_footnote'>\
            <ru_RU>"+cols[5]+"</ru_RU>\
            <en_GB>"+cols[3]+"</en_GB>\
            <es_ES>"+cols[2]+"</es_ES>\
            </div>");
        }
        else
        {   
            cnt += 1;

            if ((cnt % 3) != 0 || 1)
            {line = "<div id='dish_card'>\
                <div class=dish_title>\
                    <ru_RU>"+cols[6]+"</ru_RU>\
                    <en_GB>"+cols[2]+"</en_GB>\
                    <es_ES>"+cols[2]+"</es_ES>\
                </div>\
                <div class=dish_description>\
                    <ru_RU>"+cols[7]+"</ru_RU>\
                    <en_GB>"+cols[5]+"</en_GB>\
                    <es_ES>"+cols[3]+"</es_ES>\
                </div>\
                <div class=dish_price>"+cols[1]+"€</div>\
                </div>";
            }  

            $("div.dish_section[id ='"+mblock+"']")
            .append("<div id='dish_row'>"+line+"</div>");
            line ="";
                
        }
        
         
    });
        
        selector = 'div.dish_section:nth-child(2)';
        $(selector).css('display','flex');
        
        selector2 = 'div.menu_section_nav:nth-child(2)';
        $(selector2).addClass('selected');
 

       $( "div.menu_section_button").click(function(e) {
        
        var selector = "div.dish_section[id='"+ $(this).attr('id') +"']";
        
        $("div.dish_section[id]").css('display','none');
        $(selector).css('display','flex');

        var section = $(selector);
        
        $(".menu_section_button" ).removeClass('selected');
        $(this).addClass('selected');

    });
    
    
 });




// ------------------------------------------------  menu 

// добавляем  slider

 
 $.get("up2/server/php/files/main_slider.txt", function(data){
    lines = data.split("\n");
//    console.log("lines =",lines);
    
    var mblock;
    
    $(lines).each(function(i,e){
        
        cols = e.split("\t");
        
         $("div#main-slider").append("<div class='item'>\
		<div id='main-bg22' style='background:url(\"up2/server/php/files/"+cols[0]+"\"); background-size:cover;'></div>\
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
      
      slide_to ();  // назначаем навигацию после загрузки кнопки 
    
 });

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
                     .append("<div class='simple_popup'><br /><br />"+popText+"\
                              <div class='btn_close'/> \
                              <br /><br /></div>")
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
    
        
var sticks = {'.header-d-wr1':{dim:'0-65000000,2000-100000',
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

    
 $(window).scroll(function(){ 
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


/*************  cristmas_popup*****************/
function cristmas_popup()
{
    
    cristmas = "<div class='simple_popup'>\
                        <div class='h4'>Download</div>\
                        <a class='mobile' href='noto_menu_cristmas_2017.pdf' >\
                        <ru_RU>Рождественское меню</ru_RU>\
                        <en_GB>Cristmas Menu</en_GB>\
                        <es_ES>Menú navideño</es_ES></a>\
                        <a class='desktop' href='noto_menu_cristmas_2017_m.pdf' >\
                        <ru_RU>Рождественское меню</ru_RU>\
                        <en_GB>Cristmas Menu</en_GB>\
                        <es_ES>Menú navideño</es_ES></a><br />\
                        <div class='h4'>\
                        <ru_RU>Заказать столик</ru_RU>\
                        <en_GB>Book table</en_GB>\
                        <es_ES>Reservar Mesa</es_ES></a>\
                        </div>\
                        <a href='tel:(+34) 952-814-529'>(+34) 952-814-529</a><br /><br />\
                        <div class='btn_close'/></div>\
                        </div>";
    

    newyear = "<div class='simple_popup'>\
                        <div class='h4'>Download</div>\
                        <a class='mobile' href='noto_menu_NY_2017.pdf' >\
                        <ru_RU>Новогоднее меню</ru_RU>\
                        <en_GB>New Year Menu</en_GB>\
                        <es_ES>Menú navideño</es_ES></a>\
                        <a class='desktop' href='noto_menu_NY_2017_m.pdf' >\
                        <ru_RU>Новогоднее меню</ru_RU>\
                        <en_GB>New Year Menu</en_GB>\
                        <es_ES>Menú navideño</es_ES></a><br />\
                        <div class='h4'>\
                        <ru_RU>Заказать столик</ru_RU>\
                        <en_GB>Book table</en_GB>\
                        <es_ES>Reservar Mesa</es_ES></a>\
                        </div>\
                        <a href='tel:(+34) 952-814-529'>(+34) 952-814-529</a><br /><br />\
                        <div class='btn_close'/></div>\
                        </div>";
                        

    newyear = "\
                <div class='simple_popup' style='background:url(images_desktop/Sait_download.gif); height:300px;'>\
                        <a class='mobile' class='h4' href='noto_menu_NY_2017.pdf'>\
                        <div style='width:500px; height:300px;'>\
                        <h3>Download</h3><br /><br /><br />\
                        <a1 class='h3' href='tel:(+34) 952-814-529'>(+34) 952-814-529</a1><br /><br />\
                        </div>\
                        </a>\
                        <a class='desktop' class='h4' href='noto_menu_NY_2017_m.pdf'>\
                        <div style='width:500px; height:300px;'>\
                        <h3>Download</h3><br /><br /><br />\
                        <a1 class='h3' href='tel:(+34) 952-814-529'>(+34) 952-814-529</a1><br /><br />\
                        </div>\
                        </a>\
                        <div class='btn_close'/></div>\
                        </div>";
                        
    newyear2 = "Sait_download.gif"                        
    
    
    $('body').append("<div class='shade'></div>")
                     .append(newyear);
                     
                     
    $('.btn_close').on('click', function(event)
                                { 
                                   event.stopPropagation();
                                   $(".shade,.simple_popup").remove(); 
                                 });      
            
};


/*************  /cristmas_popup*****************/


