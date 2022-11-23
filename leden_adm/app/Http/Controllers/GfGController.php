<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leden;
use App\Models\User;
use App\Models\Role;

class GfGController extends Controller
{
    public function article() {
        
        
        $articles = Leden::all();
//         $articles = ['Article 1', 'Article 2'];
        return view('components.gfg', ['allLedens' => $articles]);
        //         return view('gfg', ['allLedens' => $articles]);
    }


   public function isPenny(User $user)
    
    {
        
        $data = (auth()->user()->email == 'admin@ledenadm.com');
	return view('/components.helo', ['data' => $data]);
        
    }

	public function isAdmin(User $user)
    
    {
        
        return 'admin@ledenadm.com';
	
        
    }

    public function roles()
    
    {
        $roles = Role::all();
        
        $users = User::all();
        
        return view('panel')
        ->with(['users'=> $users])
        ->with(['roles'=> $roles]);
	 
    }

}
