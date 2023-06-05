@extends('adminlte::page')

@section('title', 'Restore')

@section('content_header')
<div class="card">
  <div class="card-header">
      <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Recursos Estratégicos - DGTG</h1>
  </div>
  <div class="card-body">
    <h4 class="card-subtitle fa-start"> <i class="fas fa-laptop-house"></i> Pruebas de Restauración </h4>
  </div>
</div>
@include('layouts.mensajes')
@stop

@section('content')
  <div class="card" id="content">
    <div class="card-body">
      <form>

        <div class="form-row">

                  <div class="form-group col-md-2">
                    {{ Form::label('inputDatacenter', 'CENTROS DE DATOS')}}
                    {{ Form::select('inputDatacenter',  $datacenters ,null, ['class' => 'form-control select2','id' => 'inputDatacenter','placeholder' => 'Todos los centros de datos...'],) }}
                  </div>
                  <div class="form-group col-md-2">
                    {{ Form::label('inputDatabase', 'BASES DE DATOS')}}
                    {{ Form::select('inputDatabase', ['' => 'Todas las bases de datos...'],null, ['class' => 'form-control select2','id' => 'inputDatabase'],) }}
                  </div>
                  <div class="form-group col-md-2">
                    {{ Form::label('inputFecha', 'FECHA')}}
                    {{ Form::date('inputFecha', 'Selecciona una fecha...', ['class' => 'form-control','id' => 'inputFecha'],) }}
                  </div>
                  <div class="form-group col-md-2">
                    {{ Form::label('inputBackup', 'TIPO DE BACKUP')}}
                    {{ Form::select('inputBackup', $backups ,null, ['class' => 'form-control select2','id' => 'inputBackup','placeholder' => 'Selecciona un tipo...'],) }}
                  </div>
                  <div class="form-group col-md-4">
                    <label for="none">&nbsp</label>
                    <br>
                    <a href="" type="button" onclick="limpiarFiltros()"  class="btn btn-light">LIMPIAR FILTROS <i class="fa fa-eraser"></i></a>
                  </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-12">
            <a href="" type="button" id="consultaTests" class="btn btn-secondary" >CONSULTAR <i class="fas fa-search"></i></a>
            @canany(['crear_bitacora'])
              <a href="" type="button" id="agregaTest" class="btn btn-success" >AGREGAR TEST <i class="fas fa-plus-circle"></i></a>
            @endcanany
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <table id="tablaBackups" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>FECHA</th>
                <th>ESQUEMA</th>
                <th>BASE</th>
                <th>ESTADO</th>
                <th>LOGS</th>
                <th>OBSERVACIONES</th>
                <th>REVISOR</th>
                <th>ACCIÓN</th>
            </tr>
          </thead>
        </table>
    </div>
  </div>

  {{-- Editar recovertest  --}}
  <div class="modal fade" id="modalrecover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
         <div id="printThis"> {{-- zona imprimible--}}
           <form class="form-test" id="form-test" action="javascript:void(0);" method="PUT" enctype="multipart/form-data">

             @csrf
           <div class="container-fluid">
             <div class="from-group row col-md-12" id="modalc1">
             </div>



                <div class="from-group row col-md-12" id="modalc2">
                </div>


           </div>
            <div class="modal-footer d-flex justify-content-center">
              <div class="btn-group" role="group" aria-label="Basic example" id="footermodal" >
              </div>
              {{-- <button class="btn btn-default">Login</button> --}}
            </div>
          </form>
        </div>{{-- fin zona imprimible--}}
      </div>
    </div>
  </div>
  </div>
  {{-- fin Editar Esquema --}}
