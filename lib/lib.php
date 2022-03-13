

<?
/*
 2016.02.19  Добавлен вывод календаря

*/

error_reporting(E_ALL);
ini_set("display_errors", 1);
/***
$path = $_SERVER['DOCUMENT_ROOT'];

//include_once $path . '/wp-config.php';
//include_once $path . '/wp-load.php';
//include_once $path . '/wp-includes/wp-db.php';
//include_once $path . '/wp-includes/pluggable.php';

get_content_for_maket('desktop2');

//print "wpdb<pre>".print_r ($wpdb,1)."</pre>";

$wpdb->show_errors = true;

  class renderWP {
    // определяем собственный метод подкласса
    function getLangArray() {
      global  $wpdb;

        $querystr = "SELECT DISTINCT(language) as lang, COUNT(*) as cnt FROM wp_mltlngg_translate GROUP BY lang ORDER BY cnt DESC";
        $post_lang = $wpdb->get_results($querystr, OBJECT_K);

//        print "Lang=<pre>".print_r($post_lang,1)."</pre>";

        return $post_lang;
    }


// получение разных языков для post


    function getTranslation($ids) {
      global  $wpdb;


        $querystr = "select
                    t0.ID as ID,
                    t0.post_content,
                    t0.post_excerpt,
                    COALESCE(max(ru_RU),t0.post_content) content_ru_RU,
                    COALESCE(max(es_ES),'ES') content_es_ES,
                    COALESCE(max(en_GB),'EN') content_en_GB,
                    COALESCE(max(t_ru_RU),t0.post_title) title_ru_RU,
                    COALESCE(max(t_es_ES),'ES') title_es_ES,
                    COALESCE(max(t_en_GB),'EN') title_en_GB


                    from wp_posts t0
                    left join
                    (select post_ID, post_content,
                        case when language = 'ru_RU' then post_content end as ru_RU,
                        case when language = 'en_GB' then post_content end as en_GB,
                        case when language = 'es_ES' then post_content end as es_ES,
                        case when language = 'ru_RU' then post_title end as t_ru_RU,
                        case when language = 'en_GB' then post_title end as t_en_GB,
                        case when language = 'es_ES' then post_title end as t_es_ES
                        FROM `wp_mltlngg_translate` t1) t2 on (t0.ID = t2.post_ID)
                    where t0.ID IN ($ids)
                    group by t0.ID
                    order by ID asc
                    limit 0,20";

        $post_lang = $wpdb->get_results($querystr, OBJECT_K);
//        print "Lang=$querystr<br /><pre>".print_r($post_lang,1)."</pre>";
        return $post_lang;
    }

//  получить информацию о событиях

    function getEvents($cat = 'events')
    {
        $arg = array(
        	'posts_per_page'   => 20,
        	'offset'           => 0,
        	'category'         => '',
        	'category_name'    => $cat,
        	'orderby'          => 'date',
        	'order'            => 'DESC',
        	'include'          => '',
        	'exclude'          => '',
        	'meta_key'         => '',
        	'meta_value'       => '',
        	'post_type'        => 'post',
        	'post_mime_type'   => '',
        	'post_parent'      => '',
        	'author'	   => '',
        	'post_status'      => 'publish',
        	'suppress_filters' => false
        );


        $eventData = array();
        $event_post = get_posts($arg);

        foreach ($event_post as $k=>$v)  // сортируем по дате события
        {
          $pc = get_field('event_time', $v->ID);  // извлекаем  дату из произвольного поля "Время мероприятия"
          $tm = strtotime($pc);
          $events[$tm] = $v;
        }

        krsort ($events);


//        foreach ($event_post as $k=>$v)  // для 20 POST в катерогии event  79
        foreach ($events as $k=>$v)  // для 20 POST в катерогии event  79
        {


          $thumb = get_the_post_thumbnail( $v->ID, 'thumbnail' );   // извлекаем изображение
          $thumb = ($thumb)? $thumb: get_the_post_thumbnail( 1437, 'thumbnail' );

          $trans = $this->getTranslation($v->ID);   // получем переводы




//  < Форматируем  дату на разных языках >

          $pc = get_field('event_time', $v->ID);  // извлекаем  дату из произвольного поля "Время мероприятия"

          $tm = strtotime($pc);

          setlocale(LC_TIME,  'ru_RU.UTF-8', 'Russian_Russia.65001'); //Локали в UTF для русского
          $date_ru_RU = strftime("%A, %e %B %Y  %H:%M", $tm);

          setlocale(LC_TIME, "en_GB"); //only necessary if the locale isn't already set
          $date_en_GB = strftime("%A, %e %B %Y  %I:%M %p", $tm);

          setlocale(LC_TIME, "es_ES.UTF-8"); //only necessary if the locale isn't already set
          $date_es_ES = strftime("%A, %e %B %Y  %H:%M", $tm);


//  < /Форматируем  дату на разных языках >


        $today = new DateTime(); // This object represents current date/time
        $today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison


        $match_date =  new DateTime();
        $match_date->setTimestamp( $k );


        $match_date->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison

        $diff = $today->diff( $match_date );
        $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval

        switch( $diffDays ) {
            case 0:
                $today = 'today';
                break;
            case -1:
                $today = '';
                break;
            case +1:
                $today = '';
                break;
            default:
                $today = '';
        }

          $event_block[] = "
            <div class='item $today' post_id = '".$v->ID."'>
                    <div class='calendar-card'>
                        <div id='calendar-card-date'>
                            <ru_RU>$date_ru_RU</ru_RU>
                            <en_GB>$date_en_GB</en_GB>
                            <es_ES>$date_es_ES</es_ES>
                        </div>
                        <div id='calendar-card-pic'>$thumb</div>
                        <div id='calendar-card-head'>
                            <ru_RU>$v->post_title</ru_RU>
                            <en_GB>".$trans[$v->ID]->title_en_GB."</en_GB>
                            <es_ES>".$trans[$v->ID]->title_es_ES."</es_ES>
                        </div>
                        <div id='calendar-card-text'>
                            <ru_RU>$v->post_content</ru_RU>
                            <en_GB>".$trans[$v->ID]->content_en_GB."</en_GB>
                            <es_ES>".$trans[$v->ID]->content_es_ES."</es_ES>
                        </div>
                   </div>
            </div>";
          unset ($ed);
        }

 //       print "<pre style='font-size:10px'><br /><br /><br /><br />".print_r($eventData,1)."</pre>";


        return ''.implode($event_block).'';
    }


    function getReviews($cat = 'feedback')
    {
        $arg = array(
        	'posts_per_page'   => 20,
        	'offset'           => 0,
        	'category'         => '',
        	'category_name'    => $cat,
        	'orderby'          => 'date',
        	'order'            => 'DESC',
        	'include'          => '',
        	'exclude'          => '',
        	'meta_key'         => '',
        	'meta_value'       => '',
        	'post_type'        => 'post',
        	'post_mime_type'   => '',
        	'post_parent'      => '',
        	'author'	   => '',
        	'post_status'      => 'publish',
        	'suppress_filters' => false
        );


        $posts = get_posts($arg);

        foreach ($posts as $k=>$v)  // для 20 POST в катерогии event  79
        {

        $trans = $this->getTranslation($v->ID);   // получем переводы

        $block[] = "
            <div class='card item'>
                <div id='card-head'>
                    <ru_RU>$v->post_title</ru_RU>
                    <en_GB>".$trans[$v->ID]->title_en_GB."</en_GB>
                    <es_ES>".$trans[$v->ID]->title_es_ES."</es_ES>
                </div>
                <div id='card-text'>
                    <ru_RU>$v->post_content</ru_RU>
                    <en_GB>".$trans[$v->ID]->content_en_GB."</en_GB>
                    <es_ES>".$trans[$v->ID]->content_es_ES."</es_ES>
                </div>
           </div>";

        }

        return ''.implode($block).'';
    }

  }
/*

            [ID] => 2348
            [post_author] => 1
            [post_date] => 2016-02-19 12:02:39
            [post_date_gmt] => 2016-02-19 09:02:39
            [post_content] => Posted on 21 octubre, 2015 by Reginas
Date: 28 noviembre, 2015
Time: 8:30 pm  to  12:00 am
            [post_title] => THE AUTHENTIC “LEGENDS OF MOTOWN” TRIBUTE SHOW
            [post_excerpt] =>
            [post_status] => publish
            [comment_status] => closed
            [ping_status] => closed
            [post_password] =>
            [post_name] => zhivaya-muzyka
            [to_ping] =>
            [pinged] =>
            [post_modified] => 2016-02-19 12:13:58
            [post_modified_gmt] => 2016-02-19 09:13:58
            [post_content_filtered] =>
            [post_parent] => 0
            [guid] => http://marbellarestaurante.geomarkup.ru/?p=2348
            [menu_order] => 0
            [post_type] => post
            [post_mime_type] =>
            [comment_count] => 0
            [filter] => raw


*/

