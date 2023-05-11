@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
<div class="card">
  <div class="card-header">
      <h1 class="card-title"><i class="fas fa-hat-wizard"></i> Sistema de Administración para Recursos Estratégicos - DGTG</h1>
  </div>
  <div class="card-body">
    <h4 class="card-subtitle fa-start"> <i class="fas fa-laptop-house"></i> Inicio </h4>
  </div>
</div>

@stop

@section('content')
@include('layouts.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/dba/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
