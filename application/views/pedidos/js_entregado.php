<script language="javascript" type="text/javascript">

$(document).ready(function(){
    var url = "<?php echo site_url();?>/pedidos/detalle_embarcado";

    var variables = {
        id: $('input[name="id"]').attr('value'),
        estatus: $('input[name="estatus"]').attr('value')
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_captura').html(data);
        $('#canreq_top').html($('#canreq_bottom').html());
        $('#cansur_top').html($('#cansur_bottom').html());
    });
    
$('.datepicker').datepick({
        dateFormat: 'yyyy-mm-dd',
        alignment: 'bottom',
        showOtherMonths: true,
        selectOtherMonths: true,
        renderer: {
            picker: '<div class="datepick block-border clearfix form"><div class="mini-calendar clearfix">' +
                    '{months}</div></div>',
            monthRow: '{months}',
            month: '<div class="calendar-controls">' +
                        '{monthHeader:M yyyy}' +
                    '</div>' +
                    '<table cellspacing="0">' +
                        '<thead>{weekHeader}</thead>' +
                        '<tbody>{weeks}</tbody></table>',
            weekHeader: '<tr>{days}</tr>',
            dayHeader: '<th>{day}</th>',
            week: '<tr>{days}</tr>',
            day: '<td>{day}</td>',
            monthSelector: '.month',
            daySelector: 'td',
            rtlClass: 'rtl',
            multiClass: 'multi',
            defaultClass: 'default',
            selectedClass: 'selected',
            highlightedClass: 'highlight',
            todayClass: 'today',
            otherMonthClass: 'other-month',
            weekendClass: 'week-end',
            commandClass: 'calendar',
            commandLinkClass: 'button',
            disabledClass: 'unavailable'
        }
    });


});





</script>