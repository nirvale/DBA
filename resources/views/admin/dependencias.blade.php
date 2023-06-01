@extends('adminlte::page')

@section('title', 'Catálogo de Dependencias')

@section('content_header')

@include('layouts.mensajes')
<div class="card">
  <div class="card-header">
      <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Recursos Estratégicos - DGTG</h1>
  </div>
  <div class="card-body">
    <h4 class="card-subtitle fa-start"> <i class="fas fa-laptop-house"></i> Catálogo de Dependencias </h4>
  </div>
</div>

@stop

@section('content')

      @livewire('admin.dependencias')

@include('layouts.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/dba/css/admin_custom.css">
@stop

@section('js')
  <script type="text/javascript">
    window.livewire.on('dependenciaGuardado', (dependencia) => {
        $('#modalCrearDependencia').modal('hide');
        var notification = alertify.success('La dependencia:<br>'+dependencia+'<br>Fue creada con éxito...', 5, function(){  console.log(dependencia) });

    });
    window.livewire.on('errorGuardandoDependencia', (error,dependencia) => {
          var msgerror = alertify.error(""+"Error creando la Dependencia: "+dependencia+"<br>Por favor contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
          msgerror.callback = function (isClicked) {
                  if(isClicked){
                    console.log(error) ;
                    console.log('notification dismissed by user');
                  }else
                    console.log('notification auto-dismissed');
          };
    });
    window.livewire.on('cveDependenciaExistente', (dependencia,dependencian) => {
          var msgerror = alertify.error(""+"Error actualizando la Dependencia:<br> "+dependencia+"<br>La nueva clave para la dependencia:<br> "+dependencian['cve_dependencia']+"<br>Ya existe...<br>Contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
          msgerror.callback = function (isClicked) {
                  if(isClicked){
                    console.log(dependencian) ;
                    console.log('notification dismissed by user');
                  }else
                    console.log('notification auto-dismissed');
          };
    });
    window.livewire.on('DependenciaExistente', (dependencia,dependencian) => {
          var msgerror = alertify.error(""+"Error actualizando la Dependencia:<br> "+dependencia+"<br>La dependencia con nombre:<br> "+dependencian[0].nombre+"<br>Ya existe...<br>Contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
          msgerror.callback = function (isClicked) {
                  if(isClicked){
                    console.log(dependencian) ;
                    console.log('notification dismissed by user');
                  }else
                    console.log('notification auto-dismissed');
          };
    });
    window.livewire.on('dependenciaActualizado', (dependencia) => {
        $('#modalEditarDependencia').modal('hide');
        var notification = alertify.success('La dependencia:<br>'+dependencia+'<br>Actualizada con éxito...', 5, function(){  console.log(dependencia) });

    });
    window.livewire.on('errorEditandoDependencia', (error,dependencia) => {
          var msgerror = alertify.error(""+"Error editando la Dependencia:<br> "+dependencia+"<br>Por favor contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
          msgerror.callback = function (isClicked) {
                  if(isClicked){
                    console.log(error) ;
                    console.log('notification dismissed by user');
                  }else
                    console.log('notification auto-dismissed');
          };
    });
    window.livewire.on('dependenciaEliminado', (dependencia) => {
        $('#modalEditarDependencia').modal('hide');
        var notification = alertify.error('La dependencia:<br>'+dependencia+'<br>Eliminada con éxito, no se puede deshacer...', 20, function(){  console.log(dependencia) });

    });
    window.livewire.on('errorEliminandoDependencia', (error,dependencia) => {
          var msgerror = alertify.error(""+"Error eliminando el dependencia: "+dependencia+"<br>Por favor contacte al administrador... <br><button class='btn btn-danger'>Cerrar</button>",10000);
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
