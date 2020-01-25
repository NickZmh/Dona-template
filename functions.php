<?php

//adding tgm pluging
require_once get_template_directory() . '/inc/thirdparty/tgm-plugin-activation/plugins.php';

//Dona Default Function
// Excerpt length Control
function dona_excerpt_more($more) {
    return "";
}

add_filter('excerpt_more', 'dona_excerpt_more');

function custom_excerpt_length($length) {
    return 35;
}

add_filter('excerpt_length', 'custom_excerpt_length', 999);

function dona_default_function() {

    add_theme_support('title-tag');
    add_theme_support('custom-background');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-header');
    add_theme_support('automatic-feed-links');
    get_the_tags();
    if (!isset($content_width)) {
        $content_width = 900;
    }


    // Text domain
    load_theme_textdomain('dona', get_template_directory_uri() . '/languages');

    // Menu Register
    if (function_exists('register_nav_menus')) {
        register_nav_menu('frontpage-menu', __('Front Page Menu. This menu will be shown only on "Front Page" page template.', 'dona'));
        register_nav_menu('main-menu', __('Main Menu', 'dona'));
        register_nav_menu('footer-menu', __('Footer Menu. This menu doesn\'t Support Multi-level Items.', 'dona'));
    }

    add_image_size('dona_post_thumbnail', 370, 360, array('left', 'top'));
}

add_action('after_setup_theme', 'dona_default_function');


/* Comment section    */

add_theme_support('html5', array('comment-list','search-form', 'comment-form', 'gallery'));

function dona_css_and_js() {
    global $redux_demo;
    $redux_demo['opt-radio'];

    //<!-- BOOTSTRAP CSS -->
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css');
    // OWL CAROSEL CSS
    wp_enqueue_style('owl_carousel', get_template_directory_uri() . '/assets/owlcarousel/css/owl.carousel.css');
    wp_enqueue_style('owl_theme', get_template_directory_uri() . '/assets/owlcarousel/css/owl.theme.css');
    //LIGHTBOX CSS
    wp_enqueue_style('lightbox', get_template_directory_uri() . '/assets/css/lightbox.min.css');
    // MAGNIFIC CSS
    wp_enqueue_style('magnific', get_template_directory_uri() . '/assets/css/magnific-popup.css');
    //ANIMATE CSS
    wp_enqueue_style('dona-animate', get_template_directory_uri() . '/assets/css/animate.min.css');
    //MAIN STYLE CSS

    if (!empty($redux_demo['opt-radio'])) {
        wp_enqueue_style('dona-main-style', get_template_directory_uri() . "/assets/css/style ({$redux_demo['opt-radio']}).css");
    } else {
        wp_enqueue_style('dona-main-style', get_template_directory_uri() . "/assets/css/style (1).css");
    }
//RESPONSIVE CSS
    wp_enqueue_style('dona-responsive', get_template_directory_uri() . '/assets/css/responsive.css');

    //MY CUSTOM STYLESHEET

    wp_enqueue_style('dona-custom-stylesheet', get_template_directory_uri() . '/assets/css/my-custom-stylesheet.css');

    //FONT AWESOME CSS
    wp_enqueue_style('dona-linear_fonts', get_template_directory_uri() . '/assets/fonts/linear-fonts.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fonts/font-awesome.css');
    wp_enqueue_style('dona-common', get_template_directory_uri() . '/assets/css/dona-common.css', array('js_composer_front', 'font-awesome'));


    // Script register
    //BOOTSTRAP JS
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array('jquery'), 1, true);

    //PROGRESS JS
    wp_enqueue_script('jquery_appear', get_template_directory_uri() . '/assets/js/jquery.appear.js', array('jquery'), 1, true);
    //OWL CAROUSEL JS

    wp_enqueue_script('owl_carousel', get_template_directory_uri() . '/assets/owlcarousel/js/owl.carousel.min.js', array('jquery'), 1, true);
    //MIXITUP JS
    wp_enqueue_script('jquery_mixitup', get_template_directory_uri() . '/assets/js/jquery.mixitup.js', array('jquery'), 1, true);
    // MAGNIFICANT JS
    wp_enqueue_script('magnific_popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), 1, true);
    // STEALLER JS
    wp_enqueue_script('jquery_stellar', get_template_directory_uri() . '/assets/js/jquery.stellar.min.js', array('jquery'), 1, true);
    // YOUTUBE JS
    wp_enqueue_script('jquery_mb', get_template_directory_uri() . '/assets/js/jquery.mb.YTPlayer.min.js', array('jquery'), 1, true);
    wp_enqueue_script('dona_customscript', get_template_directory_uri() . '/assets/js/customscript.js', array('jquery'), 1, true);
    // COUNTER UP JS
    wp_enqueue_script('jquery_waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array('jquery'), 1, true);
    wp_enqueue_script('jquery_counterup', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array('jquery'), 1, true);
    //LIGHTBOX 

    wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/lightbox.min.js', array('jquery'), 1, true);

    //WOW JS
    wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), 1, true);


    wp_add_inline_script('wow', 'var ajaxurl = "' . admin_url('admin-ajax.php') . '"; ');
    // scripts js
    wp_enqueue_script('dona_scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), 1, true);

    //wp ajax

    wp_enqueue_script('dona_ajax', get_template_directory_uri() . '/assets/js/wp_ajax.js', array('jquery'), 1, true);
}

