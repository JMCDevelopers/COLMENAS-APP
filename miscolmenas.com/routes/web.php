<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//PageControlers
Route::get('/','Inicio\InicioController@index')->name('index');
Route::get('noticias','Inicio\InicioController@noticias')->name('noticias');
Route::get('descargas','Inicio\InicioController@descargas')->name('descargas');
Route::get('contactos','Inicio\InicioController@contactos')->name('contactos');

Auth::routes();
Route::get('dashboard','Dasboard\DashboardController@index')->name('dashboard');
Route::get('tareas','Dasboard\DashboardController@getTaskUser')->name('tareas');
Route::get('gestion-tareas','Dasboard\DashboardController@gestionarTareas')->name('gestion_tareas');
Route::get('editar-tarea/{idtareas}','Dasboard\DashboardController@editarTarea')->name('editar_tarea');
Route::post('recordinar-tarea','Dasboard\DashboardController@recordinarFechaTarea')->name('recordinar_tarea');
Route::post('finalizar-tarea','Dasboard\DashboardController@finalizarTarea')->name('finalizar_tarea');
Route::post('eliminar-tarea','Dasboard\DashboardController@eliminarTarea')->name('eliminar_tarea');
Route::get('change-pass','Dasboard\DashboardController@cambiarPassword')->name('change_pass');
Route::post('actualizar-pass','Dasboard\DashboardController@actualizarPassword')->name('actualizar_pass');
Route::get('planes','Dasboard\DashboardController@mostrarPlanes')->name('planes');

//rutas definidas para la gestion de apiarios
Route::get('apiario','Dasboard\ApiarioController@index')->name('apiario');
Route::post('apiario','Dasboard\ApiarioController@createApiario')->name('crear_apiario');
Route::post('delete','Dasboard\ApiarioController@DeleteApiario')->name('eliminar_apiario');
Route::get('edit/{idapiario}','Dasboard\ApiarioController@EditaApiario')->name('editar_apiario');
Route::post('tabla','Dasboard\ApiarioController@GenerarTablaApiarios')->name('tabla');
Route::post('actualizar','Dasboard\ApiarioController@ActualizarApiario')->name('actualizar_apiario');
Route::post('detalle','Dasboard\ApiarioController@ObtenerDetalleApiario')->name('detalle_apiario');
Route::post('provincia','Dasboard\ApiarioController@ObtenerProvinciaAjax')->name('provincia');
Route::get('map/{idapiario}','Dasboard\ApiarioController@ObtenerMapaApiario')->name('mapa_apiario');
Route::get('inspeccion-apiario/{idapiario}','Dasboard\ApiarioController@inspeccionarApiario')->name('inspeccion_apiario');
Route::post('insert-inspection','Dasboard\ApiarioController@insertarInspeccionApiario')->name('insert_inspection');
Route::get('inspeccion-details','Dasboard\ApiarioController@obtenerInspeccionApiario')->name('inspeccion_details');

//rutas por colmenas
Route::get('colmena','Dasboard\ColmenaController@index')->name('colmena');
Route::get('colmena/{idapiario}','Dasboard\ColmenaController@ObtenerVistaPorApiario')->name('colmena_2');
Route::get('crear-colmena','Dasboard\ColmenaController@CrearColmena')->name('crear_colmena');
Route::post('edad-reina','Dasboard\ColmenaController@CalcularEdadReina')->name('edad_reina');
 Route::post('insertar-colmena','Dasboard\ColmenaController@InsertarColmena')->name('insert_colmena');
Route::post('insertar-material','Dasboard\ColmenaController@InsertarComponentesColmena')->name('insertar_material');
Route::post('eliminar-colmena','Dasboard\ColmenaController@EliminarColmena')->name('eliminar_colmena');
Route::get('editar-colmena/{idcolmena}','Dasboard\ColmenaController@EditarColmena')->name('editar_colmena');
Route::post('reinas-disponibles','Dasboard\ColmenaController@ObtenerReinasDisponibles')->name('reinas_diponibles');
Route::post('liberar-reina','Dasboard\ColmenaController@CambiarReinaColmena')->name('liberar_reina');
Route::post('delete-reina','Dasboard\ColmenaController@EliminarReina')->name('delete_reina');
Route::get('actualizar-colmena','Dasboard\ColmenaController@ActualizarColmena')->name('actualizar_colmena');
Route::post('actualizar-componentes','Dasboard\ColmenaController@ActualizarComponentes')->name('actualizar_componentes');
Route::post('obtener-componentes','Dasboard\ColmenaController@ObtenerComponentesColmena')->name('obtener_componentes');
Route::post('obtener-detalle-colmenas','Dasboard\ColmenaController@getHiveDetails')->name('obtener_detalle_colmenas');
Route::post('obtener-detalle-inspeccion','Dasboard\ColmenaController@getDetailsInspection')->name('obtener_detalle_inspeccion');
Route::get('guardar-evento','Dasboard\ColmenaController@guardarEventoColmena')->name('guardar_evento');
Route::post('eventos','Dasboard\ColmenaController@obtenerEventosColmena')->name('eventos');
Route::post('eliminar-eventos','Dasboard\ColmenaController@eliminarEvento')->name('eliminar_eventos');
Route::get('obtener-reinas','Dasboard\ColmenaController@getReinasDisponibles')->name('obtener_reinas');
Route::post('crear-reina-colmena','Dasboard\ColmenaController@guardarReinaColmena')->name('crear_reina_colmena');
Route::post('asigna-reina-colmena','Dasboard\ColmenaController@asignarReinaColmena')->name('asigna_reina');
Route::get('gestion-colmena/{idColmena}','Dasboard\ColmenaController@gestionColmena');
Route::post('eliminar-inspeccion-colmena','Dasboard\ColmenaController@eliminarInspeccionColmena');

