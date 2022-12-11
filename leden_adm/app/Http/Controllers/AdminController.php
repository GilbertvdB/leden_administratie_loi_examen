<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Gate::allows('viewAny', User::class)) {

        $users_info = User::select('users.id', 'users.name', 'users.email', 'roles.naam')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->get();
        
        return view('admin.index')
        ->with(['gebruikers'=> $users_info]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User Id string  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $this->authorize('update', User::class);
        $user = User::find($id);
        
        return view('admin.edit')->with(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User Id string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->authorize('update', User::class);
        $rol = $request->get('rol_id');
        
        $update = User::find($id);
        $update->role_id = $rol;
        $update->save();
        
        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     ** @param  \Illuminate\Http\Request  $request
     * @param  User ID user $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->authorize('delete', User::class);
        $user_id = $request->get('user-id');
        $user = User::find($user_id);
        $user->delete();
        
        return redirect(route('admin.index'));
    }
}
