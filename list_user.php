<?php
session_start();
if($_SESSION["pin"]!= "1"){ header("location: index.php"); exit();}
	require_once('conexion/conexion.php');
	

?>

<script>
$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});

function readRecords() {
    $.get("table_user.php", {}, function (data, status) {
        $("#table-user").html(data);
    });
}

function addRecord() {
    // get values
    var username =  $("#username").val();
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var password = $("#password").val();
     var area = $("#sel1").val();
    
    if($("#user-form")[0].checkValidity()) {
        
        $.ajax({
                type: "POST",
                url: "addRecord.php",
                dataType: "json",
                data: ({
                    username: username,
                    first_name: first_name,
                    last_name: last_name,
                    password: password,
                    area: area
                }),
                beforeSend: function() {
                
                },
                success: function(data){
        if (data.code=='1'){
            // close the popup
            $("#add_new_record_modal").modal("hide");
     
            // read records again
            readRecords();
     
            // clear fields from the popup
            $("#first_name").val("");
            $("#last_name").val("");
            $("#password").val("");
        }else{
            $("#msj-alert").show();
            $("#msj-alert").html(data.msj);
        }
                },
                complete: function(){

                }
            });
        
    }else {
        $("#user-form")[0].reportValidity();
    }
 
    
}
</script>

	<div  class="container-fluid">
	        <!-- Bootstrap Modal - To Add New Record -->
        <!-- Modal -->
        <div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
        </div>
        <div class="modal-body">
        <form id="user-form">
         <div class="form-group">
        <label for="first_name">DNI</label>
        <input type="number" id="username" placeholder="DNI" required class="form-control" />
        </div>
        
        <div class="form-group">
        <label for="first_name">Nombres</label>
        <input type="text" id="first_name" placeholder="Nombres" required class="form-control" />
        </div>

        <div class="form-group">
        <label for="last_name">Apellidos</label>
        <input type="text" id="last_name" placeholder="Apellidos" required class="form-control" />
        </div>

        <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Contraseña" required class="form-control" />
        </div>

        <div class="form-group">
          <label for="sel1">Area:</label>
          <select class="form-control" id="sel1" name="sel1" required>
             <option value="1">Seguridad</option>
          <option value="2">Logistica</option>
           <option value="5">Operaciones</option>
          <option value="6">Supervisor</option>
          </select>
        </div>
        <div id="msj-alert" class="alert alert-danger" role="alert" style="display:none;">
        </div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="addRecord()">Agregar Usuario</button>
        </div>
        
        </div>
        </div>
        </div>
        <button class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal">Agregar Usuario</button>
        <div id="table-user">

        </div>
    </div>