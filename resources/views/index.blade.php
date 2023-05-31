@extends('adminlte::page')

@section('title', 'Público')

@section('content_header')
<div class="card">
  <div class="card-header">
      <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Recursos Estratégicos - DGTG</h1>
  </div>
  <div class="card-body">
    <h4 class="card-subtitle fa-start"> <i class="fas fa-laptop-house"></i> Inicio - Información Pública</h4>
  </div>
</div>
@include('layouts.mensajes')

@stop

@section('content')
  <div class="card">
    <div class="card-header">
        {{-- <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Recursos Estratégicos - DGTG</h1> --}}
    </div>
    <div class="card-body text-center">
      {{-- <h4 class="card-subtitle fa-start"> <i class="fas fa-laptop-house"></i> Inicio - Información Pública</h4> --}}
      <img src="{{url('/loader.png')}}" />
    </div>
  </div>
      {{-- <livewire:admin.programas /> --}}
@include('layouts.footer')

@stop

@section('right-sidebar')
  @guest

  <a class="btn btn-success btn-flat float-right  btn-block " href="login" >
  <i class="fa fa-fw fa-power-off text-white"></i>
  ENTRAR
  </a>

@endguest

@stop

@section('css')
    <link rel="stylesheet" href="/dba/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

{{-- @extends('adminlte::auth.login') --}}
