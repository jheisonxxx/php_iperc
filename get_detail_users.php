<?php
require_once ("conexion/conexion.php");

$detail_usuarios = 'SELECT * FROM tblIPERC i 
	INNER JOIN tblIPERCDetalleUsuarios du on i.Id=du.IPERCId 
	INNER JOIN tblUsuarios u on u.Id=du.UsuarioId
	INNER JOIN tblArea a on a.Id=u.AreaId
	AND du.IPERCId =(SELECT MAX(ID) FROM tblIPERC);';	
$detail_usuarios=$mysqli->query($detail_usuarios);


while($r = $detail_usuarios->fetch_assoc()) {
    $detail_users[] = $r;
}

$data['detail_user_list']=$detail_users;
echo json_encode($data);
?>
