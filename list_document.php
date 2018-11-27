<?php
session_start();
if($_SESSION["pin"]!= "1"){ header("location: index.php"); exit();}
	require_once('conexion/conexion.php');
if ($_POST['reporte_id']>0) {
        $idHiper = $_POST['reporte_id'];
        $usuario = 'SELECT * FROM tblIPERC i 
	INNER JOIN tblIPERCDetalleUsuarios du on i.Id=du.IPERCId 
	INNER JOIN tblUsuarios u on u.Id=du.UsuarioId
	INNER JOIN tblArea a on a.Id=u.AreaId
	WHERE i.Id=' . $idHiper . '
    ORDER BY i.Id DESC
	';
        $usuarios = $mysqli->query($usuario);
        $reporteHiper = 'SELECT * FROM tblIPERC i 
	INNER JOIN tblIPERCDetalleSupervisores du on i.Id=du.IPERCId 
	INNER JOIN tblUsuarios u on u.Id=du.UsuarioId
	INNER JOIN tblArea a on a.Id=u.AreaId
	WHERE i.Id=' . $idHiper . '
    ORDER BY i.Id DESC
	';
        $reporteHipers = $mysqli->query($reporteHiper);

        $hipercDetalle = 'SELECT * FROM tblIPERC i 
	INNER JOIN tblIPERCDetalleEvaluacion di on di.IPERCId=i.Id 
	WHERE i.Id=' . $idHiper . '
	ORDER BY i.Id DESC';
        $hipercDetalles = $mysqli->query($hipercDetalle);
        
        
        
        $hipercDetalles = $mysqli->query($hipercDetalle);
        
        $sqlSecuencia = 'SELECT * FROM tblIPERC i WHERE i.Id=' . $idHiper;
	    
	    $hipercSecuencias = $mysqli->query($sqlSecuencia);
	    
	    $hipercSecuencia=$hipercSecuencias->fetch_assoc();
	    
	    $secuenciaControl=$hipercSecuencia['SecuenciaControl'];
	    $fechaReporte=$hipercSecuencia['Fecha'];
        $actividad=$hipercSecuencia['Actividad'];
	
        $secuenciaControl=split(",", $secuenciaControl);

}

////////////////////
/// solo para el listado html
$listado = 'SELECT * FROM tblIPERC i 
    ORDER BY i.Id DESC
    ';
