<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Model\Teams\Athletes;

class ValidPhone implements Rule
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
        $phone = Athletes::where('phone_number',$value)->first();
        if(empty($phone)){
          return true;
        }else{
          return false;
        }
      } catch (\Exception $e) {
        return true;
      }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Phone with number ' . $this->str . ' is already used.';
    }
}
