<?php
require_once ("conexion/conexion.php");

$usuario = 'SELECT * FROM tblUsuarios u INNER JOIN tblArea a ON u.AreaId=a.Id WHERE u.Usuario='.$_POST['cli_dni'];	
$usuarios=$mysqli->query($usuario);

$user=$usuarios->fetch_assoc();


$data['cli_id']=$user['Id'];
$data['cli_area']=$user['Area'];
$data['nombre']=$user['Nombre'];
$data['apellidos']=$user['Apellidos'];

echo json_encode($data);
?>
