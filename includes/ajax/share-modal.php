<?php


add_action('wp_ajax_share_modal', 'share_modal');
add_action('wp_ajax_nopriv_share_modal', 'share_modal');


function share_modal()
{
    $share_modal_post_id = $_POST['share_post_id'];

    // echo ($share_modal_post_id);
    $post_query = get_post($share_modal_post_id);

    $posts_id_url = $post_query->guid;
    echo ($posts_id_url);

    wp_die();
}
