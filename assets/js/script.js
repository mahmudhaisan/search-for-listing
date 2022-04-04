

// bookmark btn functionality
jQuery(document).ready(function($){
$(".like-btn").on('click', function(){
var post_id = $(this).data('id');
$clicked_btn = $(this);

if($clicked_btn.hasClass('fa-thumbs-o-up')){
    actiton = 'like';

}else if($clicked_btn.hasClass('fa-thumbs-up')){
    action='unlike';
}

$.ajax



});

});