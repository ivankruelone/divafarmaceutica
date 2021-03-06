<link rel="stylesheet" href="<?php echo base_url();?>css/themes/base/jquery.ui.all.css">
<script src="<?php echo base_url();?>js/ui/jquery.ui.core.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.widget.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.position.min.js"></script>
<script src="<?php echo base_url();?>js/ui/jquery.ui.autocomplete.min.js"></script>
<script language="javascript" type="text/javascript">
$('#referencia').focus();


$('#referencia').keyup(function(){
    $(this).val($(this).attr('value').toUpperCase());
});

$('#notas').keyup(function(){
    $(this).val($(this).attr('value').toUpperCase());
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
    
$('#nueva_entrada_planta_form').submit(function(){
    
    var sucursal = $('#sucursal_id').attr('value');
	sucursal = sucursal.split('-');
	sucursal = trim(sucursal[0]);
    var subtipo = $('#subtipo').attr('value');
    var referencia = $('#referencia').attr('value');
    var fecha = $('#fec_doc').attr('value');

    if(sucursal > 0 && subtipo > 0 && referencia.length >= 1 && fecha.length == 10){
        if(confirm('Seguro que deseas agregar este folio con los datos seleccionados?')){
            return true;
        }else{
            return false;
        }
    }else{
        alert('Verifica los datos');
        return false;
    }
    
    
});


$(function() {
        
        var fuente = "<?php echo site_url();?>/sucursales/busca_sucursales_autocomplete";

		$( "#sucursal_id" ).autocomplete({
			source: fuente
		});
	});
</script>