<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\{GuestCaretaker, Caretaker};

class CaretakerCheck implements ValidationRule
{
    protected $selectedGuests;

    public function __construct($selectedGuests){
        $this->selectedGuests = $selectedGuests;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $mappedGuests = GuestCaretaker::whereIn('guest_id', $this->selectedGuests)
            ->pluck('guest_id')
            ->toArray();

        if($mappedGuests){
            $fail('The selected guests are already mapped with some other caretaker.');
        }
    }
}
