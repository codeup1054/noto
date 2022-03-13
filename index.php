<?php include('send.php') ;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$evs = array();
$gal = array();


$path = "up2/server/php/files/";

foreach (glob($path."e*.jpg") as $file) {
    $evs[] = $file;
}


foreach (glob("up/gal/g*.jpg") as $file) {
    $gal[] = $file;
}


?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>NOTO Food & People. NOTO Restaurant</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/bootstrap.css">
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="css/style_desktop_classic.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/menu_wr.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/animate.css" type="text/css" media="all">


    <script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="js/lib.js"></script>   <!-- Языки анаимация и проч.   -->
    <script src="js/targets.js"></script>   <!-- Развешиваем цели для гугла и яндекса.   -->



    <?php
    include_once('lib/lib.php'); // подключение библиотек с языками и редактированием JScript inside
    ?>

    <!-- Telephone mask ------------->
    <!--  Отключено чтобы работали другие скрипты -->

    <script src="js/mask/jquery.maskedinput.min.js"></script>
    <script src="js/mask/is.mobile.js"></script>
    <script src="js/mask/formcheck.js"></script>

    <!--owl slider-->
    <link rel="stylesheet" href="owl-carousel/owl.carousel.css"/><!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="owl-carousel/owl.theme.css"/>   <!-- Default Theme -->
    <script src="owl-carousel/owl.carousel.js"></script>         <!-- Include js plugin -->


</head>
<script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Restaurant",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "CALLE AZAHAR EDIFICIO LA RULETA, NUEVA ANDALUCÍA, 29660",
            "addressRegion": "ANDALUCÍA",
            "postalCode": "29660",
            "streetAddress": "CALLE AZAHAR EDIFICIO LA RULETA"
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4",
            "reviewCount": "250"
        },
        "name": "NOTO Food & People",
        "openingHours": [
            "Mo-Sa 12:00-00:00",
            "Mo-Th 12:00-00:00",
            "Fr-Sa 12:00-00:00"
        ],
        "priceRange": "$$",
        "servesCuisine": [
            "Middle Eastern",
            "Mediterranean"
        ],
        "telephone": "(+34) 952-814-529",
        "url": "http://notorestaurant.com"
    }



</script>


<style>

    .video-container {
        position1: absolute;
        margin-top: 80px;
        bottom: 0;
        width: 100%;
        height: 800px;
        overflow: hidden;
    }
    .video-container video {
        /* Make video to at least 100% wide and tall */
        min-width: 80%;
        min-height: 100%;

        /* Setting width & height to auto prevents the browser from stretching or squishing the video */
        width: auto;
        height: auto;

        /* Center the video */
        position1: absolute;
        margin-top: 0px;
        margin-left: 50%;
        transform: translate(-50%,-128px);
    }

</style>

<body>

<div id='langmenu' style='position:fixed; z-index:3000'>

    <?php
    $lang = array("EN"=>"en_GB","RU"=>"ru_RU","ES"=>"es_ES");

    $_lang = (isset($_REQUEST['lang']))? $_REQUEST['lang']:"en_GB";


    print "<script llang> var show_lang = '".$_lang."';</script>";
    print "<style>
        es_ES, ru_RU, en_GB { display:none;} 
        $_lang {display:inline-block;} 
        </style>";
    ?>

    <?php
    foreach ($lang as $k => $v)
    {
        $class = ($v == $_lang)?" class='selected' ":"";
        print "<a href = '/".$v."' ><div lang_code='".$v."' ".$class.">".$k."</div></a>";
    }
    ?>
</div>


