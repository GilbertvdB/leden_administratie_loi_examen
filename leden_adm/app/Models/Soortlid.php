<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soortlid extends Model
{
    use hasFactory;
    
    protected $fillable = [
        
        'omschrijving', 'familielid_id'
        
    ];
    
    
    /**
     * Linking soortlid and familielid tables/models.
     */
    public function familielid()
    {
        return $this->belongsTo(Familielid::class);
    }
    
    /**
     * Linking soortlid and contributies tables/models.
     */
    public function contributies()
    {
        return $this->belongsTo(Contributie::class, 'id');
    }
}
