<?php

namespace App\Rules\DateTimeRules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DateComparator implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $finishAt = request()->input('finish_at');

        $availableAtDateTime = new \DateTime($value);
        $finishAtDateTime = new \DateTime($finishAt);


        if ($availableAtDateTime > $finishAtDateTime) {
            $fail('La fecha de inicio no puede ser menor a la fecha de finalización del evento');
        }

        if ($availableAtDateTime >= $finishAtDateTime) {
            $fail('La fecha de inicio no puede ser igual a la fecha de finalización del evento');;
        }

        $difference = $finishAtDateTime->diff($availableAtDateTime);

        if ($difference->y > 1) {
            $fail('El evento no puede durar mas de un año.');
        }
    }
}
