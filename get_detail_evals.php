<?php
require_once ("conexion/conexion.php");

$sql = 'SELECT * FROM tblIPERCDetalleEvaluacion ev WHERE ev.IPERCId =(SELECT MAX(ID) FROM tblIPERC);';	
$detail_evalips=$mysqli->query($sql);


while($r = $detail_evalips->fetch_assoc()) {
    $detail_evals[] = $r;
}

$data['detail_eval_list']=$detail_evals;
echo json_encode($data);
?>
