<?PHP

namespace App\Livewire;

use Livewire\Component;
use Modules\Venue\Models\VenueDetails;
use Modules\Venue\Models\indialocation;
use Modules\Venue\Models\VenueType;
use Modules\Venue\Models\VenueAmenities;
use Illuminate\Support\Facades\Log;

class VenueSearch extends Component
{
    public $currentInstance;
    public $searchArea = '';
    public $searchType = '';
    public $searchSubtype = '';
    public $sortBy = '';
    public $selectedAmenities = []; // Array to store selected amenities
    public $areas;
    public $venuetypes;
    public $subtypes = [];
    public $venueamenities;

    public function mount($currentInstance = null)
    {
        // Load initial data for areas, venue types, and amenities
        $this->currentInstance = VenueDetails::first(); // Grabs the first venue

        // Emit an event whenever the instance is set or updated
         $this->dispatch('instanceUpdated', $this->currentInstance);
        

        $this->areas = indialocation::all();
        $this->venuetypes = VenueType::all();
        $this->venueamenities = VenueAmenities::all();
    }

    public function updatedSearchType($type)
    {
        // Dynamically load venue subtypes based on venue type
        $this->subtypes = VenueType::where('roottype', $type)->get()->toArray();
    }

    public function render()
    {
        Log::info('VenueSearch Filters:', [
            'searchArea' => $this->searchArea,
            'searchType' => $this->searchType,
            'searchSubtype' => $this->searchSubtype,
            'selectedAmenities' => $this->selectedAmenities,
            'sortBy' => $this->sortBy,
        ]);

        $query = VenueDetails::query();

        if ($this->searchArea) {
            $locations = indialocation::where('Areaname', 'like', '%' . $this->searchArea . '%')->pluck('id');
            Log::info('Matching Locations:', $locations->toArray());

            if ($locations->isNotEmpty()) {
                $query->whereIn('locationid', $locations);
            }
        }

        if ($this->searchType) {
            Log::info('Filtering by Venue Type:', ['venuetypeid' => $this->searchType]);
            $query->where('venuetypeid', $this->searchType);
        }

        if ($this->searchSubtype) {
            Log::info('Filtering by Venue Subtype:', ['venuesubtypeid' => $this->searchSubtype]);
            $query->where('venuesubtypeid', $this->searchSubtype);
        }

        if (!empty($this->selectedAmenities)) {
            Log::info('Filtering by Selected Amenities:', $this->selectedAmenities);
            $query->whereHas('venueamenities', function ($query) {
                $query->whereIn('id', $this->selectedAmenities);
            });
        }

        if ($this->sortBy) {
            Log::info('Applying Sort:', ['sortBy' => $this->sortBy]);
            switch ($this->sortBy) {
                case 'price_asc':
                    $query->orderBy('bookingprice', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('bookingprice', 'desc');
                    break;
                case 'featured':
                    $query->orderBy('featured', 'desc');
                    break;
                case 'alphabetical_asc':
                    $query->orderBy('venuename', 'asc');
                    break;
                case 'alphabetical_desc':
                    $query->orderBy('venuename', 'desc');
                    break;
            }
        }

        $venuelist = $query->get();
        Log::info('Filtered Venue List Count:', ['count' => $venuelist->count()]);

        Log::info('Rendering VenueSearch with data', [
            'venuelist' => $venuelist->toArray(),
            'Rendering_instance' => $this->currentInstance ?? '0'
        ]);

        $venuelist = $venuelist ?? null;
        $instance = $this->currentInstance ?? null;

        $arealocation = $this->areas;


        Log::info('Rendering _instance with data', $instance->toArray());

        // Return the view with the instance and filtered venue list
        return view('livewire.venue-search', compact('venuelist', 'instance','arealocation'));


        
    }

    public function boot()
{
    Livewire::listen('setSearchType', function ($event) {
        $this->searchType = $event['value'];
    });

    Livewire::listen('setsearchArea', function ($event) {
        $this->searchArea = $event['value'];
    });
}

    public function updated($propertyName, $value)
    {
        \Log::info("Livewire Updated: {$propertyName} => {$value}");
    }
}