add_action('wp_enqueue_scripts', 'dona_css_and_js');



//getting the custom files
require_once get_template_directory() . '/inc/functions/custom_style.php';


/* Default Menu */

function dona_statup_default_menu() {
    echo '<ul class="nav navbar-nav navbar-right">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '</ul>';
}

/* Register widgetized area and update sidebar with default widgets */

function dona_default_sidebar() {
    register_sidebar(array(
        'name' => __('Right Sidebar', 'dona'),
        'description' => __('Add your right sidebar widget here', 'dona'),
        'id' => 'right-sidebar',
        'before_widget' => '<div class="recent-post categories single-sidebar">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}

add_action('widgets_init', 'dona_default_sidebar');


add_action('init', 'spirit_post_types');
function spirit_post_types() {
    register_post_type('custom-header-pages', array(
        'public' => true,
        'labels' => array(
            'name' => 'Титул головних сторінок'
        ),
        'menu_icon' => 'dashicons-align-center',
        'taxonomies' => array('our-events-category'),
        'has_archive' => 'our-events',
        'exclude_from_search' => true,
        //'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
    ));


    register_taxonomy( 'category_latest_sermons', [ 'latest-sermons' ], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => [
            'name'              => 'Категорії',
            'singular_name'     => 'Категорія',
            'search_items'      => 'Знайти категорію',
            'all_items'         => 'Всі категорії',
            'view_item '        => 'Переглянути категорію',
            'parent_item'       => 'Parent Sermons',
            'parent_item_colon' => 'Parent Sermons',
            'edit_item'         => 'Редагувати категорію',
            'update_item'       => 'Оновити категорію',
            'add_new_item'      => 'Додати нову категорію',
            'new_item_name'     => 'Нова категорія',
            'menu_name'         => 'Категорії проповідей',
        ],
        'description'           => '', // описание таксономии
        'public'                => true,
        // 'publicly_queryable'    => null, // равен аргументу public
        'show_in_nav_menus'     => true, // равен аргументу public
        // 'show_ui'               => true, // равен аргументу public
        // 'show_in_menu'          => true, // равен аргументу show_ui
        // 'show_tagcloud'         => true, // равен аргументу show_ui
        // 'show_in_quick_edit'    => null, // равен аргументу show_ui
        'hierarchical'          => true,

        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
        'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
        // '_builtin'              => false,
        //'update_count_callback' => '_update_post_term_count',
    ] );

    register_post_type('latest-sermons', array(
        'labels' => array(
            'name' => 'Останні проповіді'
        ),
        'public' => true,
        'menu_icon' => 'dashicons-align-center',
        'taxonomies' => array('latest-sermons-category'),
        'has_archive' => 'latest-sermon',
        'exclude_from_search' => false,
        'supports' => array('title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'),
    ));

}

add_action( 'init', 'create_taxonomy' );
function create_taxonomy(){
    // список параметров: wp-kama.ru/function/get_taxonomy_labels

}

add_action( 'pre_get_posts', 'search_filter' );
function search_filter( $query ){
    if( ! is_admin() && $query->is_main_query() ){
        if( $query->is_search ){
            $query->set('post_type', 'post');
        }
    }
}


//add_action( 'init', 'register_post_types' );
//function register_post_types(){
//    register_post_type('post_type_name', array(
//        'public' => true,
//        'label'  => null,
//        'labels' => array(
//            'name'               => '____', // основное название для типа записи
//            'singular_name'      => '____', // название для одной записи этого типа
//            'add_new'            => 'Добавить ____', // для добавления новой записи
//            'add_new_item'       => 'Добавление ____', // заголовка у вновь создаваемой записи в админ-панели.
//            'edit_item'          => 'Редактирование ____', // для редактирования типа записи
//            'new_item'           => 'Новое ____', // текст новой записи
//            'view_item'          => 'Смотреть ____', // для просмотра записи этого типа.
//            'search_items'       => 'Искать ____', // для поиска по этим типам записи
//            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
//            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
//            'parent_item_colon'  => '', // для родителей (у древовидных типов)
//            'menu_name'          => '____', // название меню
//        ),
//    ) );
//}

/* Remove reply text */
add_filter('comment_form_defaults', 'dona_set_my_comment_title', 20);

function dona_set_my_comment_title($defaults) {
    $defaults['title_reply'] = __('', 'dona');
    return $defaults;
}

/* Remove after reply text */

function dona_change_up($fields) {
    $fields['comment_notes_before'] = '<p class="comment-notes"></p>';
    return $fields;
}

add_filter('comment_form_defaults', 'dona_change_up');

/* Replace Message Field to Bottom */

function dona_move_comment_field_to_bottom($fields) {
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'dona_move_comment_field_to_bottom');

/* Google Fonts */

if (!function_exists('dona_fonts_url')) :

    /**
     * Register Google fonts.
     *
     * @return string Google fonts URL for the theme.
     */
    function dona_fonts_url() {
        $fonts_url = '';
        $fonts = array();
        $subsets = '';

        /* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== esc_html_x('on', 'Montserrat font: on or off', 'dona')) {
            $fonts[] = 'Montserrat';
        }

        /* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
        if ('off' !== esc_html_x('on', 'Lato font: on or off', 'dona')) {
            $fonts[] = 'Lato';
        }

        if ($fonts) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($subsets),
                    ), 'https://fonts.googleapis.com/css');
        }

        return $fonts_url;
    }

endif;

/* Page Link */

$defaults = array(
    'before' => '<p>' . __('Pages:', 'dona'),
    'after' => '</p>',
    'link_before' => '',
    'link_after' => '',
    'next_or_number' => 'number',
    'separator' => ' ',
    'nextpagelink' => __('Next page', 'dona'),
    'previouspagelink' => __('Previous page', 'dona'),
    'pagelink' => '%',
    'echo' => 1
);

wp_link_pages($defaults);

/* Editor Style */

add_action('init', 'dona_add_editor_styles');

function dona_add_editor_styles() {
    add_editor_style(get_stylesheet_uri());
}

/**
 * Enqueue scripts and styles.
 */
function dona_scripts() {

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('dona-fonts', dona_fonts_url(), array(), null);
}

add_action('wp_enqueue_scripts', 'dona_scripts');


/* require items */
require_once get_template_directory() . '/inc/menu/navwalker.php';


/* Comment Walker */
require_once get_template_directory() . '/inc/comments/dona-walker-comment.php';

/* One click demo import */

require_once get_template_directory() . '/inc/functions/one-click-demo-config.php';


