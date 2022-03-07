<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable =[
        'country_code',
        'name'
    ];


     /**
     * Get the user that belongs to this country.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the states from country
     */
    public function states(){
        return $this->hasMany(State::class);
    }




}
