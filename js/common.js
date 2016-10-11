jQuery(document).ready(function ($)  {
//----------ВСПЛЫВАЮЩЕЕ ОКНО

	$('body').on('click', '.md-close', function() {
		$(this).parent('.md-content-header').parent('.md-content').parent('.md-modal').removeClass("md-show");
	});

	$('a[rel="fancybox"]').fancybox();

	function openPopup(url) {
        $('#'+url).html('');
		$.fancybox({
			type: 'inline',
			href: url,
			loop: false,
			'arrows': false,
			helpers: {
				overlay : {closeClick: false}
			},
			'hideOnOverlayClick': false,
			'closeClick'  : false
		});
	};
//------------ ОБЩАЯ ФОРМА
	var requestSent = false;

	$(".ajax_form").submit(function(e){
		e.preventDefault();
		var m_method = $(this).attr("method");
		var m_action = $(this).attr("action");
		var m_data = $(this).serialize();
		console.log(m_data);
		$.ajax({
			type: m_method,
			url: m_action,
			dataType: 'json',
			data: m_data,
			beforeSend: function(data) {
				$(".ajax_form").find('button[type="submit"]').hide();
			},
			success: function (result) {
				console.log(result);
				if (result.error) {
					alertify.error(result.error.text);
				};
				if (result.result) {
					if (result.result.status == 'ok') {
						alertify.success(result.result.text);
						if (result.result.do == 'go_url') {
							document.location.href = result.result.url;
						}
						if (result.result.do == 'close_modal') {
							$("#" + result.result.url).removeClass("md-show");
						}
					}
				}
			},
			complete: function () {
				$(".ajax_form").find('button[type="submit"]').show();
			}
		});
});

    var img_sto_photo1_setting = {
        uploadUrl:'../cont/img_save_to_file.php',
        uploadData:{
            "colum":"1"
        },
        cropUrl:'../cont/img_crop_to_file.php',
        cropData:{
            "colum":"1"
        },
        customUploadButtonId:'update_img_sto_photo1',
        modal:true,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onAfterImgCrop:function(){ location.reload(); },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    };
    var img_sto_photo1 = new Croppic('img_sto_photo1', img_sto_photo1_setting);

	var img_sto_photo2_setting = {
		uploadUrl:'../cont/img_save_to_file.php',
		uploadData:{
			"colum":"2"
		},
		cropUrl:'../cont/img_crop_to_file.php',
		cropData:{
			"colum":"2"
		},
		customUploadButtonId:'update_img_sto_photo2',
		modal:true,
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		onAfterImgCrop:function(){ location.reload(); },
		onError:function(errormessage){ console.log('onError:'+errormessage) }
	};
	var img_sto_photo2 = new Croppic('img_sto_photo2', img_sto_photo2_setting);

	var img_sto_photo3_setting = {
		uploadUrl:'../cont/img_save_to_file.php',
		uploadData:{
			"colum":"3"
		},
		cropUrl:'../cont/img_crop_to_file.php',
		cropData:{
			"colum":"3"
		},
		customUploadButtonId:'update_img_sto_photo3',
		modal:true,
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		onAfterImgCrop:function(){ location.reload(); },
		onError:function(errormessage){ console.log('onError:'+errormessage) }
	};
	var img_sto_photo3 = new Croppic('img_sto_photo3', img_sto_photo3_setting);

	var img_sto_photo4_setting = {
		uploadUrl:'../cont/img_save_to_file.php',
		uploadData:{
			"colum":"4"
		},
		cropUrl:'../cont/img_crop_to_file.php',
		cropData:{
			"colum":"4"
		},
		customUploadButtonId:'update_img_sto_photo4',
		modal:true,
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		onAfterImgCrop:function(){ location.reload(); },
		onError:function(errormessage){ console.log('onError:'+errormessage) }
	};
	var img_sto_photo4 = new Croppic('img_sto_photo4', img_sto_photo4_setting);

	var img_sto_photo5_setting = {
		uploadUrl:'../cont/img_save_to_file.php',
		uploadData:{
			"colum":"5"
		},
		cropUrl:'../cont/img_crop_to_file.php',
		cropData:{
			"colum":"5"
		},
		customUploadButtonId:'update_img_sto_photo5',
		modal:true,
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		onAfterImgCrop:function(){ location.reload(); },
		onError:function(errormessage){ console.log('onError:'+errormessage) }
	};
	var img_sto_photo5 = new Croppic('img_sto_photo5', img_sto_photo5_setting);

	var img_sto_photo6_setting = {
		uploadUrl:'../cont/img_save_to_file.php',
		uploadData:{
			"colum":"6"
		},
		cropUrl:'../cont/img_crop_to_file.php',
		cropData:{
			"colum":"6"
		},
		customUploadButtonId:'update_img_sto_photo6',
		modal:true,
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		onAfterImgCrop:function(){ location.reload(); },
		onError:function(errormessage){ console.log('onError:'+errormessage) }
	};
	var img_sto_photo6 = new Croppic('img_sto_photo6', img_sto_photo6_setting);

	var img_sto_photo7_setting = {
		uploadUrl:'../cont/img_save_to_file.php',
		uploadData:{
			"colum":"7"
		},
		cropUrl:'../cont/img_crop_to_file.php',
		cropData:{
			"colum":"7"
		},
		customUploadButtonId:'update_img_sto_photo7',
		modal:true,
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		onAfterImgCrop:function(){ location.reload(); },
		onError:function(errormessage){ console.log('onError:'+errormessage) }
	};
	var img_sto_photo7 = new Croppic('img_sto_photo7', img_sto_photo7_setting);

	var img_sto_photo8_setting = {
		uploadUrl:'../cont/img_save_to_file.php',
		uploadData:{
			"colum":"8"
		},
		cropUrl:'../cont/img_crop_to_file.php',
		cropData:{
			"colum":"8"
		},
		customUploadButtonId:'update_img_sto_photo8',
		modal:true,
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
		onAfterImgCrop:function(){ location.reload(); },
		onError:function(errormessage){ console.log('onError:'+errormessage) }
	};
	var img_sto_photo8 = new Croppic('img_sto_photo8', img_sto_photo8_setting);

//----------------UPLOAD PROMO PHOTO
    var croppic_promo_photo = {
        cropUrl:'../cont/promo_img_crop_to_file.php',
        customUploadButtonId:'upload_promo_image',
        modal:false,
        processInline:true,
        loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
        onAfterImgCrop:function(){ location.reload(); },
        onError:function(errormessage){ console.log('onError:'+errormessage) }
    }
    var croppic_promo = new Croppic('my_promo_photo_box', croppic_promo_photo);

//---------- DELL PROMO PHOTO
    $('body').on('click', '.dell_promo_image', function() {
        $.ajax({
            type: 'POST',
            url: '../cont/dell_promo_img.php',
            success: function(result){
               // alertify.success(result);
                location.reload();
            }
        });
    });

//---------------------------
// Edit profile
	$('.list_send_settings > .checkbox_box > input').on('change', function() {
		$name = $(this).attr('id');
		if ($(this).is(':checked')) {
			console.log('check');
			$value = 1;
		} else {
			console.log('no check');
			$value = 0;
		}
		console.log('name='+$name+'&value='+$value+'&table=users');
		$.ajax({
			type: 'POST',
			url: '../cont/edit_profile.php',
			dataType: 'json',
			data: 'name='+$name+'&value='+$value+'&table=users',
			success: function(result){
				console.log(result);
				if (result.error) {
					alertify.error(result.error.text);
				};
				if (result.result) {
					if (result.result.status == 'ok') {
						alertify.success(result.result.text);
						if (result.result.do == 'go_url') {
							document.location.href = result.result.url;
						}
						if (result.result.do == 'close_modal') {
							$("#" + result.result.url).removeClass("md-show");
						}
					}
				}
			}
		});
	});
	$('.servises_settings > .list_servises_settings > .checkbox_box > input').on('change', function() {
		$value = '';
		$('.servises_settings').find('input[type="checkbox"]').each(function (i, elem) {
			if ($(this).is(':checked')) {
				$value = $value + $(this).attr('name') + ';';
			}
			;
		});
		$.ajax({
			type: 'POST',
			url: '../cont/edit_profile.php',
			dataType: 'json',
			data: 'name=servises&value=' + $value + '&table=servises',
			success: function (result) {
				console.log(result);
				if (result.error) {
					alertify.error(result.error.text);
				}
				;
				if (result.result) {
					if (result.result.status == 'ok') {
						alertify.success(result.result.text);
						if (result.result.do == 'go_url') {
							document.location.href = result.result.url;
						}
						if (result.result.do == 'close_modal') {
							$("#" + result.result.url).removeClass("md-show");
						}
					}
				}
			}
		});
	});
//dell_box_one_img

	$('body').on('click', '.dell_box_one_img', function() {
		$url = $(this).attr('data');
		$.ajax({
			type: 'POST',
			url: '../cont/dell_box_one_img.php',
			dataType: 'json',
			data: 'url=' + $url,
			success: function (result) {
				console.log(result);
				if (result.error) {
					alertify.error(result.error.text);
				}
				;
				if (result.result) {
					if (result.result.status == 'ok') {
						alertify.success(result.result.text);
						$('.dell_box_one_img[data="'+$url+'"]').parent('div').remove();
					}
				}
			}
		});
	});

	$('body').on('click', '.detail_work_table', function() {
		$id = $(this).attr('data');
		if($('#hidden_data_'+$id).css('display') == 'none') {
			$('#hidden_data_'+$id).show();
			$(this).addClass('hide_detail_work_table').text('Свернуть');
		} else {
			$('#hidden_data_'+$id).hide();
			$(this).removeClass('hide_detail_work_table').text('Детальнее');
		}
	});

	/*
	$('.filter_period > input[name="time"]').periodpicker({
		end: '#time_end',
		format:'d.m.Y H:i',
		formatTime:'H:i',
		formatDate:'d.m.Y',
		lang: "ru",
		i18n: {
			ru: {
				'Clear': 'Очистить'
			}
		},
		clearButtonInButton: true
	});


//------------------ DAte
	$.datetimepicker.setLocale('ru');
	$('.data_time').datetimepicker({
		format:'d.m.Y H:i',
		formatTime:'H:i',
		formatDate:'d.m.Y',
		timepickerScrollbar:false
	});

//------------------- Rayting
	$('.radio_raitings > input[type="checkbox"]').on('change', function() {
		$id = $(this).val();
		$(this).parent('.radio_raitings').parent('td').parent('tr').find('input[type="checkbox"]').prop( "checked", false );
		$(this).parent('.radio_raitings').parent('td').parent('tr').children('td').each(function (i, elem) {
			if($(this).children('.radio_raitings').children('input[type="checkbox"]').val()<=$id) {
				$(this).children('.radio_raitings').children('input[type="checkbox"]').prop("checked", true);
			}
		});
	});
//------------------- Work table detail
	$('body').on('click', '.detail_work_table', function() {
		$id = $(this).attr('data');
		if($('#hidden_data_'+$id).css('display') == 'none') {
			$('#hidden_data_'+$id).show();
			$(this).addClass('hide_detail_work_table').text('Свернуть');
		} else {
			$('#hidden_data_'+$id).hide();
			$(this).removeClass('hide_detail_work_table').text('Детальнее');
		}
	});

	$('body').on('click', '.ajax_detail_work', function() {
		$id = $(this).attr('data');
		$.ajax({
			type: 'POST',
			url: '../cont/ajax_detail_work.php',
			data: 'id='+$id,
			dataType: 'json',
			success: function(result){
				console.log(result);
				if (result.error) {
					alertify.error(result.error.text);
				}
				;
				if (result.result) {
					if (result.result.status == 'ok') {
						$('#ajax_other_work').html('');
						$('#ajax_data_last_work').html(result.result.data.data_last_work);
						$('#ajax_name_work').html(result.result.data.name_work);
						$('#ajax_name_sto').html(result.result.data.name_sto);
						$('#ajax_global_gar').html(result.result.data.global_gar);
						$.each(result.result.data.other_work, function(i, elem) {
							$('#ajax_other_work').append('<li>'+elem[0]+'</li>');
						});

						$("#modal-5").addClass("md-show");
					}
				}

			}
		});

	});
	$('body').on('click', '#modal-5 > .md-content > .md-content-header > .md-close', function() {
		$("#modal-5").removeClass("md-show");
	});
*/

});
