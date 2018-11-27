<?php
require_once ("conexion/conexion.php");

$secuencia =$_POST['secuencia'];
$actividad =$_POST['actividad'];

$sql2="SELECT MAX(Id) AS maxid FROM tblIPERC;";
$rst = $mysqli->query($sql2);
$r = $rst->fetch_assoc();
$maxid = $r["maxid"];


$sql = "UPDATE tblIPERC SET `SecuenciaControl` = '$secuencia', `Estado` = '1', `Actividad` = '$actividad' WHERE `Id` = '$maxid';"; 

$rst = $mysqli->query($sql);
$data['rst_i'] = $rst;
echo json_encode($data);
?>
