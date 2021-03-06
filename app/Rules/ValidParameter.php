<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Sports\Parameters;

class ValidParameter implements Rule
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
      $athlete = Parameters::findOrFail($value);
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
      return 'Parameter with id ' . $this->str . ' is not found.';
  }
}
