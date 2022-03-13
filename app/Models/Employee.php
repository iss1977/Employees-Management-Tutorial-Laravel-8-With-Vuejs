<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name' ,
        'middle_name',
        'address',
        'country_id',
        'state_id' ,
        'department_id' ,
        'city_id' ,
        'zip_code',
        'birthdate',
        'date_hired' ,
    ];

    /** the following cast is needed if we don't have a "prepareForValidation" method in "EmployeeStoreRequest" form validation */
    /** it's work with or without it */
    protected $cast = [
        'birthdate' => 'datetime: Y-m-d',
        'date_hired' => 'datetime:Y-m-d'
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }





}
