@php
  use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte de colmenas </title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style media="screen">
      .clearfix:after {
      content: "";
      display: table;
      clear: both;
      }

      a {
      color: #5D6975;
      text-decoration: underline;
      }

      body {
      position: relative;
      width: 21cm;
      height: 29.7cm;
      margin: 0 auto;
      color: #001028;
      background: #FFFFFF;
      font-family: Arial, sans-serif;
      font-size: 12px;
      font-family: Arial;
      }

      header {
      padding: 10px 0;
      margin-bottom: 30px;
      }

      #logo {
      text-align: center;
      margin-bottom: 10px;
      }

      #logo img {
      width: 90px;
      }

      h1 {
      border-top: 1px solid  #5D6975;
      border-bottom: 1px solid  #5D6975;
      color: #5D6975;
      font-size: 2.4em;
      line-height: 1.4em;
      font-weight: normal;
      text-align: center;
      margin: 0 0 20px 0;
      background: url(dimension.png);
      }

      #project {
      float: left;
      }

      #project span {
      color: #5D6975;
      text-align: right;
      width: 75px;
      margin-right: 10px;
      display: inline-block;
      font-size: 0.8em;
      }

      #company {
      float: right;
      text-align: right;
      }

      #project div,
      #company div {
      white-space: nowrap;
      }

      table {
      width: 100%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 20px;
      }

      table tr:nth-child(2n-1) td {
      background: #F5F5F5;
      }

      table th,
      table td {
      text-align: center;
      }

      table th {
      padding: 5px 20px;
      color: #5D6975;
      border-bottom: 1px solid #C1CED9;
      white-space: nowrap;
      font-weight: normal;
      }

      table .service,
      table .desc {
      text-align: left;
      }

      table td {
      padding: 20px;
      text-align: right;
      }

      table td.service,
      table td.desc {
      vertical-align: top;
      }

      table td.unit,
      table td.qty,
      table td.total {
      font-size: 1.2em;
      }

      table td.grand {
      border-top: 1px solid #5D6975;;
      }

      #notices .notice {
      color: #5D6975;
      font-size: 1.2em;
      }

      footer {
      color: #5D6975;
      width: 100%;
      height: 30px;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 8px 0;
      text-align: center;
      }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <!--<img src="logo.png">-->
      </div>
      <h1>Mis Colmenas - Reporte colmenas</h1>

      <div id="project">
        <div><span>NOMBRE</span> {{ Auth::user()->nombre }}</div>
        <div><span>EMAIL</span> <a href="">{{ Auth::user()->email }}<</a></div>
        <div><span>FECHA</span> {{Carbon::now()}}</div>
      </div>
    </header>
    <div  style="padding-right: 30px;">
      <table>
        <thead>
          <tr>
            <th class="service">#</th>
            <th class="desc">COLMENA</th>
            <th>DESCRIPCION</th>
            <th>APIARIO</th>
            <th>FECHA CREACION</th>
            <th>ORIGEN</th>
          </tr>
        </thead>
        @php
        $con=0;
        @endphp
        <tbody>
          @foreach ($colmenas as $key => $value)
            @php
            $con++;
            @endphp
            <tr>
              <td class="service">{{$con}}</td>
              <td class="desc">{{$value->identificador_colmena}}</td>
              <td class="unit">{{$value->descripcion}}</td>
              <td class="qty">{{$value->nombre_apiario}}</td>
              <td class="total">{{$value->created_at}}</td>
              <td class="qty">{{$value->nombre_fuente}}</td>
            </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    <main align="center">

    </main>
    <footer>
      Reporte generado por el software de gestión apícola - HiveApp.
    </footer>
  </body>
</html>
