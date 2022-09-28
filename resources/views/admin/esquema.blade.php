@extends('adminlte::page')

@section('title', 'Esquemas')

@section('content_header')
<div class="card">
  <div class="card-header">
      <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Bases de Datos - DGTG</h1>
  </div>
  <div class="card-body">
    <h4 class="card-subtitle"><i class="fas fa-table"></i> Módulo de Esquemas</h4>
  </div>
</div>

@stop

@section('content')



  <div class="card" id="content">
    <div class="card-body">
        <p>
             <a href="" type="button" id="consultaEsquemas" class="btn btn-secondary" >CONSULTAR ESQUEMAS <i class="fas fa-search"></i></a>
             <a href="" type="button" id="agregaEsquemas" class="btn btn-success" >AGREGAR ESQUEMAS <i class="fas fa-plus-circle"></i></i></a>
        </p>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <table id="tablaEsquemas" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>ESQUEMA</th>
                <th>USUARIO</th>
                <th>BASE</th>
                <th>DEPENDENCIA</th>
                <th>PROGRAMA</th>
                <th>RESPALDO</th>
                <th>TIPO</th>
                <th>ESTADO</th>
                <th>PWD</th>
                <th>OBSERVACIONES</th>
                <th>ACCIÓN</th>
            </tr>
          </thead>
        </table>
    </div>
  </div>

  {{-- Editar Esquema  --}}
<div class="modal fade" id="modalesquema" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
       <form class="form-esquema" id="form-esquema" action="javascript:void(0);" method="PUT" enctype="multipart/form-data">

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
{{-- fin Editar Esquema --}}





