<!DOCTYPE html>

<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="{{asset('adminlite/img/logo-abeja.png')}}" />
  <meta name="_token" content="{{ csrf_token() }}"/>
  <title>MIS COLMENAS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('adminlite/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('adminlite/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('adminlite/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlite/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlite/css/skins/skin-blue.min.css')}}">
  <link rel="stylesheet" href="{{asset('adminlite/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">


  <link rel="stylesheet" href="{{asset('sweetalert2/sweetalert.css')}}">
  <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
  <link href='{{asset('fullcalendar/fullcalendar.min.css')}}' rel='stylesheet' />
  <link href='{{asset('fullcalendar/fullcalendar.print.min.css')}}' rel='stylesheet' media='print' />
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>MS</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>MS</b>C</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu" >
        <ul class="nav navbar-nav">
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="glyphicon glyphicon-envelope"></i>
              <span class="label label-danger">{{count($tareas_pendientes)}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tareas</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">
                  <li><!-- start notification -->
                    <a href="{{route('gestion_tareas')}}">
                      <i class="fa fa-tasks text-aqua"></i> Tienes {{count($tareas_pendientes)}}  tareas pendientes
                    </a>
                  </li>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="{{route('gestion_tareas')}}">Gestionar Tareas</a></li>
            </ul>
          </li>
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{asset('adminlite/img/logo-abeja.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ Auth::user()->nombre }} </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{asset('adminlite/img/logo-abeja.png')}}" class="img-circle" alt="User Image">
                <p>
                  {{ Auth::user()->nombre }}  - Apicultor
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ route('account') }}" class="btn btn-default btn-flat">Mi Cuenta</a>
                </div>
                <div class="pull-right">
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      {{ __('Cerrar Sesión') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" >
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" data-spy="affix" data-offset-top="200">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('adminlite/img/logo-abeja.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Gestión Apícola</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      @php
      $permiso="";
      @endphp
      @foreach ($permisos as $key => $value)
        @php
          $permiso=$value->nombre_cuenta;
        @endphp
      @endforeach
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li id="dashboard" class=""><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-dashboard"></i> <span>Dashboard</span></a></li>
        <li id="apiario" class=""><a href="{{route('apiario')}}"><i class="fa fa-link"></i> <span>Apiarios</span></a></li>
        <li id="colmena" class=""><a href="{{route('colmena')}}"><i class="glyphicon glyphicon-tasks glyphicon-lg"></i> <span>Colmenas</span></a></li>
        <!--<li id="reina" class=""><a href="{{route('reina')}}"><i class="glyphicon glyphicon-object-align-vertical"></i> <span>Reinas</span></a></li>-->
        <li id="cosecha" class=""><a href="{{route('lista_cosechas')}}"><i class="glyphicon glyphicon-king"></i> <span>Cosechas</span></a></li>
        <!--<li id="inspeccion" class=""><a href="{{route('inspeccion')}}"><i class="glyphicon glyphicon-zoom-in"></i> <span>Inspecciones</span></a></li>-->
        @if ($permiso!=="BASICO")
          <li id="monitoreo" class=""><a href="{{route('monitoreo')}}"><i class="glyphicon glyphicon-globe"></i> <span>Monitoreo</span></a></li>
        @endif
      </a>
      <li id="negocio" class="treeview">
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Negocio</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('ventas')}}"><i class="far fa-arrow-alt-circle-right"></i> Ventas</a></li>
          <li><a href="{{route('compras')}}"><i class="far fa-arrow-alt-circle-right"></i> Compras</a></li>
          <li><a href="{{route('reportes_negocio')}}"><i class="far fa-arrow-alt-circle-right"></i> Reportes Negocio</a></li>
        </ul>
      </li>
      <li id="estadistica" class="treeview">
        <a href="#">
          <i class="fa fa-bar-chart fa-lg"></i>
          <span>Reportes y Estadistica</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{route('colmenas_apiarios')}}"><i class="far fa-arrow-alt-circle-right"></i> Reportes Colmenas</a></li>
          <li><a href="{{route('cosechas_inspecciones')}}"><i class="far fa-arrow-alt-circle-right"></i>Reportes Cosechas</a></li>
          <li><a href="{{route('estadistica_reporte')}}"><i class="far fa-arrow-alt-circle-right"></i> Estadística</a></li>
        </ul>
      </li>
        <li id="salir" class=""><a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            <i class="glyphicon glyphicon-share"></i>{{ __('Salir') }}

        </a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="container-fluid">
      @yield('contenido')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Main Footer -->
  <footer class="main-footer">

    <strong>&copy; 2018 <a href="#">by Odres Group </a>.</strong> Todos los derechos reservados.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- jQuery 3 -->
<script src="{{asset('adminlite/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('adminlite/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlite/js/adminlte.min.js')}}"></script>
<script src="{{asset('adminlite/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlite/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('sweetalert2/sweetalert.min.js')}}"></script>
<script src="{{asset('fullcalendar/lib/moment.min.js')}}"></script>
<script src="{{asset('fullcalendar/fullcalendar.min.js')}}"></script>
<script src="{{asset('fullcalendar/theme-chooser.js')}}"></script>
<script src="{{asset('fullcalendar/locale/es.js')}}"></script>
<script src="{{asset('adminlite/chart/Chart.js')}}"></script>
</body>
</html>
