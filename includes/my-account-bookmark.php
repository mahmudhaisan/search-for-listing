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


?>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border-radius: 16px;">
                        <div class="well profile col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <figure>
                                    <img src="http://localhost:10003/wp-content/uploads/2022/03/da15b63c3a0f6b-1.jpg" alt="" class="img-circle" style="width:75px;" id="user-img">
                                </figure>
                                <h5 style="text-align:center;"><strong id="user-name">Arun Kumar Perumal</strong></h5>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divider text-center"></div>
                                <div class="col-lg-6 left" style="text-align:center;overflow-wrap: break-word;">
                                    <h4>
                                        <p style="text-align: center;"><strong id="user-globe-rank"><i class="fa fa-eye" aria-hidden="true"></i> </strong></p>
                                    </h4>
                                    <p><small class="label label-success"> View Listing</small></p>
                                    <!--<button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> Follow </button>-->
                                </div>
                                <div class=" col-lg-6 left" style="text-align:center;overflow-wrap: break-word;">
                                    <h4>
                                        <p style="text-align: center;"><strong id="user-college-rank"><i class="fa fa-trash" aria-hidden="true"></i> </strong></p>
                                    </h4>
                                    <p> <small class="label label-warning">Remove Listing</small></p>
                                    <!-- <button class="btn btn-info btn-block"><span class="fa fa-user"></span> View Profile </button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>



<?php }
