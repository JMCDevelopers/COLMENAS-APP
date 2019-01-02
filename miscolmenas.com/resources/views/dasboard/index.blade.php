@extends('layouts/dashboard')
@section('contenido')
  <link href='{{asset('css/calendario.css')}}' rel='stylesheet' />
  <div class="row">
    <ol class="breadcrumb">
      <li><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard text-aqua"></i> Dashboard</a></li>
    </ol>
  </div>
  <div class="panel-body">
    <div class="panel panel-info">
        <div class="panel-heading">
          <h3>Calendario de tareas</h3>
        </div>
        <div class="panel-body">
          <div id='calendar'></div>
        </div>
    </div>
  </div>
  
              </div>
<script src="{{ asset('js/dashboard.js') }}" defer></script>
@endsection
