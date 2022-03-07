<?php

namespace App\Http\Requests;

use App\Models\Country;
use Illuminate\Foundation\Http\FormRequest;

class StateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required','string', 'max:255', 'min:5']
        ];
    }

        /**
     * Configure the validator instance.
     * Bad country_id can be sended via manipulating html before sending form
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->countryIdInvalid($this->country_id)) {
                $validator->errors()->add('country_id', 'Country code does not exist. Don t touch the html elements!');
            }
        });
    }

    public function countryIdInvalid($countryId){
        return(Country::find($countryId) === null);
    }




}
