<?php
 
$arr_clientes = array('titulo'=> 'Jose', 'latitud'=> '4.151465', 'longitud'=> '-73.638209');
 
 
//Creamos el JSON
$json_string = json_encode($arr_clientes);
$file = 'clientes.json';
file_put_contents($file, $json_string);
 
?>