<?php

namespace App\Http\Controllers;

use App\Models\DataCompare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MergedDataExport implements FromCollection, ShouldAutoSize, WithStyles, WithEvents
{
    private $mergedData;

    public function __construct($mergedData)
    {
        $this->mergedData = $mergedData;
    }

    public function collection()
    {
        return collect($this->mergedData);
    }

    public function styles(Worksheet $sheet)
    {
        // Apply styles to the merged Excel file
        foreach ($this->mergedData as $key => $mergedRow) {
            if ($mergedRow['merged']) {
                // Assuming the first column is the unique identifier
                $columnToHighlight = 'A';
            
                // Cast $key to integer before adding 2
                $cellToHighlight = $columnToHighlight . ((int)$key + 2);
            
                $sheet->getStyle($cellToHighlight)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('f8f9fd');
            }
        }
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Auto-filter for all columns
                $highestRow = $event->sheet->getDelegate()->getHighestRow();
                $highestColumn = $event->sheet->getDelegate()->getHighestColumn();
                $autoFilterRange = "A1:{$highestColumn}{$highestRow}";
                            
                $event->sheet->getDelegate()->setAutoFilter($autoFilterRange);

            },
        ];
    }
}

class DataCompareController extends Controller
{
    public function index() {
        $data = DataCompare::latest()->get();
        return view('dashboard', compact('data'));
    }

    private function mergeData($data1, $data2)
    {
        // Perform comparison and merging logic here
        $mergedData = [];

        foreach ($data1 as $index => $row1) {
            $row2 = $data2[$index];

            // Assuming the first column is the unique identifier for each row
            $key = $row1[0];

            // Compare rows and merge if they are the same
            $mergedData[$key] = [
                'data1' => $row1,
                'data2' => $row2,
                'merged' => $row1 == $row2,
            ];
        }

        return $mergedData;
    }

    public function preview(Request $request)
    {
        $data1 = collect();
        $data2 = collect();

        if ($request->hasFile('data_pertama') && $request->hasFile('data_kedua')) {
            $file1 = $request->file('data_pertama')->getRealPath();
            $file2 = $request->file('data_kedua')->getRealPath();

            $data1 = Excel::toCollection(null, $file1)->first();
            $data2 = Excel::toCollection(null, $file2)->first();

            $mergedData = $this->mergeData($data1, $data2);

            // Save the merged data to the public/files directory
            $fileName = 'merged_data_' . now()->format('YmdHis') . '.xlsx';
            $filePath = storage_path('public/files/' . $fileName);
            Excel::store(new MergedDataExport($mergedData), 'public/files/' . $fileName);

            return view('preview', compact('mergedData', 'fileName'));
        }

        return view('preview', compact('data1', 'data2'));
    }
    public function download($files)
    {
        $filePath = storage_path('app/public/files/' . $files);
    
        if (file_exists($filePath)) {
            return response()->download($filePath, $files);
        } else {
            return view('404');
        }
    }

    
}