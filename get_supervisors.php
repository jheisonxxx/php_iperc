<?php
require_once ("conexion/conexion.php");

$usuario = 'SELECT * FROM tblUsuarios WHERE AreaId=6';	
$usuarios=$mysqli->query($usuario);


while($r = $usuarios->fetch_assoc()) {
    $users[] = $r;
}

$data['user_list']=$users;
echo json_encode($data);
?>
