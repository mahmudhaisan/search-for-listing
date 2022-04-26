<?php


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