//nuevas rutas editar
Route::post('editar-identificador-colmena','Dasboard\ColmenaController@editarIdentificador');
Route::post('editar-descripcion-colmena','Dasboard\ColmenaController@editarDescripcion');
Route::post('editar-tipo-colmena','Dasboard\ColmenaController@editarTipoColmena');
Route::post('editar-origen-colmena','Dasboard\ColmenaController@editarOrigenColmena');
Route::post('eliminar-reina-colmena','Dasboard\ColmenaController@eliminarReinaColmena');
Route::post('inspeccionar-colmena','Dasboard\ColmenaController@insertarInspeccionColmena')->name('inspeccionar_colmena');
Route::post('get-inspeccion','Dasboard\ColmenaController@getInspeccionColmena');
//fin

//rutas para gestion de reinas
Route::get('reina','Dasboard\ReinaController@index')->name('reina');
Route::post('crear-reina','Dasboard\ReinaController@CrearReina')->name('crear_reina');
Route::post('insertar-reina-compra','Dasboard\ReinaController@insertarReinaVenta');
Route::get('pruebas','Dasboard\ReinaController@Pruebas')->name('pruebas');
Route::post('tabla-reinas','Dasboard\ReinaController@ObtenerReinas')->name('get_reinas');
Route::post('tabla-reinas-instaladas','Dasboard\ReinaController@ObtenerReinasInstaladas')->name('get_reinas_instaladas');
Route::post('eliminar-reina','Dasboard\ReinaController@EliminarReina')->name('eliminar_reina');
Route::get('editar-reina/{idreina}','Dasboard\ReinaController@EditaReina')->name('editar_reina');
Route::post('actualizar-reina','Dasboard\ReinaController@ActualizarReina')->name('actualizar_reina');
Route::post('detalle-reina','Dasboard\ReinaController@ObtenerDetalleReina')->name('detalle-reina');
Route::post('codigo-seguimiento','Dasboard\ReinaController@getCodigoSeguimientoReina');

//inspecciones
Route::get('inspeccion','Dasboard\InspeccionController@index')->name('inspeccion');
Route::get('nueva-inspeccion/{idcolmenas}/{valor?}','Dasboard\InspeccionController@nuevaInspeccion')->name('nueva_inspeccion');;
Route::get('guardar-inspeccion','Dasboard\InspeccionController@ingresarInspeccion')->name('guardar_inspeccion');
Route::post('guardar-condiciones','Dasboard\InspeccionController@guardarCondicionesColmena')->name('guardar_condiciones');
Route::post('guardar-enfermedades','Dasboard\InspeccionController@guardarEnfermedadColmena')->name('guardar_enfermedades');
Route::post('guardar-tratamientos','Dasboard\InspeccionController@guardarTratamientoColmena')->name('guardar_tratamientos');
Route::post('guardar-alimento','Dasboard\InspeccionController@guardarAliemtacionColmena')->name('guardar_alimento');
Route::get('guardar-tarea','Dasboard\InspeccionController@guardarTarea')->name('guardar_tarea');
Route::post('guardar-imagen-inspeccion','Dasboard\InspeccionController@guardarImagenesInspeccion')->name('guardar_imagen_inspeccion');
Route::post('eliminar-inspeccion','Dasboard\InspeccionController@eliminarInspeccion')->name('eliminar_inspeccion');
Route::post('detalle-inspeccion','Dasboard\InspeccionController@obtenerDetalleInspeccion')->name('detalle_inspeccion');
Route::post('detalle-condiciones','Dasboard\InspeccionController@obtenerCondicionesColmena')->name('detalle_condiciones');
Route::post('detalle-enfermedades','Dasboard\InspeccionController@obtenerEnfermedadesColmena')->name('detalle_enfermedades');
Route::post('detalle-tratamientos','Dasboard\InspeccionController@obtenerTratamientosColmenas')->name('detalle_tratamientos');
Route::post('detalle-alimentos','Dasboard\InspeccionController@AlimentosProporcionados')->name('detalle_alimentos');
Route::post('detalle-imagenes','Dasboard\InspeccionController@obtenerImagenesInspeccion')->name('detalle_imagenes');
Route::get('editar-inspeccion/{idinspeccion_colmena}','Dasboard\InspeccionController@editarinspeccion')->name('editar_inspeccion');
Route::get('actualizar-inspeccion','Dasboard\InspeccionController@actualizarInspeccion')->name('actualizar_inspeccion');


