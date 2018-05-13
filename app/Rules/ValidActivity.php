<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Teams\Activity;

class ValidActivity implements Rule
{
    protected $str;

    public function __construct()
    {
      $this->str = $value;
      try {
        $athlete = Activity::findOrFail($value);
      } catch (\Exception $e) {
        return false;
      }
      return true;
    }

  
    public function passes($attribute, $value)
    {
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Activity with id ' . $this->str . ' is not found.';
    }
}
