<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Teams\Athletes;

class ValidAthlete implements Rule
{
  protected $str;
  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct()
  {
      //
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
    $this->str = $value;
    try {
      $athlete = Athletes::findOrFail($value);
    } catch (\Exception $e) {
      return false;
    }
    return true;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
      return 'Athlete with id ' . $this->str . ' is not found.';
  }
}
