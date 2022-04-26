<?php

/**
 * Plugin Name: Search
 * Plugin URI: http://mahmudhaisan.com/
 * Description: Search
 * Version: 1.2.0
 * Author: Mahmud haisan
 * Author URI: http://mahmudhaisan.com/
 * Developer: Mahmud Haisan
 * Developer URI: http://mahmudhaisan.com/
 * Text Domain: Search493
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


if (!defined('ABSPATH')) {
    die;
}



// search fumctionality
function searchForm493($atts)
{


    global $wp_query;
    //get search values
    // echo $wp_query->query_vars['search'];


    $_GET['search'] = preg_replace('/[^\da-z ]/i', '', strtolower($_GET['search'])); // adding, modifying value
    // unset($_GET['se']); // removing value

    $searchTerm = normalize_whitespace(strtolower($_GET['search']));

    $shortcodeArray = shortcode_atts(array(
        'redirect' => 'search-posts'

    ), $atts);

    // print_r($shortcodeArray);

    // echo $searchTerm;
    ob_start();

?>







    <div class="s130 col-sm-12">
        <form action="/<?php echo $shortcodeArray['redirect']; ?>" method="get">
            <div class="inner-form">
                <div class="input-field first-wrap">
                    <div class="svg-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </div>
                    <input autocomplete="off" type="text" class="form-control" placeholder="Search freelancers or jobs" name="search" id="" value="<?php echo $searchTerm; ?>">
                </div>
                <div class="input-field second-wrap">
                    <button type="submit" class="btn-search">Search</button>
                </div>
            </div>

        </form>
    </div>


    <?php


    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}


//add short code for search functionality
add_shortcode('searchForm493', 'searchForm493');











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
                                            } ?>
                                            <span class="p-1">
                                                <?php

                                                if ($reviewCount > 0) {
                                                    echo $reviewCount . ' Reviews';
                                                } ?>
                                            </span>
                                        </div>


                                        <?php
                                        require(plugin_dir_path(__FILE__) . 'includes/bookmark-meta.php');

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















function popularSearchResults()
{
    global $wpdb;
    // global $wp_query;
    //get search values
    // echo $wp_query->query_vars['search'];

    $searchTerm = normalize_whitespace(strtolower($_GET['search']));
    $searchTermPlus = str_replace(' ', '+', preg_replace('/[^\da-z ]/i', '', strtolower($_GET['search'])));
    $searchLink = get_the_permalink() . '?search=' . $searchTermPlus;
    // echo $searchLink;

    //select data from db by searchTerm
    $checkDuplicates = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM `wp_popular_searches` WHERE search_term = '$searchTerm'"
    ));

    $totalNumber = 0;

    ob_start();

    foreach ($checkDuplicates as $a) {
        //getting total array key
        $totalNumber++;
    }

    // echo $totalNumber;
    //check empty search value
    if ($searchTerm != '') {
        if ($totalNumber == 0) {

            if (isset($searchTerm)) {

                $sql = "INSERT INTO `wp_popular_searches` (`search_term`, `search_term_link`) VALUES ('$searchTerm', '$searchLink') ";
                $wpdb->query($sql);
            }
        }
    }

    //get all words from searchTerm string

    $explodeSearchText = explode(' ', $searchTerm);
    // print_r($explodeSearchText);


    echo '<div class="container">';
    $arrayUnique = array();
    foreach ($explodeSearchText as $explodeSearchArray) {


        $splitWordsDbSearch = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM `wp_popular_searches` WHERE search_term LIKE '%$explodeSearchArray%'"
        ));


        // print_r($splitWordsDbSearch);
        // echo '</pre>';


        foreach ($splitWordsDbSearch as $b) {

            if (!in_array($b->search_term, $arrayUnique)) {
                array_push($arrayUnique, $b->search_term);
            }
        }
    }


    foreach ($arrayUnique as $singleSearchItem) {

        $singleSearchItemLink = get_the_permalink() . '?search=' . normalize_whitespace(str_replace(' ', '+', $singleSearchItem));
        if ($singleSearchItem != $searchTerm) {

        ?>

            <a class="btn btn-dark text-white mt-3" href="<?php echo $singleSearchItemLink; ?>"><?php echo $singleSearchItem; ?></a>

        <?php }
    }
    echo '</div>';

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}


// results page shortcode
add_shortcode('popular-search-results', 'popularSearchResults');




//enqueue files
function search493_enqueue()
{
    $enq = plugin_dir_url(__FILE__) . 'assets/';
    global $new_query;



    $search = $_GET['search'];

    // style
    wp_enqueue_style('bootstrap', $enq . 'css/bootstrap.min.css');
    wp_enqueue_style('fontawesome', $enq . 'css/font-awesome.min.css');
    wp_enqueue_style('style', $enq . 'css/style.css');
    wp_enqueue_style('gotham', $enq . 'fonts/GothamLight.ttf');

    //scripts
    wp_enqueue_script('bootstrap', $enq . 'js/bootstrap.min.js', array(), false, true);
    wp_enqueue_script('script_jquery', $enq . 'js/script.js', array('jquery'), false, true);
    wp_localize_script(
        'script_jquery',
        'bookmark_ajax_script',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'aajaxurl' => admin_url('admin-ajax.php'),
            'posts_vars' => json_encode($new_query->query_vars),
            'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
            'max_pages' => $new_query->max_num_pages,
            'search_term' => $search

        )
    );
}

add_action('wp_enqueue_scripts', 'search493_enqueue');









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


    $args1 = array();

    if ($args['listing-type'] == 'freelancers' || $args['listing-type'] == 'services') {

        $args1 = array(
            "post_type" => "job_listing",
            "s" => $args['search_term'],
            'posts_per_page' => $args['show-posts'],
            "paged" => $args['paged'],
            'meta_key' => '_case27_listing_type',
            'meta_value' => $args['listing_type'],
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


            $postContent = get_the_content();

            // $blogPostContent = the_content();
            if ($args['listing-type'] == 'blog') {


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

            <?php } else { ?>


                <div class="col-md-5 align-items-center">
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
                        } ?>
                        <span class="p-1">
                            <?php

                            if ($reviewCount > 0) {
                                echo $reviewCount . ' Reviews';
                            } ?>
                        </span>
                    </div>


                    <?php
                    require(plugin_dir_path(__FILE__) . 'includes/bookmark-meta.php');

                    ?>

                </div>

                <div class="col-md-2">
                    <a href="<?php echo $postLink; ?>" class="btn btn-card">Check it out</a>
                    <a href="#" class="btn mt-3 btn-card">Check it out</a>

                </div>



        <?php }
        }
        if ($args['listing-type'] == 'blog') {
            echo '</div>';
        } ?>
        </div>
        </div>
        </div>
        </section>
<?php echo '</div>';


        wp_reset_postdata();

        // Reset Query
        wp_reset_query();
    }
    wp_die();
}



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






// require(plugin_dir_path(__FILE__) . 'includes/enqueuefiles.php');
require(plugin_dir_path(__FILE__) . 'includes/my-account-bookmark.php');
require_once(plugin_dir_path(__FILE__) . 'includes/dbtables.php');

register_activation_hook(__FILE__, 'bookmarkTable');