$listadoGeneral = $mysqli->query($listado);
/// ///////////////
///
if(isset($_POST['create_pdf'])){
	require_once('tcpdf/tcpdf.php');
	
	$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
	
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Azetasoft');
	$pdf->SetTitle($_POST['reporte_name']);
	
	$pdf->setPrintHeader(false); 
	$pdf->setPrintFooter(false);
	$pdf->SetMargins(10, 0, 10, false);
	$pdf->SetAutoPageBreak(true, 20); 
	$pdf->SetFont('Helvetica', '', 9);
	$pdf->addPage();

	$content = '';
	$content .= '
    <style>
    table tr td{
        font-size: 8pt;
    }
    
    </style>
		<div class="row">
        	<div class="col-md-12">
            	<h1 style="text-align:center;">'.$_POST['reporte_name'].'</h1>
       	<table border="1" cellpadding="5">

          <tr>
			<td rowspan="3"><img src="img/logo.png" width="360px" height="194px" ></td>
            <td><h1 class="text-center">FORMATO</h1></td>           
            <td rowspan="2" >CODIGO: '.$id.' <br> REV: <br> FECHA: '.date("d/m/Y", strtotime($fechaReporte)).'</td>
            <td rowspan="2"><img src="img/hiperc.jpg" width="250mm" height="150mm" ></td>
          </tr>
		  <tr>
            <td>IPERC CONTINUO</td>           
            <td></td>
          </tr>

		</table>
	';
    $content .= '
      <table border="1" cellpadding="5">
      <tr>
            <td bgcolor="#a9a9a9" color="#fff">ACTIVIDAD</td>  
			<td colspan="4">'.$actividad.'</td>			
          </tr>
    ';
    $content .='</table>';
	//USUARIOS
	$content .= '	
      <table border="1" cellpadding="5">
        <thead>
          <tr bgcolor="#a9a9a9" color="#fff">
            <th>FECHA</th>  
			<th>HORA</th>			
            <th>NIVEL AREA / NOMBRES</th>
            <th>NOMBRES</th>
			<th>FIRMA</th>
          </tr>
        </thead>
	';
	
	
	while ($user=$usuarios->fetch_assoc()) {
	$content .= '
		<tr>
            <td>'.date("d/m/Y", strtotime($user['Fecha'])).'</td>
            
			<td>'.date("H:i", strtotime($user['Fecha'])).'</td>
            <td>'.$user['Area'].'</td>
            <td>'.$user['Nombre'].'</td>
			<td>*********</td>
        </tr>
	';
	}
	
	$content .= '</table>';
	// FIN USUARIOS
	
	//IPERC==========================
	$content .= '
		<table border="1" cellpadding="5">
        <thead>
          <tr color="#000">
			<td width="145mm" colspan="2"></td>
            <td width="30mm" style="text-align: center;font-size: 6pt;vertical-align: bottom">EVALUACIÓN IPER</td>
            <th width="72mm"></th>
			<th width="30mm" colspan="2" style="text-align: center; font-size: 6pt">EVAL. RIESGO RESIDUAL</th>
          </tr>
          <tr bgcolor="#a9a9a9" color="#fff">
			<th width="73mm" >DESCRIPCIÓN DEL PELIGRO</th>
            <th width="72mm" >RIESGO</th>           
            <th width="10mm" bgcolor="red" color="#000">A</th>
            <th width="10mm" bgcolor="yellow" color="#000">M</th>
            <th width="10mm" bgcolor="lime" color="#000">B</th>
            <th width="72mm" >MEDIDAS DE CONTROL A IMPLEMENTAR</th>
			<th width="10mm" bgcolor="red" color="#000">A</th>
            <th width="10mm" bgcolor="yellow" color="#000">M</th>
            <th width="10mm" bgcolor="lime" color="#000">B</th>
          </tr>
        </thead>
	';
    $bgcolor="#fff";
    $hiperc1="";
    $hiperc2="";
	while ($hipercDetalle=$hipercDetalles->fetch_assoc()) {
         $hiperc1=$hipercDetalle['Iperc1'];
         $hiperc2=$hipercDetalle['Iperc2'];

         $hiperc1a="";$hiperc1b="";$hiperc1c="";$hiperc2a="";$hiperc2b="";$hiperc2c="";
         if($hiperc1 >0 && $hiperc1<9){
            $hiperc1a=$hiperc1;
        }
        else if($hiperc1 >8 && $hiperc1<16){
            $hiperc1b=$hiperc1;
        }
        else if($hiperc1 >15 && $hiperc1<26){
            $hiperc1c=$hiperc1;
        }
        //////// h 2/////////////////
        if($hiperc2 >0 && $hiperc2<9){
            $hiperc2a=$hiperc2;
        }
        else if($hiperc2 >8 && $hiperc2<16){
            $hiperc2b=$hiperc2;
        }
        else if($hiperc2 >15 && $hiperc2<26){
            $hiperc2c=$hiperc2;
        }


	$content .= '
		<tr>
            <td width="73mm">'.$hipercDetalle['Peligro'].'</td>
            <td width="72mm">'.$hipercDetalle['Riesgo'].'</td>
            <td width="10mm" style="display: inline; text-align: center">'.$hiperc1a.'</td>
            <td width="10mm" style="display: inline; text-align: center">'.$hiperc1b.'</td>
            <td width="10mm" style="display: inline; text-align: center">'.$hiperc1c.'</td>
            <td width="72mm">'.$hipercDetalle['Control'].'</td>
            <td width="10mm" style="display: inline; text-align: center">'.$hiperc2a.'</td>
            <td width="10mm" style="display: inline; text-align: center">'.$hiperc2b.'</td>
            <td width="10mm" style="display: inline; text-align: center">'.$hiperc2c.'</td>
        </tr>
	';
	}
	
	$content .= '</table>';
	
	//FIN IPERC=========================

    //SECUENCIA CONTROL==========================
    $content .= '
		<table border="1" cellpadding="5">
        <thead>
          <tr bgcolor="#a9a9a9" color="#fff">
			<th colspan="4">SECUENCIA  PARA CONTROLAR EL PELIGRO Y REDUCIR EL NIVEL DE RIESGO</th>
          </tr>
        </thead>
		<tbody>
		<tr>
			<td colspan="4">'.$secuenciaControl[0].'</td>
		</tr>
		<tr>
			<td colspan="4">'.$secuenciaControl[1].'</td>
		</tr>
		<tr>
			<td colspan="4">'.$secuenciaControl[2].'</td>
		</tr>
		<tr>
			<td colspan="4">'.$secuenciaControl[3].'</td>
		</tr>
		<tr>
			<td colspan="4">'.$secuenciaControl[4].'</td>
		</tr>
		</tbody>
		</table>
	';

    //FIN SECUENCIA CONTROL=========================

	//DATOS DEL SUPERVIDOR==========================
	$content .= '
		<table border="1" cellpadding="5">
        <thead>
          <tr bgcolor="#a9a9a9" color="#fff">
			<th colspan="4">DATOS DE LOS SUPERVISORES</th>
          </tr>
        </thead>
		<tbody>
		<tr>
			<td>HORA</td>
			<td>NOMBRE SEL SUPERVISOR</td>
			<td>MEDIDA CORRECTIVA</td>
			<td>FIRMA</td>
		</tr>';
	
	$id = 0;
        $fecha = '';
        $secuenciaControl = '';
        $nombreSupervisor = '';
        $medidaCorrectiva = '';

        while ($reporteHiper = $reporteHipers->fetch_assoc()) {
            $id = $reporteHiper['Id'];
            $fecha = $reporteHiper['Fecha'];
            $secuenciaControl = $reporteHiper['SecuenciaControl'];
            $nombreSupervisor = $reporteHiper['Nombre'];
            $medidaCorrectiva = $reporteHiper['Control'];
            $content .= '
    		<tr>
    			<td>'.date("H:i", strtotime($fecha)).'</td>
    			<td>'.$nombreSupervisor.'</td>
    			<td>'.$medidaCorrectiva.'</td>
    			<td>***********</td>
    		</tr>';
        }
        $reporteHipers->free();
		
		
		$content .='</tbody></table>;';

	//FIN DATOS SUPERVISOR=========================
	
	
	$pdf->writeHTML($content, true, 0, true, 0);

	$pdf->lastPage();
	$pdf->output('IPERC.pdf', 'I');
}

