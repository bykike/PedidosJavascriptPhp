<?php
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
		$errores[] = 'La fecha no es v&aacute;lida';
		$error = 1;
	}															
	//Validación factura 														
	if (trim($factura) != ''){
		if(!(int)$factura){
			$errores[] = 'El n&uacute;mero no es v&aacute;lido';
			$error = 1;
		}
	}else{
		$errores[] = 'El campo de factura se encuentra vac&iacute;o';
		$error = 1;
	}				
			
	if(!isset($_POST['codigo']) || sizeof($_POST['codigo'])==0){
		$errores[] = 'A&uacute;n no ha a&ntilde;adido art&iacute;culos para ser facturados';
		$error = 1;
	}
	
	if ($error==0 && (isset($errores) && sizeof($errores)==0)){
		$cod_cliente = $_POST['cod_cliente'];
		$fecha = $_POST['anio'] .$_POST['mes'].$_POST['dia'];
		$factura = $_POST['factura'];
		$monto = $_POST['monto'];								
									
		echo 'C&oacute;digo cliente: '.$cod_cliente.'<br>';
		echo 'Fecha: '.$fecha.'<br>';
		echo 'N&uacute;mero factura: '.$factura.'<br>';
		echo 'Total: '.$monto.'<br>';
		echo 'Forma de pago: '.$cod_forma_pago.'<br>';
		
		if(isset($_POST['codigo'])){
			echo '<table class="factura">';
			echo '<tr><th>C&oacute;digo</th><th>Descripci&oacute;n</th><th>Precio Unit.</th><th>Subtotal</th></tr>';
			$total = 0;
			foreach($_POST['codigo'] as $key=>$value){				
				if($_POST['cantidad'][$key]>0 && $_POST['preciounitario'][$key]>0){
					echo '<tr><td>'.$value.'</td><td>'.$productos[$value]['Nombre'].'</td><td>'.$_POST['preciounitario'][$key].'</td><td>'.$_POST['preciounitario'][$key]*$_POST['cantidad'][$key].'</td></tr>';
					$total += $_POST['preciounitario'][$key]*$_POST['cantidad'][$key];										
				}
			}
			echo '</table>';	
		}
		echo '<h3>Los datos de la compra se han registrado correctamente</h3>';
	}else{
		foreach($errores as $key=>$value)
			echo $value.'<br>';
	}
}                                                                      
?>