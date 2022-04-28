<?php



function bookmarkTable()
{
    global $wpdb;

    $like_info_table = $wpdb->prefix . 'like_info';

    $like_info = "CREATE TABLE " . $like_info_table . "(
        user_name varchar(255),
        post_id int(50),
        like_action varchar(10)
    );";

    $popularSearch = $wpdb->prefix . 'popular_searches';


    $popularSearchDb = "CREATE TABLE " . $popularSearch . " (
        search_term varchar(255),
        search_term_link varchar(255),
        search_results_page varchar(255)
    );";





    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($like_info);
    dbDelta($popularSearchDb);
}
