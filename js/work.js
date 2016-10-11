jQuery(document).ready(function ($)  {
function load_work($id) {
	$.ajax({
		type: 'POST',
		url: '../temp/work_cat_list.php',
		data: 'cat='+$id,
		success: function(result){
			$('#cat_work_list_table').html(result);
		}
	});
}
	load_work(1);
	$('body').on('click', '.shuse_cat_work > button', function() {
		$id = $(this).attr('data');
		load_work($id);
		$('.shuse_cat_work > button').removeClass('active_cat');
		$(this).addClass('active_cat');
	});

	$('body').on('click', '.give_work', function() {
		$id_work = $(this).attr('data');
		$type_work = $(this).attr('type');
		$.ajax({
			type: 'POST',
			url: '../cont/give_work.php',
			data: 'id_work='+$id_work+'&type_work='+$type_work,
			success: function(result){
				alertify.success(result);
				location.reload();
			}
		});
	});
	$('body').on('click', '.add_report', function() {
		$id_work = $(this).attr('data');
		window.location.href = "../add_report/"+$id_work;
	});
	$('body').on('click', '.edit_report', function() {
		$id_work = $(this).attr('data');
		window.location.href = "../edit_report/"+$id_work;
	});
	$('body').on('click', '.edit2_report', function() {
		$id_work = $(this).attr('data');
		window.location.href = "../edit_report/"+$id_work;
	});
});
