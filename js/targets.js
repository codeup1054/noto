
$( document ).ready( function() { 
// КОДЫ ЦЕЛЕЙ
//1. Нажатие телефона Доставки.

$("div").click(function(e) {
});


$('#header-menu-tel-home').click( function (e) { 
                         
                         ga('send', 'event', 'tel', 'click', 'tel-header-delivery-click');
                         yaCounter37746060.reachGoal('tel-header-delivery-click');
                         return true; });


// 2. Нажатие телефона Общего.
$('#header-menu-tel-scooter').click( function (e) {
                                                   ga('send', 'event', 'tel', 'click', 'tel-header-home-click');
                                                   yaCounter37746060.reachGoal('tel-header-home-click');
                                                   return true; });

// 3. Переключение языка. Поставить на кнопку каждого языка.
$('div[lang_code=ru_RU]').click( function (e) { ga('send', 'event', 'tel', 'click', 'lang_ru_RU');
                                                   yaCounter37746060.reachGoal('lang_ru_RU');
                                                   return true; });

$('div[lang_code=en_GB]').click( function (e) { ga('send', 'event', 'tel', 'click', 'lang_en_GB');
                                                   yaCounter37746060.reachGoal('lang_en_GB');
                                                   return true; });

$('div[lang_code=es_ES]').click( function (e) { ga('send', 'event', 'tel', 'click', 'lang_es_ES');
                                                   yaCounter37746060.reachGoal('lang_es_ES');
                                                   return true; });

//4. Отправка формы заявки с попапа.
$('#delivery-form').click( function (e) { ga('send', 'event', 'form', 'submit', 'order-form-sent');
                                                   yaCounter37746060.reachGoal('order-form-sent');
                                                   return true; });

//<form … onsubmit="ga('send', 'event', 'form', 'submit', 'form-sent');yaCounter37746060.reachGoal('order-form-sent');return true;">
// 5. Нажатие на email.



$('#footer-email').click( function (e) { ga('send', 'event', 'email', 'click', 'emailclick');
                                                   yaCounter37746060.reachGoal('emailclick');
                                                   console.log ("цели %o on event_type %o", $(this).attr('id'), e.type);                                                
                                                   return true; });

//6. появляющаяся кнопка в галерее 26.07.2016

$('.gallery_button').click( function (e) {   
// задать                 ga('send', 'event', 'email', 'click', 'emailclick');
                yaCounter37746060.reachGoal('gallery_button_click');
                console.log ("цели on event_type %o \n id=%o\n class= %o ", e.type , $(this).attr('id'), $(this).attr('class'));                                                
                return true; });


//7. кнопка доставки 26.07.2016

$('#delivery-button').click( function (e) {  // 26.07.2016 
// задать                 ga('send', 'event', 'email', 'click', 'emailclick');
                yaCounter37746060.reachGoal('delivery_button_click');
                console.log ("цели on event_type %o \n id=%o\n class= %o ", e.type , $(this).attr('id'), $(this).attr('class'));                                                
                return true; });


//8. большая кнопка доставки в подвале (только для мобильной версии) 26.07.2016

$('.mobile_book_table').click( function (e) {  // 26.07.2016 
// задать                 ga('send', 'event', 'email', 'click', 'emailclick');
                yaCounter37746060.reachGoal('bottom_mobile_book_table');
                console.log ("цели on event_type %o \n id=%o\n class= %o ", e.type , $(this).attr('id'), $(this).attr('class'));                                                
                return true; });




$('#footer-tel-home').click( function (e) { ga('send', 'event', 'tel', 'click', 'tel-footer-home-click');
                                                   yaCounter37746060.reachGoal('tel-footer-home-click');
                                                   return true; });

$('#footer-tel-scooter').click( function (e) { ga('send', 'event', 'tel', 'click', 'tel-footer-delivery-click');
                                                   yaCounter37746060.reachGoal('tel-footer-delivery-click');
                                                   return true; });

$('a[href=#menu-d-wr]').click( function (e) {  console.log('nav_menu_click')
                                               ga('send', 'event', 'menu', 'click', 'nav_menu_click');
                                               yaCounter37746060.reachGoal('nav_menu_click');
                                               return true; });




});



