<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Image;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
      
        $roles = Role::all();
        return view('home', compact('roles'));
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
        Auth::user()->roles()->sync($request->roles);

        $data = $request->validate([
            'name' => "required|max:255",
            'email' => 'required|max:255|email|unique:users,email,'. Auth::user()->id,
        ]);

        if(Auth::user()->update($data)){

            $request->session()->flash('success', Auth::user()->name.' has been successfully updated!');
        }else{
            $request->session()->flash('error', 'A error has accured during updating the user' );
        }
      
            return redirect()->route('home')->with('successMessage', 'Je hebt je account in goed orde gewijzigd');
        
    }
          /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAvatar(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time().".".$avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(250, 250)->save(public_path('/images/avatar/'.$filename));
            $user = Auth::user();
            $user->avatar = $filename;

            //validate
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png'
            ]);
            $user->save();
            return redirect()->route('home')->with('successMessage', 'U heeft uw profielfoto in goed orde gewijzigd');     
        }
        
    }
    public function changePassword(Request $request){
        if(!(Hash::check($request->get('current_password'), Auth::user()->password))){
            return back()->with('error', 'Uw huidige wachtwoord komt niet overeen met wat u heeft ingevuld.');
        }
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            return back()->with('error', 'Uw nieuwe wachtwoord kan niet hetzelfde zijn als uw oude wachtwoord.');
        }
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return back()->with('successMessage', 'Uw wachtwoord is succesvol gewijzigd.');
    }


       /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user = Auth::user();
        $user->roles()->detach();
        $user->delete();
        return redirect('/');
    }
}
