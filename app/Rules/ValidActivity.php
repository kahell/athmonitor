<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Teams\Activity;

class ValidActivity implements Rule
{
    protected $str;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
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

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
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
