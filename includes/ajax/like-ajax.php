<?php


// Ajax Part
add_action('wp_ajax_my_action', 'my_action');
add_action('wp_ajax_nopriv_my_action', 'my_action');
function my_action()
{
    global $wpdb;
    $post_id = $_POST['post_id'];
    $status = $_POST['status'];
    // global $status;
    $user_id = $_POST['user_id'];
    $like_counts = $_POST['like_total'];



    $like_query = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM `wp_like_info` WHERE user_name = '$user_id' AND post_id = '$post_id'"
    ));

    // echo ($wpdb->num_rows);
    $like_status = $wpdb->num_rows;
    //total like count query

    // print_r($wpdb);

    if (isset($status) && is_user_logged_in()) {
        switch ($status) {

            case 'like':
                $sql = "INSERT INTO `wp_like_info` (`user_name`, `post_id`, `like_action`) VALUES ('$user_id', $post_id, '$status') 
                ON DUPLICATE KEY UPDATE `like_action` = 'like'";
                break;

            case 'unlike':

                $sql = "DELETE FROM `wp_like_info` WHERE  `user_name`= '$user_id' AND `post_id`= '$post_id' ";

                break;
            default:
                break;
        }

        $wpdb->query($sql);

        // print_r($wpdb);

        $results = [];
        $results['like-count'] = like_count($post_id);
        $results['like2'] = 12;

        wp_send_json($results);

        // echo $like_counts . ' total like';
        // return $like_counts;
    }

    wp_die();
}


function like_count($post_id)
{
    global $wpdb;

    $likes_count_query = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM `wp_like_info` WHERE `post_id`= $post_id AND `like_action`= 'like' "
    ));
    return $likes_count_query; //working
}
