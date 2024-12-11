<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\ExcelCoordinate;
use App\Models\ExcelData;

class ExcelController extends Controller
{
    public function showDashboard()
    {
        return view('dashboard');
    }

    public function uploadExcel(Request $request)
    {
        // Validar que el archivo sea Excel
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');
        $spreadsheet = IOFactory::load($file);

        // Obtenemos todas las hojas del archivo
        $sheets = $spreadsheet->getAllSheets();

        foreach ($sheets as $sheet) {
            // Obtener el número de filas y columnas de la hoja
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            // Recorrer todas las filas y columnas
            for ($row = 1; $row <= $highestRow; $row++) {
                for ($col = 'A'; $col <= $highestColumn; $col++) {
                    // Obtener el valor de la celda
                    $value = $sheet->getCell($col . $row)->getValue();

                    // Guardar las coordenadas en la tabla excel_coordinates
                    $coordinate = ExcelCoordinate::create([
                        'column' => $col,
                        'row' => $row,
                    ]);

                    // Guardar el dato en la tabla excel_data
                    ExcelData::create([
                        'coordinate_id' => $coordinate->id,
                        'value' => $value ?? null, // Guardar como null si no tiene valor
                    ]);
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Archivo Excel cargado y procesado exitosamente.');
    }
}
