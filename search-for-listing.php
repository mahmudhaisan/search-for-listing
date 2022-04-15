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
function search15()
{

    $selectValue = $_GET['select-listing-type'];
    echo $selectValue;

    ob_start();

?>



    <div class="s130">
        <form action="/search-posts" method="get">
            <div class="inner-form">
                <div class="input-field first-wrap">
                    <div class="svg-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                        </svg>
                    </div>
                    <input type="text" class="form-control" placeholder="Search freelancers or jobs" name="search" id="" value="<?php echo $_GET['search']; ?>">
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
add_shortcode('search', 'search15');

















//search page functionality
function searchResult()
{

    ob_start();
    //check if search term in search bar and not empty
    if (isset($_GET['search']) && !empty($_GET['search'])) {

        // $selectValue = $_GET['select-listing-type'];

        $search = $_GET['search'];
        // $paged = get_query_var('paged');
        // $selectTypes = $_GET["post-type-select"];


        $paged = get_query_var('paged') ? get_query_var('paged') : 1;



        $args = array(
            "post_type" => "job_listing",
            "s" => $search,
            'posts_per_page' => 1,
            "paged" => $paged
            // 'meta_key' => '_case27_listing_type',
            // 'meta_value' => $selectValue,
            // 'meta_compare' => '='

        );

        $new_query = new WP_Query($args);
        // global $new_query;

        $currentPostId = $new_query->ID;




        // normal pagination 
        $big = 999999999; // need an unlikely integer
        echo paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $new_query->max_num_pages,

        ));





        if ($new_query->have_posts()) {


            //search results container start
            echo '<div class="container">';
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





    ?>

                <div class="col-sm-12 post-row">
                    <div class="">
                        <div class="row">
                            <div class="col-md-5">
                                <!-- show post image -->
                                <img class="wh" src="<?php if (!empty($postImage)) {
                                                            the_field('_job_cover', $new_query->ID);
                                                        } else {
                                                            echo $defaultImg;
                                                        } ?>" alt="">
                            </div>

                            <div class="col-md-5">
                                <h1 class="cta-title">
                                    <!-- post title -->
                                    <a href="<?php echo $postLink; ?>"> <?php the_title(); ?> </a>
                                </h1>
                                <div class="">
                                    <!-- post content -->
                                    <p><?php the_content(); ?></p>
                                    <br>
                                </div>

                                <div class="">
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


                                        ?>
                                        <span class="p-1">
                                            <?php

                                            if ($reviewCount > 0) {
                                                echo $reviewCount . ' Reviews';
                                            } ?>
                                        </span>
                                    </div>

                                    <?php
                                    include(plugin_dir_path(__FILE__) . 'includes/bookmark-meta.php');
                                    echo $listingType;
                                    ?>

                                </div>
                            </div>

                            <div class="col-md-2 cta-button">
                                <!-- check this functionality -->
                                <a href="#" id="test" class="btn btn-lg btn-block btn-primary">Check This</a>

                            </div>
                        </div>
                    </div>
                </div>

<?php }

            echo '</div>';
            if ($new_query->max_num_pages > 1) {
                echo '<div class="posts_loadmore">More posts</div>';
            }
        }





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
add_shortcode('results', 'searchResult');






























// working but dont know how

// function my_pagination_rewrite()
// {
//     $search = $_GET['search'];
//     $paged = (isset($my_query_array['paged']) && !empty($my_query_array['paged'])) ? $my_query_array['paged'] : 1;
//     add_rewrite_rule('search/page/?([0-9]{1,})/?$', "index.php?post_type=job_listing&paged=$paged&search=$search", 'top');
// }
// add_action('init', 'my_pagination_rewrite');
















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

    //scripts
    wp_enqueue_script('bootstrap', $enq . 'js/bootstrap.min.js', array(), false, true);
    wp_enqueue_script('script_jquery', $enq . 'js/script.js', array('jquery'), false, true);
    wp_localize_script(
        'script_jquery',
        'bookmark_ajax_script',
        array(
            'ajaxurl' => admin_url('admin-ajax.php'),
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

    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['search_term'] = $_POST['search_term']; // we need next page to be loaded




    // it is always better to use WP_Query but not here
    // $posts_qry = new WP_Query($args);

    $args1 = array(
        'post_type' => 'job_listing',
        's' => $args['search_term'],
        'posts_per_page' => 1,
        'paged'    => $args['paged'],
    );

    $loop = new WP_Query($args1);

    $out = '';

    if ($loop->have_posts()) :  while ($loop->have_posts()) : $loop->the_post();
            $out .= '<div class="small-12 large-4 columns">
                <h1>' . get_the_title() . '</h1>
                <p>' . get_the_content() . '</p>
         </div>';

        endwhile;
    endif;
    wp_reset_postdata();

    die($out);



    // Reset Query
    wp_reset_query();





    wp_die();
}






// require(plugin_dir_path(__FILE__) . 'includes/enqueuefiles.php');
require(plugin_dir_path(__FILE__) . 'includes/my-account-bookmark.php');
require_once(plugin_dir_path(__FILE__) . 'includes/dbtables.php');

register_activation_hook(__FILE__, 'bookmarkTable');
