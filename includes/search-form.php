<?php


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
