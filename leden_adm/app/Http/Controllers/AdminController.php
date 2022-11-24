<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct(){
        //
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Gate::allows('viewAny', User::class)) {

        $data = User::select('users.id', 'users.name', 'users.email', 'roles.naam')
        ->join('roles', 'roles.id', '=', 'users.role_id')
        ->get();
        
        return view('admin.index')
        ->with(['data'=> $data]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $this->authorize('update', User::class);
        $user = User::find($id);
        
        return view('admin.edit')->with(['user' => $user]);
//         return view('components.helo')->with(['test' => $gegevens]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user)
    {   
        $this->authorize('update', User::class);
        $rol = $request->get('rol_id');
        
        $update = User::find($user);
        $update->role_id = $rol;
        $update->save();
        
        return redirect(route('admin.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user) // removed type User
    {
        
        $test = User::find($user);
        $test->delete();
        
        return redirect(route('admin.index'));
    }
}
