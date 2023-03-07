$(document).ready(function(){ 	
	//$("#imprimir").attr("disabled", "disabled");
	$("#frm_factura").validate({
		rules: {
				cod_cliente: { required: true, min:1},
				factura: { required: true},
				cod_forma_pago: { required: true, min:1},
				monto: { required: false}
		},
		messages: {
				cod_cliente: { required: "Seleccione un cliente", min:"El cliente no es v&#225;lido"},
				factura: { required: "El número de factura no es v&#225;lido", min:"El número de factura no es v&#225;lido"},
				cod_forma_pago: { required: "Seleccione la forma de pago", min:"La forma de pago no es v&#225;lida"},
				monto: { required: "El monto no es v&#225;lido"}
		},
		onkeyup: false,
		submitHandler: function(form) {
			if(confirm('¿Está seguro que desea finalizar esta facturación? Una vez finalizada no podrá modificarla')){
				enviar();
			}
		} 
	});/*validate*/
});/*ready*/

function enviar(){
	$.ajax({
	  type: 'POST',
	  url: 'ventas_enviar.php',
	  data: $('#frm_factura').serialize(),
	  beforeSend:
		function(){
			$('#div_error').html("procesando...");
		},
	  success:
		function(respuesta){
			$('#div_error').html(respuesta);
			//$('#btn_agregar').attr("disabled", "disabled");//.removeAttr("disabled");
			//$("input[type=submit]").attr("disabled", "disabled");
		},
	  error	:
		function(){
			$('#div_error').html('Se produjo un error. Verifique los datos.');
		}
	});
}

var contador=0;

function agregarRenglon(){
	var cont = contador++;
	var cadena='';
	cadena = cadena + '<tr id="renglon_'+cont+'">';
	cadena = cadena + '<td><select id="cod_'+cont+'" name="codigo[]" onChange="buscarPrecio(this.id, this.value);"></select></td>';
	//cadena = cadena + '<td><input type="text" id="desc_'+cont+'" name="descripcion[]" title="Descripci&ocuate;n art&iacute;culo"></td>';
	cadena = cadena + '<td><input type="text" size="5" id="cant_'+cont+'" name="cantidad[]" title="Cantidad" onchange="recalcular(this.id);">';
	cadena = cadena + '<input class="masmenos" type="button" size="20" value="+" onclick="sumarCantidad('+cont+');" title="Aumentar cantidad"><input class="masmenos" type="button" value="-" onclick="restarCantidad('+cont+');" title="Disminuir cantidad"></td>';
	cadena = cadena + '<td><input style="text-align:right;" type="text" size="15" id="punit_'+cont+'" name="preciounitario[]" title="Precio unitario"onchange="recalcular(this.id);"></td>';
	cadena = cadena + '<td><input style="text-align:right;" class="total" type="text" size="15" id="ptotal_'+cont+'" name="preciototal[]" title="Precio total"></td>';
	cadena = cadena + '<td><a href="javascript:eliminaElemento(\'renglon_'+cont+'\');">Borrar</a></td>';
	cadena = cadena + '</tr>';
	$('#factura_detalle').append(cadena);	
	
	$.ajax({
	  type: 'POST',
	  url: 'ventas_addRenglon.php',
	  data: $('#frm_factura').serialize(),
	  beforeSend:
		function(){
			$('#div_error').html("a&ntilde;adiendo rengl&oacute;n...");
		},
	  success:
		function(respuesta){
			$('#cod_'+cont).html(respuesta);
			$('#div_error').html("");
		},
	  error	:
		function(){
			$('#div_error').html('Se produjo un error. Verifique los datos.');
		}
	});

}

function buscarPrecio(id, valor){
	var ide = id.split('_');
	$.ajax({
	  type: 'POST',
	  url: 'ventas_buscarPrecio.php',
	  data: 'value='+valor,
	  beforeSend:
		function(){
			$('#div_error').html("procesando...");
		},
	  success:
		function(respuesta){
			if(respuesta>0){
				$('#punit_'+ide[1]).val(respuesta);
				$('#div_error').html("");
			}else{
				$('#punit_'+ide[1]).val('0');
				$('#div_error').html('El art&iacute;culo seleccionado no tiene stock suficiente');
			}
		},
	  error	:
		function(){
			$('#div_error').html('Se produjo un error. Verifique los datos.');
		}
	});
}

function eliminaElemento(elemento){
	$("#"+elemento).remove();
}

function sumarCantidad(valor){
    var suma = $("#cant_" + valor).val();
	if(suma=='') suma = 0;
    $("#cant_" + valor).val(parseFloat(suma)+1);
	recalcular('cant_'+valor);
}

function restarCantidad(valor){
	var suma = $("#cant_" + valor).val();
	if(suma>0){
		    $("#cant_" + valor).val(parseFloat(suma)-1);
	}else{
		    $("#cant_" + valor).val(0);
	}
	recalcular('cant_'+valor);
}

function recalcular(valor){
	var aux = valor.split('_');
	var ide = aux[1];
	var precio = $("#punit_" + ide).val();
	var cant = $("#cant_" + ide).val();
	var subtotal = precio*cant;
	$("#ptotal_" + ide).val(subtotal.toFixed(2));
	
	var total = 0;
	
	$(".total").each(function(){ 
		total += parseFloat($(this).val());
	}); 
	$("#totalFactura").text(total.toFixed(2));	
	$("#monto").val(total.toFixed(2));	
}

function imprimir() {
	ventana=window.open("print.php","ventana","width=800,height=600");
	ventana.document.open();
}