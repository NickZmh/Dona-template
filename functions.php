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
