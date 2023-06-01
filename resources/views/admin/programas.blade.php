@extends('adminlte::page')

@section('title', 'Catálogo de Programas')

@section('content_header')

@include('layouts.mensajes')
<div class="card">
  <div class="card-header">
      <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Recursos Estratégicos - DGTG</h1>
  </div>
  <div class="card-body">
    <h4 class="card-subtitle fa-start"> <i class="fas fa-laptop-house"></i> Catálogo de Programas </h4>
  </div>
</div>

@stop

@section('content')

    @livewire('admin.programas')

@include('layouts.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/dba/css/admin_custom.css">
@stop

@section('js')
  <script type="text/javascript">
    window.livewire.on('programaGuardado', (programa) => {
        $('#modalCrearPrograma').modal('hide');
        var notification = alertify.success('El programa:<br>'+programa+'<br>Fue creado con éxito...', 5, function(){  console.log(programa) });

    });
    window.livewire.on('errorGuardandoPrograma', (error,programa) => {
          var msgerror = alertify.error(""+"Error creando el Programa: "+programa+"<br>Por favor contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
          msgerror.callback = function (isClicked) {
                  if(isClicked){
                    console.log(error) ;
                    console.log('notification dismissed by user');
                  }else
                    console.log('notification auto-dismissed');
          };
    });
    window.livewire.on('cveProgramaExistente', (programa,programan) => {
          var msgerror = alertify.error(""+"Error actualizando el Programa:<br> "+programa+"<br>La nueva clave de programa:<br> "+programan['cve_programa']+"<br>Ya existe...<br>Contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
          msgerror.callback = function (isClicked) {
                  if(isClicked){
                    console.log(programan) ;
                    console.log('notification dismissed by user');
                  }else
                    console.log('notification auto-dismissed');
          };
    });
    window.livewire.on('ProgramaExistente', (programa,programan) => {
          var msgerror = alertify.error(""+"Error actualizando el Programa: "+programa+"<br>El programa con nombre:<br> "+programan[0].programa+"<br>Ya existe...<br>Contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
          msgerror.callback = function (isClicked) {
                  if(isClicked){
                    console.log(programan) ;
                    console.log('notification dismissed by user');
                  }else
                    console.log('notification auto-dismissed');
          };
    });
    window.livewire.on('programaActualizado', (programa) => {
        $('#modalEditarPrograma').modal('hide');
        var notification = alertify.success('El programa:<br>'+programa+'<br>Actualizado con éxito...', 5, function(){  console.log(programa) });

    });
    window.livewire.on('errorEditandoPrograma', (error,programa) => {
          var msgerror = alertify.error(""+"Error editando el Programa: "+programa+"<br>Por favor contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
          msgerror.callback = function (isClicked) {
                  if(isClicked){
                    console.log(error) ;
                    console.log('notification dismissed by user');
                  }else
                    console.log('notification auto-dismissed');
          };
    });
    window.livewire.on('programaEliminado', (programa) => {
        $('#modalEditarPrograma').modal('hide');
        var notification = alertify.error('El programa:<br>'+programa+'<br>Eliminado con éxito, no se puede deshacer...', 20, function(){  console.log(programa) });

    });
    window.livewire.on('errorEliminandoPrograma', (error,programa) => {
          var msgerror = alertify.error(""+"Error eliminando el programa: "+programa+"<br>Por favor contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
          msgerror.callback = function (isClicked) {
                  if(isClicked){
                    console.log(error) ;
                    console.log('notification dismissed by user');
                  }else
                    console.log('notification auto-dismissed');
          };
    });
  </script>
  <script> console.log('Hi!'); </script>
@stop
