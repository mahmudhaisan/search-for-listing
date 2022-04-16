<?php

global $wpdb;
//getting current user
$current_user = wp_get_current_user()->user_login;
//getting current post id
$current_post_id = $currentPostId;


// users like query on database

$like_query = $wpdb->get_results($wpdb->prepare(
    "SELECT * FROM `wp_like_info` WHERE user_name = '$current_user' AND post_id = '$current_post_id'"
));

// echo ($wpdb->num_rows);
$like_status = $wpdb->num_rows;
//total like count query

$like_count_query = $wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) FROM `wp_like_info` WHERE post_id = '$current_post_id' AND like_action = 'like' "
));


// print_r($like_count_query);
$total_likes = $like_count_query;


// recieving ajax request




?>

















<div class="content-center">
    <ul class="ul-class">
        <li id="bookmark-click" <?php if ($like_status == 0) : ?> class='fa fa-heart-o like-btn bookmarks-info' <?php else : ?> class='fa fa-heart like-btn bookmarks-info bg-icon-selected' <?php endif ?> data-id='<?php echo $current_post_id; ?>' user_id='<?php echo $current_user; ?>'></li>
        <li id="bookmark-count" data-id="<?php echo ($total_likes); ?>" class="fa like-count bookmarks-info">
            <?php echo ($total_likes); ?>
        </li>
        <li id="review-link" class="">
            <a href="http://localhost:10003/listing/<?php echo $postTitleDash; ?>/#reviews">
                <i class="fa fa-star"></i>
            </a>
        </li>
        <li class="fa fa-share" data-toggle="modal" data-target="#myModal"></li>
    </ul>
</div>






<div class="mt-5">






    <!-- <i class="fa fa-heart-o"></i> -->
    <ul class="social-network social-circle">
        <!-- posts bottom bar -->

        <li id="bookmark-click" <?php if ($like_status == 0) : ?> class='fa fa-heart-o like-btn bookmarks-info' <?php else : ?> class='fa fa-heart like-btn bookmarks-info bg-icon-selected' <?php endif ?> data-id='<?php echo $current_post_id; ?>' user_id='<?php echo $current_user; ?>'>


        </li>


        <li id="bookmark-count" data-id="<?php echo ($total_likes); ?>" class="like-count bookmarks-info">
            <?php echo ($total_likes); ?>
        </li>

        <li id="bookmark-review" class="bookmarks-info">
            <a href="http://localhost:10003/listing/<?php echo $postTitleDash; ?>/#reviews">
                <i class="fa fa-star"></i>
            </a>
        </li>

        <li id="bookmark-share" class="bookmarks-info">
            <a href="" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-share"></i>
            </a>
        </li>


    </ul>


</div>




<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h5>Do you like this? Share with your friends!</h5>
                <div class="mt-5">
                    <ul class="share_links">
                        <li class="bg_fb">
                            <a href="#" class="share_icon" rel="tooltip" title="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li class="bg_insta"><a href="#" class="share_icon" rel="tooltip" title="Instagram"><i class=" fa fa-instagram"></i></a></li>

                        <li class="bg_whatsapp"><a href="#" class="share_icon" rel="tooltip" title="Whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                        <li class="bg_whatsapp"><a href="#" onclick="myFunction()" class="share_icon" rel="tooltip" title="Whatsapp"><i class="fa fa-clone" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>



            <!-- The text field -->
            <input style="display:none" type="text" value="bd" id="myInput">

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>



        </div>
    </div>
</div>