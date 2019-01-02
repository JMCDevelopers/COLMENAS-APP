@php
  use Carbon\Carbon;
@endphp
<table class="table table-bordered table-hover" id="tabla_reinas_instaladas">
  <thead>
    <tr>
      <th>#</th>
      <th>Reina</th>
      <th>Procedencia</th>
      <th>Estado</th>
      <th>Raza</th>
      <th>Fecha Nacimiento</th>
      <th>Edad Reina</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @php
    $con=0;
    @endphp
    @foreach ($reinas as $key => $value)
      @php
      $con++;
      $datenow=Carbon::now();
      $fecha_inicial=new Carbon($value->fecha_nacimiento);
      $date1=$fecha_inicial->diffInMonths($datenow);
      @endphp
      <tr >
        <td >{{$con}}</td>
        <td>{{$value->identificador_reina}}</td>
        <td >{{$value->procedencia}}</td>
        <td >{{$value->tipo}}</td>
        <td >{{$value->nombre}}</td>
        <td >{{$value->fecha_nacimiento}}</td>
        <td >{{$date1}} <span class='text-danger'>Meses</span></td>
        <td>
          <button type="button" name="button" onclick="VerDetalleReina({{$value->idreinas}})" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-eye-open"></i>Ver detalle</button>
          <button type="button" name="button" onclick="EditarReina({{$value->idreinas}})" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil"></i></button>
          <button type="button" onclick="ModalEliminarReina({{$value->idreinas}});" name="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>

        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<script type="text/javascript">

$(document).ready(function(){

  $('#tabla_reinas_instaladas').DataTable( {
        language: {
                  processing: "Procesando...",
                  search: "Filtro",
                  lengthMenu: "Mostrar _MENU_ registros",
                  info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                  infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                  infoFiltered: "(filtrado de un total de _MAX_ registros)",
                  infoPostFix: "",
                  loadingRecords: "Cargando...",
                  zeroRecords: "No se encontraron resultados",
                  emptyTable: "Ningún dato disponible en esta tabla",
                  paginate: {
                      first: "Primero",
                      previous: "Anterior",
                      next: "Siguiente",
                      last: "&uacute;ltimo"
                  }
              },

    } );
});

</script>