//rutas para gestion de cosechas
Route::get('cosecha','Dasboard\CosechaController@index')->name('cosecha');
Route::post('colmenas-apiario','Dasboard\CosechaController@ObtenerColmenasApiario')->name('colmenas_apiario');
Route::post('guardar-cosecha','Dasboard\CosechaController@GuardarCosecha')->name('guardar_cosecha');
Route::get('cosechas','Dasboard\CosechaController@ListaCosechas')->name('lista_cosechas');
Route::get('eliminar-cosecha','Dasboard\CosechaController@EliminarCosecha')->name('eliminar_cosecha');
Route::get('editar-cosecha/{idcosechas}','Dasboard\CosechaController@EditarCosecha')->name('editar_cosecha');
Route::post('actualizar-cosecha','Dasboard\CosechaController@ActualizarCosecha')->name('actualizar_cosecha');
Route::post('detalle-cosecha','Dasboard\CosechaController@getCosechaDetalle')->name('detalle_cosecha');
Route::post('colmena-cosecha','Dasboard\CosechaController@ObtenerColmena')->name('colmena_cosecha');




Route::get('monitoreo','Dasboard\MonitoreoController@index')->name('monitoreo');
//reportes rutas
Route::get('estadistica-reporte','Dasboard\ReporteController@index')->name('estadistica_reporte');
Route::get('porcentajes-cosechas','Dasboard\ReporteController@obtenerCosechasPorMes')->name('porcentajes_cosechas');
Route::get('estadistica','Dasboard\ReporteController@getInfoAcount')->name('estadistica');
Route::get('reportes','Dasboard\ReporteController@Reporte')->name('reportes');
//Route::get('reporte-cosechas','Dasboard\ReporteController@ReporteCosechas')->name('reporte_cosechas');
Route::get('reporte-inspecciones','Dasboard\ReporteController@ReporteInspecciones')->name('reporte_inspecciones');
Route::get('reporte-reinas','Dasboard\ReporteController@ReporteReinas')->name('reporte_reinas');
Route::get('reporte-reinas','Dasboard\ReporteController@ReporteReinas')->name('reporte_reinas');
Route::get('code','Dasboard\ReporteController@getQRCodeHives')->name('code');


Route::get('colmenas-apiarios','Dasboard\ReporteController@colmenasApiariosReportes')->name('colmenas_apiarios');
Route::get('cosechas-inspecciones','Dasboard\ReporteController@cosechasInspeccionesReportes')->name('cosechas_inspecciones');
Route::post('reporte-colmenas','Dasboard\ReporteController@reporteColmenas');
Route::post('reporte-cosechas','Dasboard\ReporteController@reporteCosechasMes');

//cuenta de usuario
Route::get('account','Dasboard\AccountController@index')->name('account');
Route::get('/home', 'HomeController@index')->name('home');


// rutas de Negocio
Route::get('ventas','Dasboard\NegocioController@ventas')->name('ventas');
Route::get('compras','Dasboard\NegocioController@compras')->name('compras');
Route::post('insertar-ventas','Dasboard\NegocioController@insertarVenta')->name('insertar_ventas');
Route::post('insertar-compra','Dasboard\NegocioController@ingresarCompra')->name('insertar_compra');
Route::post('obtener-venta','Dasboard\NegocioController@obtenerVenta');
Route::post('obtener-compra','Dasboard\NegocioController@obtenerCompra');
Route::post('obtener-items','Dasboard\NegocioController@obtenerItemsVenta');
Route::post('obtener-items-compra','Dasboard\NegocioController@obtenerItemsCompra');
Route::post('borrar-venta','Dasboard\NegocioController@eliminarVenta');
Route::post('borrar-compra','Dasboard\NegocioController@eliminarCompra');
Route::get('reportes-negocio','Dasboard\NegocioController@reportes')->name('reportes_negocio');
Route::post('reporte-generado','Dasboard\NegocioController@generarReporte');

// test route
  Route::get('test','Test\TestController@sendConfirmAccountEmail')->name('test');
  Route::get('codes','Test\TestController@testCode')->name('code');
