<?php
session_start();
if($_SESSION["pin"]!= "1"){ header("location: index.php"); exit();}
	require_once('conexion/conexion.php');
	

?>
<table class="table table-hover">
        <thead>
          <tr>
            <th>DNI</th>  
			<th>Nombres</th>
            <th>Apeliidos</th>           
            <th>Area</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php
            $usuario = 'SELECT * FROM tblUsuarios u INNER JOIN tblArea a ON u.AreaId = a.Id;';	
            $usuarios=$mysqli->query($usuario);
            while($r = $usuarios->fetch_assoc()) {  
        ?>
            <tr>
                <td><?php echo $r['Usuario']; ?></td>
                <td><?php echo $r['Nombre']; ?></td>
                <td><?php echo $r['Apellidos']; ?></td>
                <td><?php echo $r['Area']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
      </table>