<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="js/jquery.1.8.1.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/ventas.js"></script>
<link type="text/css" href="css/estilo.css" rel="stylesheet">
</head>
<body>
	<form action="ventas_alta_enviar.php" id="frm_factura"
		name="frm_factura" method="POST" class="formulario_encabezado"
		enctype="multipart/form-data">
		<table>
			<tr>
				<td align="left">Cliente</td>
				<td><select name="cod_cliente" id="cod_cliente">
						<option value="0">Seleccionar cliente</option>
						<option value="1">cliente Uno</option>
						<option value="2">cliente dos</option>
						<option value="3">cliente tres</option>
						<option value="4">cliente cuatro</option>
						<option value="5">cliente cinco</option>
						<option value="6">cliente seis</option>
				</select></td>
				<td>Fecha</td>
				<td><select name="dia" id="dia">
						<?php
						for($i=1;$i<=31;$i++)
						{
							if ($i < 10) 
								$aux = '0'.$i;
							else
								$aux = $i;
							if ($aux==date("d"))
							{
								echo'<option value="'. $aux. '" selected>'.$aux.'</option>';
							}
							else 
							{
								echo'<option value="'. $aux. '">'.$aux.'</option>';
							}								
						}
						?>			
					</select> <select name="mes" id="mes">
						<?php
						for($i=1;$i<=12;$i++)
						{
							if ($i < 10) $aux = '0'.$i;
							else
							$aux = $i;
							
							if ($aux==date("m"))
							{
								echo'<option value="'. $aux. '" selected>'.$aux.'</option>';
							}
							else 
							{
								echo'<option value="'. $aux. '">'.$aux.'</option>';
							}								
						}
						?>			
					</select> <select name="anio" id="anio">
						<?php
						$aux =date("Y");
						for($i=$aux-1; $i<=$aux+5;$i++)
						{
							if ($i==date("Y"))
							{
								echo'<option value="'. $i. '" selected>'.$i.'</option>';
							}
							else
							{
								echo'<option value="'. $i. '">'.$i.'</option>';
							}
						}
						?>			
					</select></td>
				<td>N&ordm; factura</td>
				<td><input class="resaltar" name="factura" id="factura" type="text"
					size="5" value="1" /></td>
			</tr>
			<tr>
				<td>Forma de pago</td>
				<td><select name="cod_forma_pago" id="cod_forma_pago">
						<option value="0">Seleccionar forma de pago</option>
						<option value="1">Contado</option>
						<!-- <option value="2">Cuente Corriente</option>
						<option value="3">Transferencia bancaria</option> -->
				</select></td>
				<td align="left">TOTAL FACTURA</td>
				<td><input name="monto" id="monto" type="text" size="20" value="0" /></td>
				<td colspan="2" align="right"></td>
			</tr>
		</table>
		<table class="hovertable" id="alternatecolor">
			<thead>
				<tr>
					<td colspan="5"><input type="button" id="btn_agregar"
						name="btn_agregar" onclick="agregarRenglon();"
						value="Agregar art&iacute;culo"></td>
				</tr>
				<tr>
					<th>Art&iacute;culo</th>
					<!--<th>Descripci&oacute;n</th>-->
					<th>Cantidad</th>
					<th>Precio unitario</th>
					<th>Precio total</th>
					<td></td>
				</tr>
			</thead>
			<tbody id="factura_detalle">
			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" id="totalFactura" align="right"></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5" align="right"><input type="submit" id="enviar"
						name="enviar" value="Facturar"></td>
				</tr>
				
					<!--Imprimir documento -->
					<form action="" method="get">
						<input type="button" name="imprimir" value="Imprimir"  onClick="window.print();"/>
					</form>
					
				<tr>
					<td colspan="5"><div id="div_error"></div></td>
				</tr>
			</tfoot>
		</table>
	</form>
</body>
</html>