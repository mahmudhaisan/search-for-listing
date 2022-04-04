<?php



function bookmarkTable()
{
    global $wpdb;

    $like_count_table = $wpdb->prefix . 'like_count';
    $like_info_table = $wpdb->prefix . 'like_info';


    $like_count = "CREATE TABLE " . $like_count_table . " (
        post_id int(50),
        total_like int(255)
    );";

    $like_info = "CREATE TABLE " . $like_info_table . "(
        user_name varchar(255),
        post_id int(50),
        like_action varchar(10)
    );";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    dbDelta($like_count);
    dbDelta($like_info);
}
