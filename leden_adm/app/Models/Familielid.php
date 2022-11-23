<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familielid extends Model
{
    use hasFactory;
    
    protected $fillable = [
        
        'naam','geboortedatum', 'familie_id', 'soortlid'
        
    ];
    
    
    /**
     * Linking familielid and familie tables/models.
     */
    public function familie()
    {
        return $this->belongsTo(Familie::class);
    }
    
    
    //
    /**
     * Linking familielid and soortlid.
     */
    public function soortleden()
    {
        return $this->hasOne(Soortlid::class);
    }

//
    /**
     * Linking familielid and contributie.
     */
    public function lidContributie()
    {
        return $this->hasOne(Contributie::class);
    }
}
