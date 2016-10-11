jQuery(document).ready(function ($)  {
    $('.add_list_servises_settings > .checkbox_box > input').on('change', function() {
        //  $name = $(this).attr('id');
        if ($(this).is(':checked')) {
            $(this).parent('.checkbox_box').parent('.add_list_servises_settings').children('.input_show').attr('style', 'display: inline-block;');
        } else {
            $(this).parent('.checkbox_box').parent('.add_list_servises_settings').children('.input_show').attr('style', 'display: none;');
        }
    });
    $('body').on('click', '.edit_report_submit', function() {
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
        console.log($data);
        $.ajax({
            type: 'POST',
            url: '../cont/edit_report.php',
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

});