<div class="wrap">
    <!--Header-->
    <div class="header-dh-wr">
        <div id="header-bg"></div>
        <div class="page">
            <div id="header-logo1"></div>
            <div id="header-tel1" class="tel"></div>
        </div>
    </div>
    <!--End Header-->


    <!--Main

    <div class="video-container">
      <video autoplay loop >
        <source src="noto_ad.mp4" type="video/mp4" />
      </video>
    </div>

    <!--End Main video-->


    <div class= 'container' style="width:100%;">

        <!-- Header spacer -->
        <div class="main-d-wr1">
            <div style='height:40px;'></div>
        </div>
        <!-- Header spacer -->


        <!--Main slider-->
        <div class="main-d-wr">
            <div id="main-slider" class="owl-carousel owl-theme"  style='margin-top:150px;'></div>
        </div>
        <!--End Main slider-->

        <!--Menu ресторана-->
        <div id="menu-d-wr" >
            <div id='menu_section_nav'>
                <div id="menu-head">Главное меню</div>
            </div>
            <div id="dish_panel"></div>
            <div id="menu_footnote"></div>
        </div>

        <!--End Menu ресторана-->

        <!--Галлерея-->
        <div id="feedback-d-wr" class="feedback-d-wr1"><br />
            <div id="gallery" class='header-bar-wr'>
                <ru_RU>Галерея</ru_RU>
                <en_GB>Gallery</en_GB>
                <es_ES>Galería</es_ES>
            </div>

            <div id="feedback-slider" class="owl-carousel owl-theme">
                <?php
                foreach ($gal as $k=>$v)
                {
                    ?>
                    <div class='animated' style= "width:2600px; height:700px;
                        background:url('<?=$v?>');
                        background-repeat: repeat-x;
                        background-position: left top;
                        " >NOTO Food & People Restaurant, Marbella, Andalusia, Spain

                        <div class='button gallery_button'
                             popup='<a href="tel:(+34) 952-814-529">(+34) 952-814-529</a><br />' >
                            <ru_RU>Заказать столик</ru_RU>
                            <en_GB>to book a table</en_GB>
                            <es_ES>reservar mesa</es_ES>
                        </div>
                    </div>
                    <?php
                }

                ?>
            </div>
        </div>

        <!--End Галлерея-->

        <!--Delivery-->

        <div class="delivery-d-wr">
            <div id="delivery-head">Доставим <br/>только что приготовленные <br/>горячие блюда</div>
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-3" popup='<a href="tel:(+34) 693-007-586">(+34) 693-007-586</a>'>
                    <div id="delivery-pic1"></div>
                    <div id="delivery-text1">Прямо к вам в отель</div>
                </div>
                <div class="col-lg-3" popup='<a href="tel:(+34) 693-007-586">(+34) 693-007-586</a>'>
                    <div id="delivery-pic2"></div>
                    <div id="delivery-text2">В офис</div>
                </div>
                <div class="col-lg-3" popup='<a href="tel:(+34) 693-007-586">(+34) 693-007-586</a>'>
                    <div id="delivery-pic3"></div>
                    <div id="delivery-text3">Прямо к вам домой</div>
                </div>
                <div class="col-lg-3"></div>
                <!--		<div id="delivery-button" class="popup-with-form" href="#delivery-form" >Заказать доставку</div>  -->
            </div>
            <div id="delivery-bg">
                <div id="delivery-button"
                     class="popup-with-form"
                     popup='<a href="tel:(+34) 693-007-586">(+34) 693-007-586</a>' >Заказать доставку
                </div>
            </div>
        </div>
        <!--End Delivery-->

        <!--NOTO Club -->
        <div class="block4">
            <div id="noto_club_bg">
                <div id="noto_club_front"></div>
                <div id="noto_club_abstract_new">
                    <div id="noto_club_header"></div>
                    <?php include ("club.php");?></div>
                <!--    	<div id="noto_club_button" class="popup-with-form" href="#noto_club_form" ></div>
                        <div id="noto_club_form" style="popup" class="mfp-hide white-popup-block contactform form_check"></div>

                -->
            </div>
        </div>



        <!--NOTO Video-->


        <div id="video_tour" class="block4" style="border: whitesmoke 0px solid; text-align:center; " >

            <video  controls  autoplay loop style="border: whitesmoke1 black 10px solid; width: 990px; height: auto;">
                <source src="noto4.mp4" type="video/mp4"/>
            </video>

            <!--Features-->

            <div id="features-head1"><en_GB>A RESTAURANT WITH TWENTY YEARS OF HISTORY IN MARBELLA</en_GB>
                <es_ES>RESTAURANTE CON 20 AÑOS DE HISTORIA EN MARBELLA</es_ES>
                <ru_RU>Ресторан в Марбелье с 20 летней историей...</ru_RU></div>

            <div class="features-pic p1"><en_GB>We cook marvellous dishes since 1995</en_GB>
                <es_ES>Cocinamos los platos excelentes desde 1995</es_ES>
                <ru_RU>Готовим отменные блюда с 1995 года</ru_RU></div>

            <div class="features-pic p3"><ru_RU>Интересные события и вечера живой музыки</ru_RU>
                <es_ES>Eventos interesantes y noches de música en vivo</es_ES>
                <en_GB>Interesting events and nights of live music</en_GB></div>

            <div class="features-pic p2"><en_GB>Exquisite traditional and contemporary menu</en_GB>
                <es_ES>Exquisito menú tradicional con un toque moderno</es_ES>
                <ru_RU>Изысканное традиционное и современное меню</ru_RU></div>

            <div class="features-pic p4"><ru_RU>Изысканные вина из лучших погребов Марбельи</ru_RU>
                <en_GB>Astonishing wines from the best cellars of Spain, France, Italy</en_GB>
                <es_ES>Vinos de las mejores bodegas de España, Francia, Italia</es_ES></div>

            <!--End Features-->
        </div>
        <!--NOTO Video-->

        <!--Calendar -->
        <?php if (count($evs)): ?>
        <div id="calendar-d-wr" class="calendar-d-wr">
            <div id="calendar-bgz"></div>
            <div id="calendar-head">наши ближайшие мероприятия</div>
            <div id="events-slider<?=(count($evs) == 1)?"-one":""?>"  >

                <?php

                foreach ($evs as $k=>$v)
                {
                    ?>
                    <div class='animated' style= "width:100%; height:640px;
                        background:#000 url('<?=$v?>');
                        background-size: contain;
                        background-repeat: no-repeat;
                        background-position: center top;
                        color:white;
                        " ><!--NOTO Food & People Restaurant, Marbella, Andalusia, Spain-->

                        <div class='button gallery_button'
                             popup='<a href="tel:(+34) 952-814-529">(+34) 952-814-529</a>' >
                            <ru_RU>Заказать столик</ru_RU>
                            <en_GB>to book a table</en_GB>
                            <es_ES>reservar mesa</es_ES>
                        </div>
                    </div>

                <?php } ?>

                <?php else: ?>
                <?php endif ?>

            </div>
        </div>
        <!--End Calendar-->

        <!--NOTO Mafia -
