<?php

namespace App\Exports;
use App\Models\Summit;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;

use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrationExport implements FromCollection, ShouldAutoSize, WithStyles, WithProperties, WithBackgroundColor, WithChunkReading, WithStrictNullComparison
{
    public function chunkSize(): int
    {
        return 1000; // Number of rows per chunk
    }

    public function batchSize(): int
    {
        return 1000; // Number of rows per batch
    }

    public function backgroundColor()
    {
        return null;
    }

    public function properties(): array
    {
        return [
            'creator'        => 'Top2Tail | Pet Summit System',
            'lastModifiedBy' => 'T2T',
            'title'          => 'Top2Tail Pet Summit Registrations',
            'description'    => 'List of Pet Summit Registrations',
            'subject'        => 'Pet Summit Registrations',
            'keywords'       => 'pet summit registrations,export,spreadsheet',
            'category'       => 'Registrations',
            'manager'        => 'Pet Summit Application',
            'company'        => 'BREEDWINNER',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Title
            1 => [
                'font' => ['bold' => true, 'size' => 15],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'E7FDEC']
                ]
            ],
            // header
            3 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'ddfffd']
                ]
            ],
        ];
    }

    public function collection()
    {
        $header = [
            'NAME',
            'EMAIL',
            'CONTROL NUMBER',
            'DATE REGISTERED',
        ];

        $data = [];

  
        $registrations = Summit::all();
         
      
        foreach($registrations as $registration) {

            $data[] = [
                $registration->name,
                $registration->email,
                $registration->control_number,
                $registration->created_at->format('F d, Y'),
            ];
           
        }

        return new Collection([
            ['TOP2TAIL | PET SUMMIT SYSTEM'],
            [''],
            $header,
            $data
        ]);
    }
}
