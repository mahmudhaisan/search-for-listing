<?php


//enqueue files
function search493_enqueue()
{
    // global PLUGINS_PATH_ASSETS;
    global $new_query;
    global $get_cat_query_var;



    $search = $_GET['search'];

    // style
    wp_enqueue_style('bootstrap', PLUGINS_PATH_ASSETS . 'css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', PLUGINS_PATH_ASSETS . 'css/font-awesome.min.css');
    wp_enqueue_style('style', PLUGINS_PATH_ASSETS . 'css/style.css');
    wp_enqueue_style('gotham', PLUGINS_PATH_ASSETS . 'fonts/GothamLight.ttf');

    //scripts
    wp_enqueue_script('bootstrap', PLUGINS_PATH_ASSETS . 'js/bootstrap.min.js', array(), false, true);
    wp_enqueue_script('script_jquery', PLUGINS_PATH_ASSETS . 'js/script.js', array('jquery'), false, true);
    wp_localize_script(
        'script_jquery',
        'bookmark_ajax_script',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'aajaxurl' => admin_url('admin-ajax.php'),
            'posts_vars' => json_encode($new_query->query_vars),
            'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
            'max_pages' => $new_query->max_num_pages,
            'search_term' => $search,
            'site_url' => site_url(),
            'get_cat_query_var' => $get_cat_query_var
        )
    );
}
add_action('wp_enqueue_scripts', 'search493_enqueue');
