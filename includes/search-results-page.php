<?php


//search page functionality
function searchResult493($atts)
{

    ob_start();
    global $totalPostsToShow;

    $shortcodeArray = shortcode_atts(array(
        'result_page' => 'main',
        'posts_per_page' => 5,
        'listing_type' => 'all'

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
        $currentPostId = $new_query->ID;
        if ($shortcodeArray['listing_type'] == 'blog') {
            // echo '<div class="row">';
        }

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

                $postContent = get_the_content();

                // $blogPostContent = the_content();
                if ($shortcodeArray['listing_type'] == 'blog') {


?>


                    <div class="col-md-4">
                        <div class="card">
                            <img class="card-img-top" src="<?php the_post_thumbnail_url(); ?>">
                            <div class=" card-body">
                                <a href="<?php echo $postLink; ?>" class="card-title"><?php the_title(); ?></a>
                                <p class="card-text"><?php echo mb_strimwidth($postContent, 0, 300, '...'); ?></p>
                                <a href="<?php echo $postLink; ?>" class="">Go somewhere </a>
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

            echo '</div>';
        }






        if ($new_query->max_num_pages > 1) { ?>

            </div>
            <div class="posts_loadmore" show-posts="<?php echo $totalPostsToShow; ?>" data-id="<?php echo $shortcodeArray['listing_type']; ?>">More posts</div>
            <div class="no-posts"></div>

<?php  }

        // echo '</div>';

        wp_reset_postdata();
    }

    if ($_GET['search'] == '') {
        echo 'please search by a keyword';
    }

    echo '</div>';

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

// results page shortcode
add_shortcode('search-results-page', 'searchResult493');