<?php 
	require_once('conexion/conexion.php');
	

?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>LISTADO DE IPERC continuo</title>
<meta name="keywords" content="">
<meta name="description" content="">
<!-- Meta Mobil
================================================== -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style-login.css" rel="stylesheet">
<script src="js/jquery-3.3.1.min.js"></script>
</head>

<body>
	<div class="container-fluid">
        <div class="col-md-6 col-md-offset-3">
            <form id='login' class="modal-content animate" action='login_user.php' method='post' accept-charset='UTF-8'>
                <div class="form-group formulario">
                    <div class="text-center">
                        <img src="img/logo.png" alt="" width="50%" height="100">
                    </div>
                    <label for='username' >Usuario:</label>
                    <input type='text' name='username' id='username'  maxlength="50"  class="form-control" />
                    <br>
                    <label for='password' >Contrseñá*:</label>
                    <input type='password' name='password' id='password' maxlength="50"  class="form-control"/>
                    <br>

                    <div class="text-center">
                    <input type='submit' name='Submit' value='Inciar Sesión' class="btn btn-primary" />
                    </div>
                </div>
            </form>
        </div>
    </div>
 <script>
$("#login").submit(function(e) {


    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: url,
           dataType: 'json',
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {    
               if(data.acceso=="1"){
                    window.location.href= "main.php";
               }else{
                   alert("Usuario o Contraseña Incorrectos")
               }
           }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});  
</script>
</body>
</html>