<?php


//search page functionality
function searchResult493($atts)
{

    ob_start();
    global $totalPostsToShow;

    $shortcodeArray = shortcode_atts(array(
        'result_page' => 'main',
        'posts_per_page' => 5,
        'listing_type' => 'all',
        'category_name' => 'all'

    ), $atts);



    $totalPostsToShow = $shortcodeArray['posts_per_page'];
    $listingTypes = $shortcodeArray['listing_type'];


    //check if search term in search bar and not empty

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;


        if ($shortcodeArray['listing_type'] == 'freelancers' || $shortcodeArray['listing_type'] == 'services') {

            $args = array(
                "post_type" => "job_listing",
                "s" => $search,
                'posts_per_page' => $totalPostsToShow,
                "paged" => $paged,
                'meta_key' => '_case27_listing_type',
                'meta_value' => $shortcodeArray['listing_type'],
                'meta_compare' => '='

            );
        }


        if ($shortcodeArray['listing_type'] == 'all') {
            $args = array(
                "post_type" => "job_listing",
                "s" => $search,
                'posts_per_page' => $totalPostsToShow,
                "paged" => $paged,
            );
        }

        if ($shortcodeArray['listing_type'] == 'blog') {
            $args = array(
                "post_type" => "post",
                "s" => $search,
                'posts_per_page' => $totalPostsToShow,
                "paged" => $paged,
            );
        }








        $new_query = new WP_Query($args);


        var_dump($new_query);
        $currentPostId = $new_query->ID;


        if ($new_query->have_posts()) {
            //search results container start
            echo '<div class="ajax_loaded_posts row">';
            // echo '<div class="container">';
            while ($new_query->have_posts()) {
                $meta = get_post_meta($currentPostId);
                $new_query->the_post();

                //posts info
                $currentPostId = get_the_ID();
                $postLink = get_the_guid();
                $defaultImg = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
                $postImage = get_field('_job_cover', $new_query->ID);

                $reviewCount = get_field('_case27_review_count', $currentPostId);
                $averageRating = get_field('_case27_average_rating', $currentPostId) / 2;
                $listingType = get_field('_case27_listing_type', $currentPostId);


                // $postAlink = get_post_meta($currentPostId, '_affiliate-link');

                $postAlink = get_post_meta($currentPostId, '_custom-field-8982');
                $postContent = wp_strip_all_tags(get_the_content());
                $sliceContent = mb_strimwidth($postContent, 0, 100, '...');


                // $blogPostContent = the_content();
                if ($shortcodeArray['listing_type'] == 'blog') {











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
                                    <div class="col-md-5 align-items-center">
                                        <img class="w-100 post-image-card" src="<?php if (!empty($postImage)) {
                                                                                    the_field('_job_cover', $new_query->ID);
                                                                                } else {
                                                                                    echo $defaultImg;
                                                                                } ?>" alt="">
                                    </div>

                                    <div class="col-md-5 px-3 align-items-center  middle-card">
                                        <div class="card-block px-3">
                                            <!-- <h4 class="card-title">Lorem ipsum dolor sit amet</h4> -->
                                            <a class="card-title" href="<?php echo get_permalink($currentPostId); ?>"> <?php the_title(); ?> </a>


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
                                        <a href="<?php echo get_permalink($currentPostId); ?>" class="btn btn-card">Check it out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>




            <?php }
            }

            echo '</div>';
        }



        if ($new_query->max_num_pages > 1) { ?>
            <div class="posts_loadmore" show-posts="<?php echo $totalPostsToShow; ?>" data-id="<?php echo $shortcodeArray['listing_type']; ?>">More posts</div>
            <div class="no-posts"></div>

            <?php  }

        // echo '</div>';

        wp_reset_postdata();
    }










    if ($_GET['search'] == '') {
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;


        if ($shortcodeArray['listing_type'] == 'freelancers' || $shortcodeArray['listing_type'] == 'services') {

            $args = array(
                "post_type" => "job_listing",
                'posts_per_page' => $totalPostsToShow,
                "paged" => $paged,
                'meta_key' => '_case27_listing_type',
                'meta_value' => $shortcodeArray['listing_type'],
                'meta_compare' => '='

            );
        }


        if ($shortcodeArray['listing_type'] == 'all') {
            $args = array(
                "post_type" => "job_listing",
                'posts_per_page' => $totalPostsToShow,
                "paged" => $paged,
            );
        }

        if ($shortcodeArray['listing_type'] == 'blog') {
            $args = array(
                "post_type" => "post",
                'posts_per_page' => $totalPostsToShow,
                "paged" => $paged,
            );
        }


        $get_cat_query_var =  $_GET['category'];



        if ($get_cat_query_var) {
            $args = array(
                "post_type" => "post",
                'posts_per_page' => $totalPostsToShow,
                "paged" => $paged,
                'category_name' => $get_cat_query_var,
            );
        }


        $new_query = new WP_Query($args);

        $currentPostId = $new_query->ID;


        if ($new_query->have_posts()) {

            //search results container start
            echo '<div class="ajax_loaded_posts row">';
            // echo '<div class="container">';
            while ($new_query->have_posts()) {

                $meta = get_post_meta($currentPostId);
                $new_query->the_post();

                //posts info
                $currentPostId = get_the_ID();
                $postLink = get_the_guid();
                $defaultImg = 'https://media.sproutsocial.com/uploads/2017/02/10x-featured-social-media-image-size.png';
                $postImage = get_field('_job_cover', $new_query->ID);
                $reviewCount = get_field('_case27_review_count', $currentPostId);
                $averageRating = get_field('_case27_average_rating', $currentPostId) / 2;
                $listingType = get_field('_case27_listing_type', $currentPostId);

                $postContent = wp_strip_all_tags(get_the_content());


                // $postAlink = get_post_meta($currentPostId, '_affiliate-link');

                $postAlink = get_post_meta($currentPostId, '_custom-field-8982');

                $sliceContent = mb_strimwidth($postContent, 0, 100, '...');
                // $blogPostContent = the_content();
                if ($shortcodeArray['listing_type'] == 'blog') {
                    // print_r($sliceContent);




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
                                    <div class="col-md-5 align-items-center">
                                        <img class="w-100 post-image-card" src="<?php if (!empty($postImage)) {
                                                                                    the_field('_job_cover', $new_query->ID);
                                                                                } else {
                                                                                    echo $defaultImg;
                                                                                } ?>" alt="">
                                    </div>

                                    <div class="col-md-5 px-3 align-items-center  middle-card">
                                        <div class="card-block px-3">
                                            <!-- <h4 class="card-title">Lorem ipsum dolor sit amet</h4> -->
                                            <a class="card-title" href="<?php echo get_permalink($currentPostId); ?>"> <?php the_title(); ?> </a>


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
                                        <a href="<?php echo get_permalink($currentPostId); ?>" class="btn btn-card">Check it out</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>




            <?php }
            }

            echo '</div>';
        }



        if ($new_query->max_num_pages > 1) { ?>
            <div class="posts_loadmore" cat-vars="<?php echo $get_cat_query_var ?>" show-posts="<?php echo $totalPostsToShow; ?>" data-id="<?php echo $shortcodeArray['listing_type']; ?>">More posts</div>
            <div class="no-posts"></div>

<?php  }

        // echo '</div>';

        wp_reset_postdata();
    }







































































    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

// results page shortcode
add_shortcode('search-results-page', 'searchResult493');
