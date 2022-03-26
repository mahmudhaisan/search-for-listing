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


    ?>

            <div class="container">
                <div class="col-sm-12">

                    <div class="bs-calltoaction bs-calltoaction-default">
                        <div class="row">

                            <div class="col-md-5 cta-contents">
                                <img class="w-100 h-100" src="https://cdn.searchenginejournal.com/wp-content/uploads/2019/08/c573bf41-6a7c-4927-845c-4ca0260aad6b-1520x800.jpeg" alt="">
                            </div>

                            <div class="col-md-5 cta-contents">
                                <h1 class="cta-title"><?php echo $q->post_title; ?></h1>
                                <div class="cta-desc">
                                    <p><?php echo $q->post_content; ?></p>
                                    <br>
                                </div>

                                <div class="cta-desc">
                                    <div>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="p-1"> 602 Reviews </span>
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
