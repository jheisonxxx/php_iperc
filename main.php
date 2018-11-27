<?php
/**
 * Created by PhpStorm.
 * User: AZETASOFT
 * Date: 24/11/2018
 * Time: 15:35
 */
session_start();
if($_SESSION["pin"]!= "1"){ header("location: index.php"); exit();}
	require_once('conexion/conexion.php');
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>PRINCIPAL - IPERC</title>
<meta name="keywords" content="">
<meta name="description" content="">
<!-- Meta Mobil
================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style-main.css" rel="stylesheet">
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function iperc_tabla()
        {
            $.ajax({
                type: "POST",
                url: "list_document.php",
                async:true,
                dataType: "html",
                data: ({
                    //pro_est:	$('#cmb_fil_pro_est').val()
                }),
                beforeSend: function() {
                    $('#div_contenido_tabla').addClass("ui-state-disabled");
                },
                success: function(html){
                    $('#div_contenido_tabla').html(html);
                },
                complete: function(){
                    $('#div_contenido_tabla').removeClass("ui-state-disabled");
                }
            });
        }
        function usuarios_tabla()
        {
            $.ajax({
                type: "POST",
                url: "list_user.php",
                async:true,
                dataType: "html",
                data: ({
                    //pro_est:	$('#cmb_fil_pro_est').val()
                }),
                beforeSend: function() {
                    $('#div_contenido_tabla').addClass("ui-state-disabled");
                },
                success: function(html){
                    $('#div_contenido_tabla').html(html);
                },
                complete: function(){
                    $('#div_contenido_tabla').removeClass("ui-state-disabled");
                }
            });
        }
        function estadisticas_tabla()
        {
            $.ajax({
                type: "POST",
                url: "estadisticas.php",
                async:true,
                dataType: "html",
                data: ({
                    //pro_est:	$('#cmb_fil_pro_est').val()
                }),
                beforeSend: function() {
                    $('#div_contenido_tabla').addClass("ui-state-disabled");
                },
                success: function(html){
                    $('#div_contenido_tabla').html(html);
                },
                complete: function(){
                    $('#div_contenido_tabla').removeClass("ui-state-disabled");
                }
            });
        }

        $(document).ready(function() {
            iperc_tabla();
            $("#sidebarCollapse").on("click", function() {
                $("#sidebar").toggleClass("active");
                $(this).toggleClass("active");
            });

            $("#lista_usuarios").on("click", function() {
                usuarios_tabla();
                $("#sidebar>ul>li.active").removeClass("active");
                $("#lista_usuarios").toggleClass("active");
            });
            $("#estadisticas").on("click", function() {
                estadisticas_tabla();
                $("#sidebar>ul>li.active").removeClass("active");
                $("#estadisticas").toggleClass("active");
            });
        });
    </script>

</head>

<body>
    <div class="wrapper">
      <!-- Sidebar Holder -->
      <nav id="sidebar">
        <div class="sidebar-header">
            <div class="text-center blanco">
                <img src="img/logo.png" alt="" width="70%">
            </div>

        </div>
        <ul class="list-unstyled components">
          <li  class="active">
            <a href="#" onclick="window.location.reload(true)">INICIO</a>
          </li>
          <li id="lista_usuarios" class="lista_usuarios">
            <a href="#">USUARIOS</a>
          </li>
          <li id="estadisticas" class="estadisticas">
            <a href="#">ESTADISTICAS</a>
          </li>
        </ul>

      </nav>

      <!-- Page Content Holder -->
      <div id="content">

        <nav class="navbar navbar-default">
          <div class="container-fluid">
                <div class="col-md-12">
                <div class="navbar-header">
                  <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                      <i class="glyphicon glyphicon-align-left"></i>
                      <span>Menú</span>
                  </button>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                      <a href="#"><?php echo $_SESSION["usuario_nombre"]; ?></a>
                      <a href="cerrar_sesion.php"><button type="button"  class="btn btn-default btn-lg">
                         <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Salir
                      </button>
                      </a>
                  </ul>
                </div>
              </div>
          </div>
        </nav>

<!--        <h2>Collapsible Sidebar Using Bootstrap 3</h2>-->
<!--        <p class="lead">This pen is a part of a <a href="https://bootstrapious.com/p/bootstrap-sidebar">Bootstrap sidebar tutorial</a> from Bootstrapious.com. CC-BY licensed.</p>-->
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure-->
<!--          dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>-->
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure-->
<!--          dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>-->
<!---->
<!--        <div class="line"></div>-->
<!---->
<!--        <h2>Lorem Ipsum Dolor</h2>-->
<!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure-->
<!--          dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>-->
          <div id="div_contenido_tabla" class="contenido_tabla">
          </div>

          <div id="div_usuario_form" class="div_usuario_form">
          </div>


      </div>
    </div>
</body>
