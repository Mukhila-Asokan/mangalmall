<?php

namespace App\Imports;

use App\Models\GuestContact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuestImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GuestContact([
            'name'     => $row['name'],
            'email'    => $row['email'], 
            'mobile_number' => $row['mobile_number'],
            'whatsapp_number' => $row['whatsapp_number'],
            'relationship' => $row['relation'],
            'location' => $row['location'],
            'notes' => $row['notes'],
            'created_by' => auth()->user()->id
        ]);
    }
}
