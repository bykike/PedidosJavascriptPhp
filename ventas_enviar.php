<?php
function enviarPedidoCorreo($mensaje)
{
	// Variables con los datos a enviar
	$nombre = "Cliente 1";
	$email = "hello@areavisual.net";
	// $mensaje = "Hola, este es un mensaje de prueba.";

	// Destinatario del correo electrónico
	$destinatario = "hello@bykike.com";

	// Asunto del correo electrónico
	$asunto = "Mensaje desde mi sitio web";

	// Cuerpo del correo electrónico
	$cuerpo = "Nombre: " . $nombre . "\r\n";
	$cuerpo .= "Email: " . $email . "\r\n";
	$cuerpo .= "Mensaje: " . $mensaje . "\r\n";

	// Cabeceras del correo electrónico
	$headers = "From: " . $email . "\r\n";
	$headers .= "Reply-To: " . $email . "\r\n";
	$headers .= "Content-type: text/plain; charset=UTF-8\r\n";

	// Enviar el correo electrónico
	if (mail($destinatario, $asunto, $cuerpo, $headers)) {
		echo "Correo electrónico enviado correctamente.";
	} else {
		echo "Error al enviar el correo electrónico.";
	}
}

include_once('arr_productos.php');
//Se presiono el Boton de Guardar ---- en el formulario
if (isset($_POST['enviar']))
{
	$cod_cliente = $_POST['cod_cliente'];
	$fecha = $_POST['anio'] .$_POST['mes'].$_POST['dia'];
	$factura = $_POST['factura'];
	$monto = $_POST['monto'];
	$cod_forma_pago = $_POST['cod_forma_pago'];
	$errores = array();
	$error = 0;							
	//Validación cod_cliente
	if (!(isset($cod_cliente))){
		$errores[] = 'Debe seleccionar un cliente de la lista o bien dar de alta uno nuevo <a href= "adm_sectores_alta.php">desde  aqu&iacute;</a>';
		$error = 1;
	}																						
	//Validación fecha																					  
	if (!checkdate($_POST['mes'], $_POST['dia'], $_POST['anio'])){	
		$errores[] = 'La fecha no es válida';
		$error = 1;
	}															
	//Validación factura 														
	if (trim($factura) != ''){
		if(!(int)$factura){
			$errores[] = 'El número no es válido';
			$error = 1;
		}
	}else{
		$errores[] = 'El campo de factura se encuentra vacío';
		$error = 1;
	}				
			
	if(!isset($_POST['codigo']) || sizeof($_POST['codigo'])==0){
		$errores[] = 'Aún no ha añadido artículos para ser facturados';
		$error = 1;
	}
	
	if ($error==0 && (isset($errores) && sizeof($errores)==0)){
		$cod_cliente = $_POST['cod_cliente'];
		$fecha = $_POST['anio'] .$_POST['mes'].$_POST['dia'];
		$factura = $_POST['factura'];
		$monto = $_POST['monto'];								
									
		echo 'Código cliente: '.$cod_cliente.'<br>';
		echo 'Fecha: '.$fecha.'<br>';
		echo 'Número factura: '.$factura.'<br>';
		echo 'Total: '.$monto.'<br>';
		echo 'Forma de pago: '.$cod_forma_pago.'<br>';
		
		if(isset($_POST['codigo'])){
			echo '<table class="factura">';
			/* echo '<tr><th>Código</th><th>Descripción</th><th>Precio Unit.</th><th>Subtotal</th></tr>';*/
			echo '<tr><th>Producto</th><th>Unidades</th></tr>';
			$total = 0;

			$camposPresupuesto = array();

			foreach($_POST['codigo'] as $key=>$value){		
				/* Para poder mostrar los productos seleccionados quito el precio unitario */
				/* if($_POST['cantidad'][$key]>0 && $_POST['preciounitario'][$key]>0){ 
					echo '<tr><td>'.$value.'</td><td>'.$productos[$value]['Nombre'].'</td><td>'.$_POST['preciounitario'][$key].'</td><td>'.$_POST['preciounitario'][$key]*$_POST['cantidad'][$key].'</td></tr>';
					$total += $_POST['preciounitario'][$key]*$_POST['cantidad'][$key];										
				}*/
				if($_POST['cantidad'][$key]>0 && $_POST['preciounitario'][$key]==""){ 
					echo '<tr><td>'.$productos[$value]['Nombre'].'</td><td>'.$_POST['cantidad'][$key].'</td></tr>';

					$nombreCampo = $productos[$value]['Nombre'];
					$nombreCantidad = $_POST['cantidad'][$key];
					
					$camposPresupuesto[] = array( $nombreCampo , $nombreCantidad );
				}
			}
			echo '</table>';	
		}
		echo '<h3>Los datos de la compra se han registrado correctamente</h3>';
		enviarPedidoCorreo($camposPresupuesto);
	}else{
		foreach($errores as $key=>$value)
			echo $value.'<br>';
	}
}                                                                      
?>