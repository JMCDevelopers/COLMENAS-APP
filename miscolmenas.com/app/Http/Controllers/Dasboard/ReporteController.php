<?php

namespace App\Http\Controllers\Dasboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\Menu;
use App\Models\Tareas\Tarea;
use App\Models\Dashboard\Cuenta;
use Carbon\Carbon;
use App\Models\Cosechas\Cosecha;
use App\Models\Apiarios\Apiario;
use App\Models\Colmenas\Colmena;
use App\Models\Inspecciones\Inspeccion;
use App\Models\Reina\Reina;
use PDF;
Use QRCode;

class ReporteController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  //obtener el id de cuenta de usuario loggeado
  public function getAcountIdUserAuth(){
    $user = auth()->user();
    $cuenta=Cuenta::where('users_id',$user->id)->firstOrFail();
    return $cuenta->idcuenta_usuario;
  }
  public function index(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cuenta=new Cuenta();
      $tarea=new Tarea();
      $data=array();
      $user = auth()->user();
      $data['permisos']=$cuenta->getUserAccount($user->id);
      $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
      return view('reportes/index',$data);
    }


    // colmenas apiarios reportes
    public function colmenasApiariosReportes(){
      try {
        $id_cuenta_usuario=$this->getAcountIdUserAuth();
        $cuenta=new Cuenta();
        $tarea=new Tarea();
        $data=array();
        $user = auth()->user();
        $data['permisos']=$cuenta->getUserAccount($user->id);
        $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
        return view('reportes/colmenas_apiarios',$data);
      } catch (\Exception $e) {

      }

    }

    // colmenas apiarios reportes
    public function cosechasInspeccionesReportes(){
      try {
        $id_cuenta_usuario=$this->getAcountIdUserAuth();
        $cuenta=new Cuenta();
        $tarea=new Tarea();
        $data=array();
        $user = auth()->user();
        $data['permisos']=$cuenta->getUserAccount($user->id);
        $data['tareas_pendientes']=$tarea->getTareasPendientes($id_cuenta_usuario);
        return view('reportes/cosechas_inspecciones',$data);
      } catch (\Exception $e) {

      }

    }

    //contar cosechas por mes
  public function obtenerCosechasPorMes(Request $request){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $cosecha=new Cosecha();
      $result=$cosecha->getCosechasPorMes($request->monthsNow,$id_cuenta_usuario);
      return response()->json($result);

    }

    public function getInfoAcount(Request $request){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $apiario=new Apiario();
      $colmena=new Colmena();
      $reina=new Reina();
      $cosecha=new Cosecha();
      $inspeccion=new Inspeccion();
      $tareas=new Tarea();

      $data=array();
      $data['colmena']=$colmena->getColmenasUsuarioEstadistica($id_cuenta_usuario);
      $data['apiario']=$apiario->getApiariosEstadistica($id_cuenta_usuario);
      $data['inspeccion']=$inspeccion->getInspeccionesUsuarioEstadistica($id_cuenta_usuario);
      $data['reina']=$reina->getReinasEstadistica($id_cuenta_usuario);
      $data['cosecha']=$cosecha->getCosechasEstadistica($id_cuenta_usuario);
      $data['tarea']=$tareas->getTareasEstadisticas($id_cuenta_usuario);
      return response()->json($data);
    }

    public function Reporte(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $data=array();
      $colmenas=new Colmena();
      $data["colmenas"]=$colmenas->getColmenasUsuario($id_cuenta_usuario);
      $pdf=PDF::loadView('reportes/reporte_colmenas',$data);
      return $pdf->stream();
    }

    public function getQRCodeHives(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $data=array();
      $colmenas=new Colmena();
      $data["colmenas"]=$colmenas->getColmenasUsuario($id_cuenta_usuario);
      $pdf=PDF::loadView('reportes/codigos-qr',$data);
      return $pdf->stream();
    }
    public function ReporteCosechas(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $data=array();
      $cosecha=new Cosecha();
      $data["cosechas"]=$cosecha->getCosechasReporte($id_cuenta_usuario);
      $pdf=PDF::loadView('reportes/reporte_cosecha',$data);
      return $pdf->stream();
    }
    //insopecciones reporte
    public function ReporteInspecciones(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $data=array();
      $inspeccion=new Inspeccion();
      $data["inspecciones"]=$inspeccion->getInspeccionesUsuarioReporte($id_cuenta_usuario);
      $pdf=PDF::loadView('reportes/reporte_inspeccion',$data);
      return $pdf->stream();
    }
    //reinas reporte
    public function ReporteReinas(){
      $id_cuenta_usuario=$this->getAcountIdUserAuth();
      $data=array();
      $reina=new Reina();
      $data["reinas"]=$reina->getReinasUser($id_cuenta_usuario);
      $pdf=PDF::loadView('reportes/reporte_reinas',$data);
      return $pdf->stream();
    }


    // reporte colmenas
    public function reporteColmenas(Request $request){
      try {
        $id_cuenta_usuario=$this->getAcountIdUserAuth();
        $objetoInspeccion=[];
        $cont=0;
          if($request->tipo==1){
            $colmenas=new Colmena();
            $result=$colmenas->getColmenasUsuario($id_cuenta_usuario);
            foreach ($result as $key => $value) {
              $colm=new Colmena();
              $resul_inspeccion="";
              $resul_inspeccion=$colm->getColmenaEnferma($value->idcolmenas);
              if(count($resul_inspeccion)>0){
                if($resul_inspeccion[0]->enfermedad=="SI"){
                  $objetoInspeccion[$cont]["apiario"]=$resul_inspeccion[0]->apiario;
                  $objetoInspeccion[$cont]["colmena"]=$resul_inspeccion[0]->colmena;
                  $objetoInspeccion[$cont]["provincia"]=$resul_inspeccion[0]->provincia;
                  $objetoInspeccion[$cont]["observacion"]=$resul_inspeccion[0]->observaciones;
                  $objetoInspeccion[$cont]["enfermedades"]=$resul_inspeccion[0]->enfermedades;
                  $cont++;
                }

              }
            }
          return response()->json($objetoInspeccion);
        }else if($request->tipo==2){
            $colm=new Colmena();
            $resul_inspeccion="";
            $resul_inspeccion=$colm->getColmenasSinReina($id_cuenta_usuario);
            foreach ($resul_inspeccion as $key => $value) {
              if(is_null($value->idreinas) && is_null($value->idReinasVenta)){
                  $objetoInspeccion[$cont]["apiario"]=$value->apiario;
                  $objetoInspeccion[$cont]["colmena"]=$value->colmena;
                  $objetoInspeccion[$cont]["provincia"]=$value->provincia;
                  $objetoInspeccion[$cont]["observacion"]="";
                  $objetoInspeccion[$cont]["enfermedades"]="";
                  $cont++;
              }
            }

        return response()->json($objetoInspeccion);
      }else if($request->tipo==3){

        $colm=new Colmena();
        $resul_inspeccion="";
        $resul_inspeccion=$colm->getColmenaReinaVieja($id_cuenta_usuario);
        foreach ($resul_inspeccion as $key => $value) {
              $edad=$this->CalcularEdadReina2($value->fecha_nacimiento);
              if($edad>12){
                $objetoInspeccion[$cont]["apiario"]=$value->apiario;
                $objetoInspeccion[$cont]["colmena"]=$value->colmena;
                $objetoInspeccion[$cont]["provincia"]=$value->provincia;
                $objetoInspeccion[$cont]["observacion"]="";
                $objetoInspeccion[$cont]["enfermedades"]="";
                $cont++;
              }


        }
        $colm=new Colmena();
        $resul_inspeccion="";
        $resul_inspeccion=$colm->getColmenaReinaViejaVenta($id_cuenta_usuario);
        foreach ($resul_inspeccion as $key => $value) {

          $edad=$this->CalcularEdadReina2($value->fecha_nacimiento);
          if($edad>12){
            $objetoInspeccion[$cont]["apiario"]=$value->apiario;
            $objetoInspeccion[$cont]["colmena"]=$value->colmena;
            $objetoInspeccion[$cont]["provincia"]=$value->provincia;
            $objetoInspeccion[$cont]["observacion"]="";
            $objetoInspeccion[$cont]["enfermedades"]="";
            $cont++;
          }

        }

        return response()->json($objetoInspeccion);
      }else if($request->tipo==4){
        $colmenas=new Colmena();
        $result=$colmenas->getAllColmenas($id_cuenta_usuario);
        foreach ($result as $key => $value) {
              $objetoInspeccion[$cont]["apiario"]=$value->apiario;
              $objetoInspeccion[$cont]["colmena"]=$value->colmena;
              $objetoInspeccion[$cont]["provincia"]=$value->provincia;
              $objetoInspeccion[$cont]["observacion"]="";
              $objetoInspeccion[$cont]["enfermedades"]="";
              $cont++;
        }
        return response()->json($objetoInspeccion);
      }


      } catch (\Exception $e) {
        return response()->json("Error:_".$e);
      }
    }

    public function CalcularEdadReina2($fecha_nacimiento){
      $datenow=Carbon::now();
      $fecha_inicial=new Carbon($fecha_nacimiento);
      $edad=$fecha_inicial->diffInMonths($datenow);
      return $edad;
    }


    // reporte cosechas mes

    public function reporteCosechasMes(Request $request){
      try {
        $id_cuenta_usuario=$this->getAcountIdUserAuth();
        $colmena= new Colmena();
        $result=$colmena->getCosechasProducto($id_cuenta_usuario,$request->producto,$request->desde,$request->hasta);
        return response()->json($result);
      } catch (\Exception $e) {
          return response()->json("Error:_".$e);
      }

    }

    public function generarCodigoQR(){
      try {

      } catch (\Exception $e) {
        return response()->json("Error:_".$e);
      }

    }
}
