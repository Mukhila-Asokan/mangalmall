<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Modules\Venue\Models\VenueDetails;
use Modules\VenueAdmin\Models\{VenueBooking, VenueBookingDetails};

class VenueAvailability implements ValidationRule
{
    protected $startDate;
    protected $endDate;
    protected $venueId;
    protected $dayTypes;
    protected $bookingId;


    public function __construct($startDate, $endDate, $venueId, $dayTypes, $bookingId = null)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->venueId = $venueId;
        $this->dayTypes = $dayTypes;
        $this->bookingId = $bookingId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->bookingId){
            $bookedDates = VenueBooking::where('venue_id', $this->venueId)
            ->where('id', '!=', $this->bookingId)
            ->where(function ($query) {
                $query->whereBetween('start_date', [$this->startDate, $this->endDate])
                    ->orWhereBetween('end_date', [$this->startDate, $this->endDate])
                    ->orWhere(function ($q) {
                        $q->where('start_date', '<=', $this->startDate)
                            ->where('end_date', '>=', $this->endDate);
                    });
            })
            ->exists();
        }
        else{
            $bookedDates = VenueBooking::where('venue_id', $this->venueId)
                ->where(function ($query) {
                    $query->whereBetween('start_date', [$this->startDate, $this->endDate])
                        ->orWhereBetween('end_date', [$this->startDate, $this->endDate])
                        ->orWhere(function ($q) {
                            $q->where('start_date', '<=', $this->startDate)
                                ->where('end_date', '>=', $this->endDate);
                        });
                })
                ->exists();
            }

        if ($bookedDates) {
            $requestedDates = array_map(fn($key) => str_replace('daytype-', '', $key), array_keys($this->dayTypes));

            $bookedDetails = VenueBookingDetails::where('venue_id', $this->venueId)
                ->whereIn('date', $requestedDates)
                ->select('date', 'daytype')
                ->get();

            foreach ($bookedDetails as $booking) {
                $dateKey = $booking->date;
                if ($booking->daytype == 'full' || $this->dayTypes["daytype-$dateKey"] == 'full') {
                    $fail('The venue is not available for the selected dates and times.');
                    return;
                }
                if (isset($this->dayTypes["daytype-$dateKey"]) && $this->dayTypes["daytype-$dateKey"] == $booking->daytype) {
                    $fail('The venue is not available for the selected dates and times.');
                    return;
                }
            }
        }
    }
}
