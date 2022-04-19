// // bookmark btn functionality
jQuery(document).ready(function($) {



    //like calculation on like button
    $(document).on('click', '.like-btn', function() {
        var post_id = $(this).data('id');
        var user_id = $(this).attr('user_id');
        var total_like = $("#bookmark-count").data('id');
        $clicked_btn = $(this);

        if ($clicked_btn.hasClass('fa-heart-o')) {
            var action = 'like';

        } else if ($clicked_btn.hasClass('fa-heart')) {
            var action = 'unlike';
        }

        $.ajax({
            url: bookmark_ajax_script.ajaxurl,
            type: 'post',
            data: {
                'action': 'my_action',
                'whatever': bookmark_ajax_script.we_value,
                'status': action,
                'post_id': post_id,
                'user_id': user_id,
                'like_total': total_like,


            },
            success: function(response) {
                // alert('Got this from the server: ' + response);





                if (jQuery('body').hasClass('logged-in')) {
                    if (action == 'like') {
                        $clicked_btn.removeClass('fa-heart-o');
                        $clicked_btn.addClass('fa-heart');
                        $clicked_btn.addClass('bg-icon-selected');


                    } else if (action == 'unlike') {
                        $clicked_btn.removeClass('fa-heart');
                        $clicked_btn.addClass('fa-heart-o');
                        $clicked_btn.removeClass('bg-icon-selected');

                    }
                } else {
                    window.location.href = 'http://localhost:10003/my-account-2/';
                    $clicked_btn.siblings('li.like-count').text(like_total);
                }


                $clicked_btn.siblings('li.like-count').text(response['like-count']);
            }
        })




    });




    //ajax load more on search results page
    $('.posts_loadmore').on('click', function() {
        $load_more = $(this);

        $.ajax({
            url: bookmark_ajax_script.ajaxurl,
            type: 'post',
            data: {
                'action': 'load_more_ajax',
                'query': bookmark_ajax_script.posts_vars,
                'page': bookmark_ajax_script.current_page,
                'search_term': bookmark_ajax_script.search_term,

            },

            success: function(data) {

                if (data) {
                    $('.ajax_loaded_posts').append(data); // insert new posts
                    bookmark_ajax_script.current_page++;

                    if (bookmark_ajax_script.current_page == bookmark_ajax_script.max_pages) {

                        $load_more.remove(); // if last page, remove the button

                    }

                    // you can also fire the "post-load" event here if you use a plugin that requires it
                    // $( document.body ).trigger( 'post-load' );
                } else {
                    $load_more.remove(); // if no data, remove the button as well
                    $('.no-posts').append('No Posts Available');

                }

                // alert('Got this from the server: ' + data);
            }

        });


    });

    $(document).on('click', '#share-social', function() {
        var share_post_id = $(this).data('id');
        $shareClicked = $(this);


        $.ajax({
            url: bookmark_ajax_script.ajaxurl,
            type: 'post',
            data: {
                'action': 'share_modal',
                'share_post_id': share_post_id

            },

            success: function(data) {

                $('#fb-share').on('click', function(e) {
                    e.preventDefault();

                    window.location.href = 'https://www.facebook.com/sharer/sharer.php?display=popup&u=' + data;
                })

                console.log('Got this from the server: ' + data);
            }

        });


    });







});