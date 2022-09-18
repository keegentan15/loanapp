<?php

namespace App\Exports;

use App\Models\UserAccount;
use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ContactBookExport implements FromCollection, WithHeadings, WithColumnWidths
{
    protected $id;
    /**
    * @return \Illuminate\Support\Collection
    */
    function __construct($id){
        $this->id = $id;
    }
    public function columnWidths():array{
        return [
            'A' => 30,
            'B' => 20
        ];
    }
    public function collection()
    {
        return Contact::select('contact_name','contact_no')->where('user_id',$this->id)->get();
    }
    public function headings():array{
        return ["Contact Name","Phone number"];
    }
}
