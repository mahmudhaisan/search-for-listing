// // bookmark btn functionality
jQuery(document).ready(function($) {



    $(".like-btn").on('click', function() {
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
                alert('Got this from the server: ' + response);



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


        console.log(pages);

    });





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
                    $('.no-posts').append('no posts available');


                }




                alert('Got this from the server: ' + data);
            }

        });




















        $(".default_option").click(function() {
            $(".dropdown ul").addClass("active");
        });

        $(".dropdown ul li").click(function() {
            var text = $(this).text();
            $(".default_option").text(text);
            $(".dropdown ul").removeClass("active");
        });

    });




    // jQuery(document).ready(function($) {


    // 	var data = {
    // 		'action': 'my_action',
    // 		'whatever': bookmark_ajax_script.we_value      // We pass php values differently!
    // 	};
    // 	// We can also pass the url value separately from ajaxurl for front end AJAX implementations
    // 	jQuery.post(bookmark_ajax_script.ajaxurl, data, function(response) {
    // 		alert('Got this from the server: ' + response);
    // 	});
    // });

});