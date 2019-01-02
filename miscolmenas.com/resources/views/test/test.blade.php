
@foreach ($colmenas as $key => $value)

  <div class="visible-print text-center">
      {!! QrCode::size(200)->generate(url('nueva-inspeccion/'.$value->idcolmenas.'/n')); !!}
      <p>Colmena <strong>{{$value->identificador_colmena}}</strong>, Escanea para realizar inspección</p>
  </div>
@endforeach
