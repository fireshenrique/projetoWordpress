<?php

/* Disable WordPress Admin Bar for all users but admins. */

show_admin_bar(false);
flush_rewrite_rules( false );

add_action( 'after_setup_theme', 'register_theme_menu' );
function register_theme_menu() {
    register_nav_menus(array(
        'Top'   => __('Top primary menu', 'theme_luapp'),
        'Footer' => __('Footer menu', 'theme_luapp'),
    ));
}

if (function_exists('acf_add_options_sub_page')) {
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page();
    }
    acf_add_options_sub_page('Tema');
    acf_add_options_sub_page('Wordpress Options');
    acf_add_options_sub_page('Settings');
}

if (!function_exists('setup')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on unius, use a find and replace
         * to change 'unius' to the name of your theme in all the template files.
         */
        load_theme_textdomain('unius', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'primary' => esc_html__('Primary Menu', 'unius'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
            )
        );

    }
}
add_action( 'after_setup_theme', 'setup' );

/*
 * Pagination
 */
function wp_pagination($pages = '', $range = 9) {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
        'base'       => @add_query_arg('page','%#%'),
        'format'     => '',
        'total'      => $wp_query->max_num_pages,
        'current'    => $current,
        'show_all'   => false,
        'prev_text'  => __('<'),
        'next_text'  => __('>'),
        'type'       => 'plain'
    );
    $currentURL = get_pagenum_link(1,true);
    $explodedLink = explode('/?', $currentURL);
    $singleLink = $explodedLink[0];
    $params = @explode('/', $explodedLink[1]);
    if ($wp_rewrite->using_permalinks()) {
        $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', $singleLink)) . 'page/%#%/', 'paged');
    }
    if (!empty($wp_query->query_vars['s'])) $pagination['add_args'] = array('s' => get_query_var('s'));
    echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 wp_pagination"><div class="container-pag">'.paginate_links($pagination).'</div></div>';
}

/*
 * Per Page dos projetos
 */
function pagination_query ($query) {
    if ($query->is_main_query() && is_category()) {

        $query->set('posts_per_page', 2);
    }
    return $query;
}
add_action('pre_get_posts', 'pagination_query' );

//TRANSFORMANDO POST EM News

function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add Post';
    $submenu['edit.php'][16][0] = 'News Tags';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'News';
    $labels->singular_name = 'New';
    $labels->add_new = 'Add Post';
    $labels->add_new_item = 'Add Post';
    $labels->edit_item = 'Edit Post';
    $labels->new_item = 'Post';
    $labels->view_item = 'View Post';
    $labels->search_items = 'Search Posts';
    $labels->not_found = 'No Post found';
    $labels->not_found_in_trash = 'No Posts found in Trash';
    $labels->all_items = 'All Posts';
    $labels->menu_name = 'News';
    $labels->name_admin_bar = 'News';

}

add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );

// ADD CATEGORIA AO CPT SOLUÇÕES

function create_taxonomy_solucao_category() {
    register_taxonomy( 'solucao_category', array( 'servicos' ), array(
        'hierarchical' => true,
        'label' => __( 'Categoria de Solução' ),
        'show_ui' => true,
        'show_in_tag_cloud' => true,
        'query_var' => true,
        'rewrite' => true,
        )
    );
}



// CPT SOLUÇÕES COM ARRAY DE SERVIÇOS


function custom_post_type_servicos() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Soluções', 'Post Type General Name', 'theme_unius' ),
        'singular_name'       => _x( 'Solução', 'Post Type Singular Name', 'theme_unius' ),
        'menu_name'           => __( 'Soluções', 'theme_unius' ),
        'all_items'           => __( 'Todas soluções', 'theme_unius' ),
        'view_item'           => __( 'Ver solução', 'theme_unius' ),
        'add_new_item'        => __( 'Adicionar novo solução', 'theme_unius' ),
        'add_new'             => __( 'Adicionar novo', 'theme_unius' ),
        'edit_item'           => __( 'Editar soluções', 'theme_unius' ),
        'update_item'         => __( 'Atualizar soluções', 'theme_unius' ),
        'search_items'        => __( 'Procurar soluções', 'theme_unius' ),
        'not_found'           => __( 'Não encontrado', 'theme_unius' ),
        'not_found_in_trash'  => __( 'Não encontrado na lixeira', 'theme_unius' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'servicos', 'theme_unius' ),
        'description'         => __( 'servicos', 'theme_unius' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title','thumbnail',  'editor'),
        // You can associate this CPT with a taxonomy or custom taxonomy.

        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',



    );

    // Registering your Custom Post Type
    register_post_type( 'servicos', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type_servicos', 0 );


// CPT CLIENTES

function custom_post_type_clientes() {

// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Clientes', 'Post Type General Name', 'theme_unius' ),
        'singular_name'       => _x( 'Cliente', 'Post Type Singular Name', 'theme_unius' ),
        'menu_name'           => __( 'Clientes', 'theme_unius' ),
        'all_items'           => __( 'Todos clientes', 'theme_unius' ),
        'view_item'           => __( 'Ver cliente', 'theme_unius' ),
        'add_new_item'        => __( 'Adicionar novo cliente', 'theme_unius' ),
        'add_new'             => __( 'Adicionar novo', 'theme_unius' ),
        'edit_item'           => __( 'Editar clientes', 'theme_unius' ),
        'update_item'         => __( 'Atualizar clientes', 'theme_unius' ),
        'search_items'        => __( 'Procurar clientes', 'theme_unius' ),
        'not_found'           => __( 'Não encontrado', 'theme_unius' ),
        'not_found_in_trash'  => __( 'Não encontrado na lixeira', 'theme_unius' ),
    );

// Set other options for Custom Post Type

    $args = array(
        'label'               => __( 'clientes', 'theme_unius' ),
        'description'         => __( 'clientes', 'theme_unius' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title','thumbnail',  'editor'),
        // You can associate this CPT with a taxonomy or custom taxonomy.

        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',



    );

    // Registering your Custom Post Type
    register_post_type( 'clientes', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type_clientes', 0 );

add_action( 'init', 'create_taxonomy_solucao_category' );
