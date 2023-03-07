<?php
include_once('arr_productos.php');
$value = $_POST['value'];

$total = $productos[$value]['Precio'];
echo number_format($total, 2, '.', ' ');
?>