?>

	<div class="container-fluid">
        <div class="row padding">
        	<div class="col-md-12">
            	<?php $h1 = "LISTADO DE  IPERC CONTINUO";
            	 echo '<h1>'.$h1.'</h1>'
				?>
            </div>
        </div>
      <table class="table table-hover">
        <thead>
          <tr>
			<th>CODIGO</th>
            <th>FECHA</th>           
            <th>SECUENCIA DE CONTROL</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        <?php
        $id=0;
        while ($listado=$listadoGeneral->fetch_assoc()) {   ?>
            <?php $id= $listado['Id']; 
                $secuencia = split(',',$listado['SecuenciaControl']);
            ?>
            <tr class="<?php if($listado['activo']=='A'){ echo 'active';}else{ echo 'danger';} ?>">
                <td><?php echo $listado['Id']; ?></td>
                <td><?php echo $listado['Fecha']; ?></td>
                <td>
                    <?php 
                    if ($secuencia[0]) echo $secuencia[0].','; 
                    if ($secuencia[1]) echo $secuencia[1].',';
                    if ($secuencia[2]) echo $secuencia[2].',';
                    if ($secuencia[3]) echo $secuencia[3].',';
                    if ($secuencia[4]) echo $secuencia[4].',';
                    ?>
                </td>
                <td><form method="post" action="list_document.php">
                	<input type="hidden" name="reporte_name" value="<?php echo $h1; ?>">
					<input type="hidden" name="reporte_id" value="<?php echo $listado['Id'];; ?>">
                	<input type="submit" name="create_pdf" class="btn btn-danger pull-right" value="Generar PDF" formtarget="_blank">
                </form>
                </td>

            </tr>
        <?php } ?>
        </tbody>
      </table>

    </div>