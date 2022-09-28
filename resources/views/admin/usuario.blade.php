@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<div class="card">
  <div class="card-header">
      <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Bases de Datos - DGTG</h1>
  </div>
  <div class="card-body">
    <h4 class="card-subtitle"> <i class="fas fa-users-cog"></i> Módulo de Usuarios</h4>
  </div>
</div>

@stop

@section('content')



  <div class="card" id="content">
    <div class="card-body">
        <p>
             <a href="" type="button" id="consultaUsuarios" class="btn btn-secondary" >CONSULTAR USUARIOS <i class="fas fa-user-check"></i></a>
             <a href="" type="button" id="agregarUsuario" class="btn btn-success" >AGREGAR USUARIO <i class="fas fa-user-plus"></i></a>
        </p>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <table id="tablaUsuarios" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                {{-- <th data-name='matricula'>Nombre</th> --}}
                <th>ID</th>
                {{-- <th>RFC</th> --}}
                <th>NOMBRE</th>
                <th>OFICINA</th>
                <th>PERFIL</th>
                <th>ESTADO</th>
                <th>ACCIÓN</th>
                {{-- <th>Acción</th> --}}
            </tr>
          </thead>
        </table>
    </div>
  </div>

  {{-- editar usuario  --}}
<div class="modal fade" id="modalusuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" >
  <div class="modal-dialog modal-lg" style="min-width:70%" role="document" >
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 font-weight-bold" id="tituloModal" ></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
       <form class="form-usuario" id="form-usuario" action="javascript:void(0);" method="PUT" enctype="multipart/form-data">

         @csrf
       <div class="container-fluid">
         <div class="from-group row col-md-12" id="modalc1">
         </div>
         <div id="printThis"> {{-- zona imprimible--}}


            <div class="from-group row col-md-12" id="modalc2">
            </div>

         </div>{{-- fin zona imprimible--}}
       </div>
        <div class="modal-footer d-flex justify-content-center">
          <div class="btn-group" role="group" aria-label="Basic example" id="footermodal" >
          </div>
          {{-- <button class="btn btn-default">Login</button> --}}
        </div>
      </form>
    </div>
  </div>
