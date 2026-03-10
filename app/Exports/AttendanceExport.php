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

class AttendanceExport implements FromCollection, ShouldAutoSize, WithStyles, WithProperties, WithBackgroundColor, WithChunkReading, WithStrictNullComparison
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
            'title'          => 'Top2Tail Pet Summit Attendees',
            'description'    => 'List of Pet Summit Attendees',
            'subject'        => 'Pet Summit Attendees',
            'keywords'       => 'pet summit attendees,export,spreadsheet',
            'category'       => 'Attendees',
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
            'DAY COME',
        ];

        $data = [];

  
        $attendances = Summit::where('attendance', 1)->get();
         
      
        foreach($attendances as $attendance) {
            if ($attendance->updated_at == '2026-03-13') {
                $day = 'DAY 1';
            } elseif ($attendance->updated_at == '2026-03-14'){
                $day = 'DAY 2';
            } elseif ($attendance->updated_at == '2026-03-15'){
                $day = 'DAY 3';
            } else {
                $day = 'N/A';
            }

            $data[] = [
                $attendance->name,
                $attendance->email,
                $attendance->control_number,
                $day,
           
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
