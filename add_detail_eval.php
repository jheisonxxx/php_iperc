<?php
require_once ("conexion/conexion.php");

$danger =$_POST['danger'];
$risk =$_POST['risk'];
$eval_iperc =$_POST['eval_iperc'];
$eval_risk =$_POST['eval_risk'];
$measurement =$_POST['measurement'];

$sql = "INSERT INTO tblIPERCDetalleEvaluacion(
	`IPERCId` ,
	`Peligro` ,
	`Riesgo` ,
	`Iperc1` ,
	`Control` ,
	`Iperc2`
	)
	VALUES ((SELECT MAX(ID) FROM tblIPERC),  '$danger',  '$risk',  '$eval_iperc',  '$measurement',  '$eval_risk');"; 

$rst = $mysqli->query($sql);
$data['rst_i'] = $rst;

$sql = "SELECT * FROM tblIPERCDetalleEvaluacion e WHERE e.Id = (SELECT MAX(Id) FROM tblIPERCDetalleEvaluacion) AND e.IPERCId =(SELECT MAX(ID) FROM tblIPERC);";
$detail_inserted = $mysqli->query($sql);
$r = $detail_inserted->fetch_assoc();
$data['danger']=$r['Peligro'];
$data['risk']=$r['Riesgo'];
$data['eval_iperc']=$r['Iperc1'];
$data['eval_risk']=$r['Iperc2'];
$data['measurement']=$r['Control'];

echo json_encode($data);
?>
