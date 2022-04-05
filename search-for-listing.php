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



?>
    <section class="search-sec">
        <div class="container">
            <form action="/search" method="get">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <input type="text" class="form-control" placeholder="Search" name="search" id="" value="<?php echo $_GET['search']; ?>">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <!-- options for search -->
                                <select class="form-control search-slt" id="exampleFormControlSelect1">
                                    <option>Select Vehicle</option>
                                    <option>Example one</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                <!-- search submit button -->
                                <button type="submit" class="btn btn-danger wrn-btn">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>



    <!-- second search layout -->
    <div class="row">
        <div class="col-md-12 ">
            <div class="content">
                <div class="pull-middle">
                    <div class="panel panel-default">
                        <div class="">
                            <form action="/search" method="get">

                                <div class="">

                                    <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                        <input type="text" class="form-control" placeholder="Search" name="search" id="" value="<?php echo $_GET['search']; ?>">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-12 p-0">
                                        <select class="form-control search-slt" id="exampleFormControlSelect1">
                                            <option>Select Vehicle</option>
                                            <option>Example one</option>
                                            <option>Example one</option>
                                            <option>Example one</option>
                                            <option>Example one</option>
                                            <option>Example one</option>
                                            <option>Example one</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                        <button type="submit" class="btn btn-danger wrn-btn">Search</button>
                                    </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <?php }




//add short code for search functionality
add_shortcode('search', 'search15');



//search page functionality
function searchResult()
{
    //check if search term in search bar and not empty
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $selectTypes = $_GET["post-type-select"];
        $args = array(
            "post_type" => "job_listing",
            "s" => $search
        );
        // posts query
        $query = get_posts($args);

        if ($query == array()) {
            echo 'No result found';
        }

        foreach ($query as $q) {

            if (has_post_thumbnail()) {
                the_post_thumbnail();
            }
            // var_dump($q);


            $postTitle = $q->post_title;
            $postTitleDash = strtolower(str_replace(' ', '-', $postTitle));
            echo $postTitleDash;

            //get image array
            $imgArray = get_post_meta($q->ID, '_job_cover', true);
            $meta = get_post_meta($q->ID);
            $link = get_permalink($q->ID);

            // post Images
            $defaultImg = 'https://cdn.searchenginejournal.com/wp-content/uploads/2019/08/c573bf41-6a7c-4927-845c-4ca0260aad6b-1520x800.jpeg';
            $postImg = $imgArray[0];

            //post ratings and reviews
            $reviewCount = $meta['_case27_review_count'][0];
            $averageRating = $meta['_case27_average_rating'][0] / 2;
            echo $averageRating;

    ?>

            <div class="container">
                <div class="col-sm-12">
                    <div class="bs-calltoaction bs-calltoaction-default">
                        <div class="row">
                            <div class="col-md-5 cta-contents">
                                <!-- show post image -->
                                <img class="wh" src="
                                <?php


                                if (!empty($postImg)) {
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

                                        if ($reviewCount == 0) {
                                            echo '<span class="fa fa-star not-checked"></span>';
                                            echo '<span class="fa fa-star not-checked"></span>';
                                            echo '<span class="fa fa-star not-checked"></span>';
                                            echo '<span class="fa fa-star not-checked"></span>';
                                            echo '<span class="fa fa-star not-checked"></span>';
                                        }

                                        ?>
                                        <span class="p-1">
                                            <?php

                                            if ($reviewCount > 0) {
                                                echo $reviewCount . ' Reviews found';
                                            } else {
                                                echo 'Not Rated Yet';
                                            }

                                            ?>
                                        </span>
                                    </div>

                                    <?php
                                    require(plugin_dir_path(__FILE__) . 'includes/bookmark.php');

                                    ?>

                                </div>
                            </div>

                            <div class="col-md-2 cta-button">
                                <!-- check this functionality -->
                                <a href="#" class="btn btn-lg btn-block btn-primary">Check This</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    }

    if (!isset($_GET['search'])) {
        echo 'something is wrong';
    }
}

// results page shortcode
add_shortcode('results', 'searchResult');





//enqueue files
function search493_enqueue()
{
    $enq = plugin_dir_url(__FILE__) . 'assets/';

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
            'we_value' => 1234
        )
    );
}


add_action('wp_enqueue_scripts', 'search493_enqueue');

// add_action('wp_ajax_logged_in_action_name', 'logged_in_action_name');
// add_action('wp_ajax_nopriv_logged_in_action_name', 'logged_in_action_name');
// add_shortcode('a', 'logged_in_action_name');

// function logged_in_action_name()
// {
//     $d = $_POST['action'];
//     echo ($d);
//     exit();
// }




// Same handler function...
add_action('wp_ajax_my_action', 'my_action');
add_action('wp_ajax_nopriv_my_action', 'my_action');
function my_action()
{
    global $wpdb;
    $post_id = $_POST['post_id'];
    $status = $_POST['status'];
    $user_id = $_POST['user_id'];


    $like_query = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM `wp_like_info` WHERE user_name = '$user_id' AND post_id = '$post_id'"
    ));

    // echo ($wpdb->num_rows);
    $like_status = $wpdb->num_rows;
    //total like count query

    // print_r($wpdb);

    if (isset($status)) {
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

        print_r($wpdb);
    }





    // if ($status == 'like') {

    //     $like_insert = "INSERT INTO `wp_like_info` (`user_name`, `post_id`, `like_action`) VALUES ('$user_id', $post_id, '$status') ON DUPLICATE KEY UPDATE like_action = 1";

    //     $qr = $wpdb->query($like_insert);
    //     print_r($qr);



    //     // if ($like_status == 0) {
    //     //     $wpdb->insert('wp_like_info', array(
    //     //         'user_name' => $user_id,
    //     //         'post_id' => $post_id,
    //     //         'like_action' => 'like'
    //     //     ));
    //     // }

    //     // if ($like_status > 0) {

    //     //     $wpdb->update('wp_like_info', array('like_action' => 'like'), array('user_name' => $user_id, 'post_id' => $post_id));
    //     // }
    // }

    // if ($status == 'unlike') {
    //     $wpdb->query("DELETE FROM 'wp_like_info' WHERE post_id = $post_id AND user_name = $user_id ");
    // }



    wp_die();
}






// require(plugin_dir_path(__FILE__) . 'includes/enqueuefiles.php');
require(plugin_dir_path(__FILE__) . 'includes/my-account-bookmark.php');
require_once(plugin_dir_path(__FILE__) . 'includes/dbtables.php');

register_activation_hook(__FILE__, 'bookmarkTable');
