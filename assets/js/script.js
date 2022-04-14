

// // bookmark btn functionality
jQuery(document).ready(function($){

$(".like-btn").on('click', function(){
var post_id = $(this).data('id');
var user_id = $(this).attr('user_id');
var total_like = $("#bookmark-count").data('id');
$clicked_btn = $(this);

if($clicked_btn.hasClass('fa-heart-o')){
    var action = 'like';

}else if($clicked_btn.hasClass('fa-heart')){
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

        if( jQuery('body').hasClass('logged-in') ) {
            if(action == 'like'){
                $clicked_btn.removeClass('fa-heart-o');
                $clicked_btn.addClass('fa-heart');
                $clicked_btn.addClass('bg-icon-selected');
                
               
            }else if(action == 'unlike'){
                $clicked_btn.removeClass('fa-heart');
                $clicked_btn.addClass('fa-heart-o');
                $clicked_btn.removeClass('bg-icon-selected');
                
            }
        } else{
            window.location.href='http://localhost:10003/my-account-2/';
            $clicked_btn.siblings('li.like-count').text(like_total);
        }


    $clicked_btn.siblings('li.like-count').text(response);
    



    }
})

 });

 $(".default_option").click(function(){
    $(".dropdown ul").addClass("active");
  });
  
  $(".dropdown ul li").click(function(){
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








    function myFunction() {
        /* Get the text field */
        var copyText = document.getElementById("myInput");
      
        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */
      
         /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
      
        /* Alert the copied text */
        alert("Copied the text: " + copyText.value);
      }
   



      