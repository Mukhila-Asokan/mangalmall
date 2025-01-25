<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\Venue\Models\VenueDetails;

class VenueSearch extends Component
{
    public function render()
    {

         $venuelist = VenueDetails::where('locationid', 'like', '%' . $this->search . '%')->get();
        return view('livewire.venue-search', [
            'venuelist' => $venuelist
        ]);
    }
}
