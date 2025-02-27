<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\Venue\Models\VenueDetails;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VenueExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $venues = VenueDetails::with(['venuettype', 'area'])->where('delete_status',0)->get();
        $venueArray = [];
        foreach($venues as $key => $venue){
            $venueArray[] = [
                $key+1,
                $venue->venuename ?? null,
                $venue->venuettype->venuetype_name ?? null,
                $venue->venueaddress ?? null,
                $venue->area->areaname ?? null,
                $venue->area->city->cityname ?? null,
                $venue->area->state->statename ?? null,
                $venue->area->district->districtname ?? null,
                $venue->contactperson ?? null,
                $venue->contactmobile ?? null,
                $venue->contacttelephone ?? null,
                $venue->contactemail ?? null,
                $venue->websitename ?? null,
                $venue->bookingprice ?? null,
                $venue->capacity ?? null,
                $venue->budgetperplate ?? null,
                $venue->food_type ?? null
            ];
        }
        return collect($venueArray);
    }

    public function headings(): array{
        return [
            "S.No",
            "Venue Name",
            "Venue Type",
            "Venue Address",
            "Venue Area",
            "Venue City",
            "Venue State",
            "Venue District",
            "Contact Person",
            "Contact Mobile",
            "Contact Telephone",
            "Contact Email",
            "Website Name",
            "Booking Price",
            "Capacity",
            "Budget Per Plate",
            "Food Type"
        ];
    }
}
