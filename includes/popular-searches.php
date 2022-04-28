<?php

use Automattic\WooCommerce\Admin\API\Reports\Categories\Query;

function popularSearchResults($atts)
{
    global $wpdb;

    $shortcodeArray = shortcode_atts(array(
        'search_results_page' => 'search-posts'

    ), $atts);



    $popular_results_redirect = $shortcodeArray['search_results_page'];




    $searchTerm = normalize_whitespace(strtolower($_GET['search']));
    $searchTermPlus = str_replace(' ', '+', preg_replace('/[^\da-z ]/i', '', strtolower($_GET['search'])));


    $searchLink = home_url() . '/search-posts/?search=' . $searchTermPlus;

    // echo $searchLink;

    //select data from db by searchTerm
    echo $searchTerm;

    $checkDuplicates = $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM `wp_popular_searches` WHERE search_term = '$searchTerm'"
    ));



    // print_r($checkDuplicates);

    $totalNumber = 0;
    ob_start();

    foreach ($checkDuplicates as $a) {
        //getting total array key
        $totalNumber++;
    }

    if ($searchTerm != '') {
        if ($totalNumber == 0) {

            if (isset($searchTerm)) {

                $sql = "INSERT INTO `wp_popular_searches` (`search_term`, `search_term_link`, `search_results_page`) VALUES ('$searchTerm', '$searchLink', '$popular_results_redirect') ";
                $wpdb->query($sql);
            }
        }
    }

    //get all words from searchTerm string
    $explodeSearchText = explode(' ', $searchTerm);


    echo '<div class="container">';
    $arrayUnique = array();
    $arrayUniqueItem = array();

    foreach ($explodeSearchText as $explodeSearchArray) {

        // print_r($explodeSearchText);
        $splitWordsDbSearch = $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM `wp_popular_searches` WHERE search_term LIKE '%$explodeSearchArray%'"
        ));


        foreach ($splitWordsDbSearch as $b) {

            if (!in_array($b->search_term, $arrayUnique)) {
                array_push($arrayUnique, $b->search_term);
                array_push($arrayUniqueItem, $b->search_term_link);
                array_merge($arrayUnique, $arrayUniqueItem);
            }
        }
    }


    foreach ($arrayUnique as $arrayToShow) {


        if ($arrayToShow != $searchTerm) {

            if ($popular_results_redirect == 'all') {
                $findSpecificPagesResults = $wpdb->get_results($wpdb->prepare(
                    "SELECT * FROM `wp_popular_searches` WHERE search_term LIKE '%$searchTerm%' "
                ));
            } else {
                $findSpecificPagesResults = $wpdb->get_results($wpdb->prepare(
                    "SELECT * FROM `wp_popular_searches` WHERE search_results_page = '$popular_results_redirect' AND search_term LIKE '%$searchTerm%' "
                ));
            }
        }
    }

    foreach ($findSpecificPagesResults as $result) {
        if ($result->search_term != $searchTerm) {

?>
            <a class="btn btn-dark text-white mt-3" href="<?php echo $result->search_term_link; ?>"><?php echo $result->search_term; ?></a>

<?
        }
    }



    echo '</div>';

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

// results page shortcode
add_shortcode('popular-search-results', 'popularSearchResults');