@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script>

              // DEPENDENCIA Change
        $('#selDependencia').change(function(){

           // entidad id
           var idd = $(this).val();
           console.log(idd);

           // liberar dropdown
           $('#selPrograma').find('option').not(':first').remove();

           // AJAX request
           $.ajax({
             url: '/admin/programa/'+idd,
             type: 'get',
             dataType: 'json',
             success: function(response){


                len = 0;
               if(response['data'] != null){
                  len = response['data'].length;

               }

               if(len > 0){
                  // Read data and create <option >
                  for(var i=0; i<len; i++){

                     var idpro = response['data'][i].CVE_DEPENDENCIA;
                     var pro = response['data'][i].NOMBRE;

                     var option = "<option value='"+idpro+"'>"+pro+"</option>";

                     $("#selPrograma").append(option);
                  }
               }

             }
           });
         });



    $(document).ready(function(){

      $('#consultaEsquemas').click(function(event){
        event.preventDefault();
        var tablaEsquemas = $('#tablaEsquemas').DataTable();
        tablaEsquemas.destroy();
        var tablaEsquemas =  $('#tablaEsquemas').DataTable({
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
              },
              "responsive": true,
              "processing": true,
              "serverSide": true,
              "ajax":{
                 "url": "/admin/esquema",
                 "type": 'GET',
                 //"dataType": 'json',
                 "data":{
                   // al_id:{{ Auth::user()->id }},
                 }
              },
              "columns":[
                 {"data": "id" },
                 {"data": "ESQUEMA" },
                 {"data": "name" },
                 {"data": "BASE" },
                 {"data": "NOMBRE" },
                 {"data": "PROGRAMA" },
                 {"data": "RESPALDO" },
                 {"data": "TIPO" },
                 {"data": "ESTADOESQUEMA" },
                 {"data": "PWD" },
                 {"data": "OBSERVACIONES" },
                 {"data": "ACTION", className: 'dt-center', },
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

    $(document).on("click", "#editaresquema", function(){
      event.preventDefault();
      //para tabla responsive
      var fila = $(this.closest("tr"));
      if(fila.hasClass("child")){
          fila = fila.prev();
      }
      //console.log(fila); // returning array of row data
      //fila = $(this).closest("tr"); // tabla estática
      id = fila.find('td:eq(0)').text();
      usu = fila.find('td:eq(2)').text();
      bas = fila.find('td:eq(3)').text();
      dep = fila.find('td:eq(4)').text();
      prog = fila.find('td:eq(5)').text();
      resp = fila.find('td:eq(6)').text();
      tip = fila.find('td:eq(7)').text();
      est = fila.find('td:eq(8)').text();


      $('#modalc1').empty();
      $('#modalc2').empty();
      $('#footermodal').empty();

      $.ajax({
        url: "/admin/esquema/"+id+"",
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
          id =  "<div class='form-group col-md-6 ml-auto'> <input value='"+response[0][0].id+"' name='id' type='text' id='id' class='form-control validate' hidden></div> ";
          esquema =  "<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='cmb_esquema'>ESQUEMA</label> <input value='"+response[0][0].ESQUEMA+"' name='esquema' type='text' id='esquema' class='form-control validate' placeholder='Nombre del Esquema'></div> ";
          usuario =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>USUARIO</label> <select class='form-control select2' id='selUsuario' name='CVE_USUARIO'><option value='' disabled selected>Seleciona una usuario..</option>");
          base =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>BASE</label> <select class='form-control select2' id='selBase' name='CVE_BASE'><option value='' disabled selected>Seleciona una base de datos...</option>");
          dependencia =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>DEPENDENCIA</label> <select class='form-control select2' id='selDependencia' name='CVE_DEPENDENCIA'><option value='' disabled selected>Seleciona una dependencia...</option>");
          programa =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>PROGRAMA</label> <select class='form-control select2' id='selPrograma' name='CVE_PROGRAMA'><option value='' disabled selected>Seleciona un programa...</option>");
          respaldo =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>RESPALDO</label> <select class='form-control select2' id='selRespaldo' name='CVE_BACKUP'><option value='' disabled selected>Seleciona una backup...</option>");
          tipo =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>TIPO</label> <select class='form-control select2' id='selTipo' name='CVE_TIPO'><option value='' disabled selected>Seleciona un tipo de esquema...</option>");
          estado =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>ESTADO</label> <select class='form-control select2' id='selEstadoesquema' name='CVE_ESTADOESQUEMA'><option value='' disabled selected>Seleciona un estado del esquema...</option>");
          observaciones =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='txt_observaciones'>OBSERVACIONES</label> <textarea value='' name='OBSERVACIONES' type='text' id='OBSERVACIONES' class='form-control validate' placeholder='Observaciones...'>"+response[0][0].OBSERVACIONES+"</textarea></div> ";
          pwd =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_PWD'>PASSWORD</label> <input value='"+response[0][0].PWD+"' name='PWD' type='text' id='PWD' class='form-control validate' placeholder='Contraseña...'></div> ";
          footermodal = "<button class='btn btn-success' id='updateEsquema' >Guardar</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";


            $('#tituloModal').html("<i class='fas fa-edit'></i> - Editar Esquema ");
            $("#modalc1").append(esquema);
            $("#modalc1").append(usuario);
            for (var j = 0; j < response[1].length; j++) {
                if (usu == response[1][j].name) {
                  selected='selected';
                }else {
                  selected='';
                }
                $("#selUsuario").append("<option value='"+response[1][j].id+"' "+selected+ ">"+response[1][j].name+"</option>");
              }
            $("#modalc1").append(base);
            for (var j = 0; j < response[2].length; j++) {
                if (bas == response[2][j].BASE) {
                  selected='selected';
                }else {
                  selected='';
                }
                $("#selBase").append("<option value='"+response[2][j].id+"' "+selected+ ">"+response[2][j].BASE+"</option>");
              }
            $("#modalc1").append(tipo);
            for (var j = 0; j < response[6].length; j++) {
                if (tip == response[6][j].TIPO) {
                  selected='selected';
                }else {
                  selected='';
                }
                $("#selTipo").append("<option value='"+response[6][j].id+"' "+selected+ ">"+response[6][j].TIPO+"</option>");
            }
            $("#modalc1").append(dependencia);
            for (var j = 0; j < response[3].length; j++) {
                if (dep == response[3][j].NOMBRE) {
                  selected='selected';
                }else {
                  selected='';
                }
                $("#selDependencia").append("<option value='"+response[3][j].CVE_DEPENDENCIA+"' "+selected+ ">"+response[3][j].NOMBRE+"</option>");
              }
            $("#modalc1").append(programa);
            for (var j = 0; j < response[4].length; j++) {
                if (prog == response[4][j].PROGRAMA) {
                  selected='selected';
                }else {
                  selected='';
                }
                $("#selPrograma").append("<option value='"+response[4][j].CVE_PROGRAMA+"' "+selected+ ">"+response[4][j].PROGRAMA+"</option>");
              }
            $("#modalc1").append(respaldo);
            for (var j = 0; j < response[5].length; j++) {
                if (resp == response[5][j].BACKUP) {
                  selected='selected';
                }else {
                  selected='';
                }
                $("#selRespaldo").append("<option value='"+response[5][j].id+"' "+selected+ ">"+response[5][j].BACKUP+"</option>");
              }
              $("#modalc1").append(estado);
              for (var j = 0; j < response[7].length; j++) {
                  if (est == response[7][j].ESTADOESQUEMA) {
                    selected='selected';
                  }else {
                    selected='';
                  }
                  $("#selEstadoesquema").append("<option value='"+response[7][j].id+"' "+selected+ ">"+response[7][j].ESTADOESQUEMA+"</option>");
                }
                $("#modalc1").append(pwd);
                $("#modalc2").append(observaciones);
            $("#footermodal").append(footermodal);
            $("#footermodal").append(id);
          //fin construir la forma

          $('#modalesquema').modal('show');
          $('#modalesquema').on('hide.bs.modal', function () {
          //  alertify.warning('Edición Cancelada');
          });




        },
        error: function(response) {
            console.log(response);
        },
      });
    });


    $(document).on("click", "#updateEsquema", function(){
      event.preventDefault();

      var data = new FormData(document.getElementById("form-esquema"));

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
      alertify.confirm('ACTUALIZACIÓN DE DATOS DE ESQUEMA ','Actuaizar esquema: '+data.get('esquema')+'', function(){

        $.ajax({
          url: '/admin/esquema/'+data.get('id'),
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
              $('#modalesquema').modal('hide');
              alertify.success ("Actualizado con éxito: <br>"+data.get('esquema'));
              if ($('.sorting_1').length)
              {
                $('#tablaEsquemas').DataTable().ajax.reload();
              }
              console.log(response);
            }


          },
          error: function(response) {

            alertify.error("Error actualizando esquema: <br>"+data.get('esquema'));
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


    $(document).on("click", "#agregaEsquemas", function(){
      event.preventDefault();

      $('#modalc1').empty();
      $('#modalc2').empty();
      $('#footermodal').empty();

      $.ajax({
        url: "/admin/esquema/create",
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
          //id =  "<div class='form-group col-md-6 ml-auto'> <input value='"+response[0][0].id+"' name='id' type='text' id='id' class='form-control validate' hidden></div> ";
          esquema =  "<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='cmb_esquema'>ESQUEMA</label> <input value='' name='esquema' type='text' id='esquema' class='form-control validate' placeholder='Nombre del Esquema'></div> ";
          usuario =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>USUARIO</label> <select class='form-control select2' id='selUsuario' name='CVE_USUARIO'><option value='' disabled selected>Seleciona una usuario..</option>");
          base =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>BASE</label> <select class='form-control select2' id='selBase' name='CVE_BASE'><option value='' disabled selected>Seleciona una base de datos...</option>");
          dependencia =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>DEPENDENCIA</label> <select class='form-control select2' id='selDependencia' name='CVE_DEPENDENCIA'><option value='' disabled selected>Seleciona una dependencia...</option>");
          programa =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>PROGRAMA</label> <select class='form-control select2' id='selPrograma' name='CVE_PROGRAMA'><option value='' disabled selected>Seleciona un programa...</option>");
          respaldo =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>RESPALDO</label> <select class='form-control select2' id='selRespaldo' name='CVE_BACKUP'><option value='' disabled selected>Seleciona una backup...</option>");
          tipo =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>TIPO</label> <select class='form-control select2' id='selTipo' name='CVE_TIPO'><option value='' disabled selected>Seleciona un tipo de esquema...</option>");
          estado =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>ESTADO</label> <select class='form-control select2' id='selEstadoesquema' name='CVE_ESTADOESQUEMA'><option value='' disabled selected>Seleciona un estado del esquema...</option>");
          observaciones =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='txt_observaciones'>OBSERVACIONES</label> <textarea value='' name='OBSERVACIONES' type='text' id='OBSERVACIONES' class='form-control validate' placeholder='Observaciones...'></textarea></div> ";
          pwd =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='cmb_PWD'>PASSWORD</label> <input value='' name='PWD' type='text' id='PWD' class='form-control validate' placeholder='Contraseña...'></div> ";
          footermodal = "<button class='btn btn-success' id='createEsquema' >Crear</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";


            $('#tituloModal').html("<i class='fas fa-edit'></i> - Crear Esquema ");
            $("#modalc1").append(esquema);
            $("#modalc1").append(usuario);
            for (var j = 0; j < response[0].length; j++) {
                $("#selUsuario").append("<option value='"+response[0][j].id+"' >"+response[0][j].name+"</option>");
              }
            $("#modalc1").append(base);
            for (var j = 0; j < response[1].length; j++) {
                $("#selBase").append("<option value='"+response[1][j].id+"' >"+response[1][j].BASE+"</option>");
              }
            $("#modalc1").append(tipo);
            for (var j = 0; j < response[5].length; j++) {
                $("#selTipo").append("<option value='"+response[5][j].id+"' >"+response[5][j].TIPO+"</option>");
            }
            $("#modalc1").append(dependencia);
            for (var j = 0; j < response[2].length; j++) {
                $("#selDependencia").append("<option value='"+response[2][j].CVE_DEPENDENCIA+"' >"+response[2][j].NOMBRE+"</option>");
              }
            $("#modalc1").append(programa);
            for (var j = 0; j < response[3].length; j++) {
                $("#selPrograma").append("<option value='"+response[3][j].CVE_PROGRAMA+"' >"+response[3][j].PROGRAMA+"</option>");
              }
            $("#modalc1").append(respaldo);
            for (var j = 0; j < response[4].length; j++) {
                $("#selRespaldo").append("<option value='"+response[4][j].id+"' >"+response[4][j].BACKUP+"</option>");
              }
              $("#modalc1").append(estado);
              for (var j = 0; j < response[6].length; j++) {
                  $("#selEstadoesquema").append("<option value='"+response[6][j].id+"' >"+response[6][j].ESTADOESQUEMA+"</option>");
                }
                $("#modalc1").append(pwd);
                $("#modalc2").append(observaciones);
            $("#footermodal").append(footermodal);

          //fin construir la forma

          $('#modalesquema').modal('show');
          $('#modalesquema').on('hide.bs.modal', function () {
          //  alertify.warning('Edición Cancelada');
          });

                      // DEPENDENCIA Change
                $('#selDependencia').change(function(){

                   // entidad id
                   var idd = $(this).val();
                  // console.log(idd);

                   // liberar dropdown
                   $('#selPrograma').find('option').not(':first').remove();

                   // AJAX request
                   $.ajax({
                     url: '/admin/programa/',
                     type: 'get',
                     dataType: 'json',
                     data: {
                         _token: $('input[name="_token"]').val(),
                          CVE_DEPENDENCIA:idd,
                     },
                     success: function(response){

                        len = 0;
                       if(response != null){
                          len = response.length;

                       }

                       if(len > 0){
                          // Read data and create <option >
                          for(var i=0; i<len; i++){

                             var idpro = response[i].CVE_PROGRAMA;
                             var pro = response[i].PROGRAMA;

                             var option = "<option value='"+idpro+"'>"+pro+"</option>";

                             $("#selPrograma").append(option);
                          }
                       }

                     }
                   });
                 });



        },
        error: function(response) {
            console.log(response);
        },
      });
    });


    $(document).on("click", "#createEsquema", function(){
      event.preventDefault();

      var data = new FormData(document.getElementById("form-esquema"));

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
      alertify.confirm('CREAR NUEVO ESQUEMA ','Se va a crear el siguiente usuario de BD: '+data.get('esquema')+'', function(){

        $.ajax({
          url: '/admin/esquema',
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
              $('#modalesquema').modal('hide');
              alertify.success ("Se creo con éxito: <br>"+data.get('esquema'));
              if ($('.sorting_1').length)
              {
                $('#tablaEsquemas').DataTable().ajax.reload();
              }
              console.log(response);
            }


          },
          error: function(response) {

            alertify.error("Error creando usuario de BD: <br>"+data.get('esquema'));
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

    $(document).on("click", "#eliminaresquema", function(){
      event.preventDefault();

      //para tabla responsive
      var fila = $(this.closest("tr"));
      if(fila.hasClass("child")){
          fila = fila.prev();
      }
      id = fila.find('td:eq(0)').text();
      nombre = fila.find('td:eq(1)').text();
      alertify.minimalDialog || alertify.dialog('minimalDialog',function(){
        return {
            main:function(content){
                this.setContent(content);
            }
        };
      });
      alertify.confirm('ELIMINACIÓN DE DATOS DE USUARIO DE BASE DE DATOS ','Eliminar esquema: '+nombre+'', function(){

        $.ajax({
          url: '/admin/esquema/'+id ,
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
              $('#modalesquema').modal('hide');
              alertify.success ("Se eliminó con éxito el esquema: <br>"+nombre );
              if ($('.sorting_1').length)
              {
                $('#tablaEsquemas').DataTable().ajax.reload();
              }
              console.log(response);
            }


          },
          error: function(response) {

            alertify.error("Error eliminando esquema: <br>"+nombre );
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
