<table class="table table-bordered table-hover" id="tabla_apiarios">
  <thead>
    <tr>
      <th>#</th>
      <th>Apiario</th>
      <th>descripcion</th>
      <th>Fecha Creacion</th>
      <th>Establecimiento</th>
      <th>Provincia</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @php
    $con=0;
    @endphp
    @foreach ($apiarios as $key => $value)
      @php
      $con++;
      @endphp
      <tr >
        <td onclick="VerDetalleApiario({{$value->idapiario}})">{{$con}}</td>
        <td onclick="VerDetalleApiario({{$value->idapiario}})">{{$value->nombre_apiario}}</td>
        <td onclick="VerDetalleApiario({{$value->idapiario}})">{{$value->descripcion}}</td>
        <td onclick="VerDetalleApiario({{$value->idapiario}})">{{$value->created_at}}</td>
        <td onclick="VerDetalleApiario({{$value->idapiario}})">{{$value->establecimiento}}</td>
        <td onclick="VerDetalleApiario({{$value->idapiario}})">{{$value->nombre_provincia}}</td>
        <td>
          <button type="button" name="button" onclick="EditarApiario({{$value->idapiario}})" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-pencil"></i>Editar</button>
          <button type="button" onclick="ModalEliminarApiario({{$value->idapiario}});" name="button" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>Eliminar</button>
          <button type="button" onclick="InspeccionApiario({{$value->idapiario}});" name="button" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-zoom-in"></i>Inspeccionar</button>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<script type="text/javascript">

$(document).ready(function(){

  $('#tabla_apiarios').DataTable({
    "language": {
              "processing": "Procesando...",
              "search": "Buscar",
              "lengthMenu": "Mostrar _MENU_ registros",
              "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "infoPostFix": "",
              "loadingRecords": "Cargando...",
              "zeroRecords": "No se encontraron resultados",
              "emptyTable": "Ningún dato disponible en esta tabla",
              paginate: {
                  first: "Primero",
                  previous: "Anterior",
                  next: "Siguiente",
                  last: "&uacute;ltimo"
              }
            }

          }
  );
});

</script>
