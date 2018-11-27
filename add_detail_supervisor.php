<?php
require_once ("conexion/conexion.php");

$usu_id =$_POST['usu_id']; 
$usu_control =$_POST['usu_control'];

$sql = "INSERT INTO tblIPERCDetalleSupervisores(
	`Fecha` ,
	`IPERCId` ,
	`UsuarioId`,
	`Control`
	)
	VALUES (
	NOW( ) ,(SELECT MAX(ID) FROM tblIPERC),  '$usu_id', '$usu_control');"; 

$rst = $mysqli->query($sql);
$data['rst_i'] = $rst;

$sql = "SELECT * FROM tblIPERC i INNER JOIN tblIPERCDetalleSupervisores du on i.Id=du.IPERCId INNER JOIN tblUsuarios u on u.Id=du.UsuarioId INNER JOIN tblArea a on a.Id=u.AreaId WHERE du.ID = (SELECT MAX(ID) FROM tblIPERCDetalleSupervisores) AND du.IPERCId =(SELECT MAX(ID) FROM tblIPERC);";
$detail_inserted = $mysqli->query($sql);
$r = $detail_inserted->fetch_assoc();
$data['supervisor_name']=$r['Nombre'];
$data['supervisor_last_name']=$r['Apellidos'];
$data['supervisor_control']=$r['Control'];

echo json_encode($data);
?>
