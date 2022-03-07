<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'name'
      ];



    /**
     * Get the country of this state
     */

     public function country(){
        return $this->belongsTo(Country::class);
     }

}
