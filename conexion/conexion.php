<?php
	$mysqli=new mysqli("ns1.ssdhosting.com.pe","aqpfact_userfactura","(3_qKZ#XUm+y","aqpfact_dbiperc"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
	$acentos = $mysqli->query("SET NAMES 'utf8'")

?>