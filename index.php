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
				<td>Nº Pedido</td>
				<td><input class="resaltar" name="factura" id="factura" type="text"
					size="5" value="1" /></td>
			</tr>
			<tr>
				<td>Forma de pago</td>
				<td><select name="cod_forma_pago" id="cod_forma_pago">
						<option value="0">Seleccionar forma de pago</option>
						<option value="1">Contado</option>
						<option value="2">Cuenta Corriente</option>
						<option value="3">Transferencia Bancaria</option>
				</select></td>
				<td align="left">TOTAL FACTURA</td>
				<td><input name="monto" id="monto" type="text" size="20" value="0" /></td>
				<td colspan="2" align="right"></td>
			</tr>

		</table>

		<table class="hovertable" id="alternatecolor">
			<thead>
				<tr>
				<td>Seleccione familia para mostrar sus productos </td>
				<td><select name="sel_familia" id="">
							<option value="ABONADORAS"                              >01 ABONADORAS</option>
                            <option value="ACCESO. DE RIEGO CON ANILLO DE SEGURIDAD">02 ACCESO. DE RIEGO CON ANILLO DE SEGURIDAD</option>
                            <option value="ACCESORIOS DE PRESION - FITTING"         >03 ACCESORIOS DE PRESION - FITTING</option>
                            <option value="ACCESORIOS ELECTROFUSION"                >04 ACCESORIOS ELECTROFUSION</option>
                            <option value="ACCESORIOS LATON"                        >05 ACCESORIOS LATON</option>
                            <option value="ACCESORIOS RIEGO"                        >06 ACCESORIOS RIEGO</option>
                            <option value="ACCESORIOS ROSCADOS P.E."                >07 ACCESORIOS ROSCADOS P.E.</option>
                            <option value="ASPERSORES Y TURBINAS"                   >08 ASPERSORES Y TURBINAS</option>
                            <option value="CINTA Y ACCESORIOS CINTA"                >09 CINTA Y ACCESORIOS CINTA</option>
                            <option value="EXTENDEDOR RECOGEDOR MANGUERA"           >10 EXTENDEDOR RECOGEDOR MANGUERA</option>
                            <option value="FILTROS"                                 >11 FILTROS</option>
                            <option value="GOTEROS"                                 >12 GOTEROS</option>
                            <option value="HUNTER"                                  >13 HUNTER</option>
                            <option value="LINEA"                                   >14 LINEA</option>
                            <option value="MICROTUBERIA"                            >15 MICROTUBERIA</option>
                            <option value="PRODUCTOS HIDROTEN"                      >16 PRODUCTOS HIDROTEN</option>
                            <option value="PROGRAMADORES Y VALVULAS"                >17 PROGRAMADORES Y VALVULAS</option>
                            <option value="PVC ACCESORIOS PRESION ENCOLAR-ROSCAR"   >18 PVC ACCESORIOS PRESION ENCOLAR-ROSCAR</option>
                            <option value="TUBERIA PE BD ALIMENTARIA"               >19 TUBERIA PE BD ALIMENTARIA</option>
                            <option value="TUBERIA INTEGRADA AUTOCOMPENSANTE"       >20 TUBERIA INTEGRADA AUTOCOMPENSANTE</option>
                            <option value="TUBERIA INTEGRADA TURBULENTO"            >21 TUBERIA INTEGRADA TURBULENTO</option>
                            <option value="TUBERIA INTERLINEA ALIMENTARIA"          >22 TUBERIA INTERLINEA ALIMENTARIA</option>
                            <option value="TUBERIA INTERLINEA AGRICOLA"             >23 TUBERIA INTERLINEA AGRICOLA</option>
                            <option value="TUBERIA PE BD AGRICOLA"                  >24 TUBERIA PE BD AGRICOLA</option>
                            <option value="TUBERIAS P.E. A D P-100"                 >25 TUBERIAS P.E. A D P-100</option>
                            <option value="TUBOS Y ACCESORIOS PVC"                  >26 TUBOS Y ACCESORIOS PVC</option>
                            <option value="VALVULAS (FITTING)"                     	>27 VALVULAS (FITTING)</option>
                            <option value="VALVULAS LATON"                          >28 VALVULAS LATON</option>
                            <option value="VARIOS"                                  >29 VARIOS</option>
				</select></td>


				<td colspan="5"><input type="button" id="btn_agregar"
						name="btn_agregar" onclick="agregarRenglon();"
						value="Agregar artículo">
				</td>
				
				</tr>
				
				<tr>
					<th>Producto</th>
					<!-- <th>Descripci&oacute;n</th> -->
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

					<td colspan="5" align="right">
						<!--Imprimir documento -->
						<form action="" method="get">
							<input type="button" name="imprimir" value="Imprimir presupuesto"  onClick="window.print();"/>
						</form>

						<input type="submit" id="enviar" name="enviar" value="Enviar presupuesto">

					</td>
					<hr>

				</tr>
				<tr>
				<td colspan="5"><div id="div_error"></div></td>
				</tr>
			</tfoot>
		</table>
	</form>
</body>
</html>