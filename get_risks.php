<?php
require_once ("conexion/conexion.php");

$sql = 'SELECT * FROM tblRiesgo';	
$riesgos=$mysqli->query($sql);


while($r = $riesgos->fetch_assoc()) {
    $risks[] = $r;
}

$data['risk_list']=$risks;
echo json_encode($data);
?>
