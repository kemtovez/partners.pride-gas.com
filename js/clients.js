jQuery(document).ready(function ($)  {
function load_clients($data) {
	$.ajax({
		type: 'POST',
		url: '../temp/client_list.php',
		data: $data,
		success: function(result){
			$('#clients_list_table').html(result);
		}
	});
}


	$('body').on('click', '.search_clients_box > p > button', function() {
		$garant_book = $('.search_clients_box').find('input[name="garant_book"]').val();
		$uid = $('.search_clients_box').find('input[name="uid"]').val();
		load_clients('garant_book='+$garant_book+'&uid='+$uid+'&type=1');
	});

	$('body').on('click', '.my_clients', function() {
		load_clients('type=2');
	});

});
