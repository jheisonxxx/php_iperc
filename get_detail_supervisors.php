<?php
require_once ("conexion/conexion.php");

$detail_supervisores = 'SELECT * FROM tblIPERC i 
	INNER JOIN tblIPERCDetalleSupervisores ds on i.Id=ds.IPERCId 
	INNER JOIN tblUsuarios u on u.Id=ds.UsuarioId
	INNER JOIN tblArea a on a.Id=u.AreaId
	AND ds.IPERCId =(SELECT MAX(ID) FROM tblIPERC);';	
$detail_supervisores=$mysqli->query($detail_supervisores);


while($r = $detail_supervisores->fetch_assoc()) {
    $detail_supervisors[] = $r;
}

$data['detail_supervisor_list']=$detail_supervisors;
echo json_encode($data);
?>
