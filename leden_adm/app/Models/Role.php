<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    //constants
    public const ADMIN = 1;
    public const VOORZITTER = 2;
    public const SECRETARIS = 3;
    public const PENNINGMEESTER = 4;
    public const ALGEMEEN = 5;


    protected $fillable = [
        'naam'        
    ];
    
   /**
     * Linking role and user.
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
