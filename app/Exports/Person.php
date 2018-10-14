<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Election;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class Person implements FromQuery, WithMapping
{
    /**`
    * @return \Illuminate\Support\Collection
    */
    /*  public function collection()
    {
        return Election::all();
    } */
    protected $filter;
    protected $search_by;
    protected $search;
    
    public function __constructor($filter,$search,$search_by){

        $this->filter = $filter;
        $this->search = $search;
        $this->search_by = $search_by;

    }

    use Exportable;
    public function query()
    {
        if($this->filter === 'voted') {
            return Election::where('voting',true);
        } else if($this->filter === 'not_voted') {
            return Election::where('voting',false);
        }

        return Election::query();
    }

    public function map($election): array{

        return [
            $election->seq_number,
            $election->first_name
        ];
    }

    public function headings(): array{

        return [
            'מספר סידורי',
            'קלפי'
        ];
    }
}
