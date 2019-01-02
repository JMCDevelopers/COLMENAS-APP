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
      .imgizq{
float:left; /*para ponerlo a la izquierda */
margin:20px; /* un margen cualquiera */
}
.imgder{
float:right; /*para ponerlo a la derecha*/
margin:20px; /* un margen cualquiera */
}
.imgizq img, .imgder img{
display: block;
margin: 0 auto; /* centrar imagen */
border-width: 2px;
border-style:solid;
border-color: #cc6633; /* color del borde */
}

.imgizq p, .imgder p{
text-align:center;
font-weight:bold;
font-size: 9px;
background-color: #cc6633; /* color del fondo del pie de foto = borde*/
color:white;
margin: 0px;
padding-top: 2px;
padding-right: 2px;
padding-bottom: 4px;
padding-left: 2px;
}

.contenedor{
  background-color: #cc6633; /* color del fondo del pie de foto = borde*/
  color:white;
  width: 200px;
  height: 200px;
  text-align:center;

}
.cont{

}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <!--<img src="logo.png">-->
      </div>
      <h1>Mis Colmenas - Codigos-QR</h1>

      <div id="project">
        <div><span>NOMBRE</span> {{ Auth::user()->nombre }}</div>
        <div><span>EMAIL</span> <a href="">{{ Auth::user()->email }}<</a></div>
        <div><span>FECHA</span> {{Carbon::now()}}</div>
      </div>
    </header>
      <div><p>Coloca el codigo QR en cada una de las colmenas según su identificador, para generar inspecciones</p></div>
    <div  style="padding-right: 30px;">

      <div class="cont">
        @foreach ($colmenas as $key => $value)

            <div class="contenedor">
                <img title="Texto emergente" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(200)->generate(url('nueva-inspeccion/'.$value->idcolmenas.'/n'))) }} ">
            </div>



      @endforeach
      </div>
    </div>
    <main align="center">

    </main>
    <footer>
      Reporte generado por el software de gestión apícola - HiveApp.
    </footer>
  </body>
</html>
