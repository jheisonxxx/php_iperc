<?php
/**
 * Created by PhpStorm.
 * User: AZETASOFT
 * Date: 24/11/2018
 * Time: 18:33
 */
session_start();
if($_SESSION["pin"]!= "1"){ header("location: index.php"); exit();}
require_once('conexion/conexion.php');


$sql = 'SELECT Control,Riesgo, Peligro FROM tblIPERCDetalleEvaluacion';
$datos=$mysqli->query($sql);
$control="";
$riesgo="";
$peligro="";
while($r = $datos->fetch_assoc()) {
    $control.=$r['Control'].',';
    $riesgo.=$r['Riesgo'].',';
    $peligro.=$r['Peligro'].',';
}

$array_control = array_map('trim', explode(',', $control));
$array_riesgo = array_map('trim', explode(',', $riesgo));
$array_peligro = array_map('trim', explode(',', $peligro));

?>

<script type="text/javascript">
    $(document).ready(function () {

    });
</script>

	<div  class="col-md-12">
        <?php
        //function to test if a value is 1
        function not1($var) { return ($var != 1);}

        $array1freq1 = array_count_values($array_control);
        $array1freq2 = array_count_values($array_riesgo);
        $array1freq3 = array_count_values($array_peligro);

        //filter the frequency array to only keep the duplicates
        $array1dup1 = array_filter($array1freq1, "not1");
        $array1dup2 = array_filter($array1freq2, "not1");
        $array1dup3 = array_filter($array1freq3, "not1");
        ?>
        <p>Conteo automático de ocurrencias por cada criterio, ya sea Riesgo, Controles o Peligros.</p>
        <table  class="table table-bordered">
            <tr>
                <th>CONTROLES</th>
                <th>N° VECES</th>
            </tr>
            <?php foreach ($array1dup1 as $key => $value) {
                echo "<tr>";
                echo "<td>".$key."</td>";
                echo "<td>".$value."</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <table  class="table table-bordered">
            <tr>
                <th>RIESGOS</th>
                <th>N° VECES</th>
            </tr>
            <?php foreach ($array1dup2 as $key => $value) {
                echo "<tr>";
                echo "<td>".$key."</td>";
                echo "<td>".$value."</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <table  class="table table-bordered">
            <tr>
                <th>PELIGROS</th>
                <th>N° VECES</th>
            </tr>
            <?php foreach ($array1dup3 as $key => $value) {
                echo "<tr>";
                echo "<td>".$key."</td>";
                echo "<td>".$value."</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>