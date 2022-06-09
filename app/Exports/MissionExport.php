<?php

namespace App\Exports;

use App\Models\Missions;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MissionExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        return [
            'mission',
            'client',
            'ville',
            'code_postal',
            'peage',
            'parking',
            'divers',
            'repas',
            'hotel',
            'km'
        ];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Missions::all();
    }
}
