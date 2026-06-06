<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TopsisService;

class TopsisController extends Controller
{
    // Muestra el formulario
    public function index()
    {
        return view('topsis.form');
    }

    // Procesa los datos del formulario
    public function calculate(Request $request)
    {
        // 1. Validar los datos que llegan del formulario
        $request->validate([
            'alternatives' => 'required|array',
            'alternatives.*.name' => 'required|string',
            'alternatives.*.values' => 'required|array',
        ]);

        // 2. Extraer los datos limpios (convertimos los valores string del input a floats)
        $alternativesInput = $request->input('alternatives');
        
        $alternatives = array_map(function ($alt) {
            return [
                'name' => $alt['name'],
                'values' => array_map('floatval', $alt['values'])
            ];
        }, $alternativesInput);

        // 3. Definir pesos y criterios (podrían venir del formulario, aquí los dejo fijos para el ejemplo)
        $weights = [0.5, 0.3, 0.2];
        $criteria = ["cost", "benefit", "benefit"];

        // 4. Instanciar el servicio y calcular
        $topsis = new TopsisService($alternatives, $weights, $criteria);
        $ranking = $topsis->rank();

        // 5. Retornar a la vista con los resultados
        return view('topsis.form', compact('ranking'));
    }
}