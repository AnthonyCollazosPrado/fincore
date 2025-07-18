<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prospecto\ProspectoDniStoreRequest;
use App\Http\Requests\Prospecto\ProspectoCeStoreRequest;
use App\Http\Requests\Prospecto\ProspectoRucStoreRequest;
use App\Http\Requests\Reporte\SunatReporteStoreRequest;
use App\Http\Requests\Supplier\SupplierStoreRequests;
use App\Models\SunatReport;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ProspectoController extends Controller {

    public function index() {
        return Inertia::render('prospecto/Index', [
            'prospectos' => Supplier::whereIn('tipo', ['Confirming', 'Factoring'])->get()
        ]);
    }

    public function prospecto() {
        return inertia('prospecto/Prospecto');
    }

    public function reporte(int $id) {
        $prospecto = DB::table('suppliers')->where('id', $id)->first();
        return Inertia::render('prospecto/Reporte', [
            'id' => $id,
            'prospecto' => $prospecto,
        ]);
    }

    public function guardarRuc(ProspectoRucStoreRequest $request){
        $data = $request->validated();
        $data['tipo_documento'] = 'ruc';
        $id = DB::table('suppliers')->insertGetId($data);
        return response()->json([
            'message' => 'Prospecto creado correctamente.',
            'id' => $id,
        ], 201);
    }

    public function guardarDni(ProspectoDniStoreRequest $request){
        $data = $request->validated();
        $data['tipo_documento'] = 'dni';
        $id = DB::table('suppliers')->insertGetId($data);
        return response()->json([
            'message' => 'Prospecto creado correctamente.',
            'id' => $id,
        ], 201);
    }
    public function guardarCe(ProspectoCeStoreRequest $request){
        $data = $request->validated();
        $data['tipo_documento'] = 'ce';
        $id = DB::table('suppliers')->insertGetId($data);
        return response()->json([
            'message' => 'Prospecto creado correctamente.',
            'id' => $id,
        ], 201);
    }

    public function guardarSunatReporte(SunatReporteStoreRequest $request){
        $data = $request->validated();
        $response = SunatReport::create($data);
        return response()->json([
            'message' => 'SunatReport creado correctamente.',
            'data' => $response,
        ], 201);
    }

    public function aceptante(int $id) {
        $prospecto = DB::table('suppliers')->where('id', $id)->get();
        $reporte = SunatReport::first();
        return Inertia::render('prospecto/Aceptante', [
            'id' => $id,
            'prospecto' => $prospecto,
            'reporte' => $reporte,
        ]);
    }

    public function guardarAceptante(SupplierStoreRequests $request, int $id) {
        $data = $request->validated();
        $data['id_factoring'] = $id;
        $data['tipo'] = 'Factoring Aceptante';
        $id_aceptante = DB::table('suppliers')->insertGetId($data);
        Log::debug('$id');
        Log::debug($id);
        Log::debug('$id_aceptante');
        Log::debug($id_aceptante);
        //$response = DB::table('suppliers')->where('id', $id)->update(['id_factoring' => $id_aceptante]);
        return response()->json([
            'message' => 'Aceptante guardado correctamente.',
            'id' => $id
        ], 201);
    }
}
