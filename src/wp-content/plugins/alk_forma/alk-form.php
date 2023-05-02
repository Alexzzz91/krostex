<?php
/*
Plugin Name: Alk form
Description: Плагин для просмотра записей с формы
Version: 1.0
Author: alk55.ru
*/

//Наш класс расширяет возможности класса WP_List_Table, поэтому мы должны убедиться, что родитель существует
if(!class_exists('WP_List_Table')){
 require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

// подключит файл breadcrumbs.php из каталога текущей темы

class alk_List_Table extends WP_List_Table {

/**
 * Переопределяем родительский конструктор,
 * чтобы передать наши собственные аргументы
*/
 function __construct() {
 parent::__construct( array(
 'singular'=> 'wp_list_text_link', //имя одной записи в единственном числе
 'plural' => 'wp_list_text_links', //имя списка записей во множественном числе
 'ajax' => true //Не поддерживать Ajax для таблицы
 ) );
 }
 
    //Returns the url of the plugin's root folder
    public static function get_base_url(){
        $folder = basename(dirname(__FILE__));
        return plugins_url($folder);
    }
/**
 * Добавим дополнительную разметку в панели инструментов до и после таблицы
 * $which - параметр имеющий тип данных string,
 * позволяющий определить куда добавлять разметку:
 * до таблицы или после нее,
 * может принимать значения: top или bottom
 */
function extra_tablenav( $which ) {
 if ( $which == "top" ){
 //Код добавляет разметку до таблицы
 
 //echo "Привет, я нахожусь до таблицы";
 }
 if ( $which == "bottom" ){
 //Код добавляет разметку после таблицы
 
//echo "Привет, я нахожусь после таблицы";
 }
}

/**
 * Определям столбцы, которые будут использоваться в нашей таблице
 * функция возвращает массив столбцов используемых в таблице $columns
 */
function get_columns() {
 return array(
    'col_id'=>__('#'),
    'col_name'=>__('имя'),
    'col_telefon'=>__('Телефон'),
    'col_email'=>__('email'),
    'col_message'=>__('Сообщение'),
    'col_time'=>__('Время')
 );
}
function get_hidden_columns() {
 return array();
}

/**
 * Определяем какиестолбцы будут иметь функцию сортировки
 * возвращает массив столбцов ($sortable) по которым можно сортировать
 */
public function get_sortable_columns() {
    return array(
        'col_id'=>array('id', true),
        'col_name'=>array('name', true),
        'col_telefon'=>array('telefon', true),
        'col_email'=>array('email', true),
        'col_message'=>array('message', true),
        'col_time'=>array('time', true)
    );
}


/**
 * Подготовка таблицы с различными параметрами, нумерация страниц (пагинация), столбцы  и элементы таблицы
 */
function prepare_items() {

 $screen = get_current_screen();

global $wpdb, $_wp_column_headers;
$table_name = $wpdb->prefix . "alkcontact_form";

/* -- Подготавливаем запрос к БД -- */
 $query = "SELECT * FROM " . $table_name . "";
 
/* -- Упорядочение параметров -- */
 //Параметры, которые будут использоваться для упорядочения результата
 $orderby = !empty($_GET["orderby"]) ? $wpdb->_escape($_GET["orderby"]) : 'ASC';
 $order = !empty($_GET["order"]) ? $wpdb->_escape($_GET["order"]) : '';
 if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }
 
/* -- Параметры для нумерации страниц -- */
 //Количество элементов таблицы?
 $totalitems = $wpdb->query($query); //возвращает общее количество задействованных строк
 //Сколько строк таблицы показывать на одной странице?
 $perpage = 20;
 //На какой мы странице?


 $paged = !empty($_GET["paged"]) ? $wpdb->_escape($_GET["paged"]) : '';
 //Номер страницы?
 if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }  //Сколько страниц у нас получилось в итоге?  
 $totalpages = ceil($totalitems/$perpage);  //настроим запрос принимая во внимание нумерацию  
 if(!empty($paged) && !empty($perpage)){  $offset=($paged-1)*$perpage;  
 $query.=' LIMIT '.(int)$offset.','.(int)$perpage;  } 
 /* -- Регистрируем нумерацию -- */  
 $this->set_pagination_args( array(
 "total_items" => $totalitems,
 "total_pages" => $totalpages,
 "per_page" => $perpage,
 ) );
 //Ссылки на страницы автоматически будут созданы в соответствии с параметрами выше
 
/* -- Регистрируем колонки -- */
$columns = $this->get_columns();
$hidden = $this->get_hidden_columns();
$sortable = $this->get_sortable_columns();
$this->_column_headers = array($columns, $hidden, $sortable);
 
/* -- Выборка элементов -- */
 $this->items = $wpdb->get_results($query);
}


