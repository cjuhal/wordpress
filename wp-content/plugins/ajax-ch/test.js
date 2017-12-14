// jQuery(document).ready( function($) {
//
// 	$.ajax({
// 		url: "http://localhost/wordpress/",
// 		success: function( data ) {
// 			alert( 'Your home page has ' + $(data).find('div').length + ' div elements.');
// 		}
// 	})
//
// })


jQuery( document ).on( 'click', '.love-button', function() {
	var post_id = jQuery(this).data('id');
	jQuery.ajax({
		url : postlove.ajax_url,
		type : 'post',
		data : {
			action : 'post_love_add_love',
			post_id : post_id
		},
		success : function( response ) {
			alert(response)
		}
	});
})