/***
// $odr = new odr();

$odr = new renderWP();

$odr->getLangArray();
//print "Lang=<pre>".print_r($odr->getLangSet,1)."</pre>";

$eventData = $odr->getEvents();
$reviewData = $odr->getReviews();

function render555($type)
{

global $wpdb;
//types_render_usermeta_field( "block-div", array( "id" => true ) );

print "<div class='".$type."'>";

$args = array(
	'posts_per_page'   => 100,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => $type,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true
);

$posts_array = get_posts( $args );




$lang = array('ru_RU'=>'RU','en_GB'=>'EN','es_ES'=>'ES',);

foreach   ($posts_array  as $k => $v)
    {

     switch ($v->post_excerpt) {

         default:
            $querystr = "SELECT * FROM wp_mltlngg_translate where post_id = ".$v->ID;
            $post_lang = $wpdb->get_results($querystr, OBJECT);




           // если нет перевода рисуем только основную русскую версию

           $c_RU = $c_EN = $c_ES = $v->post_content;


           if (isset($post_lang ))
           {
               foreach($post_lang as $plk => $plv)
               {
                switch ($plv->language)
                    {
                    case 'ru_RU': $c_RU = $plv->post_content; break;
                    case 'en_GB': $c_EN = $plv->post_content; break;
                    case 'es_ES': $c_ES = $plv->post_content; break;
                    }
               }
            }


            $id = $v->ID;

           $type = str_replace(","," ",$type);

           $str = "<div id = ".$v->post_excerpt."
                        post_id='".$id."'
                        title='".$v->post_title."'
                        class='".$v->post_excerpt." $type'>
                           <ru_RU>".$c_RU."</ru_RU>
                           <en_GB>".$c_EN."</en_GB>
                           <es_ES>".$c_ES."</es_ES>
                  </div>";

if ($type == 'menu' or 0) print "<script>console.log('php ###:',"
            .$di.",".$v->post_excert."";
            ")</script>";

            print $str;


        }
    }


print "</div>";

}



function get_content_for_maket($type)
{

global $wpdb;
//types_render_usermeta_field( "block-div", array( "id" => true ) );

print "<div class='".$type."'>";

$args = array(
	'posts_per_page'   => 101,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => $type,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true
);

//$posts_array = get_posts( $args );

//print "posts_array=".count($posts_array)."<pre>".print_r ($posts_array,1)."</pre>";


$ml_content = array();

$lang = array('ru_RU'=>'RU','en_GB'=>'EN','es_ES'=>'ES',);

foreach   ($posts_array  as $k => $v)
    {

     switch ($v->post_excerpt) {

         default:

            $querystr = "SELECT * FROM wp_mltlngg_translate where post_id = ".$v->ID;
            $post_lang = $wpdb->get_results($querystr, OBJECT);


           // если нет перевода рисуем только основную русскую версию

           $c_RU = $c_EN = $c_ES = $v->post_content;

           if (isset($post_lang ))
           {
               foreach($post_lang as $plk => $plv)
               {
                switch ($plv->language)
                    {
                    case 'ru_RU': $c_RU = $plv->post_content; break;
                    case 'en_GB': $c_EN = $plv->post_content; break;
                    case 'es_ES': $c_ES = $plv->post_content; break;
                    }
               }
            }

            $post_id = $v->ID;
            $div_id = $v->post_excerpt;


            $type = str_replace(","," ",$type);

            $ml_content[$div_id] = array ('div_id' => $div_id,
                        'post_id'=>$post_id,
                        'browser_type'=>$type,
                        'post_content' => "
                           <ru_RU>".$c_RU."</ru_RU>
                           <en_GB>".$c_EN."</en_GB>
                           <es_ES>".$c_ES."</es_ES>");


if ($type == 'menu' or 0) print "<script>console.log('###: %o | %o','"
            .$v->post_title."',".json_encode($di).")</script>";
        }
    }

// print "$ml_content <pre>".print_r ($ml_content,1)."</pre>";

        print "<script> var ml_content = ".json_encode($ml_content).";</script>";

}


/*

0: Object
ID: 1901
comment_count: "0"
comment_status: "open"
filter: "raw"
guid: "http://marbellarestaurante.geomarkup.ru/podval-telefon/"
menu_order: 0
ping_status: "open"
pinged: ""
post_author: "1"
post_content: "(+34)95-281-4529"
post_content_filtered: ""
post_date: "2016-01-23 15:53:26"
post_date_gmt: "2016-01-23 12:53:26"
post_excerpt: "footer-tel"
post_mime_type: ""
post_modified: "2016-01-23 15:53:26"
post_modified_gmt: "2016-01-23 12:53:26"
post_name: "podval-telefon"
post_parent: 0
post_password: ""
post_status: "publish"
post_title: "Подвал телефон"
post_type: "post"
to_ping: ""
__proto__: Object


*/

