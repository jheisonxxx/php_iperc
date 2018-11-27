<?php

	require_once('conexion/conexion.php');
	

	
    if($_POST['first_name']!='' && $_POST['last_name']!='' && $_POST['password']!='')
    {
        // get values 
        $username = $_POST['username'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password = $_POST['password'];
        $area = $_POST['area'];
        
        $h_password = md5($password);
        
        
        $query2 = "SELECT * FROM tblUsuarios WHERE Usuario= '$username'";
        $rst2 = $mysqli->query($query2);
        $nro_rows = $rst2->num_rows;
        if ($nro_rows>0){
            $data['code']='0';
            $data['msj']='DNI ya existe';
        }else{
            $query = "INSERT INTO tblUsuarios(Usuario, Nombre, Apellidos, Contrasena, AreaId) VALUES('$username','$first_name', '$last_name', '$h_password','$area')";
            $rst = $mysqli->query($query);
            $data['code']='1';
            $data['msj']='Inserto Correctamente';
        }
        echo json_encode($data);
    }
?>