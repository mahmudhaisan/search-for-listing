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


function search15()
{

    // $args = array(
    //     'post_type' => 'job_listing',
    // );
    // $query = new WP_Query($args);
    // var_dump(get_the_ID());
    // while ($query->posts()) {
    //     $query->the_post();
    //     var_dump($query);
    // }

    $array = wc_get_account_menu_items();
    var_dump($array);



?>
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <div class="content">
                <div class="pull-middle">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="/search" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search" name="search" id="" value="<?php echo $_GET['search']; ?>">
                                    <span class="input-group-btn">
                                        <button class="btn btn-success btn-circle" type="submit">Search</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php }


//add short code
add_shortcode('search', 'search15');


function searchResult()
{
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $args = array(
            "post_type" => "job_listing",
            "s" => $search
        );

        $query = get_posts($args);

        if ($query == array()) {
            echo 'No result found';
        }

        foreach ($query as $q) {

            if (has_post_thumbnail()) {
                the_post_thumbnail();
            }

            // get cpost types custom field keys
            // $meta1 = get_post_custom_keys($q->ID);

            $imgArray = get_post_meta($q->ID, '_job_cover', true);
            $meta = get_post_meta($q->ID);
            $link = get_permalink($q->ID);
            $defaultImg = 'https://cdn.searchenginejournal.com/wp-content/uploads/2019/08/c573bf41-6a7c-4927-845c-4ca0260aad6b-1520x800.jpeg';
            $postImg = $imgArray[0];

            $reviewCount = $meta['_case27_review_count'][0];
            $averageRating = $meta['_case27_average_rating'][0] / 2;

            // echo $averageRating;
            // echo $reviewCount;
            // echo '<pre>';
            // print_r($meta);
            // echo '</pre>';


            // print_r($meta['_case27_review_count'][0]);
            // print_r($meta['_case27_average_rating'][0]);
            // echo '</pre>';
    ?>

            <div class="container">
                <div class="col-sm-12">
                    <div class="bs-calltoaction bs-calltoaction-default">
                        <div class="row">
                            <div class="col-md-5 cta-contents">
                                <img class="wh" src="<?php
                                                        if (!empty($postImg)) {
                                                            echo $postImg;
                                                        } else {
                                                            echo $defaultImg;
                                                        } ?>" alt="">
                            </div>

                            <div class="col-md-5 cta-contents">
                                <h1 class="cta-title">
                                    <a href="<?php echo $link; ?>"> <?php echo $q->post_title; ?> </a>
                                </h1>
                                <div class="cta-desc">
                                    <p><?php echo $q->post_content; ?></p>
                                    <br>
                                </div>

                                <div class="cta-desc">
                                    <div>
                                        <?php
                                        require_once(plugin_dir_path(__FILE__) . 'includes/reviews.php');

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

                                    <div class="mt-5">
                                        <ul class="social-network social-circle">
                                            <li><a href="#" class="icoRss"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#" class="icoRss"><i class="fa fa-thumbs-up"></i></a></li>
                                            <li><a href="#" class="icoRss"><i class="fa fa-star"></i></a></li>
                                            <li><a href="#" class="icoRss"><i class="fa fa-share"></i></a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-2 cta-button">
                                <a href="#" class="btn btn-lg btn-block btn-primary">Check This</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
        // echo '<pre>';
        // $array = json_decode(json_encode($q), true);


        // print_r($array);

        // echo $query;
        // print_r($query);
    }


    if (!isset($_GET['search'])) {
        echo 'something is wrong';
    }
}

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
    wp_enqueue_script('bootstrap', $enq . 'js/bootstrap.min.js');
    wp_enqueue_script('script', $enq . 'js/script.js');
}


add_action('wp_enqueue_scripts', 'search493_enqueue');





add_action('woocommerce_account_navigation', 'action_function_name_6058');
function action_function_name_6058()
{
    echo '<a href="#">Hello </a>';
}
