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

            $postTitle = $q->post_title;
            $postTitleDash = strtolower(str_replace(' ', '-', $postTitle));
            echo $postTitleDash;

            // get cpost types custom field keys
            // $meta1 = get_post_custom_keys($q->ID);

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

                                    <div class="mt-5">
                                        <ul class="social-network social-circle">
                                            <li><a href="#" class="icoRss"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#" class="icoRss"><i class="fa fa-thumbs-up"></i></a></li>
                                            <li><a href="http://localhost:10003/listing/<?php echo $postTitleDash; ?>/#reviews" class="icoRss"><i class="fa fa-star"></i></a></li>
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








// // woocommerce account page


add_filter('woocommerce_account_menu_items', 'woo493_my_account_navs');
function woo493_my_account_navs($menu_links)
{

    $menu_links['my-listings'] = 'My Files';

    unset($menu_links['dashboard']); // Remove Dashboard
    // unset($menu_links['my-listings']); // Remove Payment Methods
    unset($menu_links['promotions']); // Remove Payment Methods
    unset($menu_links['my-bookmarks']); // Remove Payment Methods
    unset($menu_links['orders']); // Remove Payment Methods
    unset($menu_links['downloads']); // Remove Payment Methods
    //print_r(($menu_links['my-listings'])); // Remove Orders
    unset($menu_links['edit-account']); // Disable Downloads
    unset($menu_links['edit-address']); // Remove Account details tab
    unset($menu_links['customer-logout']); // Remove Logout link

    return $menu_links;
}



/*
 * Step 1. Add Link (Tab) to My Account menu
 */
add_filter('woocommerce_account_menu_items', 'woo493_add_links_account_page', 40);
function woo493_add_links_account_page($menu_links)
{

    $menu_links = array_slice($menu_links, 0, 3, true)
        + array('new-bookmarks' => 'bookmark')
        + array_slice($menu_links, 3, NULL, true);

    return $menu_links;
}


/*
 * Step 2. Register Permalink Endpoint
 */
add_action('init', 'woo493_endpoints');
function woo493_endpoints()
{

    // WP_Rewrite is my Achilles' heel, so please do not ask me for detailed explanation
    add_rewrite_endpoint('new-bookmarks', EP_PAGES);
}


/*
 * Step 3. Content for the new page in My Account, woocommerce_account_{ENDPOINT NAME}_endpoint
 */
add_action('woocommerce_account_new-bookmarks_endpoint', 'woo493_endpoint_contents');
function woo493_endpoint_contents()
{

    // of course you can print dynamic content here, one of the most useful functions here is get_current_user_id()
    echo 'Last time you logged in: yesterday from Safari.';
}
