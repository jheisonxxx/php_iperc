<?php
require_once ("conexion/conexion.php");

$usu_dni =$_POST['usu_dni']; 

$sql = "INSERT INTO tblIPERCDetalleUsuarios(
	`Fecha` ,
	`IPERCId` ,
	`UsuarioId`
	)
	VALUES (
	NOW( ) ,(SELECT MAX(ID) FROM tblIPERC), (SELECT Id FROM tblUsuarios WHERE Usuario = '$usu_dni') );"; 

$rst = $mysqli->query($sql);
$data['rst_i'] = $rst;

$sql = "SELECT * FROM tblIPERC i INNER JOIN tblIPERCDetalleUsuarios du on i.Id=du.IPERCId INNER JOIN tblUsuarios u on u.Id=du.UsuarioId INNER JOIN tblArea a on a.Id=u.AreaId WHERE du.ID = (SELECT MAX(ID) FROM tblIPERCDetalleUsuarios) AND du.IPERCId =(SELECT MAX(ID) FROM tblIPERC);";
$detail_inserted = $mysqli->query($sql);
$r = $detail_inserted->fetch_assoc();
$data['user_name']=$r['Nombre'];
$data['user_last_name']=$r['Apellidos'];
$data['user_area']=$r['Area'];

echo json_encode($data);
?>