/*********************** Обновляем текст записи сучетом языка *********************/



function update_post($data)
{
    global $wpdb;

    $wpdb->show_errors = true;

    $id = explode("-",$data['id']);


    $lang_array = array('RU_RU'=>'ru_RU','EN_GB'=>'en_GB','ES_ES'=>'es_ES',);

    $lang = $lang_array[$data['lang']];


    $post_title = "[".$data['id']."] ".substr($data['class'], 0, strpos($data['class'],' '));
    $post_content = $data['content'];


    if ($lang == 'ru_RU' )
    {
          $ru_post = array(
          'ID'           => $id[0],
          'post_content' => $post_content,
           );

//print 'wp_update_post';
            wp_update_post( $ru_post);

$post_by_id = get_post($id[0]);
$post_title = $post_by_id->post_title;

    }

    print "lib.php:208 lang = $lang <pre>".print_r($data,1)."</pre>";


    $querystr = "insert into `wp_mltlngg_translate` 
                        (post_ID,
                         post_title, 
                         post_content, 
                         `language`) 
                     VALUES (".$id[0].",
                            '$post_title',
                            '$post_content',
                            '$lang')
                     ON DUPLICATE KEY UPDATE
                      `post_content` = '$post_content',
                      `post_title` = '$post_title'";




        $post_lang = $wpdb->query($querystr);

        print "\n lib.php[143]  $lang \n sql $querystr \n result ".print_r ($ru_post,1);



/*
	1	ID
	2	post_ID
	3	post_content
	4	post_excerpt
	5	post_title
	6	language

    INSERT INTO table (id, name, age) VALUES(1, "A", 19) ON DUPLICATE KEY UPDATE
name="A", age=19

replace into `wp_mltlngg_translate2` (post_ID, post_content, language)
                     VALUES (1827,Esp Изысканное традиционное и современное меню,es_ES)

insert into `wp_mltlngg_translate2` (post_ID, post_content, `language`)
                     VALUES (1827,'Esp Изысканное традиционное и современное меню','es_ES')
                      ON DUPLICATE KEY UPDATE
                      `post_content` = 'Esp Изысканное традиционное и современное меню'


*/



}


