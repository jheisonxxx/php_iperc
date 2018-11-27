<?php

require_once ("conexion/conexion.php");

$acceso=0;

$username = $_POST['username'];

$password = $_POST['password'];

$h_password = md5($password);

$sql = "SELECT * FROM tblUsuarios WHERE Usuario='$username' AND Contrasena='$h_password' AND AreaId=6;";	
$result=$mysqli->query($sql);

$userId=0;
$userNombre="";
while($results = $result->fetch_assoc()) {
    $userId =$results['Id'];
    $userNombre=$results['Nombre'];
}
$num_rows= $result->num_rows;
if($num_rows>0){
    $acceso=1;

    session_start();
    $_SESSION['pin']			=1;
    $_SESSION['usuario_id']			=$userId;
    $_SESSION['usuario_nombre']		=$userNombre;
}

$data['acceso']=$acceso;
$data['sup_id']=$results["Id"];
echo json_encode($data);
?>
