<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributie extends Model
{
    use hasFactory;
    
    protected $fillable = [
        
        'familielid_id', 'soortlid', 'leeftijd', 'bedrag'
        
    ];
    
    
    /**
     * Linking contributie and boekjaar tables/models.
     */
    public function boekjaar()
    {
        return $this->belongsTo(Boekjaar::class);
    }
    
    /**
     * Linking contributie and soortlid tables/models.
     */
    public function soortleden()
    {
        return $this->hasMany(Soortlid::class, 'id');
    }
/**
     * Linking contributie and familielid tables/models.
     */
    public function lidContributie()
    {
        return $this->hasMany(Familielid::class, 'id');
    }
}
