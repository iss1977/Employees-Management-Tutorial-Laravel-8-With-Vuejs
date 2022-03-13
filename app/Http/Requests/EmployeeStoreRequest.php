<?php

namespace App\Http\Requests;

use DateTime;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class EmployeeStoreRequest extends FormRequest
{

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {

        // date from Vue request has the format : "YYYYMMDD" and must be converted
        if ($this->has('birthdate')){
            $this->merge([
                'birthdate' => Carbon::createFromFormat('Ymd', $this->birthdate)
            ]);
        }

        if ($this->has('date_hired')){
            $this->merge([
                'date_hired' => Carbon::createFromFormat('Ymd', $this->date_hired)
            ]);
        }

    }


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
            'first_name' => ['required'],
            'last_name'  => ['required'],
            'middle_name' => ['required'],
            'address' => ['required'],
            'country_id' => ['required', 'exists:countries,id'],
            'state_id'  => ['required', 'exists:states,id'],
            'department_id'  => ['required', 'exists:departments,id'],
            'city_id'  => ['required', 'exists:cities,id'],
            'zip_code' => ['required'],
            'birthdate' => ['required'],
            'date_hired'  => ['required'],
        ];
    }
}
