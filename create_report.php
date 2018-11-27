<?php
require_once ("conexion/conexion.php");

$sql = "INSERT INTO tblIPERC(
	`Fecha` ,
	`SecuenciaControl` ,
	`Estado`
	)
	VALUES (
	 NOW( ),'',0);"; 

$rst = $mysqli->query($sql);
$data['rst_i'] = $rst;


echo json_encode($data);
?>
