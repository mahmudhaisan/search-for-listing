<?php

        // posts query
        $query = get_posts($args);



        if ($query == array()) {
            echo 'No result found';
        }
        echo '<div class="container">';
        foreach ($query as $q) {

            if (has_post_thumbnail()) {
                the_post_thumbnail();
            }
            // var_dump($q);


            $postTitle = $q->post_title;
            $postTitleDash = strtolower(str_replace(' ', '-', $postTitle));
            // echo $postTitleDash;

            //get image array
            $imgArray = get_post_meta($q->ID, '_job_cover', true);
            $meta = get_post_meta($q->ID);
            $link = get_permalink($q->ID);

            // post Images
            $defaultImg = 'https://cdn.searchenginejournal.com/wp-content/uploads/2019/08/c573bf41-6a7c-4927-845c-4ca0260aad6b-1520x800.jpeg';
            $postImg = $imgArray[0];

            //post ratings and reviews
            $reviewCount = $meta['_case27_review_count'][0];
            echo $reviewCount;
            $averageRating = $meta['_case27_average_rating'][0] / 2;
            echo $averageRating;
            // echo $averageRating;

            ?>
            <div class="col-sm-12 post-row">
                <div class="bs-calltoaction bs-calltoaction-default">
                    <div class="row">
                        <div class="col-md-5 cta-contents">
                            <!-- show post image -->
                            <img class="wh" src="<?php if (!empty($postImg)) {
                                                        echo $postImg;
                                                    } else {
                                                        echo $defaultImg;
                                                    } ?>" alt="">
                        </div>

                        <div class="col-md-5 cta-contents">
                            <h1 class="cta-title">
                                <!-- post title -->
                                <a href="<?php echo $link; ?>"> <?php echo $q->post_title; ?> </a>
                            </h1>
                            <div class="cta-desc">
                                <!-- post content -->
                                <p><?php echo $q->post_content; ?></p>
                                <br>
                            </div>

                            <div class="cta-desc">
                                <div>
                                    <?php


                                    // show available star ratings
                                    if ($averageRating == 1 && $averageRating <= 1.20) {
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                    }

                                    if ($averageRating > 1.20 && $averageRating < 1.75) {
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fas fa-star-half-alt checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                    }
                                    if ($averageRating >= 1.75 && $averageRating <= 2.20) {
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                    }
                                    if ($averageRating > 2.20 && $averageRating < 2.75) {
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fas fa-star-half-alt checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                    }
                                    if ($averageRating >= 2.75 && $averageRating <= 3.20) {
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                    }
                                    if ($averageRating > 3.20 && $averageRating < 3.75) {
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fas fa-star-half-alt checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                    } elseif ($averageRating >= 3.75 && $averageRating <= 4.20) {
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star not-checked"></span>';
                                    }
                                    if ($averageRating > 4.20 && $averageRating < 4.75) {
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fas fa-star-half-alt checked"></span>';
                                    }
                                    if ($averageRating >= 4.75 && $averageRating <= 5) {
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                        echo '<span class="fa fa-star checked"></span>';
                                    }

                                    // if ($reviewCount == 0) {
                                    //     echo '<span class="fa fa-star not-checked"></span>';
                                    //     echo '<span class="fa fa-star not-checked"></span>';
                                    //     echo '<span class="fa fa-star not-checked"></span>';
                                    //     echo '<span class="fa fa-star not-checked"></span>';
                                    //     echo '<span class="fa fa-star not-checked"></span>';
                                    // }

                                    ?>
                                    <span class="p-1">
                                        <?php

                                        if ($reviewCount > 0) {
                                            echo $reviewCount . ' Reviews found';
                                        }
                                        // } else {
                                        //     echo 'Not Rated Yet';
                                        // }

                                        ?>
                                    </span>
                                </div>

                                <?php

                                global $wpdb;
                                //getting current user
                                $current_user = wp_get_current_user()->user_login;
                                //getting current post id
                                $current_post_id = $q->ID;


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

                                <div class="mt-5">
                                    <!-- <i class="fa fa-heart-o"></i> -->
                                    <ul class="social-network social-circle">
                                        <!-- posts bottom bar -->

                                        <li <?php if ($like_status == 0) : ?> class='fa fa-heart-o like-btn bookmark-info' <?php else : ?> class='fa fa-heart like-btn bookmark-info bg-icon-selected' <?php endif ?> data-id='<?php echo $current_post_id; ?>' user_id='<?php echo $current_user; ?>'>
                                        </li>


                                        <li id="bookmark-count" data-id="<?php echo ($total_likes); ?>" class="like-count bookmark-info">
                                            <?php echo ($total_likes); ?>
                                        </li>

                                        <li><a href="http://localhost:10003/listing/<?php echo $postTitleDash; ?>/#reviews" class="icoRss"><i class="fa fa-star"></i></a></li>

                                        <li><button type="button" class="bookmark-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-share"></i></button> </li>


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
                            </div>
                        </div>

                        <div class="col-md-2 cta-button">
                            <!-- check this functionality -->
                            <a href="#" class="btn btn-lg btn-block btn-primary">Check This</a>
                        </div>
                    </div>
                </div>
  