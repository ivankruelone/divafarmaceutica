<script language="javascript" type="text/javascript">
$('#clave').focus();

$(document).ready(function(){
   
   $('#kardex_form').submit(function(event){
    event.preventDefault();
    
    var url = "<?php echo site_url();?>/stats/submit_precios_historico";
    var clave = $('#clave').attr('value');
    var proveedor = $('#proveedor').attr('value');

    var variables = {
        clave: clave,
        proveedor: proveedor
    };
    
    $.post( url, variables, function(data) {
        $('#tabla_kardex').html(data);
    });
   });
   
   
   $('#clave').change(function(){
    
    var url = "<?php echo site_url();?>/stats/proveedor_clave";
    var clave = $('#clave').attr('value');
    var variables = {
        clave: clave
    };
    
    $.post( url, variables, function(data) {
        $('#proveedor').html(data);
    });
    
   });
    
});

</script>