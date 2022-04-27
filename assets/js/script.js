// // bookmark btn functionality
jQuery(document).ready(function($) {



    //like calculation on like button
    $(document).on('click', '.like-btn', function() {
        var post_id = $(this).data('id');
        var user_id = $(this).attr('user_id');
        var total_like = $("#bookmark-count").data('id');
        var site_url = site_url;
        var site_base = $(this).attr("url-id");
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

                    window.location.href = site_base + '/my-account-2/';
                    $clicked_btn.siblings('li.like-count').text(like_total);
                }


                $clicked_btn.siblings('li.like-count').text(response['like-count']);
            }
        })


    });




    //ajax load more on search results page

    $(document).on('click', '.posts_loadmore', function() {
        $load_more = $(this);
        var listing_type = $(this).attr("data-id");
        var show_posts = $(this).attr("show-posts");
        $.ajax({
            url: bookmark_ajax_script.ajaxurl,

            type: 'post',
            data: {
                'action': 'load_more_ajax',
                'query': bookmark_ajax_script.posts_vars,
                'page': bookmark_ajax_script.current_page,
                'search_term': bookmark_ajax_script.search_term,
                'listing_type': listing_type,
                'posts_to_show': show_posts,

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


    // share Social ajax


    $(document).on('click', '#share-social', function() {
        var share_post_id = $(this).data('id');
        $shareClicked = $(this);


        $.ajax({
            url: bookmark_ajax_script.aajaxurl,
            type: 'post',
            async: false,
            cache: false,
            data: {
                'action': 'share_modal',
                'share_post_id': share_post_id

            },

            success: function(data) {


                if (data) {


                    $('#fb-shares').on('click', function(e) {
                        e.preventDefault();


                        window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=' + data;

                    });
                    $('#fb-share').on('click', function(e) {
                        e.preventDefault();


                        window.location.href = 'https://www.facebook.com/sharer/sharer.php?u=' + data;

                    });
                    $('#twitter-share').on('click', function(e) {
                        e.preventDefault();

                        window.location.href = 'https://twitter.com/intent/tweet?url=' + data;
                    });

                    $('#linkedin-share').on('click', function(e) {
                        e.preventDefault();

                        window.location.href = 'https://www.linkedin.com/sharing/share-offsite/?url=' + data;
                    });


                    $("#inputCopyText").val(data);

                }
            }

        });

    });



    $('#link-clone').on('click', function(e) {
        e.preventDefault();

        let InputCopy = document.getElementById('inputCopyText');
        let copiedText = document.getElementById('copied-text');

        InputCopy.type = 'text';
        InputCopy.select();
        document.execCommand("copy");
        InputCopy.type = 'hidden';
        alert('copied');


        // var InputCopy = $('#inputCopyText').val();

        // InputCopy.setSelectionRange(0, 9999);


        // alert(InputCopy.value + 'link copied successfully');

        // document.body.removeChild(InputCopy);




    })


    $(document).on('click', '.bookmark-btn-remove', function(e) {
        // e.preventDefault();

        location.replace = 'fb.com';

    })

















});