

// // bookmark btn functionality
jQuery(document).ready(function($){
$(".like-btn").on('click', function(){
var post_id = $(this).data('id');
var user_id = $(this).attr('user_id');
var total_like = $("#bookmark-count").data('id');
$clicked_btn = $(this);

if($clicked_btn.hasClass('fa-thumbs-o-up')){
    var action = 'like';

}else if($clicked_btn.hasClass('fa-thumbs-up')){
    var action='unlike';
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
        'like_total': total_like
    },
    success: function(response){
        // alert('Got this from the server: ' + response);
        if(action == 'like'){
            $clicked_btn.removeClass('fa-thumbs-o-up');
            $clicked_btn.addClass('fa-thumbs-up');
            
           
        }else if(action == 'unlike'){
            $clicked_btn.removeClass('fa-thumbs-up');
            $clicked_btn.addClass('fa-thumbs-o-up');
        }


        $(document).on('click', '.love', function (e) {
            // your code
        });



        $clicked_btn.siblings('span.like-count').text(response);



        // $("#bookmark-count").text(response);

        
        
        // alert(response);

        // alert(like_total);
    }
})



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