/**
 * Отображает строки таблицы
 * возвращает строку содержащую разметку содержимого таблицы
 */
function display_rows() {
 
    //Получаем записи зарегистрированные в методе prepare_items
    $records = $this->items;

    //Получаем колонки зарегистрированные в методах get_columns и get_sortable_columns
    list( $columns, $hidden ) = $this->get_column_info();
 
    //Запускаем цикл по всем записям
    if(!empty($records)){foreach($records as $rec){
        //Открываем строку
        echo '<tr id="record_'.$rec->id.'">';
        foreach ( $columns as $column_name => $column_display_name ) {
 
            //Применяем стили к каждой колонке
            $class = "class='$column_name column-$column_name'";
            $style = "";
            if ( in_array( $column_name, $hidden ) ) $style = 'style="display:none;"';
            $attributes = $class . $style;
 
            //ссылка для редактирования
            $editlink  = '/wp-admin/admin.php?page=form_ansokan_edit&id='.(int)$rec->id;
            //Отображаем ячейку
            switch ( $column_name ) {
                case "col_id": echo '<td '.$attributes.'>'.stripslashes($rec->id).'</td>';   break;
                case "col_name": echo '<td '.$attributes.'><strong><a href="'.$editlink.'">'.stripslashes($rec->name).'</a></strong></td>'; break;
                case "col_telefon": echo '<td '.$attributes.'><strong><a href="'.$editlink.'">'.stripslashes($rec->telefon).'</a></strong></td>'; break;
                case "col_email": echo '<td '.$attributes.'><strong><a href="'.$editlink.'">'.stripslashes($rec->email).'</a></strong></td>'; break;
                case "col_message": echo '<td '.$attributes.'><strong><a href="'.$editlink.'">'.stripslashes($rec->message).'</a></strong></td>'; break;
                case "col_time": echo '<td '.$attributes.'><strong><a href="'.$editlink.'">'.stripslashes($rec->time).'</a></strong></td>'; break;
            }
        }
 
        //Закрываем строку
        echo'</tr>';
    }}
}

}

/** ************************ Регистрация тестовой страницы *****************************/
function form_ansokan(){

    $icon = 'data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDI0MC4xNjIgMjQwLjE2MiIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgMjQwLjE2MiAyNDAuMTYyIiB3aWR0aD0iMjRweCIgaGVpZ2h0PSIyNHB4Ij4KICA8Zz4KICAgIDxwYXRoIGQ9Im0zOS44MTgsNzIuNDk0aDk3LjY1MmMzLjg2NiwwIDctMy4xMzQgNy03cy0zLjEzNC03LTctN2gtOTcuNjUyYy0zLjg2NiwwLTcsMy4xMzQtNyw3czMuMTM0LDcgNyw3eiIgZmlsbD0iI0ZGRkZGRiIvPgogICAgPHBhdGggZD0ibTM5LjgxOCw5Ni41NDNoOTcuNjUyYzMuODY2LDAgNy0zLjEzNCA3LTdzLTMuMTM0LTctNy03aC05Ny42NTJjLTMuODY2LDAtNywzLjEzNC03LDdzMy4xMzQsNyA3LDd6IiBmaWxsPSIjRkZGRkZGIi8+CiAgICA8cGF0aCBkPSJtOTEuNDc3LDE3OC43MzhoLTUxLjY1OWMtMy44NjYsMC03LDMuMTM0LTcsN3MzLjEzNCw3IDcsN2g1MS42NThjMy44NjYsMCA3LTMuMTM0IDctN3MtMy4xMzMtNy02Ljk5OS03eiIgZmlsbD0iI0ZGRkZGRiIvPgogICAgPHBhdGggZD0ibTIzNi43NjMsMjAuOTExbC0yMC41OC0xMi4zNDhjLTEuNTkyLTAuOTU1LTMuNDk4LTEuMjQtNS4yOTktMC43ODktMS44MDEsMC40NS0zLjM1LDEuNTk4LTQuMzA1LDMuMTg5bC0zNS44MjksNTkuNzE0di00Mi4zMmMwLTMuODY2LTMuMTM0LTctNy03aC0xNTYuNzVjLTMuODY2LDAtNywzLjEzNC03LDd2MTk3LjI0YzAsMy44NjYgMy4xMzQsNyA3LDdoMTU2Ljc1YzMuODY2LDAgNy0zLjEzNCA3LTd2LTgxLjA2Mmw2OC40MTQtMTE0LjAyYzEuOTg5LTMuMzE1IDAuOTE0LTcuNjE0LTIuNDAxLTkuNjA0em0tOTAuNDAyLDEzNy4wNjFsLTExLjYxNyw5LjY0MyAzLjA0Mi0xNC43ODggNjcuMTUyLTExMS45MTcgOC41NzUsNS4xNDUtNjcuMTUyLDExMS45MTd6bTc0LjM1NS0xMjMuOTIybC04LjU3NS01LjE0NSAyLjg0Mi00LjczNiA4LjU3NSw1LjE0NS0yLjg0Miw0LjczNnptLTIwNi43MTYsMTg0LjU0N3YtMTgzLjI0aDE0Mi43NXY1OC42NTNsLTEyLjM2MywyMC42MDRjMC4wNDktMC4zMzUgMC4wODMtMC42NzQgMC4wODMtMS4wMjIgMC0zLjg2Ni0zLjEzNC03LTctN2gtOTcuNjUyYy0zLjg2NiwwLTcsMy4xMzQtNyw3czMuMTM0LDcgNyw3aDk3LjY1MmMxLjU1OSwwIDIuOTkzLTAuNTE2IDQuMTU2LTEuMzc3bC02Ljg1NiwxMS40MjZoLTk0Ljk1MmMtMy44NjYsMC03LDMuMTM0LTcsN3MzLjEzNCw3IDcsN2g4Ni41NTJsLTEuMjA0LDIuMDA2Yy0wLjQwNiwwLjY3Ny0wLjY5NSwxLjQxOC0wLjg1NCwyLjE5MWwtMS4yMDMsNS44NTFoLTgzLjI5MWMtMy44NjYsMC03LDMuMTM0LTcsN3MzLjEzNCw3IDcsN2g4MC40MTFsLTMuMjE3LDE1LjYzOWMtMC41OTksMi45MTEgMC43MDYsNS44ODMgMy4yNTUsNy40MTMgMS4xMTQsMC42NjggMi4zNiwwLjk5OCAzLjYwMSwwLjk5OCAxLjU5NywwIDMuMTg1LTAuNTQ1IDQuNDcyLTEuNjE0bDI3Ljg4LTIzLjE0MmMwLjE5MS0wLjE1OSAwLjM1Ny0wLjM0NCAwLjUzLTAuNTIxdjUxLjEzNWgtMTQyLjc1eiIgZmlsbD0iI0ZGRkZGRiIvPgogIDwvZz4KPC9zdmc+Cg==';

    add_menu_page('ФОРМА ЗАЯВКИ', 'ФОРМА ЗАЯВКИ', 'activate_plugins', 'form_ansokan', 'form_ansokan_render_items', $icon, 5);
} 