<div class="block4">
    <div id="noto-mafia">
        <div id="front"></div>
    	<div id="abstract">
           	<div id="header">
               #NOTOmafia
               </div>
            <?php //include ("mafia.php");?></div>
    </div>
</div>

--NOTO Mafia-->


        <!--Map -->
        <div id="header-contacts"><ru_RU>Рады вам ежедневно с 13 до 18 и с 20 до 22.30<br />
                <t class='subheader'>Доставка с13 до 22</t></ru_RU>
            <en_GB>We are glad to see you every day from 13 to 18 and from 20 to 22:30<br />
                <t class='subheader'>Delivery  from 13 to 22</t></en_GB>
            <es_ES>Nos alegra verte todos los días de 13 a 18 y de 20 a 22:30<br />
                <t class='subheader'>Servicio a domicilio de 13 a 22</t></es_ES></div>
        <? include('map.php')?>
        <!--End Map-->

        <!--Social Buttons-->

        <!--End Social Buttons-->

        <!--Footer -->
        <div class="footer-d-wr">
            <div id="footer-bg"></div>
            <div class="page">
                <div class="inner">
                    <div id="footer-tel-home"><a href="tel:(+34) 952-814-529" >(+34) 952-814-529</a></div>
                    <div id="footer-tel-scooter"><a href="tel:(+34) 693-007-586" >(+34) 693-007-586</a></div>
                    <div id="footer-email">reservations@ristorantereginamarbella.es</div>
                    <div id="footer-address">NOTO Restaurant, Calle Azahar Edificio la Ruleta, <br>Nueva Andalucía, 29660</div>
                    <div id="footer-logo"></div>
                    <div id='soc'>
                        <a fb href ='http://facebook.com/NotoRestaurant/' target='blank'><img src='images_desktop/soc_fb.png'/></a>
                        <a in href ='http://instagram.com/notorestaurant/' target='blank'><img src='images_desktop/soc_insta.png'/></a>
                    </div>
                </div>
            </div>
        </div>

        <!--End Footer-->

        <!-- Sticky Header -->
        <style>
            #download_menu
            {
                width: 150px;
                height: 40px;
                padding:9px 10px;
                border: 3px solid black;
                font-size:14px;
            }

            #download_menu:hover
            {
                background-color:black;
                color:white !important;
            }

            #download_menu:hover a
            {
                background-color:black;
                color:white !important;
            }

            #header-menu li:hover
            {
                text-decoration:underline;
                text-decoration-style: dotted;

            }

            #header-menu ul li
            {
                display: inline-block;
                color:red;
                border:0px red solid;
            }

        </style>

        <div></div>
        <div class="header-d-wr1 navbar-default navbar-fixed-top"
             style='height:170px;
            background-color:#fff;
            border:solid 0px  red;
            top:0px;
            width:100%;
            right:0%;
            z-index:100;
            position:fixed;
            box-shadow:0px 3px 3px rgba(0,0,0,0.1);'>
            <div class= '' style='height:110px; width:100%; '>

                <div id='download_menu' style="
                                position: absolute;
                                left:50%;
                                text-align:center;
                                margin:40px -500px;
                                overflow: hidden;
                                display: inline-block;

                                ">
                    <!--                    <a href="up2/server/php/files/Newdesign_menu_2017_ENG_web.pdf"> -->
                    <ru_RU><a href="up/notofiles/Menu_noto_2019_rus_web.pdf">Скачать меню</a></ru_RU>
                    <en_GB><a href="up/notofiles/Menu_noto_2019_eng_web.pdf">Download menu</a></en_GB>
                    <es_ES><a href="up/notofiles/Menu_noto_2019_eng_web.pdf">Bajar la carta</a></es_ES>
                </div>

                <div style="position: absolute;
                        left:50%;
                        margin:20px -117px;
                        height:  90px !important;
                        "  href=".desktop2" slide>
                    <a href="#container"><img src = "images_desktop/noto_logo_black_254x170.jpg"
                                              style="margin:-10px 0px 0px -15px; box-shadow: 1px 2px 3px #888;"/></a>
                </div>

                <div  id="header-contacts">
                    <div id="header-menu1" class="tel-home" slide>
                        <a href="tel:(+34) 952-814-529" >(+34) 952-814-529</a>
                    </div>

                    <div id="header-menu" class="tel-scooter">
                        <a href="tel:(+34) 693-007-586" >(+34) 693-007-586</a>
                    </div>
                </div>

                <div class='mobile_book_table_shade'>  <!--  Кнопка заказть для телефона -->
                    <div class='button mobile_book_table'
                         style='position: absolute;
                               left:50%;
                               border-radius:10px;
                               text-align:center;'>
                        <a href="tel:(+34) 952-814-529">
                            <ru_RU>Заказать столик</ru_RU>
                            <en_GB>to book a table</en_GB>
                            <es_ES>reservar mesa</es_ES>
                        </a>
                    </div>
                </div>

            </div>
            <div>
            <div id="header-menu" class='row item' style="width: 1300px; padding-left:50px; margin:0 auto;">
                <div class='col-md-5'>
                    <ul><li><a class="" href="#menu_section_nav" slide> <ru_RU>Меню</ru_RU>
                                <en_GB>Menu</en_GB>
                                <es_ES>Menú</es_ES></a></li>

                        <li><a class="" href="#noto_club_header" slide> <ru_RU>NOTO клуб</ru_RU>
                                <en_GB>NOTO club</en_GB>
                                <es_ES>CLUB</es_ES></a></li>

                        <li><a class="" href="#delivery-head" slide>    <ru_RU>Доставка</ru_RU>
                                <en_GB>Delivery</en_GB>
                                <es_ES>Entrega</es_ES></a></li></ul>
                </div>
                <div class='col-md-2'></div>
                <div class='col-md-5'>
                    <ul>
                        <li><a class="" href="#header-right" slide>
                                <ru_RU>Контакты</ru_RU>
                                <en_GB>Contact us</en_GB>
                                <es_ES>Contacto</es_ES>
                            </a></li>
                        <li><a class="" href="#feedback-d-wr" slide>
                                <ru_RU>Галерея</ru_RU>
                                <en_GB>Gallery</en_GB>
                                <es_ES>Galería</es_ES>
                            </a></li>
                        <li><a class="" href="#video_tour" slide>
                                <ru_RU>Видеотур</ru_RU>
                                <en_GB>Video</en_GB>
                                <es_ES>Video</es_ES>
                            </a></li>
                        <!--                <li><a class="" href="#calendar-head" slide>
                                                <ru_RU>Акции&События</ru_RU>
                                                <en_GB>Specials&Events</en_GB>
                                                <es_ES>Especiales&Eventos</es_ES>
                                                </a></li>
                        -->
                    </ul>
                </div>
            </div>
            </div>



        </div> <!-- ********************* main container ****************************** -->

        <!-- Sticky Header -->

        <!-- Validation --------------------------->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="js/valid/jq.validation-ru.js" type="text/javascript"></script>
        <script src="js/valid/jq.validation.js" type="text/javascript"></script>
        <script src="js/valid/validation.script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="css/jq.validation.css" type="text/css" media="all">

        <!-- <style> div.profile-photo-light {display:none;} </style>*/m -&&->


        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create','UA-78749655-1','auto');
        //  ga('set', 'userId', {{USER_ID}});
          ga('require','displayfeatures');
          ga('send','pageview');

         /* Accurate bounce rate by time */
         if (!document.referrer ||
         document.referrer.split('/')[2].indexOf(location.hostname) != 0)
         setTimeout(function(){
         ga('send', 'event', 'Новый посетитель', location.pathname);
         }, 15000);
        </script>

        &&-->

        <!-- Код тега ремаркетинга Google -$$->
        <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 880276944;
        var google_custom_params = window.google_tag_params;
        var google_remarketing_only = true;
        /* ]]> */
        </script>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
        </script>
        <noscript>
        <div style="display:inline;">
        <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/880276944/?value=0&amp;guid=ON&amp;script=0"/>
        </div>
        </noscript>
        <!-- Код тега ремаркетинга Google -->


        <!-- Yandex.Metrika counter Код ЯндексМетрики (Обязательно нужен, там есть Вебвизор, чего нет в Аналитикс): -$$->
        <script type="text/javascript">

        (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter37746060 = new Ya.Metrika({ id:37746060, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e)
        { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");
        </script>

        <noscript>
            <div>
                <img src="https://mc.yandex.ru/watch/37746060"
                style="position:absolute; left:-9999px;" alt="" />
            </div>
        </noscript>

        <!-- /Yandex.Metrika counter -->
        </script>


</body>
</html>
