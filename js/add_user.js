jQuery(document).ready(function ($)  {
    $(".add_user_form").submit(function(e){
        e.preventDefault();
        $id_sto = $('.add_user_form').find('input[name="id_sto"]').val();
        $name = $('.add_user_form').find('input[name="name"]').val();
        $tel = $('.add_user_form').find('input[name="tel"]').val();
        $email = $('.add_user_form').find('input[name="email"]').val();
        $uid = $('.add_user_form').find('input[name="uid"]').val();
        $type_car = $('.add_user_form').find('input[name="type_car"]').val();
        $model_car = $('.add_user_form').find('input[name="model_car"]').val();
        $data = 'step=1&id_sto='+$id_sto+'&name='+$name+'&tel='+$tel+'&email='+$email+'&uid='+$uid+'&type_car='+$type_car+'&model_car='+$model_car;
        $.ajax({
            type: 'POST',
            url: '../cont/add_user.php',
            dataType: 'json',
            data: $data,
            success: function (result) {
                console.log(result);
                if (result.error) {
                    alertify.error(result.error.text);
                };
                if (result.result) {
                    if (result.result.status == 'ok') {
                        alertify.success(result.result.text);
                        $('.add_work_form').find('input[name="id_user"]').val(result.result.id_user);
                        $('.add_work_form').find('input[name="id_car"]').val(result.result.id_car);
                        $('.step2').slideDown();
                        $('.step1').slideUp();
                    }
                }
            }
        });
    });
//--------------------------------------
    $('.list_servises_settings > .radio_box > input').on('change', function() {
        if ($(this).val() == 0) {
            $('.add_work_form').find('input[name="garant"]').val('3');
        } else {
            $('.add_work_form').find('input[name="garant"]').val('0');
        }
    });

    $(".add_work_form").submit(function(e){
        e.preventDefault();
        $id_sto = $('.add_work_form').find('input[name="id_sto"]').val();
        $id_user = $('.add_work_form').find('input[name="id_user"]').val();
        $id_car = $('.add_work_form').find('input[name="id_car"]').val();
        $status = $('.add_work_form').find('input[name="status"]').val();
        $type = $('.add_work_form').find('input[name="type"]:checked').val();
        $garant = $('.add_work_form').find('input[name="garant"]').val();

        $data = 'step=2&id_sto='+$id_sto+'&id_user='+$id_user+'&id_car='+$id_car+'&status='+$status+'&type='+$type+'&garant='+$garant;
        $.ajax({
            type: 'POST',
            url: '../cont/add_user.php',
            dataType: 'json',
            data: $data,
            success: function (result) {
                console.log(result);
                if (result.error) {
                    alertify.error(result.error.text);
                };
                if (result.result) {
                    if (result.result.status == 'ok') {
                        alertify.success(result.result.text);
                        $('.step3').find('a').attr('href', '/add_report/'+result.result.id_work);
                        $('.step3').slideDown();
                        $('.step2').slideUp();
                    }
                }
            }
        });
    });
    /*
    $('.add_list_servises_settings > .checkbox_box > input').on('change', function() {
      //  $name = $(this).attr('id');
        if ($(this).is(':checked')) {
            $(this).parent('.checkbox_box').parent('.add_list_servises_settings').children('.input_show').attr('style', 'display: inline-block;');
        } else {
            $(this).parent('.checkbox_box').parent('.add_list_servises_settings').children('.input_show').attr('style', 'display: none;');
        }
    });

    $('body').on('click', '.add_report_submit', function() {
        $work_id = $('.sto_report').children('input[name="work_id"]').val();
        $url_video = $('.sto_report').children('.uploads_video').children('.right_side').children('input[name="url_video"]').val();
        if($url_video == null || $url_video=='undefined') { $url_video = ''; };
        $text = $('.sto_report').children('.text_block').children('.right_side').children('textarea[name="text"]').val();
        if($text == null || $text=='undefined') { $text = ''; };
        $comment = $('.sto_report').children('.text_block').children('.right_side').children('textarea[name="comment"]').val();
        $servises = '';
        $('.add_list_servises_settings').find('input[type="checkbox"]').each(function (i, elem) {
            if ($(this).is(':checked')) {
                $gar = $(this).parent('.checkbox_box').parent('.add_list_servises_settings').children('.input_show').children('input').val();

                if($gar == null || $gar=='') {
                    $servises = $servises + $(this).attr('name') + ';';
                } else {
                    $servises = $servises + $(this).attr('name') + ':'+$gar+';';
                }

            };
        });

        $uid = $('.sto_report').children('.text_block').children('.right_side').children('input[name="uid"]').val();
        if($uid == null || $uid=='undefined') { $uid = ''; };
       $data = 'work_id='+$work_id+'&url_video='+$url_video+'&text='+$text+'&comment='+$comment+'&servises='+$servises+'&uid='+$uid;
        $.ajax({
            type: 'POST',
            url: '../cont/add_report.php',
            dataType: 'json',
            data: $data,
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
*/
});
