jQuery(document).ready(function ($)  {

	function load_balance($id) {
		$.ajax({
			type: 'POST',
			url: '../temp/balance_list.php',
			data: 'time='+$id,
			success: function(result){
				$('#balance_list').html(result);
			}
		});
	}

	$('#periodpickerstart').periodpicker({
		end: '#periodpickerend',
		formatDate: 'DD.MM.YYYY',
		lang: "ru",
	});
	$('body').on('click', '.filter_period > button', function() {
		$date = $('#periodpickerstart').periodpicker('valueStringStrong');
		load_balance($date);
	});
	load_balance(1);
});
