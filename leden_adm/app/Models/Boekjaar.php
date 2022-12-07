<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boekjaar extends Model
{
    use hasFactory;
    
    protected $fillable = [
        
        'contributie_id', 'jaar'
        
    ];
    
    
    /**
     * Linking boekjaar and contributie tables/models.
     */
    public function contributies()
    {
        return $this->belongsTo(Contributie::class);
    }
}
