
$( document ).ready( function() { 
// КОДЫ ЦЕЛЕЙ
//1. Нажатие телефона Доставки.

$("div").click(function(e) {
});


$('#header-menu-tel-home').click( function (e) { 
                         
                         console.log ("цели %o on event_type %o", $(this).attr('id'), e.type);                                                
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
$('#delivery-form').submit( function (e) { ga('send', 'event', 'form', 'submit', 'order-form-sent');
                            
                                                   alert ("цели %o on event_type %o", $(this).attr('id'), e.type);                                                
                                                   yaCounter37746060.reachGoal('order-form-sent');
                                                   return true; });

//<form … onsubmit="ga('send', 'event', 'form', 'submit', 'form-sent');yaCounter37746060.reachGoal('order-form-sent');return true;">
// 5. Нажатие на email.

$('#footer-email').click( function (e) { ga('send', 'event', 'email', 'click', 'emailclick');
                                                   yaCounter37746060.reachGoal('emailclick');
                                                   console.log ("цели %o on event_type %o", $(this).attr('id'), e.type);                                                
                                                   return true; });
//onclick="ga('send', 'event', 'email', 'click', 'emailclick')"
});