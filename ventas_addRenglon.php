<?php
include_once('arr_productos.php');
//echo '<pre>';print_r($productos);echo '</pre>';
if(!isset($_POST['codigo']) || (isset($_POST['codigo']) && sizeof($_POST['codigo'])==0)){
	foreach($productos as $key=>$value){
		echo '<option value="'.$key.'">'.$value['Nombre'].'</option>';
	}
}else{
	foreach($productos as $key=>$value){
		if(!in_array($key, $_POST['codigo'])) 
			echo '<option value="'.$key.'">'.$value['Nombre'].'</option>';
	}
}
?>
