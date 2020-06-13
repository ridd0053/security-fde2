<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Gate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // abort(500);
            
        $adminCount;
        $users = User::where('id', '!=', Auth::user()->id)->get();
        $roles = Role::withCount('users')->get();
        foreach($roles as $role) {
            $adminCount = $role->users_count;
           //dd($adminCount);
        }
        // dd($roles);
        
        $loginUserId = Auth::user()->id;
        return view('admin.users.index')->with([
            'users' => $users,
            'loginUserId' => $loginUserId,
            'roles' => $roles,

            ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        if(Gate::denies('edit-users')){
            return redirect()->route('admin.users.index');
        }

       
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            
            ]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $user->roles()->sync($request->roles);

        $data = $request->validate([
            'name' => "required|max:255",
            'email' => 'required|max:255|email|unique:users,email,'. $user->id,
        ]);

        if($user->update($data)){

            $request->session()->flash('success', $user->name.' has been successfully updated!');
        }else{
            $request->session()->flash('error', 'A error has accured during updating the user' );
        }

        return redirect()->route('admin.users.index')->with('successMsg', $user->name . ' is gewijzigd.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if(Gate::denies('delete-users')){
            return redirect()->route('admin.users.index');

        }
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('admin.users.index')->with('successMsg', $user->name . ' is vewijderd.');
    }
}
