<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function roles(){
        
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function posts(){
        
        return $this->belongsToMany(Post::class, 'post_user');
    }


    public function hasAnyRoles($roles){
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }
        return false;
    }

    public function hasRole($role){
        if($this->roles()->where('name', $role)->first()){
            return true;
        }
        return false;
    }

    public function logInUser($id){
        
        return $this->id === $id;
    }

    public function isAdmin(){
          
        if($this->hasRole('admin')){
            return true;
        }else{
            return false;
        }
    }
    
    public function countAdmin(){
        $roles = Role::withCount('users')->get();
        foreach($roles as $role) {
            $adminCount = $role->users_count;
           return $adminCount;
        }
     }

     public function isAllowedToDeleteOwnAccount($id){
        if(($this->countAdmin() > 1 AND $this->id === $id) OR !$this->isAdmin()){
            return true;
        }else{
            return false;
        }
     
    }

    public function isAllowedToEditOwnAdminRole($id){
        if($this->isAdmin()){
            return true;
        }else{
            return false;
        }
     
    }
    public function canEditOwnAccount($id){
       if($this->hasAnyRoles(['admin', 'author', 'user']) AND Auth::user()->id === $id){
            return true;
        }else{
            return false;
        }
    }
    public function canDeletePost(){
       
            if( Auth::user()->isAdmin() === true){
                return true;
            }else{
                return false;
            }
        
       
     }


    /**
     * Create admin.
     *
     * @param array $details
     * @return array
     */
    public function createAdmin(array $details) : self
    {
        $adminRole = Role::where('name', 'admin')->first();

        $admin = User::create([
            'name' => $details['name'],
            'email' => $details['email'],
            'password' => \Hash::make($details['password'])
        ]);

        
        $admin->roles()->attach($adminRole);
      
        $admin->save();

        return $admin;
    }
       
         
}
