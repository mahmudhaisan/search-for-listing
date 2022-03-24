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
 * Text Domain: Search
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */


if (!defined('ABSPATH')) {
    die;
}


function search15()
{ ?>

    <form action="" method="get">
        <input type="text" name="search" id="">
        <input type="submit" name="" id="">
    </form>


<?php }

add_shortcode('search', 'search15');





function searchResult()
{

    if (isset($_GET['search'])) {

        $search = $_GET['search'];

        $args = array(
            "post_type" => "job_listing",
            "s" => $search
        );
        $query = get_posts($args);

        foreach ($query as $q) {
            echo $q->post_title;
            echo '<br>';
            echo $q->post_content;

            echo '<br>';
            echo '<br>';
        }
        // echo '<pre>';
        // $array = json_decode(json_encode($q), true);


        // print_r($array);

        // echo $query;
        // print_r($query);
    }
}


add_shortcode('results', 'searchResult');