/*********************** Обновляем текст записи *********************/








function show_lang_menu()
{
    $defaults = array(
	'theme_location'  => '',
	'menu'            => '',
	'container'       => 'div',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);

wp_nav_menu( $defaults );

}




/* Определение языка браузера */



class lang_detect {

var $language;

public function __construct()
    {
        if (($list = strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']))) {
            if (preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', $list, $list)) {
                $this->language = array_combine($list[1], $list[2]);
                foreach ($this->language as $n => $v)
                    $this->language[$n] = $v ? $v : 1;
                arsort($this->language, SORT_NUMERIC);
            }
        } else $this->language = array();
    }


 public function getBestMatch($default, $langs)
    {
        $languages=array();
        foreach ($langs as $lang => $alias) {
            if (is_array($alias)) {
                foreach ($alias as $alias_lang) {
                    $languages[strtolower($alias_lang)] = strtolower($lang);
                }
            }else $languages[strtolower($alias)]=strtolower($lang);
        }

        foreach ($this->language as $l => $v) {
            $s = strtok($l, '-'); // убираем то что идет после тире в языках вида "en-us, ru-ru"
            if (isset($languages[$s]))
                return $languages[$s];
        }
        return $default;
    }
}


/*  вывод блюд меню ресторана */


function show_dishes($browser)
{

global $wpdb;
global $odr;


$categories = get_categories( array('parent' => 37, 'number' => 8) );

foreach($categories as $k=>$v)
    {

$querystr = "SELECT * FROM `wp_mltlngg_terms_translate` where term_id = ".$v->cat_ID."";
$cat_array = $wpdb->get_results($querystr, OBJECT );


foreach($cat_array as $ck => $cv) { $cat[$cv->language] = $cv->name; }

foreach ($odr->getLangArray() as $lk => $vk)
{
    if ($cat[$cv->language])
        $cat_menu[] =  "<$lk cat>".$cat[$lk]."</$lk>";
    else
        $cat_menu[] =  "<$lk cat>".$v->name."</$lk>";
}

unset ($cat);

/*
    $args = array(
	'posts_per_page'   => 5,
	'offset'           => 0,
	'category'         => $v->cat_ID,
	'category_name'    => '',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true
);

$posts_in_category = get_posts( $args );
*/

$querystr = "select 
t0.ID as ID, 
t0.post_content, 
t0.post_excerpt,
COALESCE(max(ru_RU),t0.post_content) ru_RU, 
COALESCE(max(es_ES),'RU') es_ES, 
COALESCE(max(en_GB),'EN') en_GB, 
COALESCE(max(t_ru_RU),t0.post_title) t_ru_RU, 
COALESCE(max(t_es_ES),'RU') t_es_ES, 
COALESCE(max(t_en_GB),'EN') t_en_GB 


from wp_posts t0 
left join 
(select post_ID, post_content,
    case when language = 'ru_RU' then post_content end as ru_RU,
    case when language = 'en_GB' then post_content end as en_GB,
    case when language = 'es_ES' then post_content end as es_ES, 
    case when language = 'ru_RU' then post_title end as t_ru_RU,
    case when language = 'en_GB' then post_title end as t_en_GB,
    case when language = 'es_ES' then post_title end as t_es_ES 
    FROM `wp_mltlngg_translate` t1) t2 on (t0.ID = t2.post_ID)
where t0.ID IN (select object_id 
    from  wp_term_relationships t3
    where term_taxonomy_id = ".$v->cat_ID.")    
group by t0.ID 
order by ID asc
limit 0,20";

$posts_array = $wpdb->get_results($querystr, OBJECT );

//print "<script>console.log('<br />  ###: ',".json_encode ($posts_array).")</script>";


foreach($posts_array as $k1 =>$v1)
    {
        $thumb = get_the_post_thumbnail( $v1->ID, 'thumbnail' );
        $thumb = ($thumb)? $thumb: get_the_post_thumbnail( 1437, 'thumbnail' );
        $thumb = '';

        foreach ($odr->getLangArray() as $lk => $vk)
        {
            if ($lk)
                {
                 $t = "t_".$lk;
                 $ml_title[] =  "<$lk>".$v1->$t."</$lk>";
                 $ml_content[] =  "<$lk>".$v1->$lk."</$lk>";
                }
        }

//print "post_lang ".($cnt++)."<pre>".print_r ($post_by_lang,1)."</pre>";

//        print "<script>console.log('Dishes $querystr lang: ',".json_encode ($post_lang).")</script>";
            $dish[] = "<div title='id ".$v1->ID."' class='dish' id='".$v1->name."' >
            ".$thumb."<br />
                <dish_title post_id='".$v1->ID."' title='".$v1->post_excerpt."' >"
                .implode(" ",$ml_title).
                "</dish_title>
                <dish_description post_id='".$v1->ID."'>"
                .implode(" ",$ml_content).
                "</dish_description>
                <div class='button dish' >
                     <en_GB>ORDER</en_GB> 
                     <es_ES>ORDEN</es_ES> 
                     <ru_RU>ЗАКАЗАТЬ</ru_RU> 
                </div>
            </div>";

            unset ($ml_content);
            unset ($ml_title);

      }

//            <dish_name>".$v1->post_title."</dish_name>


    $dish_section[] = "<div class='dish_section' 
                         id='".$v->name."'>
                         <dish_section_name>".$v->name."</dish_section_name> 
                         ".implode("",$dish)."
                         </div>";

                         unset ($dish);

    $menu_section_item[] = "<div class='dish_menu_item' 
                         id='".$v->name."'>
                         ".implode(" ",$cat_menu)."
                         </div>";

                         unset($cat_menu);


    }

    print  "<div style='position:relative; left:50%; margin:0px 0 100px -500px;'>
            <table border=0px;>
              <tr>
                <td style='vertical-align:top;'>
                    <div class='dish_menu' >".implode("",$menu_section_item)."</div>
                </td>
                <td>    
                <div class='page_dish_container' >
                    <div style='width:1500px'>
                        <div class='scroll_dish_container'> 
                                    ".implode("",$dish_section)."
                        </div>
                    </div>
                </div>
                </div>
                </td>
            </tr>
            </table></div>
            ";

                     unset ($dish_section);
                     unset ($menu_section_item);

}


/*  Рерсивный поиск */

function recursive_array_search($needle,$haystack) {
    foreach($haystack as $key=>$value) {
        $current_key=$key;
        if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value))) {
            return $current_key;
        }
    }
    return false;
}


?>







