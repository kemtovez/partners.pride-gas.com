jQuery(document).ready(function ($)  {

    $.datetimepicker.setLocale('ru');
    $('.calendar_event_box').children('.md-content').find('input[name="data"]').datetimepicker({
        format:'d.m.Y H:i',
        formatTime:'H:i',
        formatDate:'d.m.Y',
        timepickerScrollbar:false,
        onChangeDateTime:function(dp,$input){
            $('.update_time_work').show();
        }
    });

    $('body').on('click', '.update_time_work', function() {
        $id = $(this).attr('data');
        $data =  $('.calendar_event_box').children('.md-content').find('input[name="data"]').val();
        console.log('11');
        $.ajax({
            type: 'POST',
            url: '../cont/update_time_work.php',
            dataType: 'json',
            data: 'id='+$id+'&data='+$data,
            success: function (result) {
                console.log(result);
                if (result.error) {
                    alertify.error(result.error.text);
                };
                if (result.result) {
                    if (result.result.status == 'ok') {
                        alertify.success(result.result.text);
                        $('#calendar').fullCalendar( 'refetchEvents' );
                        $('.update_time_work').hide();
                    }
                }
            }
        });
    });

$('#calendar').fullCalendar({
	dayClick: function(date, jsEvent, view) {

    },
 eventClick: function(calEvent, jsEvent, view) {
console.log(calEvent);
     $('.calendar_event_box').children('.md-content').find('h3').text(calEvent.title);
     $('.calendar_event_box').children('.md-content').find('input[name="data"]').val(calEvent.data+' '+calEvent.time);
     $('.calendar_event_box').children('.md-content').find('.update_time_work').attr('data', calEvent.id);
     $('.calendar_event_box').children('.md-content').find('#ajax_name_work').html(calEvent.description);
     $('.calendar_event_box').children('.md-content').find('#ajax_name_user').html(calEvent.name_user);
     $('.calendar_event_box').children('.md-content').find('#ajax_tel_user').html(calEvent.tel_user+'<br>'+calEvent.email_user);
     $('.calendar_event_box').children('.md-content').find('#ajax_auto_user').html(calEvent.type_car+' '+calEvent.model_car);
     $("#modal-1").addClass("md-show");
    },
			header: {
				left: 'prev,next today',
				center: 'title',
				right: ''
			},
			locale: 'ru',
			editable: false,
			navLinks: false, // can click day/week names to navigate views
			eventLimit: true, // allow "more" link when too many events
			events: {
				url: '../cont/calendar.php',
				error: function() {	}
			},
eventRender: function( event, element, view ) {
    $datas = '<p>'+event.description+'</p><p>'+event.data+' '+event.time+'</p><p class="cal_user_qtip">'+event.name_user+':<br>Телефон: '+event.tel_user+'<br>Почта: '+event.email_user+'</p>';
    element.qtip({
    content: {
        text:  $datas,
        title: event.title
    },
position: {
       my: 'right top'
}
});

},
    eventAfterRender: function( event, element, view ) {
    $div = '<div style="height: '+event.zagruz+'%;background:#84cae7;width:20px;font-size:10px;" class="zagruz"><span>'+event.zagruz+'</span></div>';
     element.parent('td').parent('tr').parent('tbody').parent('table').parent('.fc-content-skeleton').parent('.fc-week').children('.fc-bg').find('.fc-day:nth-child('+event.w+')').html($div);
    },
loading: function(bool) {}
});
});
