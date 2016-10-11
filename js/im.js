jQuery(document).ready(function ($)  {
	load_work();
function load_work() {
	$cat = $('.shuse_cat_chat').children('.active_chat').attr('data');
	$('input[name="cat_chat"]').val($cat);
	$.ajax({
		type: 'POST',
		url: '../temp/chat_list.php',
		data: 'cat='+$cat,
		success: function(result){
			$('.chat_box').html(result);
		}
	});
};

	var timerId = setInterval(function() {
		load_work();
	}, 151000);


	$('body').on('click', '.shuse_cat_chat > button', function() {
		$('.shuse_cat_chat > button').removeClass('active_chat');
		$(this).addClass('active_chat');
		load_work();
	});
	$('body').on('click', '.send_im_btn', function() {
		$text = $('#text_im').val();
		$cat = $('input[name="cat_chat"]').val();
		$.ajax({
			type: 'POST',
			url: '../cont/add_chat_im.php',
			data: 'text='+$text+'&cat='+$cat,
			success: function(result){
				alertify.success(result);
				load_work();
			}
		});
	});
});
