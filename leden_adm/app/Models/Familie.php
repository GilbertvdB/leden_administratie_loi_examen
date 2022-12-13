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
    
    
    // this is the recommended way for declaring event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($familie) { // before delete() method call this
            $familie->familieLeden()->each(function($familielid) {
                $familielid->delete(); // <-- direct deletion
            });
        });
    }
}
