<?php

global $wpdb;
//getting current user
$current_user = wp_get_current_user()->user_login;
//getting current post id
$current_post_id = $q->ID;

echo $current_post_id;



// users like query on database

$like_query = $wpdb->get_results($wpdb->prepare(
    "SELECT like_action FROM `wp_like_info` WHERE user_name = '$current_user' AND post_id = '$current_post_id'"
));
$like_status = $like_query[0]->like_action;
//total like count query

$like_count_query = $wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) FROM `wp_like_info` WHERE post_id = '$current_post_id' AND like_action = 'like' "
));


// print_r($like_count_query);
$total_likes = $like_count_query;



?>

<div class="mt-5">
    <ul class="social-network social-circle">
        <!-- posts bottom bar -->
        <li>
            <i <?php if ($like_status == 'like') : ?> class='fa fa-thumbs-up like-btn' <?php else : ?> class='fa fa-thumbs-o-up like-btn' <?php endif ?> data-id='<?php echo $current_post_id; ?>'> </i>
        </li>

        <li><a href='' id="bookmark-count" name='boc' class=" fa">

                <?php
                if ($total_likes > 0) {

                    echo ($total_likes);
                } else {
                    echo 0;
                }
                ?>

            </a>
        </li>
        <li><a href="http://localhost:10003/listing/<?php echo $postTitleDash; ?>/#reviews" class="icoRss"><i class="fa fa-star"></i></a></li>
        <li><a href="#" class="icoRss"><i class="fa fa-share"></i></a></li>
    </ul>
</div>