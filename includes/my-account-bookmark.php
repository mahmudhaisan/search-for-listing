<?php

//  woocommerce my account page
add_filter('woocommerce_account_menu_items', 'woo493_my_account_navs');
function woo493_my_account_navs($menu_links)
{



    // unset($menu_links['dashboard']); // Remove Dashboard
    // unset($menu_links['my-listings']); // Remove Payment Methods
    unset($menu_links['promotions']); // Remove Payment Methods
    unset($menu_links['my-bookmarks']); // Remove Payment Methods
    unset($menu_links['orders']); // Remove Payment Methods
    unset($menu_links['downloads']); // Remove Payment Methods
    //print_r(($menu_links['my-listings'])); // Remove Orders
    unset($menu_links['edit-account']); // Disable Downloads

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
    global $current_user;
    wp_get_current_user();
    $bookmark_user = $current_user->user_login;
    // $bookmark_query = 

    if (isset($bookmark_user)) {
        global $wpdb; ?>

        <div class="row">

            <?php $bookmarks = $wpdb->get_results(
                "SELECT `post_id` FROM `wp_like_info` WHERE `user_name`= '$bookmark_user' AND `like_action`= 'like' "
            );

            if (isset($_GET['remove-id'])) {
                $wpdb;
                $removed_id = $_GET['remove-id'];
                $sql = "DELETE FROM `wp_like_info` WHERE  `user_name`= '$bookmark_user' AND `post_id`= '$removed_id' ";
                echo '<script>location.replace("?");</script>';
                $wpdb->query($sql);
            }

            foreach ($bookmarks as $bookmark) {


                $args = array(
                    'numberposts' => -1,
                    'post_type'   => 'job_listing',
                );

                $all_posts = get_posts($args);
                // echo '<pre>';
                // // print_r($all_posts);
                // echo '</pre>';






                foreach ($all_posts as $post) {

                    $post_id_number = $post->ID;
                    $post_title_name = $post->post_title;
                    $imgArray = get_post_meta($post->ID, '_job_cover', true);
                    $defaultImg = 'https://cdn.searchenginejournal.com/wp-content/uploads/2019/08/c573bf41-6a7c-4927-845c-4ca0260aad6b-1520x800.jpeg';
                    $postImg = $imgArray[0];
                    $link = get_permalink($post->ID);



                    if ($post_id_number  == $bookmark->post_id) {
            ?>
                        <div class="col-md-4">
                            <div class="card card main-card">
                                <img class="card-img-top" src="<?php if (!empty($postImg)) {
                                                                    echo $postImg;
                                                                } else {
                                                                    echo $defaultImg;
                                                                } ?>" class="card-img-top card-image-round" alt="...">
                                <div class="card-body card-body flex-column">
                                    <h5 class="card-title main-card-tittle"><a href="<?php echo $link; ?>"><?php echo $post_title_name ?></a></h5>

                                    <div class="row">
                                        <div class="col-md-6 show-post">
                                            <div class="">
                                                <i class="fa fa-eye"></i>
                                            </div>
                                            <div>
                                                <a href="<?php echo $link; ?>" class="">View Listing</a>
                                            </div>
                                        </div>



                                        <div class="col-md-6 remove-post">
                                            <div>
                                                <i class="fa fa-trash"></i>
                                            </div>
                                            <div>
                                                <a name="remove -listing" href="?remove-id=<?php echo $post_id_number ?>" class="bookmark-btn-remove">Remove Listing</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>








    <?php }
                }
            }
            echo '</div>';
        }
    }
