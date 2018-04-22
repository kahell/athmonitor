<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Teams\Teams;

class ValidTeam implements Rule
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
      $team = Teams::findOrFail($value);
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
      return 'Team with id ' . $this->str . ' is does not exists.';
  }
}