</div>
</div>
{{-- fin editar usuario --}}





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script>

    $(document).ready(function(){
      $('#consultaUsuarios').click(function(event){
        event.preventDefault();
        var tablaUsuarios = $('#tablaUsuarios').DataTable();
        tablaUsuarios.destroy();
        $('#tablaUsuarios').DataTable({
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
              },
              "responsive": true,
              "processing": true,
            //"serverSide": true,
              "ajax":{
                 "url": "/admin/usuario",
                 "type": 'GET',
                 //"dataType": 'json',
                 "data":{
                   // al_id:{{ Auth::user()->id }},
                 }
              },
              "columns":[
                 {"data": "id" },
                 {"data": "name" },
                 // {"data": "empr_rfc" },
                 {"data": "OFICINA" },
                 {"data": "PERFIL" },
                 {"data": "ESTADO" },
                 {"data": "action", className: 'dt-center', },
                 //{"data": "empeval_cantidad_espacios" },
                //{"defaultContent":   "accion",
                  // render: function ( data, type, row ) {
                  //     if ( type === 'display' ) {
                  //         return '<input type="checkbox" id="'+row.empr_id+'" class="editor-active">';
                  //     }
                  //     return data;
                  // }
                 //}
              ],
          });
    });

    $(document).on("click", "#editarusuario", function(){
      event.preventDefault();
      //para tabla responsive
      var fila = $(this.closest("tr"));
      if(fila.hasClass("child")){
          fila = fila.prev();
      }
      //console.log(fila); // returning array of row data
      //fila = $(this).closest("tr"); // tabla estática
      id = fila.find('td:eq(0)').text();
      ofi = fila.find('td:eq(2)').text();
      perf = fila.find('td:eq(3)').text();
      est = fila.find('td:eq(4)').text();
      $('#modalc1').empty();
      $('#modalc2').empty();
      $('#footermodal').empty();

      $.ajax({
        url: "/admin/usuario/"+id+"",
        type: 'GET',
        // async: false,
        dataType: 'json',
        data: {
            // _token: $('input[name="_token"]').val(),
            // enco_id:enco_id,

        },
        success: function(response) {

          console.log(response);

          //construir forma
            id =  "<div class='form-group col-md-12 ml-auto'> <input value='"+response[0][0].id+"' name='id' type='text' id='id' class='form-control validate' hidden></div> ";
            nombre =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NOMBRE</label> <input value='"+response[0][0].name+"' name='nombre' type='text' id='nombre' class='form-control validate' placeholder='Nombre del usuario'></div> ";
            email =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>CORREO</label> <input value='"+response[0][0].email+"' name='email' type='email' id='email' class='form-control validate' placeholder='Correo electrónico...'></div> ";
            oficina =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>OFICINA</label> <select class='form-control select2' id='selOficina' name='CVE_OFICINA'><option value='' disabled selected>Seleciona una oficina...</option>");
            perfil =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>PERFIL</label> <select class='form-control select2' id='selPerfil' name='ID_PERFIL'><option value='' disabled selected>Seleciona un perfil...</option>");
            estado =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>ESTADO</label> <select class='form-control select2' id='selEstado' name='CVE_ESTADO'><option value='' disabled selected>Seleciona un estado de usuario...</option>");
            pwd =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>PASSWORD</label> <input value='' name='pwd' type='text' id='pwd' class='form-control validate' placeholder='Contraseña...'></div> ";
            footermodal = "<button class='btn btn-success' id='updateUsuario' >Guardar</button><button class='btn btn-warning' id='printEvaluacion' onclick='PrintContent()' >Imprimir</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";

            $('#tituloModal').html("<i class='fas fa-user-edit'></i> - Editar Usuario ");
            $("#modalc1").append(nombre);
            $("#modalc1").append(oficina);
            for (var j = 0; j < response[2].length; j++) {
                if (ofi == response[2][j].OFICINA) {
                  selected='selected';
                }else {
                  selected='';
                }
                $("#selOficina").append("<option value='"+response[2][j].CVE_OFICINA+"' "+selected+ ">"+response[2][j].OFICINA+"</option>");
              }
            $("#modalc1").append(perfil);
            for (var j = 0; j < response[3].length; j++) {
                if (perf == response[3][j].name) {
                  selected='selected';
                }else {
                  selected='';
                }
                $("#selPerfil").append("<option value='"+response[3][j].id+"' "+selected+ ">"+response[3][j].name+"</option>");
              }
            $("#modalc1").append(estado);
            for (var j = 0; j < response[1].length; j++) {
                if (est == response[1][j].ESTADO) {
                  selected='selected';
                }else {
                  selected='';
                }
                $("#selEstado").append("<option value='"+response[1][j].CVE_ESTADO+"' "+selected+ ">"+response[1][j].ESTADO+"</option>");
              }
            $("#modalc1").append(email);
            $("#modalc1").append(pwd);
            $("#footermodal").append(footermodal);
            $("#footermodal").append(id);
          //fin construir la forma

          $('#modalusuario').modal('show');
          $('#modalusuario').on('hide.bs.modal', function () {
          //  alertify.warning('Edición Cancelada');
          });

        },
        error: function(response) {
            console.log(response);
        },
      });
    });

    $(document).on("click", "#updateUsuario", function(){
      event.preventDefault();

      var data = new FormData(document.getElementById("form-usuario"));

      data.append('_method', 'PUT');


      for (var value of data.values()) {
        console.log(value);
      }
      alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
        return {
            main:function(content){
                this.setContent(content);
            }
        };
      });
      alertify.confirm('ACTUALIZACIÓN DE DATOS DE USUARIO ','Actuaizar usuario: '+data.get('nombre')+'', function(){

        $.ajax({
          url: '/admin/usuario/'+data.get('id'),
          type: 'POST',
          headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
          processData: false,
          contentType: false,
          dataType: 'json',
          cache:false,
          data:data,

          success: function(response) {
            //validando formulario
            if(response.errors)
            {


              $.each(response.errors, function(key, value){
                var msg = alertify.error(value+"<br><button class='btn btn-danger'>Cerrar</button>",10000);
                msg.callback = function (isClicked) {
                        if(isClicked)
                            console.log('notification dismissed by user');
                        else
                            console.log('notification auto-dismissed');
                };
              });
              $(response.errors).empty();
            }
            else
            {
              $('#modalusuario').modal('hide');
              alertify.success ("Actualizado con éxito: <br>"+data.get('nombre'));
              if ($('.sorting_1').length)
              {
                $('#tablaUsuarios').DataTable().ajax.reload();
              }
              console.log(response);
            }


          },
          error: function(response) {

            alertify.error("Error actualizando usuario: <br>"+data.get('nombre'));
              for (var value of data.values()) {
                console.log(value);
                }
            console.log(response);
          //  console.log(xhr.status);
          //  console.log(xhr.responseText);
          //  console.log(thrownError);

          },
        });

      },function(){


        alertify.error('Actualización Cancelada')

      });

    });


    $(document).on("click", "#agregarUsuario", function(){
      event.preventDefault();
      $('#modalc1').empty();
      $('#modalc2').empty();
      $('#footermodal').empty();

      $.ajax({
        url: "/admin/usuario/create",
        type: 'GET',
        // async: false,
        dataType: 'json',
        data: {
            // _token: $('input[name="_token"]').val(),
            // enco_id:enco_id,

        },
        success: function(response) {

          console.log(response);

          //construir forma
            //id =  "<div class='form-group col-md-12 ml-auto'> <input value='"+response[0][0].id+"' name='id' type='text' id='id' class='form-control validate' hidden></div> ";
            nombre =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>NOMBRE</label> <input value='' name='nombre' type='text' id='nombre' class='form-control validate' placeholder='Nombre del usuario...'></div> ";
            oficina =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>OFICINA</label> <select class='form-control select2' id='selOficina' name='CVE_OFICINA'><option value='' disabled selected>Seleciona una oficina...</option>");
            perfil =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>PERFIL</label> <select class='form-control select2' id='selPerfil' name='ID_PERFIL'><option value='' disabled selected>Seleciona un perfil...</option>");
            estado =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>ESTADO</label> <select class='form-control select2' id='selEstado' name='CVE_ESTADO'><option value='' disabled selected>Seleciona un estado de usuario...</option>");
            email =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>CORREO</label> <input value='' name='email' type='email' id='email' class='form-control validate' placeholder='Correo electrónico...'></div> ";
            pwd =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_nombre'>PASSWORD</label> <input value='' name='pwd' type='text' id='pwd' class='form-control validate' placeholder='Contraseña...'></div> ";
            footermodal = "<button class='btn btn-success' id='createUsuario' >Crear</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";

            $('#tituloModal').html("<i class='fas fa-user-plus'></i> - Agregar Usuario ");
            $("#modalc1").append(nombre);
            $("#modalc1").append(oficina);
            for (var j = 0; j < response[1].length; j++) {

                $("#selOficina").append("<option value='"+response[1][j].CVE_OFICINA+"' "+">"+response[1][j].OFICINA+"</option>");
              }
            $("#modalc1").append(perfil);
            for (var j = 0; j < response[2].length; j++) {

                $("#selPerfil").append("<option value='"+response[2][j].id+"' "+">"+response[2][j].name+"</option>");
              }
              $("#modalc1").append(estado);
              for (var j = 0; j < response[0].length; j++) {

                  $("#selEstado").append("<option value='"+response[0][j].CVE_ESTADO+"' "+">"+response[0][j].ESTADO+"</option>");
                }
            $("#modalc1").append(email);
            $("#modalc1").append(pwd);
            $("#footermodal").append(footermodal);
            //$("#footermodal").append(id);
          //fin construir la forma

          $('#modalusuario').modal('show');
          $('#modalusuario').on('hide.bs.modal', function () {
          //  alertify.warning('Edición Cancelada');
          });

        },
        error: function(response) {
            console.log(response);
        },
      });
    });

    $(document).on("click", "#createUsuario", function(){
      event.preventDefault();

      var data = new FormData(document.getElementById("form-usuario"));

      //data.append('_method', 'PUT');


      for (var value of data.values()) {
        console.log(value);
      }
      alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
        return {
            main:function(content){
                this.setContent(content);
            }
        };
      });
      alertify.confirm('CREAR NUEVO USUARIO ','Se va a crear el siguiente usuario: '+data.get('nombre')+'', function(){

        $.ajax({
          url: '/admin/usuario',
          type: 'POST',
          headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
          processData: false,
          contentType: false,
          dataType: 'json',
          cache:false,
          data:data,

          success: function(response) {
            //validando formulario
            if(response.errors)
            {


              $.each(response.errors, function(key, value){
                var msg = alertify.error(value+"<br><button class='btn btn-danger'>Cerrar</button>",10000);
                msg.callback = function (isClicked) {
                        if(isClicked)
                            console.log('notification dismissed by user');
                        else
                            console.log('notification auto-dismissed');
                };
              });
              $(response.errors).empty();
            }
            else
            {
              $('#modalusuario').modal('hide');
              alertify.success ("Se creo con éxito: <br>"+data.get('nombre'));
              if ($('.sorting_1').length)
              {
                $('#tablaUsuarios').DataTable().ajax.reload();
              }
              console.log(response);
            }


          },
          error: function(response) {

            alertify.error("Error creando usuario: <br>"+data.get('nombre'));
              for (var value of data.values()) {
                console.log(value);
                }
            console.log(response);
          //  console.log(xhr.status);
          //  console.log(xhr.responseText);
          //  console.log(thrownError);

          },
        });

      },function(){


        alertify.error('Creacion Cancelada')

      });

    });

    $(document).on("click", "#eliminarusuario", function(){
      event.preventDefault();

      fila = $(this).closest("tr");
      id = fila.find('td:eq(0)').text();
      nombre = fila.find('td:eq(1)').text();
      alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
        return {
            main:function(content){
                this.setContent(content);
            }
        };
      });
      alertify.confirm('ELIMINACIÓN DE DATOS DE USUARIO ','Eliminar usuario: '+nombre+'', function(){

        $.ajax({
          url: '/admin/usuario/'+id ,
          type: 'DELETE',
          headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
          processData: false,
          contentType: false,
          dataType: 'json',
          cache:false,
        //  data:data,

          success: function(response) {
            //validando formulario
            if(response.errors)
            {


              $.each(response.errors, function(key, value){
                var msg = alertify.error(value+"<br><button class='btn btn-danger'>Cerrar</button>",10000);
                msg.callback = function (isClicked) {
                        if(isClicked)
                            console.log('notification dismissed by user');
                        else
                            console.log('notification auto-dismissed');
                };
              });
              $(response.errors).empty();
            }
            else
            {
              $('#modalusuario').modal('hide');
              alertify.success ("Se eliminó con éxito: <br>"+nombre );
              if ($('.sorting_1').length)
              {
                $('#tablaUsuarios').DataTable().ajax.reload();
              }
              console.log(response);
            }


          },
          error: function(response) {

            alertify.error("Error eliminando usuario: <br>"+nombre );
              for (var value of data.values()) {
                console.log(value);
                }
            console.log(response);
          //  console.log(xhr.status);
          //  console.log(xhr.responseText);
          //  console.log(thrownError);

          },
        });

      },function(){


        alertify.error('Eliminación Cancelada');

      });

    });



  });


  </script>
    <script> console.log('Hi!'); </script>
@stop
