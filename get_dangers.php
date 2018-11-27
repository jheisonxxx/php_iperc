<?php
require_once ("conexion/conexion.php");

$sql = 'SELECT * FROM tblPeligro';	
$peligros=$mysqli->query($sql);


while($r = $peligros->fetch_assoc()) {
    $dangers[] = $r;
}

$data['danger_list']=$dangers;
echo json_encode($data);
?>
