<?php


add_action('wp_ajax_load_more_ajax', 'load_more_ajax');
add_action('wp_ajax_nopriv_load_more_ajax', 'load_more_ajax');



function load_more_ajax()
{
    // global $totalPostsToShow;
    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['search_term'] = $_POST['search_term']; // we need next page to be loaded
    $args['listing-type'] = $_POST['listing_type'];
    $args['show-posts'] = $_POST['posts_to_show'];
    $args['cat_query'] = $_POST['cat_query'];
    // echo $args['cat_query'];

    $args1 = array();



    // print_r($args);
    // if (!empty($args['search_term'])) {


    if ($args['listing-type'] == 'freelancers') {

        $args1 = array(
            "post_type" => "job_listing",
            "s" => $args['search_term'],
            'posts_per_page' => $args['show-posts'],
            "paged" => $args['paged'],
            'meta_key' => '_case27_listing_type',
            'meta_value' => 'freelancers',
            'meta_compare' => '='

        );
    }



    if ($args['listing-type'] == 'services') {

        $args1 = array(
            "post_type" => "job_listing",
            "s" => $args['search_term'],
            'posts_per_page' => $args['show-posts'],
            "paged" => $args['paged'],
            'meta_key' => '_case27_listing_type',
            'meta_value' => 'services',
            'meta_compare' => '='

        );
    }



    if ($args['listing-type'] == 'all') {
        $args1 = array(
            "post_type" => "job_listing",
            "s" => $args['search_term'],
            'posts_per_page' => $args['show-posts'],
            "paged" => $args['paged'],
        );
    }


    if ($args['listing-type'] == 'blog') {
        $args1 = array(
            "post_type" => "post",
            "s" => $args['search_term'],
            'posts_per_page' => $args['show-posts'],
            "paged" => $args['paged'],
        );
    }

    if ($args['cat_query']) {
        $args1 = array(
            "post_type" => "post",
            'posts_per_page' => $args['show-posts'],
            "paged" => $args['paged'],
            'category_name' => $args['cat_query'],
        );
    }



    $loop = new WP_Query($args1);



    // if ($args['listing-type'] == 'blog') {
    //     // echo '<div class="row">';
    // }
    if ($loop->have_posts()) { ?>



        <?php
        //search results container start
        // echo '<div class="container">';
        while ($loop->have_posts()) {

            // $meta = get_post_meta($currentPostId);
            $loop->the_post();

            //posts info
            $currentPostId = get_the_ID();
            $postLink = get_the_guid();
            $defaultImg = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
            $postImage = get_field('_job_cover', $loop->ID);
            $reviewCount = get_field('_case27_review_count', $currentPostId);
            $averageRating = get_field('_case27_average_rating', $currentPostId) / 2;
            $listingType = get_field('_case27_listing_type', $currentPostId);



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


            $postAlink = get_post_meta($currentPostId, '_affiliate-link');

            // $postAlink = get_post_meta($currentPostId, '_affiliate-link');

            $postAlink = get_post_meta($currentPostId, '_custom-field-8982');





            $postContent = wp_strip_all_tags(get_the_content());

            // $blogPostContent = the_content();
            if ($args['listing-type'] == 'blog') {
                // $postContent = wp_strip_all_tags(get_the_content());
                $sliceContent = mb_strimwidth($postContent, 0, 100, '...');

        ?>



                <div class="col-md-4">
                    <div class="card card-full">
                        <img class="card-img-top" src="<?php if (!empty(get_the_post_thumbnail_url())) {
                                                            the_post_thumbnail_url();
                                                        } else {
                                                            echo $defaultImg;
                                                        } ?>">
                        <div class="card-body flex-column">
                            <a href="<?php echo $postLink; ?>" class="card-title"><?php the_title(); ?></a>
                            <h3 class="card-text"><?php echo $sliceContent; ?></h3>
                            <a class="align-self-start" href="<?php echo $postLink; ?>">Go somewhere <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            <?php } else {



            ?>

                <section class="card-section">
                    <div class="container card-container py-3">
                        <div class="card">

                            <div class="row card-row">





                                <div class="col-md-5 align-items-center middle-card">
                                    <img class="w-100 post-image-card" src="<?php if (!empty($postImage)) {
                                                                                the_field('_job_cover', $loop->ID);
                                                                            } else {
                                                                                echo $defaultImg;
                                                                            } ?>" alt="">
                                </div>

                                <div class="col-md-5 px-3 align-items-center">
                                    <div class="card-block px-3">
                                        <!-- <h4 class="card-title">Lorem ipsum dolor sit amet</h4> -->
                                        <a class="card-title" href="<?php echo $postLink; ?>"> <?php the_title(); ?> </a>


                                        <p class="card-text">
                                            <?php echo mb_strimwidth($postContent, 0, 300, '...');
                                            ?>
                                        </p>
                                        <?php


                                        require(PLUGINS_PATH . 'includes/review-calc.php');
                                        ?>
                                        <span class="p-1">
                                            <?php

                                            if ($reviewCount > 0) {
                                                echo $reviewCount . ' Reviews';
                                            } ?>
                                        </span>

                                        <?php
                                        if ($postAlink[0] != '') {

                                        ?>
                                            <div>
                                                <a href="<?php echo $postAlink[0]; ?>" class="affiliate_link">
                                                    Check Affilate
                                                </a>
                                            </div>

                                        <?php } ?>

                                    </div>


                                    <?php
                                    require(PLUGINS_PATH . 'includes/bookmark-meta.php');

                                    ?>

                                </div>

                                <div class="col-md-2">
                                    <a href="<?php echo $postLink; ?>" class="btn btn-card">Check it out</a>
                                    <a href="#" class="btn mt-3 btn-card">Check it out</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>



        <?php }
        }
        if ($args['listing-type'] == 'blog') {
            echo '</div>';
        } ?>

<?php echo '</div>';


        wp_reset_postdata();

        // Reset Query
        wp_reset_query();
    }
    wp_die();
}
// }