@include('layouts.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/dba/css/admin_custom.css">
@stop

@section('js')

  <script>
    $("#inputDatacenter").val("");
    $("#inputDatabase").val("");
    $("#inputBackup").val("");
    $("#inputFecha").val("");

    function limpiarFiltros(){
    event.preventDefault();

    $("#inputDatacenter").val("");
    $("#inputDatabase").val("");
    $("#inputBackup").val("");
    $("#inputFecha").val("");

    }

          // DEPENDENCIA Change
    $('#inputDatacenter').change(function(){

      // cve_programa
      var idd = $(this).val();
      console.log(idd);

      // liberar dropdown
      $('#inputDatabase').find('option').not(':first').remove();
      //$('#inputBackup').find('option').not(':first').remove();

      if (idd!='' ) {


        // AJAX request
        $.ajax({
          url: "{{route('base.bydc','')}}"+"/"+idd,
          type: 'get',
          dataType: 'json',
          success: function(response){

          len = 0;
          if(response.length != null){
            len = response.length;
          }

          if(len > 0){
            // Read data and create <option >
            for(var i=0; i<len; i++){

              var iddb = response[i].id;
              var db = response[i].base;

              var option = "<option value='"+iddb+"'>"+db+"</option>";

              $("#inputDatabase").append(option);
            }
          }

          }
        });
      }
     });

    $(document).ready(function(){
      $('#consultaTests').click(function(event){
        event.preventDefault();
        var tablaBackups = $('#tablaBackups').DataTable();
        tablaBackups.destroy();
        var tablaBackups =  $('#tablaBackups').DataTable({
              "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
              },
              "responsive": true,
              "processing": true,
              "serverSide": true,
              "ajax":{
                 "url": "{{route('recovere.index')}}",
                 "type": 'GET',
                 //"dataType": 'json',
                 "data":{
                   // al_id:{{ Auth::user()->id }},
                  cve_datacenter:$("#inputDatacenter").val(),
                  cve_base:$("#inputDatabase").val(),
                  cve_backup:$("#inputBackup").val(),
                  cve_fecha:$("#inputFecha").val(),
                 }
              },

              "columns":[
                 {"data": "id" },
                 {"data": "fecha" },
                 {"data": "esquema" },
                 {"data": "base" },
                 {"data": "estatusrecovert" },
                 {"data": "archivos",
                    render: function ( data, type, row, meta ) {
                          urls = JSON.parse(data.replace(/&quot;/g,'"'));
                          //console.log(urls.lengt);
                          var urls2 = '';
                          var j=0;
                          for (var i = 0; i < urls.length; i++) {
                            if (urls[i]) {
                              j++;
                              //urls2 =  urls2 + '<a href="/admin/getlogs/'+urls[i]+'">logfile '+ (i+1) +'</a> <br>';
                              urls2 =  urls2 + '<a style="color:green;" href="{{route('getlogs.get.r','')}}'+'/'+urls[i]+'">logfile '+ j +'</a> <br>';
                            }
                        }
                      return urls2;
                    }
                 },
                 {"data": "observaciones"                  },
                 {"data": "name" },
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
      $(document).on("click", "#agregaTest", function(){
        event.preventDefault();

        $('#modalc1').empty();
        $('#modalc2').empty();
        $('#footermodal').empty();

        $.ajax({
          url: "{{route('recovere.create')}}",
          type: 'GET',
          // async: false,
          dataType: 'json',
          data: {
              // _token: $('input[name="_token"]').val(),
              cve_datacenter:$("#inputDatacenter").val(),
              cve_base:$("#inputDatabase").val(),
              cve_fecha:$("#inputFecha").val(),
              cve_backup:$("#inputBackup").val(),

          },
          success: function(response) {

            //console.log(response);
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
              }else{
                if (response[0].length) {
                  //construir forma
                  fecha =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='bitdate'>FECHA</label><input readonly value='"+$("#inputFecha").val()+"' name='bitdate' type='date' id='bitdate' class='form-control validate'> </div>");
                  cve_backup =  ("<div class='form-group col-md-3 ml-auto' id='cvebackup'><label data-error='error' data-success='ok' for='cve_backup'>TIPO DE BACKUP</label> </div>");

                  cve_esquema =  "<div class='form-group col-md-1 ml-auto' id='cveesquema'><label data-error='error' data-success='ok' for='cve_esquema'>ESQUEMA</label> </div> ";
                  cve_bitrecord =  "<div class='form-group col-md-1 ml-auto' id='cvebitrecord'><label data-error='error' data-success='ok' for='cve_bitrecord'>BITÁCORA</label> </div> ";
                  esquema =  "<div class='form-group col-md-3 ml-auto' id='esquema'><label data-error='error' data-success='ok' for='esquema'>NOMBRE ESQUEMA</label> </div> ";
                  base =  "<div class='form-group col-md-2 ml-auto' id='base'><label data-error='error' data-success='ok' for='cmb_base'>BASE</label></div> ";
                  estado =  ("<div class='form-group col-md-2 ml-auto' id='estado'><label data-error='error' data-success='ok' for='sel'>ESTADO</label> </div>");
                  archivos =   "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='recovere_archivos' >ARCHIVOS (Selección multiple - Sólo arcvhivos tar.gz son permitidos)</label><input type='file' class='filestyle' data-text='archivos' data-btnClass='btn-success'  data-buttonBefore='true' data-badge='true' data-placeholder='Ningún archivo seleccionado...' name='recovere_archivos[]' id='recovere_archivos' multiple ></div>";
                  archivosbit =   "<div class='form-group col-md-12 ml-auto' id='archivosbitacora'><label data-error='error' data-success='ok' for='recovere_archivosbit' >LOGS DE BACKUP EN BITÁCORA</label></div>";
                  observaciones =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='txt_observaciones'>OBSERVACIONES</label> <textarea value='' name='observaciones' type='text' id='observaciones' class='form-control validate' placeholder='Observaciones...'></textarea></div> ";
                  usuario =  ("<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='sel'>REVISOR</label> <select readonly class='form-control select2' id='selUsuario' name='selUsuario'><option value='{{ Auth::user()->id}}'>{{ Auth::user()->name }}</option>");
                  ndata =  ("<div class='form-group col-md-12 ml-auto'><input hidden value='"+response[0].length+"' name='ndata' type='text' id='ndata' class='form-control validate'></div>");
                  footermodal = "<button class='btn btn-success' id='createTest' >Crear</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
                  $.getScript( "/dba/assets/bootstrap-filestyle.min.js", function( data, textStatus, jqxhr ) {
                  // console.log( data ); // Data returned
                  // console.log( textStatus ); // Success
                  // console.log( jqxhr.status ); // 200
                  // console.log( "Load was performed." );
                  });


                    $('#tituloModal').html("<i class='fas fa-edit'></i> - Registrar Prueba de Recuperación");
                    $("#modalc1").append(fecha);
                    $("#modalc1").append(cve_bitrecord);

                      for (var i = 0; i < response[0].length; i++) {
                        $("#cvebitrecord").append("<input value='"+response[3].id+"' name='cve_bitrecord["+i+"]' type='text' id='cve_bitrecord"+i+"' class='form-control validate' readonly>");
                      }
                    $("#modalc1").append(cve_esquema);

                      for (var i = 0; i < response[0].length; i++) {
                        $("#cveesquema").append("<input value='"+response[0][i].cve_esquema+"' name='cve_esquema["+i+"]' type='text' id='cve_esquema"+i+"' class='form-control validate' readonly>");
                      }

                    $("#modalc1").append(esquema);

                      for (var i = 0; i < response[0].length; i++) {
                        $("#esquema").append("<input readonly value='"+response[0][i].esquema+"' name='esquema["+i+"]' type='text' id='esquema"+i+"' class='form-control validate'>");
                      }

                    $("#modalc1").append(base);

                      for (var i = 0; i < response[0].length; i++) {
                        $("#base").append("<input readonly value='"+response[0][i].base+"' name='base["+i+"]' type='text' id='base"+i+"' class='form-control validate'>");
                      }
                    $("#modalc1").append(cve_backup);

                      for (var i = 0; i < response[0].length; i++) {
                          $("#cvebackup").append("<select readonly class='form-control select2' id='selBackup"+i+"' name='selBackup["+i+"]'><option value='' disabled >Seleciona un tipo de backup...</option>");
                            for (var j = 0; j < response[2].length; j++) {

                              if (response[0][i].backup == response[2][j].backup) {
                                selected='selected';
                              }else if (response[0][i].backup == response[2][j].backup) {
                                selected='selected';
                              }else if (response[0][i].backup == response[2][j].backup) {
                              selected='selected';
                              }else{
                                selected='';
                              }
                            $("#selBackup"+i+"").append("<option value='"+response[2][j].id+"' "+selected+ " >"+response[2][j].backup+"</option>");
                            }
                          }
                    $("#modalc1").append(estado);

                      for (var i = 0; i < response[0].length; i++) {
                          $("#estado").append("<select readonly class='form-control select2' id='selEstadoBackup"+i+"' name='selEstadoBackup["+i+"]'><option value='' disabled>Seleciona un estado de la prueba...</option>");
                          for (var j = 0; j < response[1].length; j++) {
                            if (response[1][j].estatusrecovert == 'EN PROCESO') {
                              selected='selected';
                            }else {
                              selected='';
                            }
                            $("#selEstadoBackup"+i+"").append("<option value='"+response[1][j].id+"' "+selected+ " >"+response[1][j].estatusrecovert+"</option>");
                          }
                      }



                    $("#modalc2").append(archivos);
                    $("#modalc2").append(archivosbit);

                    urls = JSON.parse(response[3].archivos);

                          for (var i = 0; i < urls.length; i++) {

                            $("#archivosbitacora").append("<div class='col-md-12 ml-auto' ><a style='color:green;' href='{{route('getlogs.get.d','')}}"+"/"+urls[i]+"'>"+urls[i]+"</a><br></div>");

                          }

                    $("#modalc2").append(observaciones);
                    $("#modalc2").append(usuario);
                    $("#modalc2").append(ndata);
                    $("#footermodal").append(footermodal);

                  //fin construir la forma

                  $('#modalrecover').modal('show');
                  $('#modalrecover').on('hide.bs.modal', function () {
                  //  alertify.warning('Edición Cancelada');
                  });
                }else {
                  console.log('No se encontraron esquemas');
                  var msg = alertify.error("Ningún esquema tiene un plan de backup coincidente con la búsqueda...<br><button class='btn btn-danger'>Cerrar</button>",10000);
                  msg.callback = function (isClicked) {
                          if(isClicked)
                              console.log('notification dismissed by user');
                          else
                              console.log('notification auto-dismissed');
                  };
                }
              }





          },
          error: function(response) {
              console.log(response);
          },
        });
      });

      $(document).on("click", "#createTest", function(){
        event.preventDefault();

        var data = new FormData(document.getElementById("form-test"));

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
        alertify.confirm('CREAR PREUBA ','Se va a registrar la prueba para la base: '+data.get('base[0]')+'', function(){

          $.ajax({
            url: '{{route('recovere.store')}}',
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
                $('#modalrecover').modal('hide');
                alertify.success ("Se creo con éxito: <br>"+data.get('base[0]'));
                if ($('.sorting_1').length)
                {
                  $('#tablaBackups').DataTable().ajax.reload();
                }
                console.log(response);
              }


            },
            error: function(response) {

              alertify.error("Error creando bitácora de BD: <br>"+data.get('base[0]'));
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

      $(document).on("click", "#editarecovertest", function(){
        event.preventDefault();
        //para tabla responsive
        var fila = $(this.closest("tr"));
        if(fila.hasClass("child")){
            fila = fila.prev();
        }
        id = fila.find('td:eq(0)').text();
        fec = fila.find('td:eq(1)').text();
        esq = fila.find('td:eq(2)').text();
        bas = fila.find('td:eq(3)').text();
        est = fila.find('td:eq(4)').text();
        arc = fila.find('td:eq(5)').text();
        obs = fila.find('td:eq(6)').text();
        usr = fila.find('td:eq(7)').text();


        $('#modalc1').empty();
        $('#modalc2').empty();
        $('#footermodal').empty();


        $.ajax({
          url: "{{route('recovere.show','')}}"+"/"+id,
          type: 'GET',
          // async: false,
          dataType: 'json',
          data: {
              // _token: $('input[name="_token"]').val(),
              // enco_id:enco_id,

          },
          success: function(response) {

            console.log(response);
            if (response[0][0].cve_dbitrecord) {
              bitrecord0=response[0][0].cve_dbitrecord;
            }else if (response[0][0].cve_sbitrecord) {
              bitrecord0=response[0][0].cve_sbitrecord;
            }

            //construir forma
            id =   "<div class='form-group col-md-1 ml-auto'><label data-error='error' data-success='ok' for='id'>ID</label><input value='"+response[0][0].id+"' name='id' type='text' id='id' class='form-control validate' readonly></div>";
            bitrecord =  "<div class='form-group col-md-2 ml-auto'><label data-error='error' data-success='ok' for='bitrecord'>BITÁCORA</label><input value='"+bitrecord0+"' name='bitrecord' type='text' id='bitrecord' class='form-control validate' disabled='disabled'></div>";
            backup =  "<div class='form-group col-md-3 ml-auto'><label data-error='error' data-success='ok' for='backup'>BACKUP</label><input value='"+response[0][0].backup+"' name='backup' type='text' id='backup' class='form-control validate' disabled='disabled'></div>";
            fecha =  "<div class='form-group col-md-2 ml-auto'><label data-error='error' data-success='ok' for='cmb_fecha'>FECHA</label> <input value='"+response[0][0].fecha+"' name='fecha' type='date' id='fecha' class='form-control validate' disabled='disabled' placeholder='fecha'></div> ";
            esquema =  "<div class='form-group col-md-4 ml-auto'><label data-error='error' data-success='ok' for='cmb_esquema'>ESQUEMA</label> <input value='"+response[0][0].esquema+"' name='esquema' type='text' id='esquema' class='form-control validate' readonly placeholder='Nombre del Esquema'></div> ";
            base =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>BASE</label> <input value='"+response[0][0].base+"' name='base' type='text' id='base' class='form-control validate' readonly placeholder='Nombre de la base de datos...'>");
            estado =  ("<div class='form-group col-md-6 ml-auto'><label data-error='error' data-success='ok' for='sel'>ESTADO</label> <select class='form-control select2' id='selEstadoBackup' name='cve_estatusrecovertest'><option value='' disabled selected>Seleciona un estado del esquema...</option>");
            archivos =   "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='erecover_archivos' >ARCHIVOS (Selección multiple - Sólo arcvhivos tar.gz son permitidos)</label><input type='file' class='filestyle' data-text='archivos' data-btnClass='btn-success'  data-buttonBefore='true' data-badge='true' data-placeholder='Ningún archivo seleccionado...' name='erecover_archivos[]' id='erecover_archivos' multiple ></div>";
            observacionesb =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='txt_observaciones'>OBSERVACIONES EN BITÁCORA</label> <textarea readonly value='' name='observaciones' type='text' id='observaciones' class='form-control validate' placeholder='Observaciones...'>"+response[0][0].observaciones+"</textarea></div> ";
            observaciones =  "<div class='form-group col-md-12 ml-auto'><label data-error='error' data-success='ok' for='txt_observaciones'>AGREGAR OBSERVACIONES</label> <textarea value='' name='observaciones' type='text' id='observaciones' class='form-control validate' placeholder='Observaciones...'></textarea></div> ";
            footermodal = "<button class='btn btn-success' id='updateRecover' >Guardar</button><button class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
            $.getScript( "/dba/assets/bootstrap-filestyle.min.js", function( data, textStatus, jqxhr ) {
            // console.log( data ); // Data returned
            // console.log( textStatus ); // Success
            // console.log( jqxhr.status ); // 200
            // console.log( "Load was performed." );
            });

              $('#tituloModal').html("<i class='fas fa-edit'></i> - Editar Prueba de Recuperación ");
              $("#modalc1").append(id);
              $("#modalc1").append(bitrecord);
              $("#modalc1").append(backup);
              $("#modalc1").append(fecha);
              // for (var j = 0; j < response[1].length; j++) {
              //     if (fec == response[1][j].name) {
              //       selected='selected';
              //     }else {
              //       selected='';
              //     }
              //     $("#selUsuario").append("<option value='"+response[1][j].id+"' "+selected+ ">"+response[1][j].name+"</option>");
              //   }
              $("#modalc1").append(esquema);
              $("#modalc1").append(base);
              $("#modalc1").append(estado);
              for (var j = 0; j < response[1].length; j++) {
                  if (est == response[1][j].estatusrecovert) {
                    selected='selected';
                  }else {
                    selected='';
                  }
                  $("#selEstadoBackup").append("<option value='"+response[1][j].id+"' "+selected+ ">"+response[1][j].estatusrecovert+"</option>");
                }
                $("#modalc2").append(observacionesb);
                $("#modalc2").append(observaciones);
                $("#modalc2").append(archivos);
                //urls
                urls = JSON.parse(response[0][0].archivos);

                      for (var i = 0; i < urls.length; i++) {
                        if (urls[i]) {
                          $("#modalc2").append("<div class='col-md-12 ml-auto' ><a style='color:green;' style='color:green;' href='{{route('getlogs.get.r','')}}"+"/"+urls[i]+"'>"+urls[i]+"</a><br></div>");
                        }
                      }
              $("#footermodal").append(footermodal);
              //$("#footermodal").append(id);
            //fin construir la forma

            $('#modalrecover').modal('show');
            $('#modalrecover').on('hide.bs.modal', function () {
            //  alertify.warning('Edición Cancelada');
            });




          },
          error: function(response) {
              console.log(response);
          },
        });
      });

      $(document).on("click", "#updateRecover", function(){
        event.preventDefault();

        var data = new FormData(document.getElementById("form-test"));

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
        alertify.confirm('ACTUALIZACIÓN DE INFORMACIÓN DE BACKUP ','Actualizar backup: '+data.get('esquema')+'', function(){

          $.ajax({
            url: "{{route('recovere.update','')}}"+"/"+data.get('id'),
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
                $('#modalrecover').modal('hide');
                alertify.success ("Actualizado con éxito: <br>"+data.get('esquema'));
                if ($('.sorting_1').length)
                {
                  $('#tablaBackups').DataTable().ajax.reload();
                }
                console.log(response);
              }


            },
            error: function(response) {

              alertify.error("Error actualizando la prueba: <br>"+data.get('esquema'));
              if ($('.sorting_1').length)
                {
                  $('#tablaBackups').DataTable().ajax.reload();
                }
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

      $(document).on("click", "#eliminarecovertest", function(){
        event.preventDefault();
        //para tabla responsive
        var fila = $(this.closest("tr"));
        if(fila.hasClass("child")){
            fila = fila.prev();
        }
        id = fila.find('td:eq(0)').text();




        $.ajax({
          url: "{{route('recovere.destroy','')}}",
          type: 'POST',
          // async: false,
          dataType: 'json',
          data: {
             _token: $('input[name="_token"]').val(),
              id:id,

          },
          success: function(response) {


              alertify.error("Eliminado: <br>"+response+"<br>No se puede deshacer...<br>");
              if ($('.sorting_1').length)
                {
                  $('#tablaBackups').DataTable().ajax.reload();
                }
                  console.log(response);



          },
          error: function(response) {
            alertify.error("Error eliminando: <br>"+response);
            if ($('.sorting_1').length)
              {
                $('#tablaBackups').DataTable().ajax.reload();
              }
                console.log(response);

          },
        });
      });

    });
  </script>
  <script> console.log('Hi!'); </script>
@stop