add_action('admin_menu', 'form_ansokan');


function form_ansokan_render_items(){
    
	$wp_list_table = new alk_List_Table();
	$wp_list_table->prepare_items();
	$wp_list_table->display();
}
function form_ansokan_css() {

    $base_url = alk_List_Table::get_base_url();
    wp_enqueue_script( 'ansokanscript', $base_url . '/css/formansokan.js', array(), 0.1);
    wp_enqueue_style( 'alkformansokan', $base_url . '/css/formansokan.css', array(), 0.1);
}
add_action( 'admin_enqueue_scripts', 'form_ansokan_css' );

function form_ansokan_record_item(){

        $id_page = $_GET["id"];
        if (empty($_GET["id"])) {
           form_ansokan_render_items();
           die;
        }

        global $wpdb, $_wp_column_headers;
        $table_name = $wpdb->prefix . "alkcontact_form";   
        
        $Entries = $wpdb->get_row("SELECT * FROM ".$table_name." WHERE id = ".$id_page."");

        //var_dump($Entries);
        echo '<table cellspacing="0" class="alkform-detail-view">';
        echo '<thead>
        <tr><th>Заявка : # '. $Entries->id .'</th><th style="font-size:14px; text-align: right;"></th></tr></thead>';
            echo '<tbody>';
                echo '<tr><td class="entry-view-field-name">ИМЯ</td>
                <td class="entry-view-field-name">'. $Entries->name.'</td>
                </tr>';
                echo '<tr><td class="entry-view-field-name">НОМЕР ТЕЛЕФОНА</td>
                <td class="entry-view-field-name">'. $Entries->telefon.'</td>
                </tr>';
                echo '<tr><td class="entry-view-field-name">E-mail</td>
                <td class="entry-view-field-name">'. $Entries->email.'</td>
                </tr>';
                echo '<tr><td class="entry-view-field-name">Сообщение</td>
                <td class="entry-view-field-name">'. $Entries->message.'</td>
                </tr>';
                echo '</tbody>';
            echo '</table>';

}

function view_edit_page(){

    add_submenu_page ( 'form_ansokan', 'Просмотр записей', 'Просмотр записей', 'activate_plugins', 'form_ansokan_edit', 'form_ansokan_record_item' );
}
add_action('admin_menu', 'view_edit_page'); 