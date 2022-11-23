<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familie extends Model
{
    use hasFactory;
    
    protected $fillable = [
        
        'naam','adres'
        
    ];
    
    
    /**
     * Linking familie and familielid tables/models.
     */
    public function familieLeden()
    {
        return $this->hasMany(Familielid::class);
    }
}
