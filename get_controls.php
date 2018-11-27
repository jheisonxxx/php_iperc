<?php
require_once ("conexion/conexion.php");

$sql = 'SELECT * FROM tblControl';	
$medidas=$mysqli->query($sql);


while($r = $medidas->fetch_assoc()) {
    $measurements[] = $r;
}

$data['measurement_list']=$measurements;
echo json_encode($data);
?>
